<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\ClassModel;
use App\Models\ClassSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClassSubjectController extends Controller
{
   public function index(Request $request) {
    $assignSubjects = ClassSubject::select('class_subjects.*','classes.name as className',
    'users.name as userName', 'subjects.name as subjectName')
    ->join('classes','classes.id', 'class_subjects.class_id')
    ->join('users', 'users.id', 'class_subjects.user_id')
     ->join('subjects', 'subjects.id', 'class_subjects.subject_id');
   
      if(!empty($request->keyword)) {
        $assignSubjects = $assignSubjects->where('classes.name', 'like', '%'.$request->keyword. '%'); 
        $assignSubjects = $assignSubjects->orWhere('subjects.name', 'like', '%'.$request->keyword. '%');    
   
      
      }

      $assignSubjects = $assignSubjects->orderBy('class_subjects.created_at','desc')->paginate(10);

    return view('admin.assign-subject.list',[
        'assignSubjects' => $assignSubjects,
        'header_title' => 'Assign Subject List'
        
    ]);
   }

   public function create() {
    $classes = ClassModel::orderBy('name','asc')->where(['status' => 1])->get();
    $subjects = Subject::orderBy('name','asc')->where(['status' => 1])->get();

     return view('admin.assign-subject.create',[
        'classes' => $classes,
        'subjects' => $subjects,
        'header_title' => 'Add New Assign Subject'
     ]);
   }

   public function store(Request $request) {
    $validator = Validator::make($request->all(),[
           'class_id' => 'required'
    ]);

    if($validator->fails()) {
        return redirect()->back()->withErrors($validator);
    }


    if(!empty($request->subject_id)) {
        foreach($request->subject_id as $subject_id) {
            $getAlreadyFirst = ClassSubject::where(['class_id' => $request->class_id, 'subject_id' =>  $subject_id])->first();
             if(!empty($getAlreadyFirst)) {
                $getAlreadyFirst->status = $request->status;
                $getAlreadyFirst->save();
  
             }else{
                $assignSubject = new ClassSubject();
                $assignSubject->class_id = $request->class_id;
                $assignSubject->subject_id = $subject_id;
                $assignSubject->user_id = Auth::user()->id;
                $assignSubject->status = $request->status;
                $assignSubject->save();

             }
            
        }
        return redirect()->route('assign_subject.list')->with('success', 'Subject Successfully Assign to Class');


    }else{
        return redirect()->back()->with('error', 'Due to some error pls try again.');

    }



   }

   public function edit(string $id) {
    $classes = ClassModel::orderBy('name','asc')->where(['status' => 1])->get();
    $subjects = Subject::orderBy('name','asc')->where(['status' => 1])->get();
    $assignSubject = ClassSubject::findOrFail($id);
    $getAssignSubjectId = ClassSubject::where(['class_id' => $assignSubject->class_id])->get();
      return view('admin.assign-subject.edit',[
        'classes' => $classes,
        'subjects' => $subjects,
        'assignSubject' => $assignSubject,
        'getAssignSubjectId' => $getAssignSubjectId,
        'header_title' => 'Edit Assign Subject'
      ]);
   }

   public function update(Request $request, string $id) {
    ClassSubject::where('class_id','=',$request->class_id)->delete();

      if(!empty($request->subject_id)) {
        foreach($request->subject_id as $subject_id) {
            $getAlreadyFirst = ClassSubject::where(['class_id' => $request->class_id, 'subject_id' =>  $subject_id])->first();
             if(!empty($getAlreadyFirst)) {
                $getAlreadyFirst->status = $request->status;
                $getAlreadyFirst->save();
  
             }else{
                $assignSubject = new ClassSubject();
                $assignSubject->class_id = $request->class_id;
                $assignSubject->subject_id = $subject_id;
                $assignSubject->user_id = Auth::user()->id;
                $assignSubject->status = $request->status;
                $assignSubject->save();

             }
            
        }
    }

    return redirect()->route('assign_subject.list')->with('success', 'Subject Successfully updated Assign to Class');


   }

   public function destroy(Request $request) {
     $id = $request->id;
     $assignSubject = ClassSubject::where('id',$id);

     $assignSubject->delete();
     session()->flash('success', 'Subject Assign to Class Deleted Successfully');
     return response()->json([
        'status' => true,
     ]);


   }


   public function edit_single(string $id) {
      $classes = ClassModel::orderBy('name','asc')->where(['status' => 1])->get();
      $subjects = Subject::orderBy('name','asc')->where(['status' => 1])->get();
      $assignSubject = ClassSubject::findOrFail($id);
      
        return view('admin.assign-subject.edit_single',[
          'classes' => $classes,
          'subjects' => $subjects,
          'assignSubject' => $assignSubject,
           'header_title' => 'Edit Single Assign Subject'
        ]);
   }


   public function update_single(Request $request, string $id) {

      $assignSubject = ClassSubject::findOrFail($id);

      $validator = Validator::make($request->all(),[
         'class_id' => 'required'
  ]);

  if($validator->fails()) {
      return redirect()->back()->withErrors($validator);
  }


          $getAlreadyFirst = ClassSubject::where(['class_id' => $request->class_id, 'subject_id' =>  $request->subject_id])->first();
           if(!empty($getAlreadyFirst)) {
              $getAlreadyFirst->status = $request->status;
              $getAlreadyFirst->save();
              return redirect()->route('assign_subject.list')->with('success', 'Status Successfully Updated');


           }else{
              $assignSubject->class_id = $request->class_id;
              $assignSubject->subject_id = $request->subject_id;
              $assignSubject->user_id = Auth::user()->id;
              $assignSubject->status = $request->status;
              $assignSubject->save();

              return redirect()->route('assign_subject.list')->with('success', 'Subject Successfully Assign to Class');


           }
          
      

}

}
