<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0"
          name="viewport">
    <meta content="ie=edge" http-equiv="X-UA-Compatible">

    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{asset("css/style.css")}}" rel="stylesheet">
    <title>yu-gi-oh Cart Home</title>
</head>
<body class="p-0 m-0 row">
<header class="container-fluid px-0">
    <!-- navbar phone-->
    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container-fluid border-bottom border-bottom-lg-0">
            <a class="navbar-brand" href="{{route("home_frontend")}}">
                <h1 class="text-dark">
                    <i class="bi bi-cart3 text-success"></i>
                    Yugi's Cart
                </h1>
            </a>
            <div class="d-flex align-items-center">
                <div class="d-lg-none">
                    <a href="#" class="text-reset" data-bs-toggle="modal" data-bs-target="#userModal">
                        <i class="bi bi-person-circle me-1"></i>
                    </a>
                    <a class="text-dark" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                       href="#offcanvasExample" role="button" aria-controls="offcanvasRight">
                        <i class="bi bi-bag-check me-2"></i>
                    </a>
                </div>
                <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
                        class="navbar-toggler border-green" data-bs-target="#navbarSupportedContent"
                        data-bs-toggle="collapse" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="d-flex w-100 my-2" role="search">
                    <input aria-label="Search" class="form-control me-2" placeholder="Search" type="search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-lg-none">
                    <li class="nav-item">
                        <a aria-current="page" class="nav-link active" href="{{route("home_frontend")}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route("shop")}}">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route("cart")}}">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route("contact")}}">contact</a>
                    </li>
                </ul>
                <div class="d-none d-lg-block w-50 d-lg-flex justify-content-end">
                    <a href="#" class="text-reset" data-bs-toggle="modal" data-bs-target="#userModal">
                        <i class="bi bi-person-circle me-1"></i>
                    </a>
                    <a class="text-dark" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                       href="#offcanvasExample" role="button" aria-controls="offcanvasRight">
                        <i class="bi bi-bag-check me-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!--model-->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4">
                <div class="modal-header border-0">
                    <h5 class="modal-title fs-3 fw-bold" id="userModalLabel">Sign Up</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="fullName" placeholder="Enter Your Name" required="">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter Email address" required="">
                        </div>
                        <div class="mb-5">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter Password" required="">
                        </div>
                        <button type="submit" class="btn btn-primary">Sign Up</button>
                    </form>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    Already have an account? <a href="#">Sign in</a>
                </div>
            </div>
        </div>
    </div>
    <!--  sidebar cart  -->
    <div class="offcanvas offcanvas-end show" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel"
         aria-modal="true" role="dialog">
        <div class="offcanvas-header border-bottom">
            <div class="text-start">
                <h5 id="offcanvasRightLabel" class="mb-0 fs-4">Shop Cart</h5>
            </div>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form method="post" action="{{action('App\Http\Controllers\HomeController@updateQuantityBulk')}}"
                  enctype="multipart/form-data">
                @csrf
                @method('POST')
                <ul class="list-group list-group-flush">
                    @if(request()->session()->has('cart'))
                        @foreach($cart as $item)
                            <li class="list-group-item py-3 ps-0 border-bottom">
                                <div class="row align-items-center">
                                    <div class="col-6 col-md-6 col-lg-4">
                                        <div class="d-flex">
                                            <img src="{{$item['product_image']}}" alt="{{$item['product_name']}}"
                                                 class="img-fluid">
                                            <div class="ms-3">
                                                <a href="../pages/shop-single.html"
                                                   class="text-dark text-decoration-none">
                                                    <h6 class="mb-0">{{$item['product_name']}} </h6>
                                                </a>
                                                <div class="mt-2 small lh-1">
                                                    <a href="{{route('removeItem', $item['product_id'])}}"
                                                       class="text-decoration-none d-flex">
                                        <span class="me-1 align-text-center">
                                            <i class="bi bi-trash text-green"></i>
                                        </span>
                                                        <p class="text-decoration-none text-black">Remove</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-4 col-lg-6 mt-4">
                                        <div class="input-group d-flex">

                                            <input type="number" step="1" max="1000" min="1"
                                                   value="{{$item['quantity']}}"
                                                   name="items[{{$loop->index}}][quantity]"
                                                   class="quantity-field form-control-sm form-input">
                                            <input class="form-control form-control-sm" type="hidden"
                                                   name="items[{{$loop->index}}][id]"
                                                   value="{{$item['product_id']}}">


                                        </div>
                                    </div>
                                    <div class="col-2 col-md-2 col-lg-2 text-lg-end text-start text-md-end ">
                                        <span class="fw-bold">&euro;{{$item['product_price']*$item['quantity']}}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{route('shop')}}" class="btn bg-green">Continue Shopping</a>
                    <button type="submit" class="btn btn-dark">Update Cart</button>
                </div>
            </form>
        </div>
    </div>
    <!-- navbar big screen-->
    <nav class="navbar navbar-expand-lg bg-green d-lg-block d-none ">
        <div class="container-fluid">
            <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
                    class="navbar-toggler" data-bs-target="#navbarSupportedContent"
                    data-bs-toggle="collapse" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-5 me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a aria-current="page" class="nav-link active text-white ps-0"
                           href="{{route("home_frontend")}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route("shop")}}">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route("cart")}}">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route("contact")}}">contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
