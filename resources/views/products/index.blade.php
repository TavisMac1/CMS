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
			<h1>Our Product Categories</h1>
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
					@foreach ($categories as $category)
						<tr>
							<td>{{ $category->name }}</td>
							<td style='width:150px;'><div style='float:left; margin-right:5px;'><a href="{{ route('products.show', $category->id) }}" class="btn btn-success btn-sm">View</a></div><div style='float:left;'>
							</td>
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