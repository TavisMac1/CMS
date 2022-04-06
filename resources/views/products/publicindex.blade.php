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
							<a href="{{ route('details.show', $item->id) }}" class="text-primary">
									<img class="card-img-top img-thumbnail" style="width:150px;height:100px;" src="{{ Storage::url('public/images/items/tn_'. $item->picture) }}" alt="Card image cap">
							</a>
							<div class="card-body">
								<h5 class="card-title"><a href="{{ route('details.show', $item->id) }}" class="text-primary">
									{{ $item->title }}
								</a></h5>
								 <ul class="list-group list-group-flush">
									<li class="list-group-item text-primary">${{ $item->price }}</li>
  								</ul>
								<a href="{{ route('details.show', $item->id) }}" class="btn btn-primary">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
									<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
									</svg>
									View
								</a>
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