@extends('layouts.app')

@section('content')
<section class="content-header">					
  <div class="container-fluid my-2">
    <div class="row mb-2">
      <div class="col-md-12">
        @include('alertMessage.alertMessage')
      </div>
      <div class="col-sm-6">
        <h1 class="heading">Parent List (Total: {{$parents->total()}})</h1>
      </div>
      <div class="col-sm-6 text-right">
        <a href="{{route('parent.create')}}" class="btn btn-primary">New Student</a>
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
        <a href="{{route('parent.list')}}" class="btn btn-primary">Reset</a>
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
              <th width="20">ID</th>
              <th>Profile Pic</th>
              <th>Name</th>
              <th>Gender</th>
              <th>Phone</th>
              <th>Email</th>
              <th>Occupation</th>
              <th>Address</th>
              <th>Created Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if ($parents->isNotEmpty())
            @foreach ($parents as $parent)
            <tr>
              <td>{{$parent->id}}</td>

              <td>
                <img src="{{asset('uploads/profile_pic/thumb/'.$parent->profile_pic)}}" style="border-radius: 50%;" class="img-fluid" />
                </td>

            <td>{{$parent->name}} {{$parent->last_name}}</td>
            <td>{{$parent->gender}}</td>
            <td>{{$parent->mobile_number}}</td>
            <td>{{$parent->email}}</td>
            <td>{{$parent->occupation}}</td>
            <td>{{$parent->address}}</td>
              <td>{{\Carbon\Carbon::parse($parent->created_at)->format('d M, Y')}}</td>

              @if($parent->status == 1)
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
                <a href="{{route('parent.edit',$parent->id)}}">
                  <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                  </svg>
                </a>
                <a href="javascript:void(0);" class="text-danger w-4 h-4 mr-1" onclick="deleteParent({{$parent->id}})">
                  <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </a>

                <a href="{{route('parent.myStudent',$parent->id)}}" class="btn btn-primary">My Student</a>
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
      {{$parents->links('pagination::bootstrap-5')}}
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

    var url = '{{route("parent.list")}}?';

    var keyword = $("#keyword").val();

    if(keyword != '') {
      url += '&keyword='+keyword;
    }
    
    window.location.href=url;
   });

 

    $("#keyword").change(function() {
    $("#searchForm").submit();
  });



function deleteParent(id) {
  if(confirm("Are You sure you want to delete?")) {
    $.ajax({
      url: '{{route("parent.destroy")}}',
      type:'delete',
      data: {
        "_token" : "{{csrf_token()}}",
        id:id
      },
      dataType: 'json',
      success: function(response) {
         window.location.href="{{route('parent.list')}}";
      }
  });
  }

}
</script>
  
@endsection