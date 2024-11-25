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
					<a href="javascript:void(0);" class="h3">Forgot Passowrd</a>
			  	</div>
			  	<div class="card-body">
					<form action="{{route('processResetPassword')}}" method="post">
						@csrf
            <input type="hidden" name="tokenString" value="{{$tokenString}}">
				  		<div class="input-group mb-3">
							<input type="password" name="new_password" value="{{old('new_password')}}" class="form-control @error('new_password') is-invalid @enderror" placeholder="New Password">
							<div class="input-group-append">
					  			<div class="input-group-text">
                    <span class="fas fa-lock"></span>
					  			</div>
								
							</div>
              @error('new_password')
                <span class="invalid-feedback">{{$message}}</span>
              @enderror
				  		</div>

              <div class="input-group mb-3">
                <input type="password" value="{{old('confirm_password')}}"  name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" placeholder="Confirm Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  
                </div>
                @error('new_password')
                <span class="invalid-feedback">{{$message}}</span>
              @enderror
                </div>

				  		<div class="row">
						
							<!-- /.col -->
							<div class="col-4">
					  			<button type="submit" class="btn btn-primary btn-block">Submit</button>
							</div>
							<!-- /.col -->
				  		</div>
					</form>
							
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
		<script>
			setTimeout(() => {
				 $("#alert-box").fadeOut('slow');
			 }, 3000);
		 </script>
	</body>
</html>