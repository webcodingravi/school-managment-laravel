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
            <h1 class="heading">Add New Teacher</h1>
          </div>
          <div class="col-sm-6 text-right">
            <a href="{{route('teacher.list')}}" class="btn btn-primary">Back</a>
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
            <form action="{{route('teacher.store')}}" method="post" enctype="multipart/form-data">		
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
           
            </div>

           
            <div class="row">

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="profile_pic">Profile Pic</label>
                  <input type="file" name="image" id="image" class="form-control" accept="image/*">	
           
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
               
              
                </div>

              </div>


            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="date_of_birth">Date of Birth</label>
                  <input type="date" value="{{old('date_of_birth')}}"  name="date_of_birth" id="date_of_birth" class="form-control" placeholder="Date of Birth">	
              
                </div>

              </div>
           

       
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="joining_date">Joining Date</label>
                  <input type="date" value="{{old('joining_date')}}" name="joining_date" id="joining_date" class="form-control" placeholder="Joining Date">	
          
                </div>

              </div>

            </div>

       

            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="current_address">Current Address</label>
                  <textarea name="current_address" value="{{old('current_address')}}" id="current_address" cols="5" rows="2" class="form-control" placeholder="Current Address"></textarea>
               
                </div>

              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="permanent_address">Permanent Address</label>
                  <textarea name="permanent_address" value="{{old('permanent_address')}}"  id="permanent_address" cols="5" rows="2" class="form-control" placeholder="Permanent address"></textarea>
               
                </div>

              </div>

          

            </div>

            <div class="row">

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="qualification">Qualification</label>
                  <textarea name="qualification" value="{{old('qualification')}}"  id="qualification" cols="5" rows="2" class="form-control" placeholder="Qualification"></textarea>
            
                </div>

              </div>


              <div class="col-md-6">
                <div class="mb-3">
                  <label for="work_expirence">Work Experience</label>
                  <textarea name="work_experience" value="{{old('work_experience')}}" id="work_experience" cols="5" rows="2" class="form-control" placeholder="Work Experience"></textarea>
                  
                </div>

              </div>

         

            </div>


            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="note">Note</label>
                  <textarea name="note" value="{{old('note')}}" id="note" cols="5" rows="2" class="form-control" placeholder="Note"></textarea>

                </div>

              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="marital_status">Marital Status</label>
                  <select name="marital_status" value="{{old('marital_status')}}" id="marital_status" class="form-select">
                    <option value="">Please Select</option>
                    <option value="Married">Married</option>
                    <option value="Unmarried">Unmarried </option>
                
                  </select>
              
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
          <a href="{{route('teacher.list')}}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
      </div>
      </form>
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  
@endsection

