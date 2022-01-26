<?php
session_start();
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
				<tbody>
					@foreach ($items as $item)
							<tr>
								<td>{{ $item->title }}</td>
								<td><img src="{{ Storage::url('public/images/items/lrg_'. $item->picture) }}" ></td>
								<td>${{ $item->price }}</td>
								<td>{{ $item->description }}</td>
								<td>{{ $item->quantity }}</td>
								<td>{{ $item->id }}</td>
								<td>{{ $item->sku }}</td>
								<td style="width: 175px;"><div style='float:left; margin-right:5px;'><a href="{{ route('items.edit', $item->id) }}" class="btn btn-primary btn-sm">Add to cart</a></div><div style='float:left;'>
							</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

@endsection