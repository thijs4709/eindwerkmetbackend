<x-header></x-header>

<main class="container-fluid col-12 col-lg-10 offset-lg-1">
    <section class="my-5" id="section1">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 mb-2">
                <div class="p-4" id="background1">
                    <h3 class="my-3">Buy here your spell cards</h3>
                    <p class="mb-3">Some extra text need some writing</p>
                    <a class="btn btn-dark" href="{{route("shop", ['filter_spell' => $spellTypes->pluck('id')->all()]) }}" style="background-color:#1a3540">Shop naw</a>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-2">
                <div class="p-4" id="background2">
                    <h3 class="my-3">Buy here your trap cards</h3>
                    <p class="mb-3">Some extra text need some writing</p>
                    <a class="btn btn-dark" href="{{route("shop", ['filter_trap' => $trapTypes->pluck('id')->all()]) }}" style="background-color:#1a3540">Shop naw</a>
                </div>
            </div>
            <div class="col-12 col-lg-4 d-block d-md-none d-lg-block">
                <div class="p-4" id="background3">
                    <h3 class="my-3">Buy here your monster cards</h3>
                    <p class="mb-3">Some extra text need some writing</p>
                    <a class="btn btn-dark" href="{{route("shop", ['filter' => $monsterTypes->pluck('id')->all()]) }}" style="background-color:#1a3540">Shop naw</a>
                </div>
            </div>
        </div>

    </section>
    <section class="row m-0" id="section2">
        <header class="p-0">
            <h2 class="text-dark">Shop by Attribute</h2>
        </header>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-6 g-6">
            <div class="col">
                <div class="card my-2">
                    <a class="text-decoration-none text-dark" href="{{route("shop", ['filter_attribute' => $filterOptionMonsterAttribute = 1])}}">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <img alt="..." class="card-img-top img-fluid mb-3 p-4" src="{{asset("/images/DARK.svg")}}">
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card my-2">
                    <a class="text-decoration-none text-dark" href="{{route("shop", ['filter_attribute' => $filterOptionMonsterAttribute = 3])}}">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <img alt="..." class="card-img-top img-fluid mb-3" src="{{asset("/images/EARTH.svg")}}">
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card my-2">
                    <a class="text-decoration-none text-dark" href="{{route("shop", ['filter_attribute' => $filterOptionMonsterAttribute = 4])}}">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <img alt="..." class="card-img-top img-fluid mb-3" src="{{asset("/images/FIRE.svg")}}">
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card my-2">
                    <a class="text-decoration-none text-dark" href="{{route("shop", ['filter_attribute' => $filterOptionMonsterAttribute = 5])}}">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <img alt="..." class="card-img-top img-fluid mb-3" src="{{asset("/images/LIGHT.svg")}}">
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card my-2">
                    <a class="text-decoration-none text-dark" href="{{route("shop", ['filter_attribute' => $filterOptionMonsterAttribute = 6])}}">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <img alt="..." class="card-img-top img-fluid mb-3" src="{{asset("/images/WATER.svg")}}">
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card my-2">
                    <a class="text-decoration-none text-dark" href="{{route("shop", ['filter_attribute' => $filterOptionMonsterAttribute = 7])}}">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <img alt="..." class="card-img-top img-fluid mb-3" src="{{asset("/images/WIND.svg")}}">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="py-4" id="section3">
        <div class="container my-3">
            <div class="d-flex justify-content-between">
                <header>
                    <h2 class="font-weight-light mb-3">Boxes</h2>
                </header>
                <div class="d-flex">
                    <a class="carousel-control-prev bg-arrows me-1" data-bs-slide="prev" href="#monster"
                       role="button">
                        <i aria-hidden="true" class="bi bi-caret-left-fill"></i>
                    </a>
                    <a class="carousel-control-next bg-arrows" data-bs-slide="next" href="#monster"
                       role="button">
                        <i aria-hidden="true" class="bi bi-caret-right-fill"></i>
                    </a>
                </div>
            </div>
            <div class="row mx-auto my-auto justify-content-center">
                <div class="carousel slide" data-bs-ride="carousel" id="monster">
                    <div class="carousel-inner" role="listbox">
                        @foreach($boxes as $box)
                            <div class="carousel-item monster gap-3 @if($loop->index === 1) active @endif">
                                <div class="col-md-4">
                                    <div class="card p-3">
                                        <div class="card-img mb-5">
                                            <a href="{{route("shop_detail_box", $box->slug)}}"><img class="img-fluid" src="{{asset($box->photo->file)}}"></a>
                                        </div>
                                        <p>{{$box->name}}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p>{{$box->price}}</p>
                                            <a href="{{route('addToCart',['id' => $box->id, 'product_type' => $box->product_type])}}" class="btn bg-green"><i class="bi bi-plus-lg"></i>add</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="row d-flex justify-content-around border-top py-4" id="section4" id="end-main">
        <article class="col-lg-3 col-md-6">
            <i class="bi bi-clock fs-1 text-green"></i>
            <header>
                <h3 class="my-3">Fast shopping</h3>
            </header>
            <p class="mb-3">Get your orders within 2 days of ordering</p>
        </article>
        <article class="col-lg-3 col-md-6">
            <i class="bi bi-gift fs-1 text-green"></i>
            <header>
                <h3 class="my-3">Best Prices & Offers</h3>
            </header>
            <p class="mb-3">Cheaper prices then your local stores. Get the best Prices & offers</p>
        </article>
        <article class="col-lg-3 col-md-6">
            <i class="bi bi-box-seam fs-1 text-green"></i>
            <header>
                <h3 class="my-3">Wide Assortment</h3>
            </header>
            <p class="mb-3">Choose form over 12 000 cards</p>
        </article>
        <article class="col-lg-3 col-md-6">
            <i class="bi bi-arrow-repeat fs-1 text-green"></i>
            <header>
                <h3 class="my-3">Easy Returns</h3>
            </header>
            <p class="mb-3">Not satisfied with a product? Return the cards & get a full refund.</p>
        </article>
    </section>
</main>

<x-footer></x-footer>
