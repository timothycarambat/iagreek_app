@extends('app.layout.layout')

@section('main_content')
	<div class="content">
			<div class="container-fluid">
					@include('app.components.dashboard.topCards')
					@include('app.components.dashboard.campaigns')


			</div>
	</div>
@endsection
