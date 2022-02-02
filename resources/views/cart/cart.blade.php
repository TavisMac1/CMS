<?php
session_start();
$sess = session_id();
$getIP = $_SERVER['REMOTE_ADDR'];
?>
@extends('common') 

@section('pagetitle')
Item List
@endsection

@section('pagename')
Laravel Project
@endsection

@section('content')
	
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1> Your shopping cart</h1>
		</div>
		<div class="col-md-12">
			<hr />
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
								
								{!! Form::open(['route' => ['shopping.update', $item->id], 'method'=>'PUT']) !!}
									{{Form::label('quantity', 'Quantity')}}
									<input type="number" name="quantity" id="input" class="form-control" value='{{$cart[0]->quantity}}' min="{1"} max="{11"} step="" required="required" title="">
									<input type="hidden" name="sess" value="{{$sess}}"/>
									<input type="hidden" name="id" value="{{$item->id}}"/>
									{{!! Form::submit('Update Quantity', ['class' => 'btn btn-primary']) !!}}
								{!!Form::close() !!}
								{!! Form::open(['route' => ['shopping.destroy', $item->id], 'method'=>'DELETE']) !!}
									{{ Form::submit('Delete', ['class'=>'btn btn-sm btn-danger btn-block', 'style'=>'', 'onclick'=>'return confirm("Are you sure?")']) }}
								{!!Form::close() !!}

								<td>${{ $item->price }}</td>
								<td>{{ $item->quantity }}</td>
								<td style="width: 175px;"><div style='float:left; margin-right:5px;'><a href="{{ route('items.edit', $item->id) }}" class="btn btn-primary btn-sm">Add to cart</a></div><div style='float:left;'>
							</tr>
							<div> 
								<span> 
									Price: ${{$item->price * $cart[0]->quantity}}
								</span>
							</div>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

@endsection