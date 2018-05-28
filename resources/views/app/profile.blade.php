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
                          <img class="avatar border-outline" src="{{Storage::url('avatars/mATjj5N2gkjJ.png')}}" alt="..."/>
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
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Organization</label>
                                        <input type="text" class="form-control border-input" disabled placeholder="Organization" value="{{Auth::user()->org_name}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control border-input" placeholder="Email" value="{{Auth::user()->email}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" class="form-control border-input" placeholder="First Name" value="{{explode(' ', Auth::user()->name)[0]}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control border-input" placeholder="Last Name" value="{{explode(' ', Auth::user()->name)[1]}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Billing Address</label>
                                        <input type="text" class="form-control border-input" placeholder="Billing Address" value="{{Auth::user()->billing_address}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Billing City</label>
                                        <input type="text" class="form-control border-input" placeholder="Billing City" value="{{Auth::user()->billing_city}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Billing State</label>
                                        <input type="text" class="form-control border-input" placeholder="State" value="{{Auth::user()->billing_state}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Billing Zip Code</label>
                                        <input type="number" class="form-control border-input" placeholder="ZIP Code" value="{{Auth::user()->billing_zip}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                              <div class="col-md-4">
                                <div class="text-center">
                                    <a href='#' class="btn btn-default btn-wd">Manage Members</a>
                                </div>
                              </div>
                              <div class="col-md-4">

                              </div>
                            </div>


                            <div class="text-center">
                                <button type="submit" class="btn btn-info btn-fill btn-wd">Update Profile</button>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>


			</div>
	</div>
@endsection
