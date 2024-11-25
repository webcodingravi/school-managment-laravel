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
            <h1 class="heading">Add New Admin</h1>
          </div>
          <div class="col-sm-6 text-right">
            <a href="{{route('admin.list')}}" class="btn btn-primary">Back</a>
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
            <form action="" method="post" id="newAdminForm" name="newAdminForm">		
              @csrf				
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="name">Name</label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Name">	
                  <p></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="email">Email</label>
                  <input type="text" name="email" id="email" class="form-control" placeholder="Email">	
                  <p></p>
                </div>
              </div>	



            </div>
              <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password" class="form-control" placeholder="Password">	
                  <p></p>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="confirm_password">Confirm Password</label>
                  <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password">	
                  <p></p>
                </div>
              </div>

             						
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="mb-3">
                  
                  <input type="radio" name="user_type" value="1" id="admin">	
                  <label for="admin">Admin</label>

                 
                  <input type="radio" name="user_type"  value="2"  id="teacher">	
                  <label for="teacher">Teacher</label>

                  
                  <input type="radio" name="user_type"  value="3" id="student">	
                  <label for="student">Student</label>

                  
                  <input type="radio" name="user_type"  value="4" id="parent">	
                  <label for="parent">Parent</label>
                  <p></p>
                </div>
              </div>	
            </div>
       
          </div>		

        </div>
        <div class="pb-5 pt-3">
          <button class="btn btn-primary">Create</button>
          <a href="{{route('admin.list')}}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
      </form>
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  
@endsection

@section('customJs')
<script>
  $("#newAdminForm").submit(function(e) {
   e.preventDefault();

   $.ajax({
         url:'{{route("admin.store")}}',
         type: 'post',
         data: $(this).serializeArray(),
         dataType: 'json',
         success:function(response) {
            if(response.status == true) {
              $("#name").removeClass("is-invalid").siblings("p").removeClass("invalid-feedback").html('');
              $("#email").removeClass("is-invalid").siblings("p").removeClass("invalid-feedback").html('');
              $("#password").removeClass("is-invalid").siblings("p").removeClass("invalid-feedback").html('');
              $("#confirm_password").removeClass("is-invalid").siblings("p").removeClass("invalid-feedback").html('');

                 window.location.href="{{route('admin.list')}}";

            }else{
              if(response.errors['name']) {
                 $("#name").addClass("is-invalid").siblings("p").addClass("invalid-feedback").html(response.errors['name']);
              }else{
                $("#name").removeClass("is-invalid").siblings("p").removeClass("invalid-feedback").html('');

              }

              if(response.errors['email']) {
                 $("#email").addClass("is-invalid").siblings("p").addClass("invalid-feedback").html(response.errors['email']);
              }else{
                $("#email").removeClass("is-invalid").siblings("p").removeClass("invalid-feedback").html('');

              }

              if(response.errors['password']) {
                 $("#password").addClass("is-invalid").siblings("p").addClass("invalid-feedback").html(response.errors['password']);
              }else{
                $("#password").removeClass("is-invalid").siblings("p").removeClass("invalid-feedback").html('');

              }

              if(response.errors['confirm_password']) {
                 $("#confirm_password").addClass("is-invalid").siblings("p").addClass("invalid-feedback").html(response.errors['confirm_password']);
              }else{
                $("#confirm_password").removeClass("is-invalid").siblings("p").removeClass("invalid-feedback").html('');

              }

          
            }
         }
   });
  });
</script>

@endsection