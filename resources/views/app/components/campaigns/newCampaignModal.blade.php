<!-- New Member Modal -->
<div class="modal fade" id="newCampaignModal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title text-center">Start New Campaign</h4>
    </div>
    <div class="modal-body">
      <p class="well">Create a new campaign here so you can make start sending out signature requests. Once underway you can then send reminder emails,
        check on the status in real time, and also download all the signed documents for offline storage - but we always have your back if you dont have a big enough hard drive!
      </p>

      <div class="row">
        <div class="col-md-12">
          {!!Form::open(['url' => '/campaigns/new_campaign'])!!}
            <div class="col-md-12">
                <div class="form-group">
                    <label>Name</label>
                    {{Form::text('name',null,['placeholder'=>'Campaign Title', 'class'=>'form-control border-input','required'=>'required'])}}
                </div>
            </div>
            {{Form::submit('Create Campaign',['class'=>'btn btn-wd btn-info'])}}
            {!!Form::close()!!}
        </div>
      </div>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>
