@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between shadow-lg p-3 mb-5 bg-body-tertiary rounded">
        <div class="d-flex">
            <h1 class="m-0">Show Box</h1>
            <a href="{{route('boxes.index')}}" class="btn btn-primary m-2 rounded-pill">All Boxes</a>
        </div>
        <a href="{{route('boxes.create')}}" class="btn btn-primary m-2 rounded-pill">Add Box</a>
    </div>
    <div>
        <h1><strong class="text-dark">{{$box->name}}</strong></h1>
        <div class="d-flex">
            <img class="img-thumbnail img-fluid" src="{{asset($box->photo->file)}}" alt="{{$box->name}}">
            <div  class="mx-5">
                <p>Posted on {{$box->created_at ? $box->created_at->diffForHumans() : 'no date'}}</p>
            </div>
        </div>
    </div>
@endsection
