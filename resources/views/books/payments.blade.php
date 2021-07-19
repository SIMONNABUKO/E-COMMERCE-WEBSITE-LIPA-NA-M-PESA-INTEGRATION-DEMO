@extends('layouts.store')
@section('content')
<div class="container mt-5 py-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">User</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Date</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @if($pays->count() > 0)
                        @foreach($pays as $pay)
                        <tr>
                        <th scope="row">{{$pay->mpesa_trans_id}}</th>
                        <td>{{$pay->user->name}}</td>
                        <td>{{$pay->amount}}</td>
                        <td>{{$pay->phone}}</td>
                        <td>{{$pay->created_at}}</td>
                    </tr>
                        @endforeach
                    @endif
                   
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection