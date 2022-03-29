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
	<div class="d-flex justify-content-center">
		@foreach ($items as $item)
			<div class="card text-center bg-primary" style="width: 30rem;">
				<img class="card-img-top img-thumbnail" style="width:350px;height:300px;" src="{{ Storage::url('public/images/items/lrg_'. $item->picture) }}" alt="Card image cap">
				<div class="card-body">
					<h5 class="card-title text-secondary">{{ $item->title }}</h5>
					<ul class="list-group list-group-flush">
						<li class="list-group-item text-primary">PRICE: {{ $item->price }}</li>
						<li class="list-group-item text-primary">QUANTITY: {{$item->quantity}}</li>
						<li class="list-group-item text-primary">ID: {{$item->id}}</li>
						<li class="list-group-item text-primary">SKU: {{$item->sku}}</li>
					</ul>
					<p class="card-text">{{$item->description}}</p>
					<form action="{{route('shopping.store')}}" method="post"> 
						@csrf
						<input type="hidden" name="id" value="{{$item->id}}"/>
						<input type="hidden" name="sess" value="{{$sess}}"/>
						<input type="hidden" name="ip" value="{{$getIP}}"/>
						<input type="submit" class="btn btn-success btn-md" value="Buy"/>
					</form>
				</div>
			</div>
		</div>
		@endforeach
@endsection