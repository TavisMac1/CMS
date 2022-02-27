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
			<h1>Our Products</h1>
		</div>
		<div class="col-md-12">
			<hr />
		</div>
	</div>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<table class="table">
				<thead>
					<th>Name</th>
				</thead>
				<tbody>
					@foreach ($items as $item)
							<tr>
								<td>{{ $item->title }}</td>
								<td><img style="width:150px;height:100px;" src="{{ Storage::url('public/images/items/tn_'. $item->picture) }}" ></td>
								<td>${{ $item->price }}</td>
								<td style="width: 175px;"><div style='float:left; margin-right:5px;'><a href="{{ route('details.show', $item->id) }}" class="btn btn-primary btn-sm">Buy Now</a></div><div style='float:left;'>
							</tr>
					@endforeach
				</tbody>
			</table>
			<div class="text-center">
				{!! $categories->links(); !!}
			</div>
		</div>
	</div>

@endsection