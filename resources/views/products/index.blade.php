<?php
session_start();
$getIP = $_SERVER['REMOTE_ADDR'];
?>
@extends('common') 

@section('pagetitle')
Item List
@endsection

@section('pagename')
Tavis Store | Products
@endsection

@section('content')
<style>
	#imgs a:hover {
		transform: scale(1.5);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
	}
</style>
	<div class="container" id="itemsCon" style="display: flex; border-right: solid; border-color:dodgerblue; background-color:rgb(215, 215, 215);">
		<table class="table-inline table-hover" style="width: 10%; max-height:300px; float: left; background-color: rgb(228, 228, 228); margin-right: 10px; border-right: solid; border-color:rgb(50, 131, 252); border-width: 3px;">
			<thead class="well">
				<tr>
					<th class="text-center" style="color:rgb(50, 131, 252);">Categories</th>
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
		<table class="table" style="border: none; float: left;">
			<thead >
				<tr>
					@foreach ($items as $item)
						<th style="display: none;"></th>
					@endforeach
				</tr>
			</thead>
			<tbody style="float: left;">
				<tr style="float: left;">
					@foreach ($items as $item)
						<td style="max-width: 150px; display:inline-table; border: none; margin-bottom: 10px;">
							<a href="{{ route('details.show', $item->id) }}" style=" border: none; border-radius: 15px; font-size: 10px; font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">{{$item->title}}</a>
							<a href="{{ route('details.show', $item->id) }}" class="text-primary">
								<img onMouseOver="this.style.transform='scale(1.3)'" onMouseOut="this.style.transform='scale(1)'" class="card-img-top img-thumbnail" id="imgs" style="width:150px;height:100px;" src="{{ Storage::url('public/images/items/tn_'. $item->picture) }}" alt="Card image cap">
							</a>
							<a href="{{ route('details.show', $item->id) }}" class="btn btn-primary" style=" border: none; border-radius: 15px; font-size: 10px; font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">buy now</a>
							<small class="text-muted" style="color: rgb(65, 65, 65);">${{$item->price}}</small>
						</td>
					@endforeach
				</tr>
			</tbody>
		</table>
	</div>
@endsection