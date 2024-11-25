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
            <h1 class="heading">Edit Exam</h1>
          </div>
          <div class="col-sm-6 text-right">
            <a href="{{route('exam.list')}}" class="btn btn-primary">Back</a>
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
            <form action="{{route('exam.update',$exams->id)}}" method="post">		
              @csrf		
              @method('put')		
            <div class="row">
              <div class="col-md-12">
                <div class="mb-3">
                  <label for="">Name</label>
                  <input type="text" name="name" value="{{old('name',$exams->name)}}" id="name" class="form-control @error('name') is-invalid @endif" placeholder="Name">	
                @error('name')
                  <span class="invalid-feedback">{{$message}}</span>
                @enderror
                </div>
              </div>
              <div class="col-md-12">
                <div class="mb-3">
                  <label for="">Note</label>
                  <textarea name="note" class="form-control" value="{{old('note',$exams->note)}}" cols="10" rows="5" placeholder="Note..">{{$exams->note}}</textarea>                
                </div>
              </div>	

            </div>
 		
            </div>
       
          </div>		

        </div>
        <div class="pb-5 pt-3">
          <button class="btn btn-primary">Update</button>
          <a href="{{route('exam.list')}}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
      </form>
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  
@endsection

