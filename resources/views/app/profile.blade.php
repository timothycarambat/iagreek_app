@extends('app.layout.layout')

@section('main_content')
	<div class="content">
			<div class="container-fluid">

        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="card card-user">
                    <div class="image" style='background-color:#d68d8d'>
                    </div>
                    <div class="content">
                        <div class="author">
													<div class="">
														<img class="avatar border-outline" src="{{Auth::user()->avatar}}" alt="..."/>
														<a data-toggle="modal" data-target="#profileModal">
															<i class='profile-upload fas fa-plus'></i>
														</a>
													</div>
                          <h4 class="title">{{Auth::user()->name}}<br />
                             <a href="#"><small>{{Auth::user()->email}}</small></a>
                          </h4>
                        </div>
                        <p class="description text-center">
                            Account manager for
                            <br>
                            {{Auth::user()->org_name}}
                        </p>
                    </div>
                    <hr>
                    <div class="text-center">
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">
                                <h5>0<br /><small>Org. Size</small></h5>
                            </div>
                            <div class="col-md-4">
                                <h5>0<br /><small>Documents</small></h5>
                            </div>
                            <div class="col-md-3">
                                <h5>0<br /><small>Campaigns</small></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="header">
                        <h4 class="title">Active Campaigns</h4>
                    </div>
                    <div class="content">
                        <ul class="list-unstyled team-members">

                                    <li>
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <div class='counter'> 1 </div>
                                            </div>
                                            <div class="col-xs-6">
                                                Campaign One
                                                <br />
                                                <span class="text-muted">Created: <small> 5/25/2018</small></span>
                                            </div>

                                            <div class="col-xs-3 text-right">
                                                <btn class="btn btn-sm btn-success btn-icon"><i class="far fa-eye"></i></btn>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Edit Profile</h4>
                    </div>
                    <div class="content">
                        {!!Form::open(['url'=>'/profile/update'])!!}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Organization</label>
																				{{Form::text('org_name',Auth::user()->org_name,['placeholder'=>'Organization', 'class'=>'form-control border-input','disabled'=>'disabled','required'=>'required'])}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email address</label>
																				{{Form::email('email',Auth::user()->email,['placeholder'=>'Email', 'class'=>'form-control border-input','required'=>'required'])}}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>First Name</label>
																				{{Form::text('first_name',explode(' ', Auth::user()->name)[0],['placeholder'=>'First Name', 'class'=>'form-control border-input','required'=>'required'])}}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Last Name</label>
																				{{Form::text('last_name',explode(' ', Auth::user()->name)[1],['placeholder'=>'Last Name', 'class'=>'form-control border-input','required'=>'required'])}}
                                    </div>
                                </div>
																<div class="col-md-4">
                                    <div class="form-group">
                                        <label>Phone</label>
																				{{Form::text('phone',App\User::formatPhone(Auth::user()->phone),['placeholder'=>'(555) 123-4567', 'class'=>'form-control border-input','required'=>'required'])}}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Billing Address</label>
																				{{Form::text('address',Auth::user()->billing_address,['placeholder'=>'Billing Address', 'class'=>'form-control border-input','required'=>'required'])}}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Billing City</label>
																				{{Form::text('city',Auth::user()->billing_city,['placeholder'=>'Billing City', 'class'=>'form-control border-input','required'=>'required'])}}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Billing State</label>
																				{{Form::select('state', App\States::makeStateSelection(), Auth::user()->billing_state,['class'=>'form-control border-input','required'=>'required'])}}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Billing Zip Code</label>
																				{{Form::number('zip',Auth::user()->billing_zip,['placeholder'=>'ZIP Code', 'class'=>'form-control border-input','required'=>'required'])}}
                                    </div>
                                </div>
                            </div>

														<div class="text-center">
																<button type="submit" class="btn btn-info btn-fill btn-wd">Update Profile</button>
														</div>
														<div class="clearfix"></div>
												{!!Form::close()!!}

														<hr>
                            <div class="row">
                                <div class="col-md-6">
																	<h3 class="subsection-title">Document Settings</h3>
                                    <div class="form-group">
                                        <label>Document Letterhead</label>
																				<div class="custom-file">
																					@if( empty(Auth::user()->letterhead) )
																					<div class="well" data-letterhead-well>
																						<label>No Letterhead Image Set <br>
																							Accepted Filetypes: .png, jpeg, jpg
																						</label><br>
																						<label id="filename"></label>
																						<label id="progress"></label>
																						<label id="progressBar"></label>
																					</div>
																						<span class="btn btn-primary btn-file">
																						    Upload <input id='fileupload' type='file' name='letterhead' class="custom-file-input">
																						</span>
																					@else
																					<div class="well" data-letterhead-well>
																						<img class='letterhead-img' src='{{Auth::user()->letterhead}}'/>
																						<label id="filename"></label>
																						<label id="progress"></label>
																						<label id="progressBar"></label>
																					</div>
																						<span class="btn btn-primary btn-file">
																								Upload New <input id='fileupload' type='file' name='letterhead' class="custom-file-input">
																						</span>
																					@endif
																				</div>
                                    </div>
                                </div>

                            </div>

                    </div>
                </div>
            </div>


			</div>
	</div>

	<!-- User Profile image Modal -->
<div style='position:fixed' class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" >Upload a New Profile Image</h5>
      </div>
      <div class="modal-body">
					<div class="well" data-avatar-well>
						<img class='avatar-img' src='{{Auth::user()->avatar}}'/>
						<label id="filename"></label>
						<label id="progress"></label>
						<label id="progressBar"></label>
					</div>
						<span class="btn btn-primary btn-file">
								Upload New <input id='fileupload' type='file' name='avatar' class="custom-file-input">
						</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Done</button>
      </div>
    </div>
  </div>
</div>
@endsection
