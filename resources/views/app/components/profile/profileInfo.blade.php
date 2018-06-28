<div class="header">
    <h4 class="title">Edit Profile</h4>
</div>
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
        <button type="submit" class="btn btn-info btn-wd">Update Profile</button>
    </div>
    <div class="clearfix"></div>
{!!Form::close()!!}
