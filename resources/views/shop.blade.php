@php use App\Models\Card; @endphp
<x-header></x-header>
<main class="container-fluid col-12 col-lg-10 offset-lg-1">
    <div class="row">
        <!--filter-->
        <aside class="col-lg-3 ">
            <form action="{{route("shop")}}" method="GET">
                <div id="monster">
                    <header>
                        <h2>monster</h2>
                    </header>
                    <div id="monsterKind">
                        <p>Monster Class</p>
                        @foreach($monsterClasses as $monsterClass)
                            <div class="form-check">
                                <input name="filter[]" @if(!($filterOptionMonsterClass === null)) {{in_array($monsterClass->id,$filterOptionMonsterClass) ? "checked" : ""}}@endif value="{{$monsterClass->id}}" class="form-check-input" id="{{$monsterClass->name}}"
                                       type="checkbox">
                                <label class="form-check-label" for="{{$monsterClass->id}}">{{$monsterClass->name}} Monster</label>
                            </div>
                        @endforeach
<!--                        <div class="form-check">
                            <input name="filter_pendulum[]" value="1" class="form-check-input" id="Pendulum-Monster"
                                   type="checkbox">
                            <label class="form-check-label" for="Pendulum-Monster">Pendulum Monster</label>
                        </div>-->
                    </div>
                    <div id="monsterCategorie">
                        <label>Monster Type</label><br>
                        <select name="filter_monster_type" id="monsterType">
                            <option value="0">Select type</option>
                            @foreach($monsterTypes as $monsterType)
                                <option value="{{$monsterType->id}}" @if($filterOptionMonsterType == $monsterType->id) selected @endif >
                                    {{$monsterType->name}}
                                </option>
                            @endforeach
                        </select><br>
                        <label>Monster Special Type</label><br>
<!--                        <select name="filter_monster_special_type[]" id="monsterSpecialType">
                            <option value="0">Select Special type</option>
                            <option value="1">Gemeni</option>
                            <option value="2">Spirit</option>
                            <option value="3">Toon</option>
                            <option value="4">Tuner</option>
                            <option value="5">Union</option>
                        </select><br>-->
                        <label>Attribute</label><br>
                        <select name="filter_attribute" id="Attribute">
                            <option value="0">Select Attribute</option>
                            @foreach($monsterAttributes as $monsterAttribute)
                                <option value="{{$monsterAttribute->id}}" @if($filterOptionMonsterAttribute == $monsterAttribute->id) selected @endif">
                                    {{$monsterAttribute->name}}
                                </option>
                            @endforeach
                        </select><br>
<!--                        <label>Level/Rank/link</label><br>
                        <select name="filter_level[]" id="Level" class="mb-2">
                            <option value="99" >Select Level/Rank/link</option>
                            <option value="0" >0</option>
                            <option value="1" >1</option>
                            <option value="2" >2</option>
                            <option value="3" >3</option>
                            <option value="4" >4</option>
                            <option value="5" >5</option>
                            <option value="6" >6</option>
                            <option value="7" >7</option>
                            <option value="8" >8</option>
                            <option value="9" >9</option>
                            <option value="10" >10</option>
                            <option value="11" >11</option>
                            <option value="12" >12</option>
                            <option value="13" >13</option>
                        </select>-->
<!--                        <div class="d-flex align-items-center">
                            <input type="text" name="filter_atk_low"  pattern="[0-9]|[0-9]{2}|[0-9]{3}|[0-9]{4}|[?]"
                                   title="Use max 4 numbers or only a: '?'" class="form-control me-1 " id="attackLow"
                                   placeholder="low">
                            <span>≤ATK≤</span>
                            <input type="text" name="filter_atk_high" pattern="[0-9]|[0-9]{2}|[0-9]{3}|[0-9]{4}|[?]"
                                   title="Use max 4 numbers or only a: '?'" class="form-control " id="AttackHigh"
                                   placeholder="high">
                        </div>
                        <div class="d-flex align-items-center">
                            <input type="text" name="filter_def_low" pattern="[0-9]|[0-9]{2}|[0-9]{3}|[0-9]{4}|[?]"
                                   title="Use max 4 numbers or only a: '?'" class="form-control me-1 " id="defenseLow"
                                   placeholder="low">
                            <span>≤DEF≤</span>
                            <input type="text" name="filter_def_high" pattern="[0-9]|[0-9]{2}|[0-9]{3}|[0-9]{4}|[?]"
                                   title="Use max 4 numbers or only a: '?'" class="form-control " id="defenseHigh"
                                   placeholder="high">
                        </div>-->
                    </div>
                </div>
                <div id="spell">
                    <header>
                        <h2>spell</h2>
                    </header>
                    @foreach($spellTypes as $spellType)
                    <div class="form-check">
                        <input name="filter_spell[]"  value="{{$spellType->id}}" @if(!($filterOptionSpellType === null)) {{in_array($spellType->id,$filterOptionSpellType) ? "checked" : ""}}@endif class="form-check-input" id="{{$spellType->id}}" type="checkbox">
                        <label class="form-check-label" for="{{$spellType->id}}">{{$spellType->name}}</label>
                    </div>
                    @endforeach
                </div>
                <div id="traps">
                    <header>
                        <h2>Trap</h2>
                    </header>
                    @foreach($trapTypes as $trapType)
                    <div class="form-check">
                        <input name="filter_trap[]" value="{{$trapType->id}}" @if(!($filterOptionTrapType === null)) {{in_array($trapType->id,$filterOptionTrapType) ? "checked" : ""}}@endif class="form-check-input" id="{{$trapType->id}}" type="checkbox">
                        <label class="form-check-label" for="{{$trapType->id}}">{{$trapType->name}}</label>
                    </div>
                    @endforeach
                </div>
                <button type="submit" class="btn bg-green text-white mt-2">Apply Filters</button>
            </form>


        </aside>
        <!--shop-->
        <section class="col-lg-9 px-0">
            <header class="bg-secondary py-4 ps-4">
                <h2>Yu-Gi-Oh Cards!</h2>
            </header>
            <div class="my-2 d-lg-flex justify-content-between align-items-center">
                <p><span>{{count($boxes)}}</span> Boxes Found, <span>{{ $cards->total() }}</span> Cards Found</p>
                <div class="d-lg-flex align-items-center">
                    <select class="form-select me-2" name="show-items" id="show-items">
                        <option value="cards">cards</option>
                        <option value="boxes">boxes</option>
                    </select>
                </div>
            </div>
            <div id="shop">
                <div class="boxes-links d-none row g-4 my-2">
                    @foreach($boxes as $box)
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="card h-100">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <a href="{{route("shop_detail_box", $box->slug)}}">
                                        <img class="img-fluid" src="{{asset($box->photo->file)}}">
                                    </a>
                                    <!-- heading -->
                                    <div class="text-small mb-1">
                                        <small>
                                            {{$box->name}}
                                        </small>
                                    </div>
                                    <!-- price -->
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p>&euro;{{$box->price}}</p>
                                        <a href="{{route('addToCart',['id' => $box->id, 'product_type' => $box->product_type])}}" class="btn bg-green">
                                            <i class="bi bi-plus-lg"></i> add
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="cards-links row g-4 my-2">
                    @foreach($cards as $card)
                        <div class=" col-xl-3 col-lg-4 col-md-6">
                            <div class="card h-100">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <a href="{{route("shop_detail_card", $card->slug)}}">
                                        <img class="img-fluid" src="{{asset($card->photo->file)}}">
                                    </a>
                                    <!-- heading -->
                                    <div class="text-small mb-1">
                                        <small>
                                            {{$card->name}}
                                        </small>
                                    </div>
                                    <!-- price -->
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p>&euro;{{$card->price}}</p>
                                        <a href="{{route('addToCart',['id' => $card->id, 'product_type' => $card->product_type])}}"
                                           class="btn bg-green">
                                            <i class="bi bi-plus-lg"></i> add
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


            </div>
            <div class="boxes-links d-none">
                {{$boxes->links()}}
            </div>
            <div class="cards-links">
                {{$cards->links()}}
            </div>


        </section>
    </div>


</main>

<x-footer></x-footer>
<script>
    //for changing the shop with boxes or cards
    function handleSelection() {
        let selectElement = document.getElementById("show-items");
        let boxesLinks = document.getElementsByClassName("boxes-links");
        let cardsLinks = document.getElementsByClassName("cards-links");

        if (selectElement.value === "boxes") {
            for (let i = 0; i < boxesLinks.length; i++) {
                boxesLinks[i].classList.remove("d-none");
            }
            for (let i = 0; i < cardsLinks.length; i++) {
                cardsLinks[i].classList.add("d-none");
            }
        } else if (selectElement.value === "cards") {
            for (let i = 0; i < boxesLinks.length; i++) {
                boxesLinks[i].classList.add("d-none");
            }
            for (let i = 0; i < cardsLinks.length; i++) {
                cardsLinks[i].classList.remove("d-none");
            }
        }
        console.log(selectElement.value, "test");
    }

    // Add event listener to call handleSelection when selection changes
    document.getElementById("show-items").addEventListener("change", handleSelection);
</script>

