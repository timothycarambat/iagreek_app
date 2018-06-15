@extends('app.layout.layout')

@section('main_content')
<div class="content">
    <div class="container-fluid">

      <div class="row" style="margin-bottom:10px;">
        <div class="col-md-12">
          <a data-target='#newDocumentModal' data-toggle='modal'>
            <div class="col-md-2 btn btn-wd btn-info">
              <i class="fas fa-plus fa-fw"></i>Create Document
            </div>
          </a>
        </div>
      </div>



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
                                <i class="fas fa-bolt"></i> Last Updated: {{date('n/j/y g:ia',strtotime($document->updated_at))}}
                                <a href="/documents/remove_document/{{$document->id}}" style='color:#daa0a0' class="pull-right"><i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
              </a>
            </div>
          @endforeach
        @endif
      </div>

    </div>
</div>

@include('app.components.documents.newDocumentModal')

@endsection
