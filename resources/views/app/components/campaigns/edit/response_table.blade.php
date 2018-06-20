<div class="card">
    <div class="header">
        <h4 class="title">Responses</h4>
        <p class="category">View Progress and Download Completed Documents</p>
    </div>
    <div class="content table-responsive table-full-width">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Signer</th>
          	<th>Email</th>
          	<th>Primary Signature</th>
            @if($sign_requests->first()->additional_required)
          	 <th>Add. Signatures</th>
            @endif
          	<th>Document</th>
          </tr>
        </thead>
        <tbody>
          @foreach($sign_requests as $req)
          <tr>
            <td>{{$req->member->name}}</td>
            <td>{{$req->member->email}}</td>

            <td>
              @if($req->status)
                <span class="label label-success"><i class="fas fa-check fa-fw"></i> Signed</span>
              @else
                <span class="label label-default">Not Signed</span>
              @endif
            </td>

            @if($req->additional_required)
              <td class="text-center">{{$req->getAdditionalProgress()}}</td>
            @endif

            <td>
              @if($req->file_link)
                <a download href="{{$req->file_link}}">
                  <span class="label label-success"><i class="fas fa-download fa-fw"></i>Download</span>
                </a>
              @else
                <span class="label label-default">Not available</span>
              @endif
            </td>

          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">
          {{$sign_requests->links()}}
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="col-md-3">
            <div class="btn btn-wd btn-primary" data-toggle='modal' data-target='#sendReminders'>
              Send Reminder Emails
            </div>
          </div>
          <div class="col-md-3 pull-right">
            <div class="btn btn-wd btn-danger" id='endCampaign' data-toggle='modal' data-target='#endCampaignModal'>
              End Campaign
            </div>
          </div>
        </div>
      </div>

    </div>
</div>

<div class="modal fade" id="endCampaignModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header  alert-danger">
        <h4 class="modal-title text-center" style="color:#671f00">Archive Campaign?</h4>
      </div>
      <div class="modal-body">
        <div class="well" style="font-size:20px">
          Are you sure you want to do this? Usually, when everyone is done signing or the expiration date passes - we will automatically end the campaign.
          There are other reasons to end a campaign, but just know that the signing requests remaining wont be able to filled now for this campaign.
          <br><br>
          If you still need to look at the results of this campaign after this - you can find it in <a href="/archives">The Archives.</a>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">
            <a href="/campaigns/end_campaign/{{$campaign->id}}">
              <div class="col-md-4 col-md-offset-4 btn btn-wd btn-danger">
                Yes, I am sure.
              </div>
            </a>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="sendReminders" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header  alert-info">
        <h4 class="modal-title text-center" style="color:#005e75">Send Reminder Emails?</h4>
      </div>
      <div class="modal-body">
        <div class="well" style="font-size:20px">
          Hey! Use this option to send a little nudge to all your members who still havent got around to signing your document yet!
          It make take a minute for this process to complete - so give us some time to complete this!
        </div>
        <div class="row">
          <div class="col-md-12 text-center">
            <a data-send-reminders href="/campaigns/send_reminders/{{$campaign->id}}">
              <div class="col-md-4 col-md-offset-4 btn btn-wd btn-info">
                I know, lets do this thing!
              </div>
            </a>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="submitModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-xs-12 text-center">
            <i class="fas fa-spinner fa-spin fa-5x"></i>
          </div>
        </div>
        <h5><b>Sending Reminders!</b> This process can take a few minutes sometimes!</h5>
      </div>
    </div>

  </div>
</div>
