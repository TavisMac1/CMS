@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Orders</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
            {!! Form::open(['route' => 'order.store', 'files' =>false]) !!}
				<input type="hidden" name="show" value=""/>
			    {{ Form::submit('Show Orders', ['class'=>'btn btn-success btn-lg btn-block', 'style'=>'margin-top:20px']) }}

			{!! Form::close() !!}
                    <table class="table">
                        <thead>
                            <th>History</th>
                        </thead>
                        <tbody>
                            @foreach ($sold as $item)
                                    <tr>
                                        <td>Item ID: {{ $item->item_id }}</td>
                                        <td>Order ID: {{ $item->order_id }}</td>
                                        <td>Price: {{ $item->item_price }}</td>
                                        <td> Quantity: {{ $item->quantity }}</td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
