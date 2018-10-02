<div class="header">
    <h4 class="title">Subscribe To IAGREEK</h4>
</div>
{!!Form::open(['url'=>'/billing/subscribe','data-card-submit'])!!}
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>First Name</label>
                {{Form::text('first_name',explode(' ', Auth::user()->billing_name)[0],['placeholder'=>'First Name', 'class'=>'form-control border-input','required'=>'required'])}}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Last Name</label>
                {{Form::text('last_name',explode(' ', Auth::user()->billing_name)[1],['placeholder'=>'Last Name', 'class'=>'form-control border-input','required'=>'required'])}}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Phone</label>
                {{Form::text('billing_phone',App\User::formatPhone(Auth::user()->billing_phone),['placeholder'=>'(555) 123-4567', 'class'=>'form-control border-input','required'=>'required'])}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Billing Address</label>
                {{Form::text('billing_address',Auth::user()->billing_address,['placeholder'=>'Billing Address', 'class'=>'form-control border-input','required'=>'required'])}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Billing City</label>
                {{Form::text('billing_city',Auth::user()->billing_city,['placeholder'=>'Billing City', 'class'=>'form-control border-input','required'=>'required'])}}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Billing State</label>
                {{Form::select('billing_state', App\States::makeStateSelection(), Auth::user()->billing_state,['class'=>'form-control border-input','required'=>'required'])}}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Billing Zip Code</label>
                {{Form::number('billing_zip',Auth::user()->billing_zip,['placeholder'=>'ZIP Code', 'class'=>'form-control border-input','required'=>'required'])}}
            </div>
        </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
            <label>Estimated Active Organization Size:</label>
            {{Form::number('org_size', Auth::user()->org_size(),['placeholder'=>'Organization Size', 'class'=>'form-control border-input','required'=>'required'])}}
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label>Recommended Plan:</label>
          {{Form::select('org_type', App\Subscription::getPlanList(),
            'iag_small', ['class' =>'form-control border-input', 'required'=>'required'])
          }}
        </div>
      </div>

    </div>

    <div class="row">
      <div class="col-md-8">
        <div class="form-group">
          {{ Form::label(null, 'Credit card number',['style'=>'font-weight:800','data-cc-label']) }}
            <div class="form-control border-input" id='card-number'></div>
            <div id="card-errors" role="alert"></div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          {{Form::label('coupon', 'Coupon Code:',['style'=>'font-weight:800'])}}
          {{Form::text('coupon',null,['class' => 'form-control border-input']) }}
        </div>
      </div>
    </div>


    <div class="text-center">
        <button type="submit" class="btn btn-info btn-wd">Subscribe to IAGREEK</button>
    </div>
    <div class="clearfix"></div>
{!!Form::close()!!}
