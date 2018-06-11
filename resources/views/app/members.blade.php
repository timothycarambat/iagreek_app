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

						<a data-toggle="modal" data-target="#newMemberModal" style='margin-top:5px;' class="btn btn-wd btn-default"><i class="fa-fw fas fa-plus"></i>Add More Members</a>

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
									<td style="width:6%">
											<a data-toggle='modal' data-target='' data-add-tags data-member='{{$member->id}}' style='cursor:pointer' title="Add Tags to Member"><i style='color:#3c763d' class="fa-fw fas fa-tags"></i></a>
											<a data-toggle='modal' data-target='' data-edit-member data-member='{{$member->id}}' style='cursor:pointer' title="Edit Member Info"><i style='color:#31708f' class="fa-fw fas fa-user-edit"></i></a>
											<a data-toggle='modal' data-target='' data-remove-member data-member='{{$member->id}}' style='cursor:pointer' title="Delete Member"><i style='color:#a94442' class="fa-fw fas fa-trash-alt"></i></a>
									</td>
									<td class="text-center">{{$member->name}}</td>
									<td class="text-center">{{$member->email}}</td>
									<td class="text-center">{{$member->status}}</td>
									<td class="text-center">{{$member->position}}</td>
									<?php
										$tags = [];
										foreach($member->tags as $tag) {
											$tags[] = $tag->name;
										}
										$tags = implode(',',$tags);
									?>
									<td class="text-center">{{ empty($tags)? "--" : $tags }}</td>
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

@include('app.components.members.newMemberModal')
@include('app.components.members.addTagsModal')


@endsection
