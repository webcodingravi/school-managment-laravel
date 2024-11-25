<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use App\Models\ClassSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class SubjectController extends Controller
{
    public function index(Request $request) {
        $subjects = Subject::orderBy('created_at','DESC')->with('user');
        if(!empty($request->keyword)) {
            $subjects = $subjects->where('name','like', '%'.$request->keyword.'%'); 
            $subjects = $subjects->orWhere('type','like', '%'.$request->keyword.'%'); 

        }
        $subjects = $subjects->paginate(10);

        return view('admin.subject.list',[
           'subjects' => $subjects,
           'header_title' => 'Subject List'
        ]);
    }

    public function create() {
    $data['header_title'] = 'Subject Create';
     return view('admin.subject.create',$data);
    }


    public function store(Request $request) {
    $validator = Validator::make($request->all(),[
              'name' => 'required',
              'type' => 'required'
    ]);

    if($validator->fails()) {
        return response()->json([
             'status' => false,
             'errors' => $validator->errors()
        ]);
    }

      $subject = new Subject();
      $subject->name = $request->name;
      $subject->type = $request->type;
      $subject->user_id = Auth::user()->id;
      $subject->status = $request->status;
      $subject->save();

      session()->flash('success', 'New Subject added Successfully');
      return response()->json([
           'status' => true
      ]);
    }


    public function edit(string $id) {
     $subject = Subject::findOrFail($id);

     return view('admin.subject.edit',[
        'subject' => $subject,
        'header_title' => 'Subject Edit'
     ]);
    }

    public function update(Request $request, string $id) {
        $subject = Subject::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'type' => 'required'
            ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
        $subject->name = $request->name;
        $subject->type = $request->type;
        $subject->user_id = Auth::user()->id;
        $subject->status = $request->status;
        $subject->save();

        session()->flash('success', 'Subject Updated Successfully');
        return response()->json([
            'status' => true
        ]);


    }
    public function destroy(Request $request) {
       $id = $request->id;
       
       $subject = Subject::findOrFail($id);

       $subject->delete();


       session()->flash('success', 'Subject Deleted Successfully');
       return response()->json([
           'status' => true
       ]);
    }


// student side
    public function MySubject() {
        $class_id = Auth::user()->class_id;
        $subjects = ClassSubject::select('class_subjects.*', 'subjects.type as subjectType','subjects.name as subjectName')
            ->join('classes','classes.id', 'class_subjects.class_id')
            ->join('users', 'users.id', 'class_subjects.user_id')
            ->join('subjects', 'subjects.id', 'class_subjects.subject_id')
            ->where('class_subjects.class_id', '=', $class_id)
            ->where('class_subjects.status', '=', 1)
            ->orderBy('class_subjects.created_at','desc')->get();

        $data['subjects'] = $subjects;
        $data['header_title'] = 'My Subject';

        return view('student.my-subject',$data);

    }

    // parent side
    public function ParentStudentSubject(string $student_id) {
        $user = User::findOrFail($student_id);
        $data['getUser'] = $user ;
        $subjects = ClassSubject::select('class_subjects.*', 'subjects.type as subjectType','subjects.name as subjectName')
        ->leftJoin('classes','classes.id', 'class_subjects.class_id')
        ->leftJoin('users', 'users.id', 'class_subjects.user_id')
        ->leftJoin('subjects', 'subjects.id', 'class_subjects.subject_id')
        ->where('class_subjects.class_id', '=', $user->class_id)
        ->where('class_subjects.status', '=', 1)
        ->orderBy('class_subjects.created_at','desc')->get();

        $data['subjects'] = $subjects;
        $data['header_title'] = 'My Subject';

        return view('parent.my-student-subject',$data);
        
    }

}
