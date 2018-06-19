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
          	<th>Status</th>
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
              <td></td>
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
        <div class="col-md-12">
          <div class="col-md-3">
            <div class="btn btn-wd btn-primary">
              Send Reminder Emails
            </div>
          </div>
          <div class="col-md-3 pull-right">
            <div class="btn btn-wd btn-danger" id='endCampaign'>
              End Campaign
            </div>
          </div>
        </div>
      </div>

    </div>
</div>
