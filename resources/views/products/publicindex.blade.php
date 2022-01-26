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
								<td><img src="{{asset('storage/job'.$item->picture)}}" alt='image non avail'> </td>
								<td>{{ $item->title }}</td>
								<td>${{ $item->price }}</td>
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