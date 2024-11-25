@extends('layouts.app')

@section('content')
		<!-- Content Header (Page header) -->
    <section class="content-header">					
      <div class="container-fluid my-2">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="heading">Edit Assign Class Teacher</h1>
          </div>
          <div class="col-sm-6 text-right">
            <a href="{{route('assign-class-teacher.list')}}" class="btn btn-primary">Back</a>
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
            <form action="{{route('assign-class-teacher.update',$getRecord->id)}}" method="post">		
              @csrf	
              @method('put')			
            <div class="row">
              <div class="col-md-12">
                <div class="mb-3">
                  <h4 class="heading">Class Name</h4>
                  <select name="class_id" id="class_id" class="form-select @error('class_id') is-invalid @enderror">
                    <option value="">Please Select..</option>
                    @if (!empty($classes)) 
                      @foreach ($classes as $class)
                      <option {{($getRecord->class_id == $class->id) ? 'selected' : ''}} value="{{$class->id}}">{{$class->name}}</option>
                      @endforeach
                  
                    @endif
                
                  </select>
                  @error('class_id')
                    <span class="invalid-feedback">{{$message}}</span>
                  @enderror
                </div>
              </div>	

              <div class="col-md-12">
                <div class="mb-3">
                  <h4 class="pt-2 heading">Teacher Name</h4>
                      <ul class="ps-0 pt-2">
                       
                      @foreach ($getTeacher as $index => $teacher)
                        @php
                        $checked = '';
                        @endphp
                        @foreach ($getAssignClassTeacherId as $teacherID)
                        @if ($teacherID->teacher_id == $teacher->id)
                        @php
                          $checked = 'checked';
                          @endphp
                        @endif
                          
                        @endforeach
                        <li class="d-flex mt-1">
                        <input {{$checked}} type="checkbox" value="{{$teacher->id}}" name="teacher_id[]" class="form-check me-2" id="{{$index}}">
                        <label for="{{$index}}" class="form-label">{{$teacher->name}}
                      </label>
                    </li>
                      @endforeach
                    </ul>
                   
                   
                  </ul>
                  
                  <p></p>
                </div>
              </div>	

              <div class="col-md-12">
                <div class="mb-3">
                  <h4 class="pt-2 heading">Status </h4>
                  <select name="status" id="status" class="form-select">
                    <option {{($getRecord->status == 1) ? 'selected' : ''}} value="1">Active</option>
                    <option {{($getRecord->status == 0) ? 'selected' : ''}} value="0">Deactive</option>
                  </select>
              
                </div>
              </div>
              
            </div>

            		

        <div class="pb-5 pt-3">
          <button class="btn btn-primary">Update</button>
          <a href="{{route('assign-class-teacher.list')}}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
      </div>
      </form>
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  
@endsection

