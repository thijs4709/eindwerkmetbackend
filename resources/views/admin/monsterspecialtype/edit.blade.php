@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between shadow-lg p-3 mb-5 bg-body-tertiary rounded">
        <div class="d-flex">
            <h1 class="m-0">Edit Monster Special Type</h1>
            <a href="{{route('monsterspecialtype.index')}}" class="btn btn-primary m-2 rounded-pill">All Monster Special
                Type</a>
        </div>
        <a href="{{route('monsterspecialtype.create')}}" class="btn btn-primary m-2 rounded-pill">Add Monster Special
            Type</a>
    </div>
    @if (session('alert'))
        <x-alert :type="session('alert')['type']" :message="session('alert')['message']">
            <x-slot name="title">Users</x-slot>
        </x-alert>
    @endif

    <form action="{{action('App\Http\Controllers\AdminMonsterSpecialTypeController@update',$monsterSpecialType->id)}}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group mb-3">
            <input name="name" type="text" class="form-control" id="floatingInputValue" placeholder="Name"
                   value="{{$monsterSpecialType->name}}">
            @error('name')
            <p class="text-danger fs-6">{{$message}}</p>
            @enderror
        </div>
        <button type="submit" class="ml-auto btn btn-dark d-flex justify-content-end me-3">UPDATE</button>
    </form>

@endsection


