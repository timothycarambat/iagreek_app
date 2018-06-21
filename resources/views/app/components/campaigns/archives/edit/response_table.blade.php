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

          </div>
          <div class="col-md-3 pull-right">
            <div class="btn btn-wd btn-danger" id='deleteCampaign' data-toggle='modal' data-target='#deleteCampaignModal'>
              Delete Campaign
            </div>
          </div>
        </div>
      </div>

    </div>
</div>

<div class="modal fade" id="deleteCampaignModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header  alert-danger">
        <h4 class="modal-title text-center" style="color:#671f00">Delete Campaign?</h4>
      </div>
      <div class="modal-body">
        <div class="well" style="font-size:20px">
          Are you sure you want to do this? This is going to wipe your campaign off the map and you will no longer be able to get the signed documents!
          <br><br>
          If you're sure you dont need these documents ever again then go ahead! Once this done not even we can help you get them back!
        </div>
        <div class="row">
          <div class="col-md-12 text-center">
            <a href="/archive/delete_campaign/{{$campaign->id}}">
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
