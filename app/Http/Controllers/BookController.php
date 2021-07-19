<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Transaction;
use App\Models\Payment;
use Cart;

class BookController extends Controller
{
    public function welcome()
    {
        $books = Book::latest()->get();
       
        return view('welcome', compact('books'));
    }
    public function transactions()
    {
        $trans = Transaction::latest()->get();
       
        return view('books.transactions', compact('trans'));
    }

     public function payments()
    {
        $pays = Payment::latest()->get();
       
        return view('books.payments', compact('pays'));
    }

    public function create()
    {
        return view('books.create');
    }
    public function store(Request $request)
    {
        $request->validate([
           'title'=>'required',
           'price'=>'required',
           'desc'=>'required',
       ]);

        Book::create($request->all());
        return back();
    }
    public function book($id)
    {
        $book = Book::find($id);
        $books = Book::latest()->get();

        return view('books.book', compact('book', 'books'));
    }

    public function addToCart(Request $request, $id)
    {
        $book = Book::find($id);
        $rowId = $id; // generate a unique() row ID
        $userID = auth()->id(); // the user ID to bind the cart contents
        $quantity= $request->quantity;
        Cart::add(array(
        'id' => $rowId,
        'name' => $book->title,
        'price' => $book->price,
        'quantity' =>$quantity,
        'image'=>$book->image
));

        $books = \Cart::getContent();
        $subTotal = Cart::getSubTotal();
        $cartTotalQuantity = Cart::getTotalQuantity();
        return view('books.cart', compact('books','subTotal','cartTotalQuantity'));
    }

    public function cart()
    {   $books = \Cart::getContent();
        $subTotal = Cart::getSubTotal();
        $cartTotalQuantity = Cart::getTotalQuantity();
        return view('books.cart', compact('books','subTotal','cartTotalQuantity'));
    }

     public function download()
        {   $books = \Cart::getContent();
            
            return view('books.download');
        }
}
