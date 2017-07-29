<!DOCTYPE html>
<html>
<head>
	<title>{{ trans2("A166", "Product not founded") }}</title>
	<style type="text/css">
		body {
			padding-top: 80px;
			/*background: linear-gradient(to bottom, #E3F2FD , #FFF) no-repeat;*/
			background: #FCFCFC;
			color: #2d2d2d;
			height: 500px;
			font-family: 'Open Sans', sans-serif;
		}
	</style>
</head>
<body>
	<center>
		<h1>{{ trans2("A167", "Product not founded") }}</h1>
		<img src="{{ asset('icons/404.png') }}">
		<h3><a href="/admin">{{ trans2("A168", "Back to admin home") }}</a></h3>
	</center>
</body>
</html>