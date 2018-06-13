@extends('app.layout.layout')

@section('main_content')
	<div class="content">
			<div class="container-fluid">

        <div class="row" style="margin-bottom:10px;">
          <div class="col-md-1 btn btn-wd btn-info save-btn">
            Save Document
          </div>
        </div>

        <div class="row">
          <div class="editor col-md-12">
            <?php print "$document->content"; ?>
          </div>
        </div>


			</div>
	</div>
@endsection
