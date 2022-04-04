<?php
	session_start();
	$sess = session_id();
	$getIP = $_SERVER['REMOTE_ADDR'];
	$firstName = "";
	$lastName = "";
	$emailAddr = "";
	$phoneNumber = "";
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
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1 class="text-primary"> Your shopping cart</h1>
		</div>
		<div class="col-md-12">
		</div>
	</div>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<table class="table">
				<thead>
					<th class="text-primary">Your cart</th>
				</thead>
				<hr/>
				<tbody>
					@foreach ($items as $item)
							<tr>
								<td>{{ $item->title }}</td>
								{!! Form::open(['route' => ['shopping.update', $cart->id], 'method'=>'PUT']) !!}
									<ul class="list-group">
										<li class="list-group-item">
											{{Form::label('quantity', 'Quantity')}}
										</li>
										<li class="list-group-item">
											<input type="number" name="quantity" id="input" class="form-control" value="{{$cart->quantity}}" min="{1"} max="{11"} step="" required="required" title="">
											<input type="hidden" name="sess" value="{{$sess}}"/>
											<input type="hidden" name="id" value="{{$item->id}}"/>
										</li>
										<li class="list-group-item">
											{!! Form::submit('Update Quantity', ['class' => 'btn btn-primary btn-block']) !!}
											{!!Form::close() !!}
										</li>
										<li class="list-group-item">
											{!! Form::open(['route' => ['shopping.destroy', $cart->id], 'method'=>'DELETE']) !!}
												{{ Form::submit('Delete', ['class'=>'btn btn-sm btn-danger btn-block', 'onclick'=>'return confirm("Are you sure?")']) }}
											{!!Form::close() !!}
										</li>
										<li class="list-group-item">
											Price: {{ $item->price * $cart->quantity}}
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
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1 class="text-primary">Customer Details</h1>
			<hr/>

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

			    {{ Form::submit('Place Order', ['class'=>'btn btn-primary btn-lg btn-block', 'style'=>'margin-top:20px']) }}

			{!! Form::close() !!}

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