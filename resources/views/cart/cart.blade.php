<?php
	session_start();
	$sess = session_id();
	$getIP = $_SERVER['REMOTE_ADDR'];
	$firstName = "";
	$lastName = "";
	$emailAddr = "";
	$phoneNumber = "";
	$allPrice = 0;
?>
@extends('common') 

@section('pagetitle')
Shopping Cart
@endsection

@section('pagename')
Tavis Store
@endsection

@section('scripts')
{!! Html::script('/bower_components/parsleyjs/dist/parsley.min.js') !!}
@endsection

@section('css')
{!! Html::style('/css/parsley.css') !!}
@endsection

@section('content')
	@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="text-danger">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@endif
<div class="jumbotron bg-info">
  	<h2 class="display-4 text-info">Your shopping cart</h2>
  	<p class="lead">Check your order details and fill out your customer information at the bottom</p>
</div>
<h4 class="text-primary text-center">Items in cart...
	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wind" viewBox="0 0 16 16">
  	<path d="M12.5 2A2.5 2.5 0 0 0 10 4.5a.5.5 0 0 1-1 0A3.5 3.5 0 1 1 12.5 8H.5a.5.5 0 0 1 0-1h12a2.5 2.5 0 0 0 0-5zm-7 1a1 1 0 0 0-1 1 .5.5 0 0 1-1 0 2 2 0 1 1 2 2h-5a.5.5 0 0 1 0-1h5a1 1 0 0 0 0-2zM0 9.5A.5.5 0 0 1 .5 9h10.042a3 3 0 1 1-3 3 .5.5 0 0 1 1 0 2 2 0 1 0 2-2H.5a.5.5 0 0 1-.5-.5z"/>
	</svg>
	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
  	<path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
	</svg>
</h4>
<hr/>
<div style="">
	<table class="table">
		<tbody>
		@foreach ($cart as $cart)
			<tr>
				{!! Form::open(['route' => ['shopping.update', $cart->id], 'method'=>'PUT']) !!}
					<ul class="list-group" style="display: inline-block; float: left;">
						<li class="list-group-item">
							@foreach ($items as $item)
								@if($item->id == $cart->item_id)
									<h5> {{$item->title}} </h5>
								@endif
							@endforeach
						</li>
						<li class="list-group-item">
							{{Form::label('quantity', 'Quantity')}}
						</li>
						<li class="list-group-item">
							<input type="number" name="quantity" id="input" class="form-control" value="{{$cart->quantity}}" min="{1"} max="{11"} step="" required="required" title="">
							<input type="hidden" name="sess" value="{{$sess}}"/>
						{{--<input type="hidden" name="id" value="{{$items->id}}"/>--}}
						</li>
							<li class="list-group-item">
							{!! Form::submit('Update Quantity', ['class' => 'btn btn-primary btn-block']) !!}
				{!!Form::close() !!}
						</li>
						<li class="list-group-item">
							{!! Form::open(['route' => ['shopping.destroy', $cart->id], 'method'=>'DELETE']) !!}
								<input type="hidden" name="sess" value="{{$sess}}"/>
								{{ Form::submit('Delete', ['class'=>'btn btn-sm btn-danger btn-block', 'onclick'=>'return confirm("Are you sure?")']) }}
							{!!Form::close() !!}
						</li>
						<li class="list-group-item">
							@foreach ($items as $item)
								@if($item->id == $cart->item_id)
									Price: {{ $item->price * $cart->quantity}}
									<?php
										$allPrice += $item->price * $cart->quantity;
									?>
								@endif
							@endforeach
						</li>
						<li class="list-group-item">
							Quantity: {{ $cart->quantity }}
						</li>
					</ul>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
<div style="display: block; float: left; width: 100%;">
	<div style="width: 35%; display: block; float: left;">
		<div class="card text-center">
			<div class="card-header">
				Customer Details
				<hr/>
			</div>
			<div class="card-body">
				{!! Form::open(['route' => 'order.store', 'data-parsley-validate' => '', 
							'files' => false]) !!}
							
					{{ Form::label('fname', 'First Name:') }}
					{{ Form::text('fname', $firstName, ['class'=>'form-control', 'style'=>'', 
													'data-parsley-required'=>'', 
													'data-parsley-maxlength'=>'255']) }}

					{{ Form::label('lname', 'Last Name:', ['style'=>'margin-top:20px']) }}
					{{ Form::text('lname', $lastName, ['class'=>'form-control', 
														'data-parsley-required'=>'']) }}

					{{ Form::label('pnum', 'Phone Number:', ['style'=>'margin-top:20px']) }}
					{{ Form::text('pnum', $phoneNumber, ['class'=>'form-control', 
													'data-parsley-required'=>'']) }}	

					{{ Form::label('email', 'Email:', ['style'=>'margin-top:20px']) }}
					{{ Form::text('email', $emailAddr, ['class'=>'form-control', 
													'data-parsley-required'=>'']) }}
					<input type="hidden" name="sess" value="{{$sess}}"/>
					<input type="hidden" name="price" value="{{$cart->price * $cart->quantity}}"/>
					<input type="hidden" name="quantity" value="{{$cart->quantity}}"/>
					<input type="hidden" name="id" value="{{$cart->item_id}}"/>
					<input type="hidden" name="all_price" value="{{$allPrice}}"/>

					{{ Form::submit('Place Order', ['class'=>'btn btn-primary btn-lg btn-block', 'style'=>'margin-top:20px']) }}

				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
	<?php
		if (!empty($_GET)) {
			$firstName = $_GET['fname'];
			$lastName = $_POST['lname'];
			$emailAddr = $_POST['pnum'];
			$phoneNumber = $_POST['email'];
		}
	?>

@endsection