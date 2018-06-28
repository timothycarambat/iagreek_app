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
													<?php $enum  = 1; ?>
													@if(App\Campaign::where('org_admin_id', Auth::user()->id)->where('archived', false)->count() > 0)
														@foreach(Auth::user()->campaigns as $campaign)
															@if(!$campaign->archived)
																<li>
																		<div class="row">
																				<div class="col-xs-3">
																						<div class='counter'> {{$enum}} </div>
																				</div>
																				<div class="col-xs-6">
																						{{$campaign->name}}
																						<br />
																						<span class="text-muted">Created: <small>{{$campaign->created_at->diffForHumans()}}</small></span>
																				</div>

																				<div class="col-xs-3 text-right">
																					<a href="/campaign/edit/{{$campaign->id}}">
																						<btn class="btn btn-sm btn-success btn-icon"><i class="far fa-eye"></i></btn>
																					</a>
																				</div>
																		</div>
																</li>
															@endif
														@endforeach
													@else
														<li>
															<div class="row">
																<div class="col-xs-12 text-center">
																	No Active Campaigns
																</div>
															</div>
														</li>
													@endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="card">



									<div class="row">
										<div class="col-md-12">

											<ul class="nav nav-tabs">
												<li class="nav-item active">
													<a class="nav-link active" href="#profileInfo" data-toggle="tab">Profile Info</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" href="#billingInfo" data-toggle="tab">Billing Info</a>
												</li>
											</ul>

												<div class="tab-content">

													<div class="tab-pane active" id="profileInfo">
														<div class="content">
															@include('app.components.profile.profileInfo')
														</div>
													</div>

													<div class="tab-pane" id="billingInfo">
														<div class="content">
															@include('app.components.profile.billingInfo')
														</div>
													</div>

												</div>

										</div>
									</div>


                    <div class="content">
												<hr>
												{!!Form::open(['url'=>'/profile/update/notify'])!!}
	                        <div class="row">
														<div class="col-md-12">
															<h3 class="subsection-title">Email Notification Settings</h3>

															<div class="col-md-4">
	                                <div class="form-group">
																		<label>Email On Completed Campaign</label>
																		<br>
																		<label class="switch">
																		  <input type="checkbox" {{Auth::user()->email_on_campaign_complete ? 'checked':''}} name='email_on_campaign_complete'>
																		  <span class="slider round"></span>
																		</label>
	                                </div>
	                            </div>

														</div>
	                        </div>

													<div class="text-center">
															<button type="submit" class="btn btn-info btn-wd">Update Notifications</button>
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
												<hr>
                        <div class="row">
													<div class="col-md-12 text-right">
														<a data-toggle='modal' data-target='#cancelAccount' class="btn btn-danger btn-wd"> Close Account</a>
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


<!-- User Cancel Profile Modal -->
<div style='position:fixed' class="modal fade" id="cancelAccount" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header alert alert-danger">
        <h5 class="modal-title text-center " ><b>Cancel Account?</b></h5>
      </div>
      <div class="modal-body" style="font-size:20px;">
				Hey there,

				We would hate to see you go, but we would really like to know why and see what we can do for you to make this expierence better for you. The Coliseum wasn't built in a day - and we strive
				constantly to make this platform greater for all our users.
				<br><br>
				If you could take a moment and let us know why you cancelled it would help us a lot.
				<br><br>
				This action will take effect immedietly and will automatically sort out the billing costs for you. It will log you out and you wont have access to your signed documents anymore.
				<br><br>
				However, you're still a dear member to us and if you email us at <a href="mailto:{{$_ENV['SUPPORT_EMAIL']}}">{{$_ENV['SUPPORT_EMAIL']}}</a> we can grab all your signed documents we
				have for you and send them so you always have them! This is at no cost!
 				<br><br>
				Best,
				<br>
				IAGREEK Support Team
				<br><br><br>
				Your Comments:
				{!!Form::open(['url'=>'/user/'.Auth::user()->id.'/unsubscribe'])!!}
				<textarea name="cancel_comments" rows="8" style="width:100%;resize:vertical"></textarea>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger btn-wd" data-cancel-account>Cancel Account</button>
      </div>
			{!!Form::close()!!}
    </div>
  </div>
</div>
@endsection
