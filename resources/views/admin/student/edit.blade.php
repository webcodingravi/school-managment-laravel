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
            <h1 class="heading">Edit Student</h1>
          </div>
          <div class="col-sm-6 text-right">
            <a href="{{route('student.list')}}" class="btn btn-primary">Back</a>
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
            <form action="{{route('student.update',$students->id)}}" method="post" enctype="multipart/form-data">		
              @csrf		
              @method('put')		
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="first_name">First Name</label>
                  <input type="text" value="{{old('first_name',$students->name)}}" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="First Name">
                  @error('first_name')
                  <span class="invalid-feedback">{{$message}}</span>
               @enderror	
                </div>

              </div>


              <div class="col-md-6">
                <div class="mb-3">
                  <label for="last_name">Last Name</label>
                  <input type="text" value="{{old('last_name',$students->last_name)}}" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Last Name">	
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
                  <input type="text" value="{{old('email',$students->email)}}" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">	
                  @error('email')
                  <span class="invalid-feedback">{{$message}}</span>
               @enderror
                </div>

              </div>


              <div class="col-md-6">
                <div class="mb-3">
                  <label for="admission_number">Admission Number</label>
                  <input type="text" value="{{old('admission_number',$students->admission_number)}}" name="admission_number" id="admission_number" class="form-control @error('admission_number') is-invalid @enderror" placeholder="Admission Number">	
                  @error('admission_number')
                  <span class="invalid-feedback">{{$message}}</span>
               @enderror
                </div>

              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="roll_number">Roll Number</label>
                  <input type="text" value="{{old('roll_number',$students->roll_number)}}" name="roll_number" id="roll_number" class="form-control @error('roll_number') is-invalid @enderror" placeholder="Roll Number">	
                  @error('roll_number')
                  <span class="invalid-feedback">{{$message}}</span>
               @enderror
                </div>

              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="class">Class</label>
                  <select name="class_id" id="class_id" class="form-select">
                  <option value="">Please Select..</option>
                  @foreach ($classes as $class)
                  <option {{($students->class_id == $class->id) ? 'selected' : ''}} value="{{$class->id}}">{{$class->name}}</option>

                  @endforeach
                  </select>
                  @error('class_id')
                  <span class="invalid-feedback">{{$message}}</span>
               @enderror
                </div>

              </div>

            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="gender">Gender</label>
                  <select name="gender" id="gender" class="form-select">
                    <option value="">Please Select..</option>
                    <option {{($students->gender == 'Male') ? 'selected' : ''}} value="Male">Male</option>
                    <option {{($students->gender == 'Female') ? 'selected' : ''}} value="Female">Female</option>
                    <option {{($students->gender == 'Other') ? 'selected' : ''}} value="Other">Other</option>
                  </select>
                  @error('gender')
                  <span class="invalid-feedback">{{$message}}</span>
               @enderror
              
                </div>

              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="date_of_birth">Date of Birth</label>
                  <input type="date" value="{{old('date_of_birth',$students->date_of_birth)}}" name="date_of_birth" id="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" placeholder="Date of Birth">	
                  @error('date_of_birth')
                  <span class="invalid-feedback">{{$message}}</span>
               @enderror
                </div>

              </div>

            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="caste">Caste</label>

                  <select name="caste" id="caste" class="form-select">
                    <option value="">Please Select..</option>
                    <option {{($students->caste == 'General') ? 'selected' : ''}} value="General">General</option>
                    <option {{($students->caste == 'OBC') ? 'selected' : ''}} value="OBC">OBC</option>
                    <option {{($students->caste == 'ST') ? 'selected' : ''}} value="ST">ST</option>
                    <option {{($students->caste == 'SC') ? 'selected' : ''}} value="SC">SC</option>
                    <option {{($students->caste == 'Other') ? 'selected' : ''}} value="Other">Other</option>
                    @error('caste')
                    <span class="invalid-feedback">{{$message}}</span>
                 @enderror
                  </select>
                </div>

              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="religion">Religion</label>
                  <input type="text" value="{{old('religion',$students->religion)}}" name="religion" id="religion" class="form-control @error('religion') is-invalid @enderror" placeholder="Religion">	
                  @error('religion')
                  <span class="invalid-feedback">{{$message}}</span>
               @enderror
                </div>

              </div>

            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="mobile_number">Mobile Number</label>
                  <input type="text" value="{{old('mobile_number',$students->mobile_number)}}" name="mobile_number" id="mobile_number" class="form-control @error('mobile_number') is-invalid @enderror" placeholder="Mobile Number">	
                  @error('mobile_number')
                  <span class="invalid-feedback">{{$message}}</span>
               @enderror
                </div>

              </div>
         
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="admission_date">Admission Date</label>
                  <input type="date" value="{{old('admission_date',$students->admission_date)}}" name="admission_date" id="admission_date" class="form-control @error('admission_date') is-invalid @enderror" placeholder="Admission Date">	
                  @error('admission_date')
                  <span class="invalid-feedback">{{$message}}</span>
               @enderror
                </div>

              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="profile_pic">Profile Pic</label>
                  <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">	
                  @error('image')
                  <span class="invalid-feedback">{{$message}}</span>
               @enderror

                  <img src="{{asset('uploads/profile_pic/thumb/'.$students->profile_pic)}}" class="img-fluid">

                </div>

              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="blood_group">Blood Group</label>
                  <input type="text" value="{{old('blood_group',$students->blood_group)}}" name="blood_group" id="blood_group" class="form-control @error('blood_group') is-invalid @enderror" placeholder="Blood Group">	
                  @error('blood_group')
                  <span class="invalid-feedback">{{$message}}</span>
               @enderror
                </div>

              </div>

            </div>

            
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="height">Height</label>
                  <input type="text" value="{{old('height',$students->height)}}" name="height" id="height" class="form-control @error('height') is-invalid @enderror" placeholder="Height">	
                  @error('height')
                  <span class="invalid-feedback">{{$message}}</span>
               @enderror
                </div>

              </div>

           

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="weight">Weight</label>
                  <input type="text" value="{{old('weight',$students->weight)}}" name="weight" id="weight" class="form-control @error('weight') is-invalid @enderror" placeholder="weight">	
                  @error('weight')
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
                    <option {{($students->status == 1) ? 'selected' : ''}} value="1">Active</option>
                    <option {{($students->status == 0) ? 'selected' : ''}} value="0">Deactive</option>
                    @error('status')
                    <span class="invalid-feedback">{{$message}}</span>
                 @enderror
                  </select>
              
                </div>
              </div>	


              <div class="col-md-6">
                <div class="mb-3">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                  <span class="text-muted">Due you want to change password so Please add new Password</span>
             
               
              
                </div>
              </div>	
            </div>


    
        <div class="pb-5 pt-3">
          <button class="btn btn-primary">Update</button>
          <a href="{{route('student.list')}}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
      </div>
      </form>
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  
@endsection

