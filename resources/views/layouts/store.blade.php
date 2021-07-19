<?php
 $cartbooks = \Cart::getContent();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Buy BOOK</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset('storage/css/styles.css')}}" rel="stylesheet" />
    @yield('styles')
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="/">Book Store</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Home</a></li>
                     <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{route('payments')}}">Payments</a></li>
                      <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{route('transactions')}}">Transactions</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/">Actions</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="{{route('book.create')}}">Post a Book</a></li>

                            <li><a class="dropdown-item" href="/">Books</a></li>

                            @auth
                            <li><a class="dropdown-item" href="#!"> {{auth()->user()->name}}</a></li>
                            @endauth

                            <li><form action="{{route('logout')}}" method="POST">
                                @csrf
                                <input type="submit" class="btn btn-success" value="Logout" >
                            </form></li>
                        </ul>
                    </li>
                    @guest
                    <li class="nav-item mx-3"><a class="nav-link active btn btn-primary " aria-current="page"
                            href="/register">Register</a></li>
                    <li class="nav-item"><a class="nav-link active btn btn-success" aria-current="page"
                            href="/login">Login</a></li>
                    @endguest

                    @auth
                    <li><a class="dropdown-item" href="#!"> {{auth()->user()->name}}</a></li>
                    @endauth
                </ul>
                <form class="d-flex">
                    <a  href="{{route('cart')}}" class="btn btn-outline-dark" >
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill">{{$cartbooks->count()}}</span>
</a>
                </form>
            </div>
        </div>
    </nav>
    <!-- Header-->
    @yield('content');

    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{asset('storage/js/scripts.js')}}"></script>
</body>

</html>