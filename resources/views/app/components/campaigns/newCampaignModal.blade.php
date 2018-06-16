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

          <ul class="nav nav-tabs">
            <li class="nav-item active">
              <a class="nav-link active" href="#nameCampaign" data-toggle="tab">Campaign Info</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#signers" data-toggle="tab">Who Is Signing?</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#Multisigners" data-toggle="tab">Anyone Else?</a>
            </li>
          </ul>

          {!!Form::open(['url' => '/campaigns/new_campaign','id'=>'newCampaignForm'])!!}
            <div class="tab-content">

              <div class="tab-pane active" id="nameCampaign">
                @include('app.components.campaigns.newCampaign_info')
              </div>

              <div class="tab-pane" id="signers">
                @include('app.components.campaigns.newCampaign_signers')
              </div>

              <div class="tab-pane" id="Multisigners">
                @include('app.components.campaigns.newCampaign_Multisigners')
              </div>

            </div>
            {{Form::submit('Launch Campaign',['class'=>'btn btn-wd btn-primary pull-right'])}}
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
