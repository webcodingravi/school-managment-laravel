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
              <a href="{{route('teacher.dashboard')}}">Dashboard</a></li>
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
      <h3 class="profile-username text-center">{{$getRecord->name}}</h3>
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
                <label for="">Email</label>
                <p>{{$getRecord->email}}</p>
            </div>
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