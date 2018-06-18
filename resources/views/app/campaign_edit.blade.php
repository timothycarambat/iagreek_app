@extends('app.layout.layout')

@section('main_content')
<div class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-4">
          @include('app.components.campaigns.edit.stats_chart')
        </div>

        <div class="col-md-8">
          @include('app.components.campaigns.edit.response_table')
        </div>

      </div>

    </div>
</div>
@endsection
