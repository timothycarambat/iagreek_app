@extends('app.layout.layout')

@section('main_content')
<div class="content">
    <div class="container-fluid">

      @if( (Auth::user()->onValidTrial() && Auth::user()->withinLimit('trial_documents', count($documents)) && !Auth::user()->onExpiredTrial()) || Auth::user()->isPayingCustomer()  )
        <div class="row" style="margin-bottom:10px;">
          <div class="col-md-12">
            <a data-target='#newDocumentModal' data-toggle='modal'>
              <div class="col-md-2 btn btn-wd btn-info">
                <i class="fas fa-plus fa-fw"></i>Create Document
              </div>
            </a>
          </div>
        </div>
      @endif



      <div class="row">
        @if(count($documents) > 0 )
          @foreach($documents as $document)
            <div class="col-lg-3 col-sm-6">
              <a class='card-holder' href="/documents/edit/{{$document->id}}">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="icon-big icon-info text-center">
                                    <i class="fas fa-file"></i>
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <div class="numbers">
                                    <p>Document</p>
                                    {{$document->name}}
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats" style="width:100%">
                                <i class="fas fa-bolt"></i> Last Updated: {{$document->updated_at->diffForHumans()}}
                                <a data-toggle='modal' data-target='#removeDocumentModal{{$document->id}}' style='cursor:pointer;color:#daa0a0' class="pull-right"><i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
              </a>
            </div>
            @include('app.components.documents.removeDocumentModal')
          @endforeach
        @else
          <div class="col-md-12 text-center" style="opacity:0.4">
            <i class="fas fa-file-alt fa-8x"></i>
            <h2>You Don't Have Any Documents Written Yet!
              <br>
              Click the "Create Document" Button To Get Started
            </h2>
          </div>
        @endif
      </div>

    </div>
</div>

@if( (Auth::user()->onValidTrial() && Auth::user()->withinLimit('trial_documents', count($documents)) && !Auth::user()->onExpiredTrial()) || Auth::user()->isPayingCustomer()  )
  @include('app.components.documents.newDocumentModal')
@endif

@endsection
