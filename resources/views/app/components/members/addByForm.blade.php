<div class="row">
  <div class="col-md-12">
    {!!Form::open(['url' => '/members/submit/newmember'])!!}
      <div class="col-md-6">
          <div class="form-group">
              <label>Name</label>
              {{Form::text('name',null,['placeholder'=>'Member Name', 'class'=>'form-control border-input','required'=>'required'])}}
          </div>
      </div>

      <div class="col-md-6">
          <div class="form-group">
              <label>Email</label>
              {{Form::email('email',null,['placeholder'=>'Member Email', 'class'=>'form-control border-input','required'=>'required'])}}
          </div>
      </div>

      <div class="col-md-6">
          <div class="form-group">
              <label>Position</label>
              {{Form::text('position',null,['placeholder'=>'Member Position', 'class'=>'form-control border-input','required'=>'required'])}}
          </div>
      </div>

      <div class="col-md-6">
          <div class="form-group">
              <label>Status</label>
              {{Form::select('status',['active'=>'Active','inactive'=>'Inactive'],'Active',['class'=>'form-control border-input','required'=>'required'])}}
          </div>
      </div>

      <div class="col-md-12">
          <div class="form-group">
            {{Form::submit('Submit',['class'=>'btn btn-wd btn-success'])}}
          </div>
      </div>

    {!!Form::close()!!}
  </div>
</div>
