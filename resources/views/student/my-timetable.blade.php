@extends('layouts.app')

@section('content')
<section class="content-header">					
  <div class="container-fluid my-2">
    <div class="row mb-2">
      <div class="col-md-12">
        @include('alertMessage.alertMessage')
      </div>
      <div class="col-sm-6">
        <h1 class="heading">My Timetable</h1>
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
  <!-- /.card -->
  
  @foreach ($getRecord as $value)
  <div class="card">
    <div class="card-header bg-dark border-0">
      <h2 class="card-title">
        {{$value['name']}}
      </h2>
    </div>
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
          @foreach ($value['week'] as $valueW)
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
  @endforeach	

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

