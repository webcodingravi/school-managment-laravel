@extends('layouts.app')

@section('content')
<section class="content-header">					
  <div class="container-fluid my-2">
    <div class="row mb-2">
      <div class="col-md-12">
        @include('alertMessage.alertMessage')
      </div>
      <div class="col-sm-6">
        <h1 class="heading">Class List (Total: {{$classes->total()}})</h1>
      </div>
      <div class="col-sm-6 text-right">
        <a href="{{route('class.create')}}" class="btn btn-primary">New Class</a>
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
      <div class="card-header">
        <a href="{{route('class.list')}}" class="btn btn-primary">Reset</a>
        <div class="card-tools">
          
          <form action="" method="get" id="searchForm" name="searchForm">
          <div class="input-group input-group" style="width: 250px;">
            <input type="search" value="{{Request::get('keyword')}}" id="keyword" name="keyword" class="form-control float-right" placeholder="Search">
  
            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
              <i class="fas fa-search"></i>
              </button>
            </div>
            </div>
          </form>
        </div>
      </div>
      <div class="card-body table-responsive p-0">								
        <table class="table table-hover text-nowrap table-bordered table-striped">
          <thead class="bg-dark">
            <tr>
              <th width="60">ID</th>
              <th>Name</th>
              <th>Create By</th>
              <th>Create Date</th>
              <th>Status</th>
              <th width="100">Action</th>
            </tr>
          </thead>
          <tbody>
            @if ($classes->isNotEmpty())
            @foreach ($classes as $class)
            <tr>
              <td>{{$class->id}}</td>
              <td>{{$class->name}}</td>
              <td>{{$class->user->name}}</td>
              <td>{{\Carbon\Carbon::parse($class->created_at)->format('d M, Y')}}</td>

              @if($class->status == 1)
              <td>
              <svg class="text-success-500 h-6 w-6 text-success" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </td>
              @else
              <td>
                <svg class="text-danger h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </td>


              @endif

            
              <td>
                <a href="{{route('class.edit',$class->id)}}">
                  <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                  </svg>
                </a>
                <a href="#" class="text-danger w-4 h-4 mr-1" onclick="deleteClass({{$class->id}})">
                  <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </a>
              </td>
            </tr>
            @endforeach
              @else
              <tr><td colspan="6">Not Found Data</td></tr>
            @endif
            
        
          </tbody>
        </table>										
      </div>
      <div class="card-footer clearfix">
      {{$classes->links('pagination::bootstrap-5')}}
      </div>
    </div>
  </div>
  <!-- /.card -->
</section>
<!-- /.content -->
  
@endsection

@section('customJs')
<script>
   $("#searchForm").submit(function(e) {
    e.preventDefault();

    var url = '{{route("class.list")}}?';

    var keyword = $("#keyword").val();

    if(keyword != '') {
      url += '&keyword='+keyword;
    }
    
    window.location.href=url;
   });

 

    $("#keyword").change(function() {
    $("#searchForm").submit();
  });



function deleteClass(id) {
  if(confirm("Are You sure you want to delete?")) {
    $.ajax({
      url: '{{route("class.destroy")}}',
      type:'delete',
      data: {
        "_token" : "{{csrf_token()}}",
        id:id
      },
      dataType: 'json',
      success: function(response) {
         window.location.href="{{route('class.list')}}";
      }
  });
  }

}
</script>
  
@endsection