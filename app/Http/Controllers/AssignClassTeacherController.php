<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use App\Models\AssignClassTeacher;
use Illuminate\Support\Facades\Auth;

class AssignClassTeacherController extends Controller
{
    public function index(Request $request) {
      $assignClassTeacher = AssignClassTeacher::select('assign_class_teachers.*', 'teachers.name as teacher_name','classes.name as className',
        'users.name as userName')
        ->join('users as teachers', 'teachers.id', '=', 'assign_class_teachers.teacher_id')
        ->join('classes','classes.id', 'assign_class_teachers.class_id')
        ->join('users', 'users.id', 'assign_class_teachers.user_id');
         
       
          if(!empty($request->keyword)) {
            $assignClassTeacher = $assignClassTeacher->where('classes.name', 'like', '%'.$request->keyword. '%'); 
            $assignClassTeacher = $assignClassTeacher->orWhere('teachers.name', 'like', '%'.$request->keyword. '%'); 
          }
    
          $assignClassTeacher = $assignClassTeacher->orderBy('assign_class_teachers.created_at','desc')->paginate(10);
    
        $data['assignClassTeacher'] = $assignClassTeacher;
       $data['header_title'] = 'Assign Class Teacher';
       return view('admin.assign-class-teacher.list',$data);
    }

    public function create() {
        $classes = ClassModel::orderBy('name','asc')->where(['status' => 1])->get();
        $getTeacher = User::where(['user_type' => 2])->orderBy('id','desc')->get();
        $data['classes'] =  $classes;
        $data['getTeacher'] =  $getTeacher;

        return view('admin.assign-class-teacher.create',$data);
    }


    
    public function store(Request $request) {
       
    if(!empty($request->teacher_id)) {
        foreach($request->teacher_id as $teacher_id) {
            $getAlreadyFirst = AssignClassTeacher::where(['class_id' => $request->class_id, 'teacher_id' =>  $teacher_id])->first();
             if(!empty($getAlreadyFirst)) {
                $getAlreadyFirst->status = $request->status;
                $getAlreadyFirst->save();
  
             }else{
                $assignClassTeacher = new AssignClassTeacher();
                $assignClassTeacher->class_id = $request->class_id;
                $assignClassTeacher->teacher_id = $teacher_id;
                $assignClassTeacher->user_id = Auth::user()->id;
                $assignClassTeacher->status = $request->status;
                $assignClassTeacher->save();

             }
            
        }
        return redirect()->route('assign-class-teacher.list')->with('success', ' Assign Class to Teacher Successfully');


    }else{
        return redirect()->back()->with('error', 'Due to some error pls try again.');

    }

    }

    public function edit(string $id) {
      $classes = ClassModel::orderBy('name','asc')->where(['status' => 1])->get();
      $getTeacher = User::where(['user_type' => 2])->orderBy('id','desc')->get();
      $getRecord = AssignClassTeacher::findOrFail($id);
      $getAssignClassTeacherId = AssignClassTeacher::where(['class_id' => $getRecord->class_id])->get();

      $data['classes'] = $classes;
      $data['getTeacher'] = $getTeacher;
      $data['getRecord'] = $getRecord;
      $data['getAssignClassTeacherId'] = $getAssignClassTeacherId;
      $data['header_title'] = 'Edit Assign Class Teacher';
        return view('admin.assign-class-teacher.edit',$data);
     
    }


    public function update(Request $request, $id) {
     
      AssignClassTeacher::where('class_id','=',$request->class_id)->delete();

      if(!empty($request->teacher_id)) {
        foreach($request->teacher_id as $teacher_id) {
            $getAlreadyFirst = AssignClassTeacher::where(['class_id' => $request->class_id, 'teacher_id' => $teacher_id])->first();
             if(!empty($getAlreadyFirst)) {
                $getAlreadyFirst->status = $request->status;
                $getAlreadyFirst->save();
  
             }else{
                $assignClassTeacher = new AssignClassTeacher();
                $assignClassTeacher->class_id = $request->class_id;
                $assignClassTeacher->teacher_id = $teacher_id;
                $assignClassTeacher->user_id = Auth::user()->id;
                $assignClassTeacher->status = $request->status;
                $assignClassTeacher->save();

             }
            
        }
    }
    return redirect()->route('assign-class-teacher.list')->with('success', 'Assign Class to Teacher Successfully');


    }

    public function destroy(Request $request) {
      $id = $request->id;
      $assignClassTeacher = AssignClassTeacher::findOrFail($id);
      $assignClassTeacher->delete();


      session()->flash('success', 'Class Deleted Successfully');
      return response()->json([
         'status' => true,
      ]);
    }



    public function edit_single(string $id) {
      $classes = ClassModel::orderBy('name','asc')->where(['status' => 1])->get();
      $getTeacher = User::where(['user_type' => 2])->orderBy('id','desc')->get();
      $assignSingleTeacher = AssignClassTeacher::findOrFail($id);
      

      $data['classes'] = $classes;
      $data['assignSingleTeacher'] = $assignSingleTeacher;
      $data['getTeacher'] = $getTeacher;
      $data['header_title'] = 'Edit Single Assign Class Teacher';

      return view('admin.assign-subject.edit_single',$data);
    
   }


   public function update_single(Request $request, string $id) {
    $assignClassTeacher = AssignClassTeacher::findOrFail($id);

        $getAlreadyFirst = AssignClassTeacher::where(['class_id' => $request->class_id, 'teacher_id' =>  $request->teacher_id])->first();
         if(!empty($getAlreadyFirst)) {
            $getAlreadyFirst->status = $request->status;
            $getAlreadyFirst->save();
            return redirect()->route('assign-class-teacher.list')->with('success', 'Status Successfully Updated');


         }else{
          $assignClassTeacher->class_id = $request->class_id;
          $assignClassTeacher->teacher_id = $request->subject_id;
          $assignClassTeacher->user_id = Auth::user()->id;
          $assignClassTeacher->status = $request->status;
          $assignClassTeacher->save();

          return redirect()->route('assign-class-teacher.list')->with('success', 'Assign Class to Teacher Successfully Updated');


         }
        
         
}


// teacher side work
public function MyClassSubject() {
   $id = Auth::user()->id;
 $data['getRecord'] = AssignClassTeacher::select('assign_class_teachers.*',
        'classes.name as className','subjects.name as subjectName','subjects.type as subjectType','subjects.id as subject_id')
        ->leftJoin('classes','classes.id', 'assign_class_teachers.class_id')
        ->leftJoin('class_subjects','class_subjects.class_id', '=','classes.id')
        ->leftJoin('subjects','subjects.id', 'class_subjects.subject_id')
        ->where(['assign_class_teachers.teacher_id' => $id, 'assign_class_teachers.status' => 1, 
           'subjects.status' => 1, 'class_subjects.status' => 1,
        ])->get();
   
   $data['header_title'] = 'My Class & Subject';
   return view('teacher.my-class-subject',$data);
}

}
