@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between shadow-lg p-3 mb-5 bg-body-tertiary rounded">
        <div class="d-flex">
            <h1 class="m-0">Show Order</h1>
            <a href="{{route('order.index')}}" class="btn btn-primary m-2 rounded-pill">All Orders</a>
        </div>
    </div>
    <div>
        <h1><strong class="text-dark">order: {{$order->id}}</strong></h1>
        <ul class="list-group">
            <li class="list-group-item">Status: {{$order->status}}</li>
            <li class="list-group-item">Total price: {{$order->total_price}}</li>
            <li class="list-group-item">Address: {{$order->street}} {{$order->street_number}}</li>
            <li class="list-group-item">City: {{$order->city}} {{$order->city_number}}</li>
            <li class="list-group-item">Delivery time: {{$order->delivery_time}}</li>
            <li class="list-group-item">Instructions: {{$order->instructions}}</li>
        </ul>
        <h2 class="my-3"><strong class="text-dark">Items</strong></h2>
        <table class="table table-striped shadow-lg p-3 mb-5 bg-body-tertiary rounded">
            <thead>
            <tr>
                <td>product name</td>
                <td>image</td>
                <td>Quantity</td>
                <th>Product original price</th>
                <th>Total price</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{$item->product_name}}</td>
                    <td><img class="img-thumbnail" width="62" height="62"
                             @if($item->card_id)
                                 src="{{$item->card->photo->file ? asset($item->card->photo->file) : 'http://via.placeholder.com/62x62'}}"
                             @elseif($item->box_id)
                                 src="{{$item->box->photo->file ? asset($item->box->photo->file) : 'http://via.placeholder.com/62x62'}}"
                             @else
                                 src="http://via.placeholder.com/62x62"
                             @endif
                             alt="{{$item->product_name}}">
                    </td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->product_original_price}}</td>
                    <td>{{$item->product_original_price * $item->quantity}}</td>
                    <td>{{Str::limit($item->product_description,50)}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

