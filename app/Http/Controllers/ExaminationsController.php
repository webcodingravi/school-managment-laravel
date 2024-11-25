<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExaminationsController extends Controller
{
    public function index(Request $request) {
    $getRecord = Exam::select('exams.*','users.name as userName');
    $getRecord = $getRecord->leftJoin('users','users.id','exams.user_id');
    if(!empty($request->keyword)) {
        $getRecord = $getRecord->where('exams.name','like', '%'.$request->keyword.'%');
  
    }
    $getRecord = $getRecord->orderBy('exams.created_at','desc')->paginate(10);
    $data['getRecord'] = $getRecord;
    $data['header_title'] ="Exam List";
    return view('admin.examination.exam.list',$data);

    }

    public function create() {
        $data['header_title'] ="Add New Exam";
        return view('admin.examination.exam.create',$data);
    }


    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $exam = new Exam();
        $exam->name = $request->name;
        $exam->note = $request->note;
        $exam->user_id = Auth::user()->id;
        $exam->save();

        return redirect()->route('exam.list')->with('success','Exam successfully created');
    }

    public function edit(string $id) {
        $data['exams'] = Exam::findOrFail($id);
        $data['header_title'] ="Edit Exam";
        return view('admin.examination.exam.edit',$data);
    }

    public function update(Request $request,string $id) {
        $exam = Exam::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'name' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $exam->name = $request->name;
        $exam->note = $request->note;
        $exam->user_id = Auth::user()->id;
        $exam->save();

        return redirect()->route('exam.list')->with('success','Exam successfully Updated');

    }

    public function destory(Request $request) {
       $id = $request->id;
       $exam = Exam::findOrFail($id);
       $exam->delete();

       session()->flash('success','Exam successfully Deleted');
       return response()->json([
           'status' => true
       ]);
    

    }
}
