@extends('layouts.store')

@section('content')
<!-- Product section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{$book->image}}" alt="..." /></div>
            <div class="col-md-6">
                <div class="small mb-1">{{$book->id}}</div>
                <h1 class="display-5 fw-bolder">{{$book->title}}</h1>
                <div class="fs-5 mb-5">
                    <span class="text-decoration-line-through">$45.00</span>
                    <span>{{$book->price}}</span>
                </div>
                <p class="lead">{{$book->desc}}</p>
                <div >
                    <form class="d-flex" action="{{route('cart.add', $book->id)}}" method="POST">
                        @csrf
                        <input class="form-control text-center me-3" name="quantity" value="1"
                            style="max-width: 3rem" />
                        <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Add to cart
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Related items section-->
<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Related products</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">





            @if($books->count() > 0)
            @foreach($books as $book)

            <div class="col mb-5">
                <a href="{{route('book', $book->id)}}">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="{{$book->image}}" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">{{$book->title}}</h5>
                                <!-- Product price-->
                                {{$book->price}}
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            @endforeach
            @endif





            @endsection