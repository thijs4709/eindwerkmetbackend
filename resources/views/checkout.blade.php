<x-header></x-header>

<main class="container-fluid row m-0 ps-2">
    <section class="col-12 col-lg-10 offset-lg-1 px-0">
        <header class="my-4">
            <h2>checkout</h2>
        </header>

        <div class="row p-4 mb-5">
            <div class="accordion col-12 col-lg-6" id="accordionExample">
                <form action="">
                    <!--adress-->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button aria-controls="collapseOne" aria-expanded="true" class="accordion-button fw-bold"
                                    data-bs-target="#collapseOne" data-bs-toggle="collapse" type="button">
                                <i class="bi bi-geo-alt me-2 text-dark"></i>Add delivery address
                            </button>
                        </h2>
                        <div aria-labelledby="headingOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample"
                             id="collapseOne">
                            <div class="accordion-body">
                                <input id="street" type="text" class="form-control mb-2" placeholder="street" required>
                                <input id="streetNumber" type="number" class="form-control mb-2" placeholder="street number" required>
                                <input id="stad" type="text" class="form-control mb-2" placeholder="city" required>
                                <input id="stadNummer" type="number" class="form-control mb-2" placeholder="city number" required>
                            </div>
                        </div>
                    </div>
                    <!--time-->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button aria-controls="collapseTwo" aria-expanded="false" class="accordion-button collapsed fw-bold"
                                    data-bs-target="#collapseTwo" data-bs-toggle="collapse" type="button">
                                <i class="bi bi-clock text-dark me-2"></i>Delivery Time
                            </button>
                        </h2>
                        <div aria-labelledby="headingTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample"
                             id="collapseTwo">
                            <div class="accordion-body">
                                <label for="deliverlyTime"></label>
                                <input type="date" id="deliverlyTime" name="deliverlyTime" min="{{ now()->addDays(2)->format('Y-m-d') }} " required>>
                            </div>
                        </div>
                    </div>
                    <!--instructions-->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button aria-controls="collapseThree" aria-expanded="false" class="accordion-button collapsed fw-bold"
                                    data-bs-target="#collapseThree" data-bs-toggle="collapse" type="button">
                                <i class="bi bi-bag-check me-2 text-dark"></i>Delivery instructions
                            </button>
                        </h2>
                        <div aria-labelledby="headingThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample"
                             id="collapseThree">
                            <div class="accordion-body">
                                <label class="form-label" for="DeliveryInstructions">Delivery instructions</label>
                                <textarea class="form-control" id="DeliveryInstructions" placeholder="Write delivery instructions"
                                          rows="3"></textarea>
                                <p class="form-text">Add instructions for how you want your order shopped and/or
                                    delivered</p>
                            </div>
                        </div>
                    </div>
                </form>
                <!--pay-->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button aria-controls="collapseFour" aria-expanded="false" class="accordion-button collapsed fw-bold"
                                data-bs-target="#collapseFour" data-bs-toggle="collapse" type="button">
                            <i class="bi bi-credit-card me-2 text-dark"></i>Pay
                        </button>
                    </h2>
                    <div aria-labelledby="headingFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample"
                         id="collapseFour">
                        <div class="accordion-body">
                            <form action="{{route('checkoutPay')}}" method="POST">
                                @csrf
                                <button class="text-white btn bg-green">Place Order</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-lg-4 offset-lg-1">
                <div class="mt-5 mt-lg-0">
                    <div class="card">
                        <h5 class="py-2 px-3">Order Details</h5>
                    </div>
                    <ul class="list-group">
                        @foreach($cart as $item)
                        <li class="list-group-item px-2 py-1">
                            <div class="row align-items-center">
                                <div class="col-2">
                                    <img class="img-fluid" src="{{$item['product_image']}}" alt="{{$item['product_name']}}">
                                </div>
                                <p class="col-5 col-md-5 fw-bold">{{$item['product_name']}}</p>
                                <p class="col-2 text-center text-grey">{{$item['quantity']}}</p>
                                <p class="col-3 fw-bold">&euro;{{$item['product_price']*$item['quantity']}}</p>
                            </div>
                        </li>
                        @endforeach
                        <li class="list-group-item p-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="m-0">Total</p>
                                <p class="fw-bold m-0">{{Session::has('cart') ? Session::get('cart')->totalPrice:'0'}} &euro;</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </section>
</main>

<x-footer></x-footer>
