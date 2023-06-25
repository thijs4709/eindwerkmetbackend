@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between shadow-lg p-3 mb-5 bg-body-tertiary rounded">
        <div class="d-flex">
            <h1 class="m-0">Edit Box</h1>
            <a href="{{route('boxes.index')}}" class="btn btn-primary m-2 rounded-pill">All Boxes</a>
        </div>
        <a href="{{route('boxes.create')}}" class="btn btn-primary m-2 rounded-pill">Add Box</a>
    </div>
 @if (session('alert'))
        <x-alert :type="session('alert')['type']" :message="session('alert')['message']">
            <x-slot name="title">Users</x-slot>
        </x-alert>
    @endif
    <div class="row my-2">
        <div class="col-6">
            <form action="{{action('App\Http\Controllers\AdminBoxesController@update',$box->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input name="name" type="text" class="form-control" id="floatingInputValue" placeholder="Name" value="{{$box->name}}">
                    @error('name')
                    <p class="text-danger fs-6">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="price">Price</label>
                    <input name="price"  type="number" step="any" class="form-control" id="floatingInputValue" placeholder="Price" value="{{$box->price}}">
                    @error('price')
                    <p class="text-danger fs-6">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="description">Description</label>
                    <input name="description" type="text" class="form-control" id="floatingInputValue" placeholder="description" value="{{$box->description}}">
                    @error('description')
                    <p class="text-danger fs-6">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="file" name="photo_id" id="ChooseFile">
                </div>
                <button type="submit" class="ml-auto btn btn-dark d-flex justify-content-end me-3">UPDATE</button>
            </form>
        </div>
        <div class="col-6">
            <img class="img-fluid img-thumbnail"
                 src="{{$box->photo ? asset($box->photo->file) : 'http://via.placeholder.com/400'}}" alt="{{$box->name}}">
        </div>
    </div>
@endsection


