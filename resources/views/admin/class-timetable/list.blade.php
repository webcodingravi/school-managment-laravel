@extends('layouts.app')

@section('content')
<section class="content-header">					
  <div class="container-fluid my-2">
    <div class="row mb-2">
      <div class="col-md-12">
        @include('alertMessage.alertMessage')
      </div>
      <div class="col-sm-6">
        <h1 class="heading">Class Timetable</h1>
      </div>
      <div class="col-sm-6 text-right">
        {{-- <a href="" class="btn btn-primary">Add New Class Timetable</a> --}}
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
     <div class="card">
      <div class="card-header">
       <h5> Search Class Timetable</h5>
        </div>	
      <div class="card-body">	
        <form action="" method="get">				
        <div class="row">
          <div class="col-md-6">
            <div class="mb-6">
              <label for="">Class Name</label>
              <select name="class_id" class="form-select getClass">
                <option value="">Please Select..</option>
                @foreach ($classes as $class)
                <option {{(Request::get('class_id') == $class->id) ? 'selected' : ''}} value="{{$class->id}}">{{$class->name}}</option>

                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="mb-3">
              <label for="">Subject Name</label>
              <select name="subject_id" class="form-select getSubject">
                @if (!empty($getSubject))
                @foreach ($getSubject as $subject)
                {{$subject}}
                <option {{(Request::get('subject_id') == $subject->subject_id) ? 'selected' : ''}} 
                  value="{{$subject->subject_id}}">{{$subject->subjectName}}</option>
                @endforeach
                @endif
              </select>
            </div>
          </div>	
        </div>


      <div class="pb-5 pt-3">
        <button class="btn btn-primary">Search</button>
        <a href="{{route('class-timetable.list')}}" class="btn btn-danger">Reset</a>
      </div>
      </form>
      </div>
   
 
    </div>

    {{-- end Search --}}
  </div>
  <!-- /.card -->

@if (!empty(Request::get('class_id')) && !empty(Request::get('subject_id')))
<form action="{{route('class-timetable.store')}}" method="post">
@csrf
<input type="text" hidden name="subject_id" value="{{Request::get('subject_id')}}">
<input type="text" hidden name="class_id" value="{{Request::get('class_id')}}">

  <div class="card">
    <div class="card-header">
      <h5>Class Timetable</h5>		
    </div>
    <div class="card-body table-responsive p-0">		
      <table class="table table-hover text-nowrap table-bordered table-striped">
          <thead class="bg-dark">
            <tr>
              <th>Week</th>
              <th>Start Time</th>
              <th>End Time</th>
              <th>Room Number</th>
            </tr>
          </thead>
        <tbody>
          @php
            $i = 1;
          @endphp
         @foreach ($week as $value)
           <tr>
            <th>
              <input type="text" hidden name="timetable[{{ $i }}][week_id]" value="{{$value['week_id']}}">
              {{$value['week_name']}}
            </th>
            <td>
              <input type="time" name="timetable[{{ $i }}][start_time]" value="{{$value['start_time']}}" class="form-control">
            </td>
            <td>
              <input type="time" name="timetable[{{ $i }}][end_time]" value="{{$value['end_time']}}" class="form-control">
            </td>
            <td>
              <input type="text" name="timetable[{{ $i }}][room_number]" value="{{$value['room_number']}}" class="form-control" placeholder="Room Number">
            </td>
           </tr>
           @php
           $i++;
         @endphp
         @endforeach
     
        
        </tbody>
      </table>	
      <div class="text-center py-2">
      <button type="submit" class="btn btn-primary">Submit</button>	
    </div>								
    </div>
   
  </div>
</form>
  @endif
</section>
<!-- /.content -->
  
@endsection

@section('customJs')
<script>
  $('.getClass').change(function() {
    var value = $(this).val();

    $.ajax({
         url : '{{route("class-timetable.get_subject")}}',
         type : 'get',
         data :{
          "_token:" : '{{csrf_token()}}',
          value:value
         },
         dataType: 'json',
         success:function(response) {
           $(".getSubject").html(response.html);
      
         }
    });
  });
</script>
  
@endsection

