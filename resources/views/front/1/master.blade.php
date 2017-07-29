<!DOCTYPE html>
<html lang="{{ $main_lang }}">
<head>
	@include('includes.sub-header')
    <title>@yield('title')</title>

	<link rel="stylesheet" type="text/css" href="./packages/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./packages/Multi_level_dropdown_menu_BS3/style.css">
	@yield('head-css')
	<link rel="stylesheet" type="text/css" href="./assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="./front/assets/css/main.css">

	@if(App::getLocale('locale') == 'ar')
		<link rel="stylesheet" href="./packages/bootstrap-rtl/dist/css/bootstrap-rtl.min.css">
		<link rel="stylesheet" type="text/css" href="./assets/css/langs/ar/main.css">
		<link rel="stylesheet" type="text/css" href="./front/assets/css/langs/ar/main.css">
	@endif

	<script type="text/javascript" src="./assets/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="./packages/bootstrap/js/bootstrap.min.js"></script>
	@yield('head-js')
	<script type="text/javascript" src="./assets/js/main.js"></script>
	<script type="text/javascript" src="./front/assets/js/main.js"></script>
</head>
<body>
	@include("front.$frontendNumber.add-ons.navbar-1")

	@yield('content')

	<footer id="footer">
		<div class="container">
			<span>{{ trans2("A21", "© 2016 Company, Inc.") }} · <a href="#">{{ trans2("A22", "Privacy") }}</a> · <a href="#">{{ trans2("A23", "Terms") }}</a></span> ·
			<span>{{ trans2("A24", "Sensorization demo project") }}</span>
		</div>
	</footer>

    @yield('footer-js')
	<script type="text/javascript" src="./assets/js/token.js"></script>
</body>
</html>