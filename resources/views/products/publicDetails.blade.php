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
	
	
	<h1 style="color: rgb(58, 58, 58)"> Your Cart </h1>
	<hr />

	@foreach ($items as $item)
		<div class="card text-center" style="width: 30rem; display: inline-flex; float: left;">
			<img class="card-img-top img-thumbnail" style="width:350px;height:300px;" src="{{ Storage::url('public/images/items/lrg_'. $item->picture) }}" alt="Card image cap">
		</div>
		<ul class="list-group list-group-flush" style="display: block; float: left;">
  			<li class="list-group-item">{{ $item->title }}</li>
  			<li class="list-group-item">Price: {{ $item->price }}</li>
  			<li class="list-group-item">Quantity: {{$item->quantity}}</li>
  			<li class="list-group-item">Id: {{$item->id}}</li>
  			<li class="list-group-item">Sku: {{$item->sku}}</li>
			<li class="list-group-item">{{$item->description}}</li>
			<li class="list-group-item">
				<form action="{{route('shopping.store')}}" method="post"> 
					@csrf
					<input type="hidden" name="id" value="{{$item->id}}"/>
					<input type="hidden" name="sess" value="{{$sess}}"/>
					<input type="hidden" name="ip" value="{{$getIP}}"/>
					<input type="submit" class="btn btn-primary btn-md" value="Buy"/>
				</form>
			</li>
		</ul>
	@endforeach
@endsection