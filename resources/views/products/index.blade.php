<?php
session_start();
$getIP = $_SERVER['REMOTE_ADDR'];
?>
@extends('common') 

@section('pagetitle')
Item List
@endsection

@section('pagename')
Tavis Store Front
@endsection

@section('content')
	<div class="jumbotron mx-auto text-center">
		<p class="lead text-primary">Here are the categories of products available</p>
	</div>
	<div class="container" style="width: 200px; position: fixed; left: -15px;">
		<table class="table table-hover" style="width: 100%; background-color: rgb(228, 228, 228); border-right: solid; border-color:rgb(50, 131, 252); border-width: 3px;">
			<thead class="well">
				<tr>
					<th style="color:rgb(50, 131, 252);">Categories</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($categories as $category)
				<tr>
					<td>
						<a href="{{ route('products.show', $category->id) }}" class="btn btn-link btn-sm text-white">View {{ $category->name }}</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="container" style="width: 650px; margin-right: auto; margin-left: auto;">
		<table class="table" style="border: none;">
			<thead>
				<tr>
					@foreach ($items as $item)
						<th style="display: none;"></th>
					@endforeach
				</tr>
			</thead>
			<tbody>
				<tr class="">
					@foreach ($items as $item)
						<td style="max-width: 150px; display:inline-table; border: none; margin-bottom: 10px;">
							<a href="{{ route('details.show', $item->id) }}" style=" border: none; border-radius: 15px; font-size: 10px; font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">{{$item->title}}</a>
							<a href="{{ route('details.show', $item->id) }}" class="text-primary">
								<img class="card-img-top img-thumbnail" style="width:150px;height:100px;" src="{{ Storage::url('public/images/items/tn_'. $item->picture) }}" alt="Card image cap">
							</a>
							<a href="{{ route('details.show', $item->id) }}" class="btn btn-primary" style=" border: none; border-radius: 15px; font-size: 10px; font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">buy now</a>
							<small class="text-muted" style="color: dodgerblue;">${{$item->price}}</small>
						</td>
					@endforeach
				</tr>
			</tbody>
		</table>
	</div>
@endsection