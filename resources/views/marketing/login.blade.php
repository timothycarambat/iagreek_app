@extends('marketing.layout')

@section('main_content')

  @include('marketing.navbar')
  <?php $states = App\States::getStatesAll()?>
  <article id="main">
    <header>
      <h2>Welcome Back!</h2>
    </header>
    <section class="wrapper style5">
      <div class="inner">

        @if ( !is_null( session('failure') ) )
          <div class="alert alert-danger text-center" style="font-weight:800">
              <div class="container">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="nc-icon nc-simple-remove"></i>
                  </button>
                  <span>{{ session('failure') }} </span>
              </div>
          </div>
        @endif

          @if( !empty($errors->first() ) )
          <div class="alert alert-danger text-center" style="font-weight:800">
              <div class="container">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="nc-icon nc-simple-remove"></i>
                  </button>
                  <span>{{ $errors->first() }} </span>
              </div>
          </div>
          @endif

        <h2>Sign Up</h2>

        {!! Form::open(['url' => 'login','class'=>'container']) !!}

        <div style="border-right: 2px solid #f5f5f5;" class="col-xs-6">
          <h6><u>Login Information</u></h6>
          {{Form::label('email', 'Email:',['style'=>'font-weight:800'])}}
          {{Form::text('email',null,['class' => 'form-control','placeholder'=>'alpha@betagamma.org','required' => 'required']) }}

          {{Form::label('password', 'Password:',['style'=>'font-weight:800'])}}
          {{Form::password('password',['class' => 'form-control','required' => 'required']) }}

          <div class="row">
            <div class="pull-left">
              {{Form::submit('Log In',['class'=>'button special','style'=>'margin-top:10px;margin-bottom:10px;'])}}
            </div>
          </div>
        </div>

        <div class="col-xs-6">
          <h6><u>Dont Have an Account?</u></h6>
          <div class="row">
            <div class="pull-left">
              <a style='border-bottom:none;'href='/register'><div class='button special' style='margin-top:10px;margin-bottom:10px;'> Create an Account </div></a>
            </div>
          </div>
          <h3 class=" col-xs-6 text-center">OR</h3>

          <div class="row">
            <div class="pull-left">
              <a style='border-bottom:none;'href='/about'><div class='button' style='margin-top:10px;margin-bottom:10px;'> See our Advantages </div></a>
            </div>
          </div>
        </div>

        {!! Form::close() !!}
    </section>
  </article>
@endsection

@section('page_script')
<script type="text/javascript">
  $('#header').removeClass('alt');
</script>
@endsection
