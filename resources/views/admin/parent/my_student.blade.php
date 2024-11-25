@extends('layouts.app')

@section('content')
<section class="content-header">					
  <div class="container-fluid my-2">
    <div class="row mb-2">
      <div class="col-md-12">
        @include('alertMessage.alertMessage')
      </div>
      <div class="col-sm-6">
        <h1 class="heading">Parent Student List ({{$getSingleParent->name}} {{$getSingleParent->last_name}})</h1>
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
      <div class="card-body">		
        <form action="" method="get">				
        <div class="row">
          <div class="col-md-6">
            <div class="mb-6">
              <label for="id">Student ID</label>
              <input type="text" value="{{Request::get('id')}}" name="id" class="form-control" placeholder="Student ID">	
            </div>
          </div>

          <div class="col-md-6">
            <div class="mb-3">
              <label for="name">First Name</label>
              <input type="text" value="{{Request::get('name')}}" name="name" class="form-control" placeholder="First Name">	
            </div>
          </div>	
        </div>
          <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label for="last_name">Last Name</label>
              <input type="text" value="{{Request::get('last_name')}}" name="last_name" id="last_name" class="form-control" placeholder="Last Name">	
            </div>
          </div>	

          <div class="col-md-6">
            <div class="mb-3">
              <label for="email">Email</label>
              <input type="text" value="{{Request::get('email')}}" name="email" id="email" class="form-control" placeholder="Email">	
            </div>
          </div>
          
        </div>

    <div class="pb-5 pt-3">
      <button class="btn btn-primary">Search</button>
      <a href="{{route('parent.myStudent',$parent_id)}}" class="btn btn-danger">Reset</a>
    </div>
    </form>
  </div>
   
 
    </div>

    {{-- end Search --}}


    @if($getSearchStudent->isNotEmpty())
    <div class="card">
      <div class="card-header">
        <h6>Student List</h6>		
      </div>
      <div class="card-body table-responsive p-0">		
        <table class="table table-hover text-nowrap table-bordered table-striped">
          <thead class="bg-dark">
            <tr>
              <th width="20">ID</th>
              <th>Profile Pic</th>
              <th>Student Name</th>
              <th>Email</th>
              <th>Parent Name</th>
              <th>Created Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($getSearchStudent as $student)
            <tr>
              <td>{{$student->id}}</td>

              <td>
                <img src="{{asset('uploads/profile_pic/thumb/'.$student->profile_pic)}}" style="border-radius: 50%;" class="img-fluid" />
                </td>

            <td>{{$student->name}} {{$student->last_name}}</td>
            <td>{{$student->email}}</td>
            <td>{{$student->parent_name}}</td>
              <td>{{\Carbon\Carbon::parse($student->created_at)->format('d M, Y')}}</td>

            
              <td>
                <a href="{{route('assign_student_parent',[$student->id, $parent_id])}}" class="btn btn-primary">
                   Add Student to Parent
                </a>

              </td>
            </tr>
            @endforeach
             
            
        
          </tbody>
        </table>										
      </div>
      <div class="card-footer clearfix">
      {{$getSearchStudent->links('pagination::bootstrap-5')}}
      </div>
    </div>

    @endif
  

   
    <div class="card">
      <div class="card-header">
        <h6>Parent Student List</h6>	

      </div>
      <div class="card-body table-responsive p-0">	
       						
        <table class="table table-hover text-nowrap table-bordered table-striped">
          <thead class="bg-dark">
            <tr>
              <th width="20">ID</th>
              <th>Profile Pic</th>
              <th>Student Name</th>
              <th>Email</th>
              <th>Parent Name</th>
              <th>Created Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if ($getRecordParents->isNotEmpty())
            @foreach($getRecordParents as $parentRecord)
            <tr>
              <td>{{$parentRecord->id}}</td>

              <td>
                <img src="{{asset('uploads/profile_pic/thumb/'.$parentRecord->profile_pic)}}" style="border-radius: 50%;" class="img-fluid" />
                </td>

            <td>{{$parentRecord->name}} {{$parentRecord->last_name}}</td>
            <td>{{$parentRecord->email}}</td>
            <td>{{$parentRecord->parent_name}}</td>
              <td>{{\Carbon\Carbon::parse($parentRecord->created_at)->format('d M, Y')}}</td>

            
              <td>
             
                <a href="#" onclick="deleteAssignStudentParent({{$parentRecord->id}})" class="text-danger w-4 h-4 mr-1">
                  <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </a>

              </td>
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


@section('customJs')
<script>
  function deleteAssignStudentParent(id) {
  if(confirm("Are You sure you want to delete?")) {
    $.ajax({
      url: '{{route("assign_student_parent.delete")}}',
      type:'delete',
      data: {
        "_token" : "{{csrf_token()}}",
        id:id
      },
      dataType: 'json',
      success: function(response) {
         window.location.href="{{url()->current()}}";
      }
  });
  }

}
</script>
  
@endsection

