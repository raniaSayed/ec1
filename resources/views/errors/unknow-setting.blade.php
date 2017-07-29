<!DOCTYPE html>
<html>
<head>
	<title>{{ trans2("A169", "Unknowen setting") }}</title>
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
		<h1>{{ $msg }}</h1>
		<img src="{{ asset('assets/icons/404.png') }}">
		<h3><a href="/admin">{{ trans2("A170", "Back to admin home") }}</a></h3>
	</center>
</body>
</html>