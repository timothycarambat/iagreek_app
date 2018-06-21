<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="images/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="images/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="view" content="{{ $view }}">

	<title>IAGREEK :: {{$title}}</title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="viewport" content="width=device-width" />

  <link rel="stylesheet" href="{{asset('css/app.css')}}" />
  <!--  Fonts and icons     -->
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>

</head>
<body>

@if ($errors->any())
  @foreach ($errors->all() as $error)
      <input type='hidden' data-error value='{{ $error }}'/>
  @endforeach
@endif

@if(session('error'))
	<input type='hidden' data-error value='{{ session('error') }}'/>
@endif

@if(session('success'))
	<input type='hidden' data-success value='{{ session('success') }}'/>
@endif

@if(session('info'))
	<input type='hidden' data-info value='{{ session('info') }}'/>
@endif

<div class="wrapper">
        @include('app.layout.sidebar')

    <div class="main-panel">
        @include('app.layout.header')

        @yield('main_content')

        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>

                        <li>
                            <a href="{{$_ENV['ALT_URL']}}">
                               IAGREEK
                            </a>
                        </li>
                        <li>
                            <a href="#">
                               FAQ
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Support
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i>
                </div>
            </div>
        </footer>
    </div>
</div>


</body>

	<script
	src="https://code.jquery.com/jquery-3.2.1.min.js"
	integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
	crossorigin="anonymous"></script>
	<script src="https://js.stripe.com/v3/"></script>
	<script type="text/javascript">
	  window.pkeys = {
	    Stripe: "{{$_ENV['STRIPE_KEY']}}",
	  }
	</script>
	<script src='{{asset("js/app.js")}}'></script>


</html>
