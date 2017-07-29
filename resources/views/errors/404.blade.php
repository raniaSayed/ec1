<!DOCTYPE html>
<html>
<head>
	<title>{{ trans2("A161", "Page not found") }}</title>
	<style type="text/css">
		body {
			padding-top: 80px;
			background: #FCFCFC;
			color: #2d2d2d;
			height: 500px;
			font-family: 'Open Sans', sans-serif;
		}
	</style>
</head>
<body>
	<center>
		<h1>{{ trans2("A162", "404 Error - Page not found") }}</h1>
		<img src="{{ asset('assets/icons/404.png') }}">
		<h3><a href="/">{{ trans2("A163", "Back to home") }}</a></h3>
	</center>
</body>
</html>