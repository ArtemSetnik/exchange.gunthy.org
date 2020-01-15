<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="Jeremy Kenedy">
	<link rel="shortcut icon" href="/favicon/favicon.ico"> {{-- CSRF Token --}}
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="apple-touch-icon" sizes="57x57" href="/img/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/img/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/img/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/img/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/img/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/img/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/img/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/img/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192" href="/img/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/img/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
	<link rel="manifest" href="/img/favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/img/favicon/ms-icon-144x144.png">

	<title>
		@if(trim($__env->yieldContent('title'))) @yield('title') | @endif {!! config('app.name', Lang::get('titles.app')) !!}
	</title>

	{{-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries --}}
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	{!! HTML::style('https://fonts.googleapis.com/css?family=Roboto:300italic,400italic,400,100,300,600,700', array('type' =>
	'text/css', 'rel' => 'stylesheet')) !!} {!! HTML::style(asset('https://fonts.googleapis.com/icon?family=Material+Icons'),
	array('type' => 'text/css', 'rel' => 'stylesheet')) !!}

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
	<!-- Bootstrap core CSS -->
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">
	<!-- Your custom styles (optional) -->
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<style>
		html, body, #app {
			height: 100%;
		}
	</style>

	<script>
		window.Laravel = {!! json_encode([
			'csrfToken' => csrf_token(),
		]) !!};
		var timeOffset = new Date("@php echo Date("Y-m-d h:i:s"); @endphp").getTime() - Date.now();
	</script>

	@yield('head')
</head>

<body class="bg-dark-1">

	<!-- Start your project here-->
	<div id="app" class="d-flex flex-column">
		<div>
			@include('layouts.header')
		</div>
		<div class="app-content">
			@yield('content')
		</div>
		<div class="mt-auto">
			@include('layouts.footer')
		</div>
	</div>

	<!-- SCRIPTS -->
	<!-- JQuery -->
	<script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
	<script>
	</script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="{{ asset('js/mdb.js') }}"></script>
	<script>
		wow = new WOW().init();
	</script>
	<script type="text/javascript" src="{{ asset('js/node_modules/lodash.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/node_modules/lodash-arithmetic.js') }}"></script>

	<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

	@yield('script')
	<script>
		function get24hrVolumns()
		{
			get_api('{{ Route("api.24hrVolumns") }}', 'GET', [])
			.then(data => {
				var html = "<span>24hr Volume: </span>";
				data['Data'].forEach((item, index) => {
						html += `${_.trimEnd(item.quantity, /[.0]/i) || 0} <span>${item.currency} / </span>`;
				});
				html = _.trimEnd(html, '/ </span>') + '</span>';
				$('#siteWalletsFooter').html(html);
			})
		}
		setInterval(() => {
			get24hrVolumns();
		}, 5000);

		function displayServerTime() {
			var options = {year: 'numeric', month: '2-digit', day: '2-digit',hour: 'numeric', minute: '2-digit', hour12: false };
			var date = new Date(Date.now() + timeOffset);
			$('server-time').html( date.toLocaleDateString('en-US', options));
			setTimeout(function(){
				displayServerTime();
			}, 60000)
		}
		displayServerTime();
	</script>

</body>

</html>