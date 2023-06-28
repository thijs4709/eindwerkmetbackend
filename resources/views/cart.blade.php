<x-header></x-header>

<main class="container-fluid col-12 col-lg-10 offset-lg-1">
    <section>
        <div class="my-5">
            <header>
                <h2>Shop Cart</h2>
            </header>
        </div>
        @if(!auth()->check())
            <h3 class="text-grey mb-3 text-danger fw-bold fw">You must have an accout to pay for your order.</h3>
        @endif
        <div class="row my-5">
            <div class="col-12  col-xl-8">
                <ul class="list-group list-group-flush">
                    @foreach($cart as $item)
                        <li class="list-group-item py-3 py-lg-0 px-0 border-top">
                            <div class="row align-items-center my-2">

                                <div class="col-3 col-md-2 col-lg-2">
                                    <img src="{{$item['product_image']}}" alt="{{$item['product_name']}}"
                                         class="img-fluid">
                                </div>
                                <div class="col-4 col-md-3 col-lg-3">
                                    <a href="#" class="text-decoration-none text-black">
                                        <h6 class="mb-0">
                                            {{$item['product_name']}}
                                        </h6>
                                    </a>
                                    <div class="mt-2 small lh-1">
                                        <a href="{{route('removeItem', $item['product_id'])}}" class="text-decoration-none d-flex">
                                        <span class="me-1 align-text-center">
                                            <i class="bi bi-trash text-green"></i>
                                        </span>
                                            <p class="text-decoration-none text-black">Remove</p>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-12 col-md-5 col-lg-5 py-4 py-lg-0">
                                    <div class="input-group ">
                                        <form method="post" action="{{route('quantity')}}" enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <input type="number" step="1" max="1000" min="1" value="{{$item['quantity']}}" name="quantity"
                                                   class="quantity-field form-control-sm form-input">
                                            <input class="form-control form-control-sm" type="hidden" name="id" value="{{$item['product_id']}}">
                                            <button type="submit" class="btn border border-green rounded-3 ms-2 bg-green text-white">Update price</button>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-2 col-md-2 col-lg-2 text-lg-end text-start text-md-end">
                                    <span class="fw-bold">&euro;{{$item['product_price']*$item['quantity']}}</span>

                                </div>
                            </div>

                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-12  col-xl-4">
                <div class="mt-5 mt-lg-0 card p-4">
                    <div class="card mb-3">
                        <h5 class="py-2 px-3">Summary</h5>
                    </div>
                    <div class="card">
                        <div class="d-flex justify-content-between py-2 px-3">
                            <p>item Subtotal</p>
                            <p>{{Session::has('cart') ? Session::get('cart')->totalPrice:'0'}} &euro;</p>
                        </div>
                        @auth()
                        <div class="py-2 px-3">
                            <div class="btn bg-green  d-flex rounded-4 justify-content-between align-items-center">
                                <a href="{{route("checkout")}}" class="text-white text-decoration-none"> Go to Checkout</a>
                                <p class="text-white">
                                    {{Session::has('cart') ? Session::get('cart')->totalPrice:'0'}} &euro;</p>
                            </div>
                        </div>
                        @endauth

                    </div>

                </div>
            </div>
        </div>

    </section>

</main>

<x-footer></x-footer>
