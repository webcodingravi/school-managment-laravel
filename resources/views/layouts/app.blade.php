<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{{!empty($header_title) ? $header_title : ''}}</title>
		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">

    {{-- Bootstrap-5 css --}}
    <link rel="stylesheet" href="{{asset('assets/bootstrap-5/bootstrap.min.css')}}">
		<!-- Theme style -->
		<link rel="stylesheet" href="{{asset('assets/css/adminlte.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">

    <script src="{{asset('assets/jquery/jquery-3.6.0.min.js')}}"></script>
	</head>
	<body class="hold-transition sidebar-mini">
		<!-- Site wrapper -->
		<div class="wrapper">
			<!-- Navbar -->
			@include('layouts.header')
			<!-- /.navbar -->
			<!-- Main Sidebar Container -->

			<aside class="main-sidebar sidebar-dark-primary bg-dark elevation-4" style="position: fixed">
	            @include('layouts.sidebar')
				<!-- /.sidebar -->
         	</aside>
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
			@yield('content')
				<!-- /.content -->
			</div>
			<!-- /.content-wrapper -->
			<footer class="main-footer">
				
				<strong>Copyright &copy; {{date('Y')}} School Managment All rights reserved.
			</footer>
			
		</div>
		<!-- ./wrapper -->
		<!-- jQuery -->
		<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
		<!-- Bootstrap 4 -->
		<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Bootstrap 5 -->
		<script src="{{asset('assets/bootstrap-5/bootstrap.js')}}"></script>

		<!-- AdminLTE App -->
		<script src="{{asset('assets/js/adminlte.min.js')}}"></script>

    <script>
   	setTimeout(() => {
				$("#alert-box").fadeOut('slow');
			}, 3000);
    </script>

    @yield('customJs')

	</body>
</html>