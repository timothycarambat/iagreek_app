<!DOCTYPE HTML>
<html>
	<head>
		<title>IAGREEK :: {{$title}}</title>
		<meta charset="utf-8" />
		<link rel="icon" type="image/x-icon" href="images/favicon.ico?v=2">
		<link rel="apple-touch-icon" sizes="76x76" href="images/apple-icon.png">

		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="view" content="{{ $view }}">



		<!--[if lte IE 8]><script src="js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="{{asset('css/app.css')}}" />
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

	</head>
	<body class="landing">
    <!-- Page Wrapper -->
      <div id="page-wrapper">

        @yield('main_content')

			<!-- Footer -->
				<footer id="footer">
					<ul class="icons">
						<!-- <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li> -->
						<!-- <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li> -->
						<li><a href="tel:+15023261" class="icon fa-phone"><span class="label">Phone</span></a></li>
						<li><a href="mailto:{{$_ENV['SUPPORT_EMAIL']}}" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
					</ul>
					<ul class="copyright">
						<li>&copy;{{date('Y',strtotime('now'))}} IAGREEK</li><li>Design: <a href="http://industrialobject.com">Industrial Object</a></li>
					</ul>
				</footer>

			</div>

		<!-- Scripts -->

			<script
			src="https://code.jquery.com/jquery-3.2.1.min.js"
			integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
			crossorigin="anonymous"></script>
			<script src="js/jquery.scrollex.min.js"></script>
			<script src="js/jquery.scrolly.min.js"></script>
			<script src="js/skel.min.js"></script>
			<script src="js/util.js"></script>

			<script src="https://js.stripe.com/v3/"></script>
		  <script type="text/javascript">
		    window.pkeys = {
		      Stripe: "{{$_ENV['STRIPE_KEY']}}",
		      Places: "{{$_ENV['GOOGLE_PLACES_API']}}"
		    }
		  </script>
			<script src='{{asset("js/app.js")}}'></script>

			<!--[if lte IE 8]><script src="js/ie/respond.min.js"></script><![endif]-->

			@yield('page_script')

	</body>
</html>
