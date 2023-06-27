<x-header></x-header>

<main class="container-fluid col-12 col-lg-10 offset-lg-1">
    <section class="mt-8">
        <div class="container my-3">
            <div class="row">
                <!--img-->
                {{--todo met library Magnify zoom in zetten als je tijd over hebt--}}
                <div class="col-md-6">
                    <div>
                        <img class="img-fluid" src="{{asset($card->photo->file)}}">
                    </div>
                </div>
                <!--info-->
                <div class="col-md-6">
                    <div class="ps-lg-10 mt-6 mt-md-0">
                        <h1 class="mb-1">{{$card->name}} </h1>
                        <div class="fs-4">
                            <span class="fw-bold text-dark">&euro;{{$card->price}}</span>
                        </div>
                    </div>
                    <div class="mt-3 row justify-content-start g-2 align-items-center">
                        <div class="col-md-4 col-4">
                            <a href="{{route('addToCart',['id' => $card->id, 'product_type' => $card->product_type])}}"
                               class="btn bg-green">
                                <i class="bi bi-plus-lg"></i> add
                            </a>
                        </div>
                    </div>
                    <hr class="my-6">
                    <div>
                        <table class="table table-borderless mb-0">
                            <tbody>
                            @if($card->card_type_id == "2")
                                <tr>
                                    <td>Spell type:</td>
                                    <td>{{ $card->spellType->name ?? '/' }}</td>
                                </tr>
                            @elseif($card->card_type_id == "3")
                                <tr>
                                    <td>Trap type:</td>
                                    <td>{{$card->trapType->name ?? '/'}}</td>
                                </tr>
                            @elseif($card->card_type_id == "1")
                                <tr>
                                    <td>CardType:</td>
                                    <td>{{$card->cardType->name ?? '/'}}</td>
                                </tr>
                                <tr>
                                    <td>Attribute:</td>
                                    <td>{{$card->monsterAttribute->name ?? '/'}}</td>
                                </tr>
                                <tr>
                                    <td>Monster class:</td>
                                    <td>{{$card->monsterClass->name ?? '/'}}</td>
                                </tr>
                                <tr>
                                    <td>@if($card->monster_class_id == "6")
                                            Rank
                                        @elseif($card->monster_class_id == "7")
                                            Arrows
                                        @else
                                            Level
                                        @endif:
                                    </td>
                                    <td>{{$card->level ?? '/'}}</td>
                                </tr>
                                <tr>
                                    <td>Monster type:</td>
                                    <td>{{$card->monsterType->name ?? '/'}}</td>
                                </tr>
                                <tr>
                                    <td>Pendalum:</td>
                                    <td>@if($card->pendulum)
                                            pendulum
                                        @else
                                            /
                                        @endif</td>
                                </tr>
                                <tr>
                                    <td>Monster special type:</td>
                                    <td>{{$card->monsterSpecialType->name ?? '/'}}</td>
                                </tr>
                                <tr>
                                    <td>ATK/DEF</td>
                                    <td>{{$card->atk ?? '/'}}/{{$card->def ?? '/'}}</td>
                                </tr>
                            @endif
                            <tr>
                                <td>Effect:</td>
                                <td>{{ $card->description}}</td>
                            </tr>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<x-footer></x-footer>
