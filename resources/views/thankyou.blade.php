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
                    <hr>
                    <h5 style='color:rgb(128, 128, 128);'> Customer Name: {{ $order[0]->fname }}</h5>
                    <h5 style='color:rgb(128, 128, 128);'> Customer Last Name: {{ $order[0]->lname }}</h5>
                    <h5 style='color:rgb(128, 128, 128);'> Customer Last Name: {{ $order[0]->email }}</h5>
                    <h5 style='color:rgb(128, 128, 128);'> Customer Last Name: {{ $order[0]->pnum }}</h5>
                    <div>
                        @foreach ($sale as $sales)
                            <h5 style='color:rgb(128, 128, 128);'> Price: {{ $sales->item_price }}</h5>
                        @endforeach
                        @foreach ($item as $items)
                            <h5 style='color:rgb(128, 128, 128);'> Item Name: {{ $items->title }}</h5>
                        @endforeach
                        {{--@foreach ($order as $order)
                            <h5 style='color:rgb(128, 128, 128);'> Customer Name: {{ $order->fname }}</h5>
                            <h5 style='color:rgb(128, 128, 128);'> Customer Last Name: {{ $order->lname }}</h5>
                            <br/>
                        @endforeach --}}
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