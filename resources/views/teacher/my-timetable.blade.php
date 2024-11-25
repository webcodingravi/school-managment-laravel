@extends('layouts.app')

@section('content')
<section class="content-header">					
  <div class="container-fluid my-2">
    <div class="row mb-2">
      <div class="col-md-12">
        @include('alertMessage.alertMessage')
      </div>
      <div class="col-sm-6">
        <h1 class="heading">My Timetable ({{$getClass->name}} - {{$getSubject->name}})</h1>
      </div>
      <div class="col-sm-6 text-right">
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <!-- /.card -->
  
  <div class="card">

    <div class="card-body table-responsive p-0">	
      <table class="table table-hover text-nowrap table-bordered table-striped">
          <thead class="bg-dark border-0">
            <tr>
              <th>Week</th>
              <th>Start Time</th>
              <th>End Time</th>
              <th>Room Number</th>
            </tr>
          </thead>
        <tbody>
          @foreach ($getRecord as $valueW)
           <tr>
            <td>{{$valueW['week_name']}}</td>
            <td>
                   {{ !empty($valueW['start_time']) ? \Carbon\Carbon::parse($valueW['start_time'])->format('h:i A') : ''}}

            </td>
            <td>
              {{ !empty($valueW['start_time']) ? \Carbon\Carbon::parse($valueW['end_time'])->format('h:i A') : ''}}
             </td>

             <td>{{$valueW['room_number']}}</td>
           </tr>
           @endforeach	
        </tbody>
      </table>	
    					
    </div>
   
  </div>
  
</section>
<!-- /.content -->
  
@endsection

