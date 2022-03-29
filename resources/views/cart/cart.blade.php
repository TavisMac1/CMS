<?php
session_start();
$sess = session_id();
$getIP = $_SERVER['REMOTE_ADDR'];
?>
@extends('common') 

@section('pagetitle')
Shopping Cart
@endsection

@section('pagename')
Tavis Store
@endsection

@section('content')
	
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1> Your shopping cart</h1>
		</div>
		<div class="col-md-12">
		</div>
	</div>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<table class="table">
				<thead>
					<th>Your cart</th>
				</thead>
				<hr/>
				<tbody>
					@foreach ($items as $item)
							<tr>
								<td>{{ $item->title }}</td>
								
								{!! Form::open(['route' => ['shopping.update', $cart->id], 'method'=>'PUT']) !!}
									{{Form::label('quantity', 'Quantity')}}
									<input type="number" name="quantity" id="input" class="form-control" value="" min="{1"} max="{11"} step="" required="required" title="">
									<input type="hidden" name="sess" value="{{$sess}}"/>
									<input type="hidden" name="id" value="{{$item->id}}"/>
									{!! Form::submit('Update Quantity', ['class' => 'btn btn-primary', 'style'=>'width: 200px;']) !!}
								{!!Form::close() !!}
								{!! Form::open(['route' => ['shopping.destroy', $cart->id], 'method'=>'DELETE']) !!}
									{{ Form::submit('Delete', ['class'=>'btn btn-sm btn-danger btn-block', 'style'=>'width: 200px; float: right', 'onclick'=>'return confirm("Are you sure?")']) }}
								{!!Form::close() !!}

								<td>${{ $item->price }}</td>
								<td>{{ $item->quantity }}</td>
							</tr>
							<div> 
								<span> 
									Price: ${{$item->price * $cart->quantity}}
								</span>
							</div>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Customer Details</h1>
			<hr/>

			{!! Form::open(['route' => 'order.store', 'data-parsley-validate' => '', 
			                'files' =>false]) !!}
			    
				{{ Form::label('fname', 'First Name:') }}
			    {{ Form::text('fname', null, ['class'=>'form-control', 'style'=>'', 
			                                  'data-parsley-required'=>'', 
											  'data-parsley-maxlength'=>'255']) }}

			    {{ Form::label('lname', 'Last Name:', ['style'=>'margin-top:20px']) }}
			    {{ Form::text('lname', null, ['class'=>'form-control', 
				                                 'data-parsley-required'=>'']) }}

				{{ Form::label('pnum', 'Phone Number:', ['style'=>'margin-top:20px']) }}
				{{ Form::text('pnum', null, ['class'=>'form-control', 
												'data-parsley-required'=>'']) }}	

				{{ Form::label('email', 'Email:', ['style'=>'margin-top:20px']) }}
				{{ Form::text('email', null, ['class'=>'form-control', 
												'data-parsley-required'=>'']) }}
				<input type="hidden" name="sess" value="{{$sess}}"/>
				<input type="hidden" name="price" value="{{$item->price * 1}}"/>
				<input type="hidden" name="quantity" value="{{$item->quantity}}"/>
				<input type="hidden" name="id" value="{{$item->id}}"/>

			    {{ Form::submit('Place Order', ['class'=>'btn btn-primary btn-lg btn-block', 'style'=>'margin-top:20px']) }}

			{!! Form::close() !!}

		</div>
	</div>

@endsection