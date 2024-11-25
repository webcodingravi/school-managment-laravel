@extends('layouts.app')

@section('content')
		<!-- Content Header (Page header) -->
    <section class="content-header">					
      <div class="container-fluid my-2">
        <div class="row mb-2">
          <div class="col-md-12">
            @include('alertMessage.alertMessage')
          </div>
          <div class="col-sm-6">
            <h1 class="heading">Subject Update </h1>
          </div>
          <div class="col-sm-6 text-right">
            <a href="{{route('subject.list')}}" class="btn btn-primary">Back</a>
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
          <div class="card-body">		
            <form action="" method="post" id="UpdateSubjectForm" name="UpdateSubjectForm">		
              @csrf				
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="name">Subject Name</label>
                  <input type="text" name="name" value="{{$subject->name}}" id="name" class="form-control" placeholder="Name">	
                  <p></p>
                </div>
              </div>	


              <div class="col-md-6">
                <div class="mb-3">
                  <label for="status">Subject Type</label>
                  <select name="type" id="type" class="form-select">
                    <option value="Theory" {{($subject->type == 'Theory') ? 'selected' : ''}}>Theory</option>
                    <option value="Practical" {{($subject->type == 'Practical') ? 'selected' : ''}}>Practical</option>
                  </select>
                  <p></p>
                </div>
              </div>	

            </div>

            <div class="row">
            <div class="col-md-12">
              <div class="mb-3">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                  <option value="1" {{($subject->status == 1) ? 'selected' : ''}}>Active</option>
                  <option value="0" {{($subject->status == 0) ? 'selected' : ''}}>Deactive</option>
                </select>
            
              </div>
            </div>	
            </div>

            <div class="pb-5 pt-3">
              <button class="btn btn-primary">Update</button>
              <a href="{{route('subject.list')}}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>

        </div>

    
     
      </div>
      </form>

      </div>

    
      <!-- /.card -->
    </section>
    <!-- /.content -->
  
@endsection

@section('customJs')
<script>
  $("#UpdateSubjectForm").submit(function(e) {
   e.preventDefault();

   $.ajax({
         url:'{{route("subject.update",$subject->id)}}',
         type: 'put',
         data: $(this).serializeArray(),
         dataType: 'json',
         success:function(response) {
            if(response.status == true) {
              $("#name").removeClass("is-invalid").siblings("p").removeClass("invalid-feedback").html('');
           
                 window.location.href="{{route('subject.list')}}";

            }else{
              if(response.errors['name']) {
                 $("#name").addClass("is-invalid").siblings("p").addClass("invalid-feedback").html(response.errors['name']);
              }else{
                $("#name").removeClass("is-invalid").siblings("p").removeClass("invalid-feedback").html('');

              }

              if(response.errors['type']) {
                 $("#type").addClass("is-invalid").siblings("p").addClass("invalid-feedback").html(response.errors['type']);
              }else{
                $("#type").removeClass("is-invalid").siblings("p").removeClass("invalid-feedback").html('');

              }

          
          
            }
         }
   });
  });
</script>

@endsection