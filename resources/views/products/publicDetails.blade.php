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
	
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1> Title </h1>
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
								<td><img style="width:350px;height:300px;"src="{{ Storage::url('public/images/items/lrg_'. $item->picture) }}" ></td>
								<td>${{ $item->price }}</td>
								<td>{{ $item->description }}</td>
								<td>{{ $item->quantity }}</td>
								<td>{{ $item->id }}</td>
								<td>{{ $item->sku }}</td>
								<td style="width: 200px;"><div style='float:left; margin-right:5px;'>
									<form action="{{route('shopping.store')}}" method="post"> 
										@csrf
										<input type="hidden" name="id" value="{{$item->id}}"/>
										<input type="hidden" name="sess" value="{{$sess}}"/>
										<input type="hidden" name="ip" value="{{$getIP}}"/>
										<input type="submit" class="btn btn-primary btn-sm" value="Buy"/>
									</form>
								</div>
								<div style='float:left;'>
							</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection