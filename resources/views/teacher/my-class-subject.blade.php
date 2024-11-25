@extends('layouts.app')

@section('content')
<section class="content-header">					
  <div class="container-fluid my-2">
    <div class="row mb-2">
      <div class="col-md-12">
        @include('alertMessage.alertMessage')
      </div>
      <div class="col-sm-6">
        <h1 class="heading">My Class & Subject</h1>
      </div>
      {{-- <div class="col-sm-6 text-right">
        <a href="{{route('assign-class-teacher.create')}}" class="btn btn-primary">New Assign Class Teacher</a>
      </div> --}}
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
              <th>Class Name</th>
              <th>Subject Name</th>
              <th>Subject Type</th>
              <th>My Class TimeTable</th>
              <th>Create Date</th>
              <th>Action</th>
              
            </tr>
          </thead>
          <tbody>
            <tr>

              @if ($getRecord->isNotEmpty())
           
            @foreach ($getRecord as $record)
            <tr>
              <td>{{$record->className}}</td>
              <td> {{$record->subjectName}}</td>
              <td> {{$record->subjectType}}</td>
              <td> 
                @php
                  $ClassSubject = $record->getMyTimeTable($record->class_id, $record->subject_id);
                @endphp
                @if(!empty($ClassSubject))
                  {{\Carbon\Carbon::parse($ClassSubject->start_time)->format('h:i A')}} to
                   {{\Carbon\Carbon::parse($ClassSubject->end_time)->format('h:i A')}}
                   <hr/>
                   Room Number : {{$ClassSubject->room_number}}
                @endif
              </td>
              <td>{{\Carbon\Carbon::parse($record->created_at)->format('d M, Y')}}</td>
              <td>
                <a href="{{route('MyTimetableTeacher',[$record->class_id, $record->subject_id])}}" class="btn btn-primary">My Class Timetable</a>
              </td>

            </tr>
            @endforeach
              @else
              <tr><td colspan="7">Not Found Data</td></tr>
            @endif

            </tr>
            
            
        
          </tbody>
        </table>										
      </div>

    </div>
  </div>
  <!-- /.card -->
</section>
<!-- /.content -->
  
 @endsection

