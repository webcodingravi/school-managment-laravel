@extends('layouts.app')

@section('content')
<section class="content-header">					
  <div class="container-fluid my-2">
    <div class="row mb-2">
      <div class="col-md-12">
        @include('alertMessage.alertMessage')
      </div>
      <div class="col-sm-6">
        <h1 class="heading">My Subject</h1>
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
      <div class="card-body table-responsive p-0">								
        <table class="table table-hover text-nowrap table-bordered table-striped">
          <thead class="bg-dark">
            <tr>
              <th>Subject Name</th>
              <th>Subject Type</th>
           
            </tr>
          </thead>
               <tbody>
                @foreach ($subjects as $subject)
                <tr>
                  <td>{{$subject->subjectName}}</td>
                  <td>{{$subject->subjectType}}</td>
                </tr>
                @endforeach
               
                 
               </tbody>
        </table>										
      </div>

    </div>
  </div>
  <!-- /.card -->
</section>
<!-- /.content -->
  
@endsection

