<?php
session_start();
if(!session_id()) {
    return redirect('/products');
 }
?>
@extends('common')
@section('content')
@section('pagetitle')
Orders
@endsection
@section('pagename')
Tavis Store 
@endsection
<div class="container">
    <div class="row justify-content-center" style='margin: auto'>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Your Orders </strong></div>
                <br>
                <div class="card-body">
                    Thank you for your order! Your order details are listed below
                    <div>
                        @foreach ($cart as $cartItems)
                            @foreach ($order as $orderDets)
                                <hr>
                                <h5 style='color:rgb(128, 128, 128);'> Customer Name: {{ $orderDets->fname }}</h5>
                                <h5 style='color:rgb(128, 128, 128);'> Customer Last Name: {{ $orderDets->lname }}</h5>
                                <h5 style='color:rgb(128, 128, 128);'> Customer Email: {{ $orderDets->email }}</h5>
                                <h5 style='color:rgb(128, 128, 128);'> Customer Phone Number: {{ $orderDets->pnum }}</h5>
                            @endforeach
                            @foreach ($item as $items)
                                @if ($items->id == $cartItems->item_id)
                                    <h5 style='color:rgb(128, 128, 128);'> Item Name: {{ $items->title }}</h5>
                                    <h5 style='color:rgb(128, 128, 128);'> Item Price: {{ $items->price * $cartItems->quantity }}</h5>
                                    <h5 style='color:rgb(128, 128, 128);'> Item Quantity: {{ $cartItems->quantity }}</h5>
                                @endif
                            @endforeach
                        @endforeach
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    session_unset();
    session_destroy();
?>
@endsection