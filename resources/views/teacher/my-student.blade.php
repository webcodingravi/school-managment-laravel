@extends('layouts.app')

@section('content')
<section class="content-header">					
  <div class="container-fluid my-2">
    <div class="row mb-2">
      <div class="col-md-12">
        @include('alertMessage.alertMessage')
      </div>
      <div class="col-sm-6">
        <h1 class="heading">Student List</h1>
      </div>
      <div class="col-sm-6 text-right">
        <a href="{{route('student.create')}}" class="btn btn-primary">New Student</a>
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
      <div class="card-body table-responsive p-0">								
        <table class="table table-hover text-nowrap table-bordered table-striped">
          <thead class="bg-dark">
            <tr>
             
              <th width="80">Profile Pic</th>
              <th width="50">Student Details</th>
              <th width="50">Create Date</th>
             
            </tr>
          </thead>
          <tbody>
            @if ($students->isNotEmpty())
            @foreach ($students as $student)
            <tr>
        

              <td>
                <img src="{{asset('uploads/profile_pic/thumb/'.$student->profile_pic)}}" style="border-radius: 50%;" class="img-fluid" />
                </td>
                
              <td> 
                <span><strong>Name : </strong> {{$student->name}} {{$student->last_name}}  | 
                <span><strong>Mobile No. : </strong> {{$student->mobile_number}} | 
                  <strong>Email Id : </strong> {{$student->email}} </span> <br>
                    <strong><span>Religion: </strong> {{$student->religion}} | 
                      <strong>Caste : </strong> {{$student->caste}}  </span><br>
                    <sapn><strong>Admission No. : </strong> {{$student->admission_number}} | 
                    <strong>Admission Date : </strong> {{\Carbon\Carbon::parse($student->admission_date)->format('d M, Y')}}</span><br>
                      <span><strong>Roll No. : </strong> {{$student->roll_number}} | 
                        <strong>Class : </strong> {{$student->className}}</span><br>
                      <span><strong>Gender : </strong> {{$student->gender}} | 
                        <strong>Date Of Birth: </strong> {{\Carbon\Carbon::parse($student->date_of_birth)->format('d M, Y')}}</span><br>
                        <strong>Blood Group : </strong> {{$student->blood_group}} | <strong>Height : </strong> {{$student->height}} | 
                        <strong>Weight : </strong> {{$student->weight}}</span><br>

              
              </td>
              <td>{{\Carbon\Carbon::parse($student->created_at)->format('d M, Y')}}</td>
            </tr>
            @endforeach
              @else
              <tr><td colspan="6">Not Found Data</td></tr>
            @endif
            
        
          </tbody>
        </table>										
      </div>
      <div class="card-footer clearfix">
        {{$students->links('pagination::bootstrap-5')}}
        </div>
    
    </div>
  </div>
  <!-- /.card -->
</section>
<!-- /.content -->
  
@endsection
