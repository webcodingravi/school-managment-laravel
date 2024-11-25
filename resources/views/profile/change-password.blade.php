@extends('layouts.app')

@section('content')
		<!-- Content Header (Page header) -->
    <section class="content-header">					
      <div class="container-fluid my-2">
        <div class="row mb-2">
          <div class="col-md-12">
            @include('alertMessage.alertMessage')
          </div>
          <div class="col-sm-6">
            <h1 class="heading">Update Password</h1>
          </div>
        
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">		
            <form action="" method="post">		
              @csrf				
            <div class="row">
              <div class="col-md-12">
                <div class="mb-3">
                  <label for="old_password">Old Password</label>
                  <input type="password" name="old_password" id="old_password" class="form-control @error('old_password') is-invalid @enderror" placeholder="Old Password">	
                  @error('old_password')
                    <span class="invalid-feedback">{{$message}}</span>
                  @enderror
                </div>
              </div>

              <div class="col-md-12">
                <div class="mb-3">
                  <label for="new_password">New Password</label>
                  <input type="password" name="new_password" id="new_password" class="form-control @error('new_password') is-invalid @enderror" placeholder="New Password">	
                  @error('new_password')
                  <span class="invalid-feedback">{{$message}}</span>
                @enderror
                </div>
              </div>


              <div class="col-md-12">
                <div class="mb-3">
                  <label for="confirm_password">Confirm Password</label>
                  <input type="password" name="confirm_password" id="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" placeholder="Confirm Password">	
                  @error('confirm_password')
                  <span class="invalid-feedback">{{$message}}</span>
                @enderror
                </div>
              </div>
          </div>		

        <div class="pb-5 pt-3">
          <button class="btn btn-primary">Update</button>
        </div>
      </div>
      </form>
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  
@endsection
