<div class="row">
    <div class="col-lg-6 col-sm-6">
        <div class="card">
          <div class="header">
            <p style="font-size:22px">Campaigns At A Glance</p>
          </div>
            <div class="content">

                <div class="row">
                    <div class="col-xs-12">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th class="text-center" style="font-weight:bold">Campaign</th>
                            <th class="text-center" style="font-weight:bold">Started</th>
                            <th class="text-center" style="font-weight:bold">Progress</th>
                            <th class="text-center" style="font-weight:bold">View</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if( Auth::user()->campaigns()->where('archived', false)->count() > 0 )
                            @foreach( Auth::user()->campaigns()->where('archived', false)->get() as $campaign )
                              <tr>
                                  <td class='text-center' style="">{{ucwords($campaign->name)}}</td>
                                  <td class='text-center' style="">{{$campaign->created_at->diffForHumans()}}</td>
                                  <td class='text-center' style="">
                                    <div class="progress" style="margin:0px;">
                                      <div class="progress-bar" role="progressbar" style="background-color:#7AC29A; width: {{$campaign->getNumericProgress()}}%" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="col-xs-12 text-center">
                                      <a href="/campaign/edit/{{$campaign->id}}" class="btn btn-success">
                                        View
                                      </a>
                                    </div>
                                  </td>
                              </tr>
                            @endforeach
                          @else
                          <tr>
                            <td colspan="4" class="text-center"> You have no <i>Active</i> Campaigns</td>
                          </tr>
                          @endif
                        </tbody>
                      </table>
                    </div>
                </div>
                <div class="footer">
                    <hr />
                    <div class="stats" style="line-height:14px;">
                        <i class="fas fa-info-circle"></i> This preview reports results for the primary signer - there still may be additional signatures required.
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
