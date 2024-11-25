@extends('layouts.app')

@section('content')
<section class="content-header">					
  <div class="container-fluid my-2">
    <div class="row mb-2">
      <div class="col-md-12">
        @include('alertMessage.alertMessage')
      </div>
      <div class="col-sm-6">
        <h1 class="heading">My Student</h1>
      </div>
   
    </div>
  </div>
  <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="container-fluid">
      {{-- Search --}}


    {{-- end Search --}}
   
    <div class="card">
    
      <div class="card-body table-responsive p-0">	
       						
        <table class="table table-hover text-nowrap table-bordered table-striped">
          <thead class="bg-dark">
            <tr>
              <th>Profile Pic</th>
              <th>Name</th>
              <th>Mobile Number</th>
              <th>Email Id</th>
              <th>Religion</th>
              <th>Caste</th>
              <th>Admission No.</th>
              <th>Admission Date</th>
              <th>Roll No</th>
              <th>Class</th>
              <th>Gender</th>
              <th>Date Of Birth</th>
              <th>Blood Group</th>
              <th>Height</th>
              <th>Weight</th>
              <th>Created Date</th>
              <th>Action</th>
            
            </tr>
          </thead>
          <tbody>
            @if ($getRecordStudent->isNotEmpty())
            @foreach($getRecordStudent as $studentRecord)
            <tr>
              <td>
                <img src="{{asset('uploads/profile_pic/thumb/'.$studentRecord->profile_pic)}}" style="border-radius: 50%;" class="img-fluid" />
                </td>

                <td>{{$studentRecord->name}} {{$studentRecord->last_name}} </td>
                <td>{{$studentRecord->mobile_number}} </td>
                <td>{{$studentRecord->email}} </td>
                <td>{{$studentRecord->religion}} </td>
                <td>{{$studentRecord->caste}}  </td>
                <td>{{$studentRecord->admission_number}} </td>
                <td>{{\Carbon\Carbon::parse($studentRecord->admission_date)->format('d M, Y')}} </td>
                <td>{{$studentRecord->roll_number}} </td>
                <td>{{$studentRecord->className}} </td>
                <td>{{$studentRecord->gender}} </td>
                <td>{{\Carbon\Carbon::parse($studentRecord->date_of_birth)->format('d M, Y')}} </td>
                <td>{{$studentRecord->blood_group}}</td>
                <td>{{$studentRecord->height}}</td>
                <td>{{$studentRecord->weight}}</td>
                
              <td>{{\Carbon\Carbon::parse($studentRecord->created_at)->format('d M, Y')}}</td>
              <td><a href="{{route('ParentStudentSubject',$studentRecord->id)}}" class="btn btn-primary btn-sm">Student</a></td>
            
    
            </tr>
            @endforeach
            @else
            <tr><td colspan="7">No Record Found</td></tr>
            @endif
           
            
        
          </tbody>
        </table>									
      </div>
      
    </div>
  </div>
  <!-- /.card -->
</section>
<!-- /.content -->
  
@endsection



