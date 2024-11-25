@extends('layouts.app')

@section('content')
<section class="content-header">					
  <div class="container-fluid my-2">
    <div class="row mb-2">
      <div class="col-md-12">
        @include('alertMessage.alertMessage')
      </div>
      <div class="col-sm-6">
        <h1 class="heading">Admin (Total: {{$users->total()}})</h1>
      </div>
      <div class="col-sm-6 text-right">
        <a href="{{route('admin.create')}}" class="btn btn-primary">New Admin</a>
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
        <a href="{{route('admin.list')}}" class="btn btn-primary">Reset</a>
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
              <th>Email</th>
              <th>Role</th>
              <th width="100">Action</th>
            </tr>
          </thead>
          <tbody>
            @if ($users->isNotEmpty())
            @foreach ($users as $user)
            <tr>
              <td>{{$user->id}}</td>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td>
              @if ($user->user_type == 1)
                 Admin
               @elseif ($user->user_type == 2)
               Teacher

               @elseif ($user->user_type == 3)
               Student

               @else
               Parent
              @endif
            </td>
            
              <td>
                <a href="{{route('admin.edit',$user->id)}}">
                  <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                  </svg>
                </a>
                <a href="#" class="text-danger w-4 h-4 mr-1" onclick="deleteUser({{$user->id}})">
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
      {{$users->links('pagination::bootstrap-5')}}
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

    var url = '{{route("admin.list")}}?';

    var keyword = $("#keyword").val();

    if(keyword != '') {
      url += '&keyword='+keyword;
    }
    
    window.location.href=url;
   });

 

    $("#keyword").change(function() {
    $("#searchForm").submit();
  });



function deleteUser(id) {
  if(confirm("Are You sure you want to delete?")) {
    $.ajax({
      url: '{{route("admin.destroy")}}',
      type:'delete',
      data: {
        "_token" : "{{csrf_token()}}",
        id:id
      },
      dataType: 'json',
      success: function(response) {
         window.location.href="{{route('admin.list')}}";
      }
  });
  }

}
</script>
  
@endsection