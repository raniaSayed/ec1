<!DOCTYPE html>
<html>
<head>
	<title>{{ trans2("A158", "Invalid permission") }}</title>
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
		<h1>{{ trans2("A159", "You haven't permission to enter here") }}</h1>
		<img src="{{ asset('assets/icons/stop.png') }}">
		<h3><a href="/admin">{{ trans2("A160", "Back to admin home") }}</a></h3>
	</center>
</body>
</html>