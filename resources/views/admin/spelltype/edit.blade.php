@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between shadow-lg p-3 mb-5 bg-body-tertiary rounded">
        <div class="d-flex">
            <h1 class="m-0">Edit Spell type</h1>
            <a href="{{route('spelltype.index')}}" class="btn btn-primary m-2 rounded-pill">All Spell type</a>
        </div>
        <a href="{{route('spelltype.create')}}" class="btn btn-primary m-2 rounded-pill">Add Spell type</a>
    </div>
    @if (session('alert'))
        <x-alert :type="session('alert')['type']" :message="session('alert')['message']">
            <x-slot name="title">Users</x-slot>
        </x-alert>
    @endif

    <form action="{{action('App\Http\Controllers\AdminSpellTypeController@update',$spellType->id)}}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group mb-3">
            <input name="name" type="text" class="form-control" id="floatingInputValue" placeholder="Name"
                   value="{{$spellType->name}}">
            @error('name')
            <p class="text-danger fs-6">{{$message}}</p>
            @enderror
        </div>
        <button type="submit" class="ml-auto btn btn-dark d-flex justify-content-end me-3">UPDATE</button>
    </form>

@endsection


