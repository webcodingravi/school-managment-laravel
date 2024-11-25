<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Week;
use App\Models\Subject;
use App\Models\ClassModel;
use App\Models\ClassSubject;
use Illuminate\Http\Request;
use App\Models\AssignClassTeacher;
use Illuminate\Support\Facades\Auth;
use App\Models\ClassSubjectTimetable;

class ClassTimetableController extends Controller
{
    public function index(Request $request) {
        $classes = ClassModel::orderBy('name','asc')->where(['status' => 1])->get();

        if(!empty($request->class_id)) {

        $data['getSubject'] = ClassSubject::select('class_subjects.*', 'subjects.type as 
        subjectType','subjects.name as subjectName')
        ->leftJoin('classes','classes.id', 'class_subjects.class_id')
        ->leftJoin('users', 'users.id', 'class_subjects.user_id')
        ->leftJoin('subjects', 'subjects.id', 'class_subjects.subject_id')
        ->where('class_subjects.class_id', '=', $request->class_id)
        ->where('class_subjects.status', '=', 1)
        ->orderBy('class_subjects.created_at','desc')->get();   
    }

    $getWeek = Week::get();
    $week = array();
    foreach($getWeek as $value) {
        $dataW = array();
        $dataW['week_id'] = $value->id;
        $dataW['week_name'] = $value->name;
        if(!empty($request->class_id) && !empty($request->subject_id)) {
            $ClassSubject = ClassSubjectTimetable::where(['class_id' => $request->class_id, 'subject_id' => $request->subject_id,
            'week_id' => $value->id])->first();

            if(!empty($ClassSubject)) {
                $dataW['start_time'] = $ClassSubject->start_time;
                $dataW['end_time'] = $ClassSubject->end_time;
                $dataW['room_number'] = $ClassSubject->room_number;
            }else{
            
            $dataW['start_time'] = '';
            $dataW['end_time'] = '';
            $dataW['room_number'] = '';
            }
         }else{
            $dataW['start_time'] = '';
            $dataW['end_time'] = '';
            $dataW['room_number'] = '';
         }
        $week[] = $dataW;

    }
         $data['week'] = $week;
   

        $data['classes'] = $classes;
        $data['header_title'] = 'Class Timetable';
        return view('admin.class-timetable.list',$data);
    }

    public function get_subject(Request $request) {
        $class_id = $request->value;
        $getRecord = ClassSubject::select('class_subjects.*', 'subjects.type as 
        subjectType','subjects.name as subjectName')
        ->leftJoin('classes','classes.id', 'class_subjects.class_id')
        ->leftJoin('users', 'users.id', 'class_subjects.user_id')
        ->leftJoin('subjects', 'subjects.id', 'class_subjects.subject_id')
        ->where('class_subjects.class_id', '=', $class_id)
        ->where('class_subjects.status', '=', 1)
        ->orderBy('class_subjects.created_at','desc')->get();

        
    
        $html = "<option value=''>Please Select..</option>";
        foreach($getRecord as $value) {
           
            $html .= "<option value='".$value->subject_id."'>".$value->subjectName."</option>";
        }
        $json['html'] = $html;
        echo json_encode($json);
        
    }


    public function insert_update(Request $request) {
        ClassSubjectTimetable::where(['class_id' => $request->class_id, 'subject_id' => $request->subject_id])->delete();
        foreach($request->timetable as $timetable){
            if(!empty($timetable['week_id']) && !empty($timetable['start_time']) && !empty($timetable['end_time']) && !empty($timetable['room_number'])) {

                $timetableSave = new ClassSubjectTimetable();
                $timetableSave->subject_id = $request->subject_id;
                $timetableSave->class_id = $request->class_id;
                $timetableSave->week_id = $timetable['week_id'];
                $timetableSave->start_time = $timetable['start_time'];
                $timetableSave->end_time = $timetable['end_time'];
                $timetableSave->room_number = $timetable['room_number'];
                $timetableSave->save();

            }
        }
        return redirect()->back()->with('success','Class Timetable Successfully Saved');
          
    }


    // Student side

    public function MyTimetable() {
        $class_id = Auth::user()->class_id;
        $ClassSubject = ClassSubject::select('class_subjects.*', 'subjects.type as subjectType','subjects.name as subjectName')
        ->join('classes','classes.id', 'class_subjects.class_id')
        ->join('users', 'users.id', 'class_subjects.user_id')
        ->join('subjects', 'subjects.id', 'class_subjects.subject_id')
        ->where('class_subjects.class_id', '=', $class_id)
        ->where('class_subjects.status', '=', 1)
        ->orderBy('class_subjects.created_at','desc')->get();
          
        $result = array();
        foreach($ClassSubject as $getRecord) {
            $dataS['name'] = $getRecord->subjectName;
            $getWeek = Week::get();

            $week = array();
            foreach($getWeek as $valueW) {
                $dataW = array();
                $dataW['week_name'] = $valueW->name;
                $ClassSubject = ClassSubjectTimetable::where(['class_id' => $getRecord->class_id, 'subject_id' => $getRecord->subject_id,
                'week_id' => $valueW->id])->first();
    
                if(!empty($ClassSubject)) {
                    $dataW['start_time'] = $ClassSubject->start_time;
                    $dataW['end_time'] = $ClassSubject->end_time;
                    $dataW['room_number'] = $ClassSubject->room_number;
                }else{
                $dataW['start_time'] = '';
                $dataW['end_time'] = '';
                $dataW['room_number'] = '';
                }

                $week[] = $dataW;
        
            }
            $dataS['week'] = $week;
            $result[] = $dataS;


        }
        $data['getRecord'] = $result;
      
        $data['header_title'] = 'My Timetable';
        return view('student.my-timetable',$data);
    }


    // teacher side
    public function MyTimetableTeacher($class_id, $subject_id) {
        $data['getClass'] = ClassModel::findOrfail($class_id);
        $data['getSubject'] = Subject::findOrfail($subject_id);

        $getWeek = Week::get();
        $week = array();
        foreach($getWeek as $valueW) {
            $dataW = array();
            $dataW['week_name'] = $valueW->name;

            $ClassSubject = ClassSubjectTimetable::where(['class_id' => $class_id, 'subject_id' => $subject_id,
            'week_id' => $valueW->id])->first();

            if(!empty($ClassSubject)) {
            $dataW['start_time'] = $ClassSubject->start_time;
            $dataW['end_time'] = $ClassSubject->end_time;
            $dataW['room_number'] = $ClassSubject->room_number;
            }else{
            $dataW['start_time'] = '';
            $dataW['end_time'] = '';
            $dataW['room_number'] = '';
            }
            $result[] = $dataW;

        }
        $data['getRecord'] = $result;
        $data['header_title'] = 'My Timetable';
        return view('teacher.my-timetable',$data);  
    }


    // parent side
   
    public function MyStudentTimetableParent($class_id, $subject_id, $student_id) {
        $data['getClass'] = ClassModel::findOrfail($class_id);
        $data['getSubject'] = Subject::findOrfail($subject_id);
        $data['getStudent'] = User::findOrfail($student_id);

        $getWeek = Week::get();
        $week = array();
        foreach($getWeek as $valueW) {
            $dataW = array();
            $dataW['week_name'] = $valueW->name;

            $ClassSubject = ClassSubjectTimetable::where(['class_id' => $class_id, 'subject_id' => $subject_id,
            'week_id' => $valueW->id])->first();

            if(!empty($ClassSubject)) {
            $dataW['start_time'] = $ClassSubject->start_time;
            $dataW['end_time'] = $ClassSubject->end_time;
            $dataW['room_number'] = $ClassSubject->room_number;
            }else{
            $dataW['start_time'] = '';
            $dataW['end_time'] = '';
            $dataW['room_number'] = '';
            }
            $result[] = $dataW;

        }
        $data['getRecord'] = $result;
        $data['header_title'] = 'My Timetable';
        return view('parent.my-timetable',$data);  
    } 
}
