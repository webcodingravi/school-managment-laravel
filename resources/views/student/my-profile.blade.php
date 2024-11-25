@extends('layouts.app')
@section('content')

<div class="content">
  <div class="container-fluid">
 <section class="content-header">
<div class="container-fluid">
<div class="row">
  <div class="col-sm-6">
  </div>
  <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">
              <a href="{{route('student.dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active">Profile</li>
      </ol>
  </div>
</div>
</div>
</section>
<div class="row">
<div class="col-md-3">
<div class="card card-primary card-outline">
  <div class="card-body box-profile">
      <div class="text-center">
      <img class="profile-user-img img-fluid img-circle" src="{{asset('uploads/profile_pic/thumb/'.$getRecord->profile_pic)}}" alt="">
      </div>
      <div class="text-center">
      <h3 class="profile-username text-center">{{$getRecord->name}} {{$getRecord->last_name}}</h3>
      <p><strong>{{$getRecord->className}} Class</strong></p>
      <span><strong>Roll No: </strong>{{$getRecord->roll_number}}<span><br>
      <p><strong>Admission No: </strong>{{$getRecord->admission_number}}</p>
      
      </div>
  </div>
</div>
</div>
<div class="col-md-9">
<div class="card">
  <div class="card-header">
      <h3 class="card-title">Profile Info</h3>
      {{-- <div class="card-tools">
          <a href="{{route('MyAccount')}}" class="btn btn-info">Edit</a>
      </div> --}}
  </div>
  <div class="card-body">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="name">Name</label>
                <p>{{$getRecord->name}}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <p>{{$getRecord->last_name}}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="email">Email</label>
                <p>{{$getRecord->email}}</p>
            </div>
        </div>
    </div>

      <div class="row">
          <div class="col-md-4">
              <div class="form-group">
                  <label for="phone">Phone</label>
                  <p>{{$getRecord->mobile_number}}</p>
              </div>
          </div>
          <div class="col-md-4">
              <div class="form-group">
                  <label for="phone">Gender</label>
                  <p>{{$getRecord->gender}} </p>
              </div>
          </div>
          <div class="col-md-4">
              <div class="form-group">
                  <label for="date_of_birth">Date Of Birth</label>
                  <p>{{\Carbon\Carbon::parse($getRecord->date_of_birth)->format('d M,Y')}}</p>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-4">
              <div class="form-group">
                  <label for="caste">Caste</label>
                  <p>{{$getRecord->caste}}</p>
              </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
                <label for="">Religion</label>
                <p>{{$getRecord->religion}}</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="">Blood Group</label>
                <p>{{$getRecord->blood_group}}</p>
            </div>
        </div>

        


      </div>


      <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="">Height</label>
                <p>{{$getRecord->height}}</p>
            </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
              <label for="">Weight</label>
              <p>{{$getRecord->weight}}</p>
          </div>
      </div>





    </div>

      
  </div>
</div>
</div>
</div>
  </div>
</div>
  
@endsection