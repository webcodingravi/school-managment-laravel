<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Laravel Shop :: Administrative Panel</title>
		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
		<!-- Theme style -->
		<link rel="stylesheet" href="{{asset('assets/css/adminlte.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">

		<script src="{{asset('assets/jquery/jquery-3.6.0.min.js')}}"></script>

	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						@include('alertMessage.alertMessage')
					</div>
				</div>
			</div>
			<!-- /.login-logo -->
			<div class="card card-outline card-primary">
			  	<div class="card-header text-center">
					<a href="#" class="h3">Administrative Panel</a>
			  	</div>
			  	<div class="card-body">
					<p class="login-box-msg">Sign in to start your session</p>
					<form action="{{route('authenticate')}}" method="post">
						@csrf
				  		<div class="input-group mb-3">
							<input type="text" value="{{old('email')}}" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
							<div class="input-group-append">
					  			<div class="input-group-text">
									<span class="fas fa-envelope"></span>
					  			</div>
								
							</div>
							@error('email')
							<span class="invalid-feedback">{{$message}}</span>
								
							@enderror

				  		</div>
				  		<div class="input-group mb-3">
							<input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
							<div class="input-group-append">
					  			<div class="input-group-text">
									<span class="fas fa-lock"></span>
					  			</div>
							</div>
							@error('password')
							<span class="invalid-feedback">{{$message}}</span>
								
							@enderror
				  		</div>
				  		<div class="row">
							<div class="col-8">
					  			<div class="icheck-primary">
									<input type="checkbox" name="remember" id="remember">
									<label for="remember">
						  				Remember Me
									</label>
					  			</div>
							</div>
							<!-- /.col -->
							<div class="col-4">
					  			<button type="submit" class="btn btn-primary btn-block">Login</button>
							</div>
							<!-- /.col -->
				  		</div>
					</form>
		  			<p class="mb-1 mt-3">
				  		<a href="{{route('forgotPassword')}}">I forgot my password</a>
					</p>					
			  	</div>
			  	<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
		<!-- ./wrapper -->
		<!-- jQuery -->
		<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
		<!-- Bootstrap 4 -->
		<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
		<!-- AdminLTE App -->
		<script src="{{asset('assets/js/adminlte.min.js')}}"></script>
		<!-- AdminLTE for demo purposes -->
		{{-- <script src="js/demo.js"></script> --}}

		<script>
			setTimeout(() => {
				 $("#alert-box").fadeOut('slow');
			 }, 3000);
		 </script>
	</body>
</html>