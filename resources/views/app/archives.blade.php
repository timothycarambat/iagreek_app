@extends('app.layout.layout')

@section('main_content')
<div class="content">
    <div class="container-fluid">

      <div class="row">
        @if(count($campaigns) > 0 )
          @foreach($campaigns as $campaign)
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="content">
                      <a class='card-holder' href="/archive/edit/{{$campaign->id}}">
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="icon-big icon-info text-center">
                                    <i class="fas fa-file"></i>
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <div class="numbers">
                                    <p>Campaign</p>
                                    {{$campaign->name}}
                                </div>
                            </div>
                        </div>
                      </a>
                        <div class="footer">
                            <hr />
                            <div class="stats" style="width:100%">
                                <i class="fas fa-bolt"></i> Last Updated: {{ $campaign->updated_at->diffForHumans() }}
                                <a href="/archive/delete_campaign/{{$campaign->id}}" style='color:#daa0a0' class="pull-right"><i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          @endforeach
        @else
          <div class="col-md-12 text-center" style="opacity:0.4">
            <i class="fas fa-university fa-8x"></i>
            <h2>You Haven't Had Any Campaigins End or Archived Yet!
              <br>
              <a href="/campaigns">Launch or Manage Campaigns</a>
            </h2>
          </div>
        @endif
      </div>

    </div>
</div>


@endsection
