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


	<!-- New Member Modal -->
<div class="modal fade" id="newMemberModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center">Add New Members</h4>
      </div>
      <div class="modal-body">
				<p class="well"> <strong>Hey!</strong> We offer two easy ways to add members. You can either download our template and reupload it with all
					your members and we will update members that are already here and add the ones that aren't! You can also
					add single inputs of members!
					<br><br>Keep in mind that only active members count against your subscription count!</p>


				<ul class="nav nav-tabs">
				  <li class="nav-item active">
				    <a class="nav-link active" href="#addByFile" data-toggle="tab">Add by File</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" href="#addByForm" data-toggle="tab">Add by Form</a>
				  </li>
				</ul>

				<div class="tab-content">
	        <div class="tab-pane active" id="addByFile">
					  @include('app.components.addByFile')
	        </div>

	        <div class="tab-pane" id="addByForm">

	        </div>
      	</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection
