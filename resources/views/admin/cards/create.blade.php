@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between shadow-lg p-3 mb-5 bg-body-tertiary rounded">
        <div class="d-flex">
            <h1 class="m-0">Create Cards</h1>
            <a href="{{route('cards.index')}}" class="btn btn-primary m-2 rounded-pill">All Cards</a>
        </div>
    </div>
    <form action="{{route('cards.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <select id="cardType" name="card_type_id" class="form-select mb-3" aria-label="Default select example">
            @foreach($cardTypes as $cardType)
                <option value="{{ $cardType->id}}">{{$cardType->name}}</option>
            @endforeach
        </select>

        <div class="form-group mb-3">
            <input name="name" type="text" class="form-control" id="floatingInputValue" placeholder="Name"
                   value="{{ old('name') }}">
            @error('name')
            <p class="text-danger fs-6">{{$message}}</p>
            @enderror
        </div>

        <div class="form-group mb-3">
            <input name="description" type="text" class="form-control" id="floatingInputValue" placeholder="Description"
                   value="{{ old('description') }}">
            @error('description')
            <p class="text-danger fs-6">{{$message}}</p>
            @enderror
        </div>

        <div class="form-group mb-3">
            <input name="price" type="number" step="any" class="form-control" id="floatingInputValue"
                   placeholder="Price" value="{{ old('price') }}">
            @error('price')
            <p class="text-danger fs-6">{{$message}}</p>
            @enderror
        </div>

        <div class="form-group">
            <input type="file" name="photo_id" id="ChooseFile">
            @error('photo_id')
            <p class="text-danger fs-6">{{$message}}</p>
            @enderror
        </div>


        <div id="monsterSection">
            <div class="d-flex justify-content-around border border-1 my-3 py-3 bg-white">
                <div class="form-group mb-3 d-flex flex-column">
                    <label>Monster Attribute</label>
                    <div class="btn-group-vertical">
                        @foreach($monsterAttributes as $monsterAttribute)
                            <label>
                                <input type="radio" name="monster_attribute_id" value="{{ $monsterAttribute->id }}"
                                       autocomplete="off"> {{ $monsterAttribute->name }}
                            </label>
                        @endforeach
                    </div>
                    @error('monster_attribute_id')
                    <p class="text-danger fs-6">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mb-3 d-flex flex-column">
                    <label>Monster Class</label>
                    <div class="btn-group-vertical">
                        @foreach($monsterClasses as $monsterClass)
                            <label>
                                <input type="radio" name="monster_class_id" value="{{ $monsterClass->id }}"
                                       autocomplete="off"> {{ $monsterClass->name }}
                            </label>
                        @endforeach
                    </div>
                    @error('monster_class_id')
                    <p class="text-danger fs-6">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mb-3 d-flex flex-column">
                    <label>Monster Special Type</label>
                    <div class="btn-group-vertical">
                        <label>
                            <input type="radio" name="monster_special_type_id" value="" autocomplete="off"> None
                        </label>
                        @foreach($monsterSpecialTypes as $monsterSpecialType)
                            <label>
                                <input type="radio" name="monster_special_type_id" value="{{ $monsterSpecialType->id }}"
                                       autocomplete="off"> {{ $monsterSpecialType->name }}
                            </label>
                        @endforeach
                    </div>
                    @error('monster_special_type_id')
                    <p class="text-danger fs-6">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mb-3 d-flex flex-column flex-wrap">
                    <label>Monster Type</label>
                    <div class="btn-group-vertical">
                        @foreach($monsterTypes as $monsterType)
                        <label>
                            <input type="radio" name="monster_type_id" value="{{ $monsterType->id }}"
                                   autocomplete="off"> {{ $monsterType->name }}
                        </label>
                        @endforeach
                    </div>
                    @error('monster_type_id')
                    <p class="text-danger fs-6">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <input name="level" type="number" min="0" max="13" class="form-control" id="floatingInputValue" placeholder="Level"
                       value="{{ old('level') }}">
                @error('level')
                <p class="text-danger fs-6">{{$message}}</p>
                @enderror
            </div>

            <div class="btn-group-vertical">
                <input type="hidden" name="pendulum" value="0">
                <label>
                    <input type="checkbox" class="form-check-input" value="1"  name="pendulum">Pendulum
                </label>
                @error('pendulum')
                <p class="text-danger fs-6">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group mb-3">
                <input name="atk" type="text" pattern="^\d+|\?$" class="form-control" id="floatingInputValue" placeholder="Atk"
                       value="{{ old('atk') }}">
                @error('atk')
                <p class="text-danger fs-6">{{$message}}</p>
                @enderror
            </div>

            <div class="form-group mb-3">
                <input name="def" type="text" pattern="^\d+|\?$" class="form-control" id="floatingInputValue" placeholder="Def"
                       value="{{ old('def') }}">
                @error('def')
                <p class="text-danger fs-6">{{$message}}</p>
                @enderror
            </div>
        </div>

        <div id="spellSection">
            <div class="form-group mb-3 d-flex flex-column">
                <label>Spell Type</label>
                <div class="btn-group-vertical">
                    @foreach($spellTypes as $spellType)
                        <label>
                            <input type="radio" name="spell_type_id" value="{{ $spellType->id }}"
                                   autocomplete="off"> {{ $spellType->name }}
                        </label>
                    @endforeach
                    @error('spell_type_id')
                    <p class="text-danger fs-6">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div id="trapSection">
            <div class="form-group mb-3 d-flex flex-column">
                <label>Trap Type</label>
                <div class="btn-group-vertical">
                    @foreach($trapTypes as $trapType)
                        <label>
                            <input type="radio" name="trap_type_id" value="{{ $trapType->id }}"
                                   autocomplete="off"> {{ $trapType->name }}
                        </label>
                    @endforeach
                </div>
                @error('trap_type_id')
                <p class="text-danger fs-6">{{ $message }}</p>
                @enderror
            </div>
        </div>



        <button type="submit" class="ml-auto btn btn-dark d-flex justify-content-end me-3">Submit</button>
    </form>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get references to the select element and form sections
        let cardTypeSelect = document.getElementById('cardType');
        let monsterSection = document.getElementById('monsterSection');
        let spellSection = document.getElementById('spellSection');
        let trapSection = document.getElementById('trapSection');

        // Hide all form sections initially
        spellSection.style.display = 'none';
        trapSection.style.display = 'none';

        // Listen for changes in the select element
        cardTypeSelect.addEventListener('change', function () {
            // Get the selected option value
            let selectedOption = cardTypeSelect.value;

            // Hide all form sections
            monsterSection.style.display = 'none';
            spellSection.style.display = 'none';
            trapSection.style.display = 'none';

            // Show the corresponding form section based on the selected option
            if (selectedOption === '1') {
                monsterSection.style.display = 'block';
            } else if (selectedOption === '2') {
                spellSection.style.display = 'block';
            } else if (selectedOption === '3') {
                trapSection.style.display = 'block';
            }
        });
    });
</script>
