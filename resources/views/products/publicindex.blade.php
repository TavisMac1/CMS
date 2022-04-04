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
	
	<div class="jumbotron">
		<h1 class="display-4">Our products!</h1>
		<p class="lead">Add a product to your cart when ready</p>
		<hr class="my-4">
	</div>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<table class="table">
				<tbody>
					@foreach ($items as $item)
						<div class="card bg-secondary border" style="width: 15rem; float: left; margin-right: 5px;">
							<img class="card-img-top img-thumbnail" style="width:150px;height:100px;" src="{{ Storage::url('public/images/items/tn_'. $item->picture) }}" alt="Card image cap">
							<div class="card-body">
								<h5 class="card-title">{{ $item->title }}</h5>
								 <ul class="list-group list-group-flush">
									<li class="list-group-item text-primary">${{ $item->price }}</li>
  								</ul>
								<a href="{{ route('details.show', $item->id) }}" class="btn btn-primary">Add to cart</a>
							</div>
						</div>
					@endforeach
				</tbody>
			</table>
			<div class="text-center">
				{!! $categories->links(); !!}
			</div>
		</div>
	</div>

@endsection