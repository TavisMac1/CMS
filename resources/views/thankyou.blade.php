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
                    <div>
                        @foreach ($cart as $cartItems)
                            @foreach ($sale as $sales)
                                <h5 style='color:rgb(128, 128, 128);'> Price: {{ $sales->item_price }}</h5>
                            @endforeach
                            @foreach ($item as $items)
                                <h5 style='color:rgb(128, 128, 128);'> Item Name: {{ $items->title }}</h5>
                            @endforeach
                            @foreach ($order as $orders)
                                <h5 style='color:rgb(128, 128, 128);'> Customer Name: {{ $orders->fname }}</h5>
                                <h5 style='color:rgb(128, 128, 128);'> Customer Last Name: {{ $orders->lname }}</h5>
                            @endforeach
                            <br/>
                        @endforeach
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection