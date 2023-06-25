<x-header></x-header>

<main class="container-fluid col-12 col-lg-10 offset-lg-1">
    <div class="row">
        <aside class="col-lg-3 " >
            <div id="monster">
                <header>
                    <h2>monster</h2>
                </header>
                <div id="monsterKind">
                    <p>monsterKind</p>
                    <div class="form-check">
                        <input class="form-check-input" id="normal-Monster" type="checkbox">
                        <label class="form-check-label" for="normal-Monster">normal Monster</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="Effect-Monster" type="checkbox">
                        <label class="form-check-label" for="Effect-Monster">Effect Monster</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="Ritual-Monster" type="checkbox">
                        <label class="form-check-label" for="Ritual-Monster">Ritual Monster</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="Fusion-Monster" type="checkbox">
                        <label class="form-check-label" for="Fusion-Monster">Fusion Monster</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="Syncro-Monster" type="checkbox">
                        <label class="form-check-label" for="Syncro-Monster">Syncro Monster</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="XYZ-Monster" type="checkbox">
                        <label class="form-check-label" for="XYZ-Monster">XYZ Monster</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="Link-Monster" type="checkbox">
                        <label class="form-check-label" for="Link-Monster">Link Monster</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="Pendulum-Monster" type="checkbox">
                        <label class="form-check-label" for="Pendulum-Monster">Pendulum Monster</label>
                    </div>
                </div>
                <div id="monsterCategorie">
                    <label>Monster Type</label><br>
                    <select name="Monster Type" id="monsterType">
                        <option value="">Select type</option>
                        <option value="Aqua">Aqua</option>
                        <option value="Beast">Beast</option>
                        <option value="Beast-Warrior">Beast-Warrior</option>
                        <option value="Celestial-Warrior">Celestial-Warrior</option>
                        <option value="Cyborg">Cyborg</option>
                        <option value="Dinosaur">Dinosaur</option>
                        <option value="Divine-Beast">Divine-Beast</option>
                        <option value="Dragon">Dragon</option>
                        <option value="Fairy">Fairy</option>
                        <option value="Fiend">Fiend</option>
                        <option value="Fish">Fish</option>
                        <option value="Galaxy">Galaxy</option>
                        <option value="High Dragon">High Dragon</option>
                        <option value="High Dragon">High Dragon</option>
                        <option value="Insect">Insect</option>
                        <option value="Machine">Machine</option>
                        <option value="Magical Knight">Magical Knight</option>
                        <option value="Omega psychic">Omega psychic</option>
                        <option value="Plant">Plant</option>
                        <option value="Psychic">Psychic</option>
                        <option value="Pyro">Pyro</option>
                        <option value="Reptile">Reptile</option>
                        <option value="Rock">Rock</option>
                        <option value="Sea Serpent">Sea Serpent</option>
                        <option value="Spellcaster">Spellcaster</option>
                        <option value="Thunder">Thunder</option>
                        <option value="Worrior">Worrior</option>
                        <option value="Winged Beast">Winged Beast</option>
                        <option value="Wyrm">Wyrm</option>
                        <option value="Zombie">Zombie</option>
                    </select><br>
                    <label>Monster Type</label><br>
                    <select name="Monster Special Type" id="monsterSpecialType">
                        <option value="">Select Special type</option>
                        <option value="Gemeni">Gemeni</option>
                        <option value="Spirit">Spirit</option>
                        <option value="Toon">Toon</option>
                        <option value="Tuner">Tuner</option>
                        <option value="Union">Union</option>
                    </select><br>
                    <label>Attribute</label><br>
                    <select name="Attribute" id="Attribute">
                        <option value="">Select Attribute</option>
                        <option value="Dark">Dark</option>
                        <option value="Divine">Divine</option>
                        <option value="Earth">Earth</option>
                        <option value="Fire">Fire</option>
                        <option value="Light">Light</option>
                        <option value="Water">Water</option>
                        <option value="Wind">Wind</option>
                    </select>
                    <p>Links</p>
                    <div class="form-check">
                        <input class="form-check-input" id="Link-Top" type="checkbox">
                        <label class="form-check-label" for="Link-Top">Top</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="Link-Top-Right" type="checkbox">
                        <label class="form-check-label" for="Link-Top-Right">Top right</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="Link-Right" type="checkbox">
                        <label class="form-check-label" for="Link-Right">Right</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="Link-Bottom-right" type="checkbox">
                        <label class="form-check-label" for="Link-Bottom-right">Bottom right</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="Link-Bottom" type="checkbox">
                        <label class="form-check-label" for="Link-Bottom">Bottom</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="Link-Bottom-left" type="checkbox">
                        <label class="form-check-label" for="Link-Bottom-left">Bottom left</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="Link-Left" type="checkbox">
                        <label class="form-check-label" for="Link-Left">Left</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="Link-Top-Left" type="checkbox">
                        <label class="form-check-label" for="Link-Top-Left">Top left</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <input type="text" pattern="[0-9]|[0-9]{2}|[0-9]{3}|[0-9]{4}|[?]" title="Use max 4 letters or only a: '?'" class="form-control me-1 " id="attackLow" placeholder="low">
                        <span>≤ATK≤</span>
                        <input type="text" pattern="[0-9]|[0-9]{2}|[0-9]{3}|[0-9]{4}|[?]" title="Use max 4 letters or only a: '?'" class="form-control " id="AttackHigh" placeholder="high">
                    </div>
                    <div class="d-flex align-items-center">
                        <input type="text" pattern="[0-9]|[0-9]{2}|[0-9]{3}|[0-9]{4}|[?]" title="Use max 4 letters or only a: '?'" class="form-control me-1 " id="defenseLow" placeholder="low">
                        <span>≤DEF≤</span>
                        <input type="text" pattern="[0-9]|[0-9]{2}|[0-9]{3}|[0-9]{4}|[?]" title="Use max 4 letters or only a: '?'" class="form-control " id="defenseHigh" placeholder="high">
                    </div>
                </div>
            </div>
            <div id="spell">
                <header>
                    <h2>spell</h2>
                </header>
                <div class="form-check">
                    <input class="form-check-input" id="normal-spell" type="checkbox">
                    <label class="form-check-label" for="normal-spell">normal spell</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" id="Continuous-spell" type="checkbox">
                    <label class="form-check-label" for="Continuous-spell">Continuous spell</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" id="Equip-spell" type="checkbox">
                    <label class="form-check-label" for="Equip-spell">Equip spell</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" id="Quick-play-spell" type="checkbox">
                    <label class="form-check-label" for="Quick-play-spell">Quick-play spell</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" id="Field-spell" type="checkbox">
                    <label class="form-check-label" for="Field-spell">Field spell</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" id="Ritual-spell" type="checkbox">
                    <label class="form-check-label" for="Ritual-spell">Ritual spell</label>
                </div>
            </div>

            <div id="traps">
                <header>
                    <h2>Trap</h2>
                </header>
                <div class="form-check">
                    <input class="form-check-input" id="normal-trap" type="checkbox">
                    <label class="form-check-label" for="normal-trap">normal trap</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" id="Continuous-trap" type="checkbox">
                    <label class="form-check-label" for="Continuous-trap">Continuous trap</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" id="Counter-trap" type="checkbox">
                    <label class="form-check-label" for="Counter-trap">Counter trap</label>
                </div>
            </div>


        </aside>
        <section class="col-lg-9 px-0">
            <header class="bg-secondary py-4 ps-4">
                <h2>Yu-Gi-Oh Cards!</h2>
            </header>
            <div class="my-2 d-lg-flex justify-content-between align-items-center">
                <p><span>24</span> Products Found</p>
                <div class="d-lg-flex align-items-center">
                    <i class="bi bi-list-ul me-2"></i>
                    <i class="bi bi-grid me-2"></i>
                    <i class="bi bi-grid-3x3-gap me-2"></i>
                    <select class="form-select me-2" name="show-amount-items" id="show-amount-items">
                        <option value="50">Show 50</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                    </select>
                    <select class="form-select" name="sort-items" id="sort-items">
                        <option>Sort by:featured</option>
                        <option value="Low to High">Name: Low to High</option>
                        <option value="High to Low">Name: High to Low</option>
                        <option value="Low to High">Price: Low to High</option>
                        <option value="High to Low">Price: High to Low</option>
                    </select>
                </div>
            </div>
            <div id="cards-for-sale">

            </div>
        </section>
    </div>



</main>

<x-footer></x-footer>
