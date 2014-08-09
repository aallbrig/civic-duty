<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> @yield('title','Do Your Civic Duty App')</title>
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
	@yield('css')
</head>
<body>
	@yield('content')
	<script src="vendor/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
	@yield('js')
</body>
</html>