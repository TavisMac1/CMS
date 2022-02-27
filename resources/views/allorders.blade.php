@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
            {!! Form::open(['route' => 'order.store', 'files' =>false]) !!}
				<input type="hidden" name="show" value="{{$show}}"/>
			    {{ Form::submit('Show Orders', ['class'=>'btn btn-success btn-lg btn-block', 'style'=>'margin-top:20px']) }}

			{!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
