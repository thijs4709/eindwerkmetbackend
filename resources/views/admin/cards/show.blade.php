@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between shadow-lg p-3 mb-5 bg-body-tertiary rounded">
        <div class="d-flex">
            <h1 class="m-0">Show Box</h1>
            <a href="{{route('cards.index')}}" class="btn btn-primary m-2 rounded-pill">All Cards</a>
        </div>
        <a href="{{route('cards.create')}}" class="btn btn-primary m-2 rounded-pill">Add Card</a>
    </div>
    <div>
        <h1><strong class="text-dark">{{$card->name}}</strong></h1>
        <div class="d-flex">
            <img class="img-thumbnail img-fluid" src="{{asset($card->photo->file)}}" alt="{{$card->name}}">
            <div  class="mx-5">
                <p>Cardtype: {{$card->cardType->name ?? '/'}}</p>

                @if($card->cardType->id === 1)
                <p>level/rank/arrows: {{$card->level ?? '/'}}</p>
                <p>Monster attribute: {{$card->monsterAttribute->name ?? '/'}}</p>
                <p>Monster class: {{$card->monsterClass->name ?? '/'}}</p>
                <p>Monster type: {{$card->monsterType->name ?? '/'}}</p>
                <p>Pendulum: @if($card->pendulum) pendulum @else / @endif</p>
                <p>Monster special type: {{$card->monsterSpecialType->name ?? '/'}}</p>
                <p>ATK {{$card->atk ?? '/'}}</p>
                <p>DEF {{$card->def ?? '/'}}</p>
                @endif

                @if($card->cardType->id === 2)
                <p>Spell type {{$card->spellType->name ?? '/'}}</p>
                @endif

                @if($card->cardType->id === 3)
                <p>Trap type {{$card->trapType->name ?? '/'}}</p>
                @endif

                <p>Description {{$card->description}}</p>
                <p>Price {{$card->price}} €</p>
                <p>Posted on {{$card->created_at ? $card->created_at->diffForHumans() : 'no date'}}</p>
            </div>
        </div>
    </div>
@endsection
