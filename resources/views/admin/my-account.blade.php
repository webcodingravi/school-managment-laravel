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
            <h1 class="heading">My Account Setting</h1>
          </div>
          <div class="col-sm-6 text-right">
            <a href="{{route('admin.dashboard')}}" class="btn btn-primary">Back</a>
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
            <form action="" method="post" enctype="multipart/form-data">		
              @csrf				
            <div class="row">
              <div class="col-md-12">
                <div class="mb-3">
                  <label for="name">Name</label>
                  <input type="text" name="name" value="{{$getRecord->name}}" id="name" class="form-control" placeholder="Name">	
                  <p></p>
                </div>
              </div>
              <div class="col-md-12">
                <div class="mb-3">
                  <label for="email">Email</label>
                  <input type="text" name="email" value="{{$getRecord->email}}" id="email" class="form-control" placeholder="Email">	
                  <p></p>
                </div>
              </div>	
          


            <div class="col-md-12">
              <div class="mb-3">
                <label for="profile_pic">Profile Pic</label>
                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">	
                @error('image')
                <span class="invalid-feedback">{{$message}}</span>
             @enderror

                <img src="{{asset('uploads/profile_pic/thumb/'.$getRecord->profile_pic)}}" class="img-fluid">

              </div>

            </div>
       
          </div>		

        </div>
        <div class="pb-5 pt-3">
          <button class="btn btn-primary">Update</button>
          <a href="{{route('admin.dashboard')}}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
      </form>
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  
@endsection
