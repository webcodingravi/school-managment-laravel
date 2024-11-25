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
            <h1 class="heading">Add New Parent</h1>
          </div>
          <div class="col-sm-6 text-right">
            <a href="{{route('parent.list')}}" class="btn btn-primary">Back</a>
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
            <form action="{{route('parent.store')}}" method="post" enctype="multipart/form-data">		
              @csrf				
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="first_name">First Name</label>
                  <input type="text" value="{{old('first_name')}}" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="First Name">
                  @error('first_name')
                  <span class="invalid-feedback">{{$message}}</span>
               @enderror	
                </div>

              </div>


              <div class="col-md-6">
                <div class="mb-3">
                  <label for="last_name">Last Name</label>
                  <input type="text" value="{{old('last_name')}}" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Last Name">	
                  @error('last_name')
                  <span class="invalid-feedback">{{$message}}</span>
               @enderror
                </div>

              </div>

            </div>


            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="email">Email</label>
                  <input type="text" value="{{old('email')}}" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">	
                  @error('email')
                  <span class="invalid-feedback">{{$message}}</span>
               @enderror
                </div>

              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="mobile_number">Mobile Number</label>
                  <input type="text" value="{{old('mobile_number')}}" name="mobile_number" id="mobile_number" class="form-control @error('mobile_number') is-invalid @enderror" placeholder="Mobile Number">	
                  @error('mobile_number')
                  <span class="invalid-feedback">{{$message}}</span>
               @enderror
                </div>

              </div>


              <div class="col-md-6">
                <div class="mb-3">
                  <label for="address">Address</label>
                  <textarea name="address" value={{old('address')}} id="address" cols="5" rows="2" class="form-control" placeholder="Address"></textarea>
                   @error('address')
                  <span class="invalid-feedback">{{$message}}</span>
               @enderror
                </div>

              </div>

                
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="gender">Gender</label>
                  <select name="gender" id="gender" class="form-select">
                    <option value="">Please Select..</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                  </select>
                  @error('gender')
                  <span class="invalid-feedback">{{$message}}</span>
               @enderror
              
                </div>

              </div>
            </div>

              <div class="row">
     
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="occupation">Occupation</label>
                  <input type="text" value="{{old('occupation')}}" name="occupation" id="occupation" class="form-control @error('occupation') is-invalid @enderror" placeholder="Occupation">	
                  @error('occupation')
                  <span class="invalid-feedback">{{$message}}</span>
               @enderror
                </div>

              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="profile_pic">Profile Pic</label>
                  <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">	
                  @error('image')
                  <span class="invalid-feedback">{{$message}}</span>
               @enderror
                </div>

              </div>
          
            </div>


            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="status">Status</label>
                  <select name="status" id="status" class="form-select">
                    <option value="1">Active</option>
                    <option value="0">Deactive</option>
                    @error('status')
                    <span class="invalid-feedback">{{$message}}</span>
                 @enderror
                  </select>
              
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="password">Password</label>
                  <input type="password" name="password" value="{{old('password')}}" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                    @error('password')
                    <span class="invalid-feedback">{{$message}}</span>
                 @enderror
               
              
                </div>
              </div>


            </div>

        <div class="pb-5 pt-3">
          <button class="btn btn-primary">Create</button>
          <a href="{{route('parent.list')}}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
      </div>
      </form>
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  
@endsection

