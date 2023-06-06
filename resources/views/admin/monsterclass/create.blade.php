@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between shadow-lg p-3 mb-5 bg-body-tertiary rounded">
        <div class="d-flex">
            <h1 class="m-0">Create Monster class</h1>
            <a href="{{route('monsterclass.index')}}" class="btn btn-primary m-2 rounded-pill">All Monster classes</a>
        </div>
    </div>
    <form action="{{route('monsterclass.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group mb-3">
            <input name="name" type="text" class="form-control" id="floatingInputValue" placeholder="Name" value="{{ old('name') }}">
            @error('name')
            <p class="text-danger fs-6">{{$message}}</p>
            @enderror
        </div>
        <button type="submit" class="ml-auto btn btn-dark d-flex justify-content-end me-3">Submit</button>
    </form>
@endsection


