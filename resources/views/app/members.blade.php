@extends('app.layout.layout')

@section('main_content')
	<div class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-3">

						@if(request()->showAll)
							<a href="?showAll=true" class="btn btn-wd btn-defaultactive">Showing All ({{$org_size}} Members)</a>
						@else
							<a href="?showAll=true" class="btn btn-wd btn-default">Show All ({{$org_size}} Members)</a>
						@endif

						<a href="#" style='margin-top:5px;' class="btn btn-wd btn-default"><i class="fa-fw fas fa-plus"></i>Add More Members</a>
						
					</div>
				</div>
				<br>
				<table class='table table-striped table-bordered table-responsive member-table'>
					<thead>
						<tr>
							<th class="text-center"></th>
							<th class="text-center">Name <i class="fa-fw fas fa-sort"></i></th>
							<th class="text-center">Email <i class="fa-fw fas fa-sort"></i></th>
							<th class="text-center">Status <i class="fa-fw fas fa-sort"></i></th>
							<th class="text-center">Position <i class="fa-fw fas fa-sort"></i></th>
							<th class="text-center">Tags</th>
						</tr>
					</thead>
					<tbody>
						@if( count($members) > 0 )
							@foreach($members as $member)
								<tr>
									<td></td>
									<td class="text-center">{{$member->name}}</td>
									<td class="text-center">{{$member->email}}</td>
									<td class="text-center">{{$member->status}}</td>
									<td class="text-center">{{$member->position}}</td>
									<td class="text-center">N/A</td>
								</tr>
							@endforeach
						@else
						<tr>
							<td colspan ="6" class="text-center">No Members Listed!</td>
						</tr>
						@endif
					</tbody>
				</table>

				@if(!request()->showAll)
					<div class="pagination-bar text-center">
		       	{{ $members->links() }}
					</div>
				@endif

			</div>
	</div>

@endsection
