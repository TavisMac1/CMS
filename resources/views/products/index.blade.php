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
	<div class="jumbotron">
		<h1 class="display-4">Our Product Categories!</h1>
		<p class="lead">Here are the categories of products available</p>
		<hr class="my-4">
	</div>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<table class="table">
				<tbody>
					@foreach ($categories as $category)
						<ul class="list-group">
							<li class="list-group-item active text-info">{{ $category->name }}</li>
							<li class="list-group-item"><a href="{{ route('products.show', $category->id) }}" class="btn btn-primary btn-sm">View {{ $category->name }}</a></li>
						</ul>
					@endforeach
				</tbody>
			</table>
			<div class="text-center">
				{!! $categories->links(); !!}
			</div>
		</div>
	</div>

@endsection