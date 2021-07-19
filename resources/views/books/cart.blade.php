@extends('layouts.store')

@section('content')
@section('styles')
<link rel="stylesheet" href="{{asset('css/cartstyles.css')}}">
@endsection

<div class="container">
    <header class="bg-light py-1">
        <div class="container px-4 px-lg-5 my-1">
            <div class="text-center text-dark">
                <h1 class="display-4 fw-bolder">Your Cart</h1>

            </div>
        </div>
    </header>

    <div class="card">
        <div class="row">
            <div class="col-md-8 cart">
                <div class="title">
                    <div class="row">
                        <div class="col">
                            <h4><b>Shopping Cart</b></h4>
                        </div>
                        <div class="col align-self-center text-right text-muted">3 items</div>
                    </div>
                </div>

                @if($books->count() > 0)
                @foreach($books as $book)
                <div class="row">
                    <div class="row main align-items-center">
                        <div class="col-2"><img class="img-fluid" src="{{$book->image}}"></div>
                        <div class="col">
                            <div class="row">{{Str::limit($book->name, 15)}}</div>
                        </div>
                        <div class="col"> <a href="#">-</a><a href="#" class="border">{{$book->quantity}}</a><a
                                href="#">+</a> </div>
                        <div class="col">${{$book->price}}<span class="close">&#10005;</span></div>
                    </div>
                </div>
                @endforeach
                @endif

                <div class="back-to-shop"><a href="#">&leftarrow;</a><span class="text-muted">Back to shop</span></div>
            </div>
            <div class="col-md-4 summary">
                <div>
                    <h5><b>Summary</b></h5>
                </div>
                <hr>
                <div class="row">
                    <div class="col" style="padding-left:0;">Total books </div>
                    <div class="col text-right">{{$cartTotalQuantity}}</div>
                </div>

                <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                    <div class="col">TOTAL PRICE</div>
                    <div class="col text-right">${{$subTotal}}</div>
                </div>
                <form action="{{route('book.pay', ['cart_total'=>$subTotal, 'user_id'=>auth()->id()])}}" method="POST">
                    @csrf
                <button type="submit" class="btn btn-success">CHECKOUT with M-PESA</button>
                </form>


                
            </div>
        </div>
    </div>
</div>
@endsection