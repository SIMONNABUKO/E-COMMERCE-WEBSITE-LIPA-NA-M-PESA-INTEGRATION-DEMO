<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mpesa;
use App\Models\User;
use App\Models\Book;
use App\Models\Transaction;
use App\Models\Payment;
use Str;
use Session;

class MpesaController extends Controller
{
    public function stkSimulation(Request $request, $cart_total, $user_id)
    {
        $user = User::find($user_id);
        $cart = \Cart::getContent();
        $transId = Str::random().$cart_total.$user_id;
        $transexists = Transaction::where('user_id', $user_id)->where('status', 0)->first();
        if($transexists){
            session()->flash('error','You still have a pending transaction!');
            return redirect()->route('transactions');
        }
        $trans = new Transaction;
        $trans->user_id = $user_id;
        $trans->transaction_id =$transId;
        $trans->cart = json_encode($cart);
        $trans->save();
        $phone =  $user->phone;
        $formatedPhone = substr($phone, 1);//726582228
        $code = "254";
        $phoneNumber = $code.$formatedPhone;//254726582228
        $mpesa= new \Safaricom\Mpesa\Mpesa();
        $BusinessShortCode=174379;
        $LipaNaMpesaPasskey=env('MPESA_PASS_KEY');
        $TransactionType="CustomerPayBillOnline";
        $Amount=$cart_total;
        $PartyA=$phoneNumber;
        $PartyB=174379;
        $PhoneNumber=$phoneNumber;
        $CallBackURL="https://39a177fa4e25.ngrok.io/api/mpesa/stkpush/response";
        $AccountReference="Simon's Tech School Payment";
        $TransactionDesc="lipa Na M-PESA web development";
        $Remarks="Thank for paying!";
        
        $stkPushSimulation=$mpesa->STKPushSimulation(
            $BusinessShortCode,
            $LipaNaMpesaPasskey,
            $TransactionType,
            $Amount,
            $PartyA,
            $PartyB,
            $PhoneNumber,
            $CallBackURL,
            $AccountReference,
            $TransactionDesc,
            $Remarks
        );

        \Cart::clear();
        return redirect()->route('transactions');
    }

    public function resData(Request $request)
    {
        $response = json_decode($request->getContent());
        $resData =  $response->Body->stkCallback->CallbackMetadata;
        $reCode =$response->Body->stkCallback->ResultCode;
        $resMessage =$response->Body->stkCallback->ResultDesc;
        $amountPaid = $resData->Item[0]->Value;
        $mpesaTransactionId = $resData->Item[1]->Value;
        $paymentPhoneNumber =$resData->Item[4]->Value;
        //replace the first 254 with 0
        $formatedPhone = str_replace("254","0",$paymentPhoneNumber);
        $user = User::where('phone', $formatedPhone)->first();
        $trans = Transaction::where('user_id', $user->id)->where('status', 0)->first();
        $transId = $trans->id;
        $payment = new Payment;
        $payment->amount = $amountPaid;
        $payment->trans_id =  $transId;
        $payment->user_id = $user->id;
        $payment->mpesa_trans_id = $mpesaTransactionId;
        $payment->phone = $formatedPhone;
        $payment->save();
        $trans->status = 1;
        $trans->save();

    }
}
