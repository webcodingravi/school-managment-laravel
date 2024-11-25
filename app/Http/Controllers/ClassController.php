<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClassController extends Controller
{
   public function index(Request $request) {
    $classes = ClassModel::orderBy('created_at','DESC')->with('user');    
    
    if(!empty($request->keyword)) {
        $classes = $classes->where('name', 'like', '%'.$request->keyword.'%'); 

        
    }

    $classes = $classes->paginate(10);

    return view('admin.Class.list',[
        'classes' => $classes,
        'header_title' => 'Class List'
    ]);

   }


   public function create() {
    $data['header_title'] = 'Class Create';
     return view('admin.Class.create',$data);
   }

   public function store(Request $request) {
        $validator = Validator::make($request->all(),[
          'name' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $class = new ClassModel();
        $class->name = $request->name;
        $class->user_id = Auth::user()->id;
        $class->status = $request->status;
        $class->save();

        session()->flash('success', 'Class Successfully Added');
        return response()->json([
           'status' => true,
        ]);
   }

   public function edit(string $id) {
    $class = ClassModel::findOrFail($id);
    return view('admin.Class.edit',[
        'class' => $class,
        'header_title' => 'Class Edit'
    ]);
   }

   public function update(Request $request, string $id) {
    $class = ClassModel::findOrFail($id);

    $validator = Validator::make($request->all(),[
        'name' => 'required'
      ]);

      if($validator->fails()) {
          return response()->json([
              'status' => false,
              'errors' => $validator->errors()
          ]);
      }

      $class->name = $request->name;
      $class->user_id = Auth::user()->id;
      $class->status = $request->status;
      $class->save();

      session()->flash('success', 'Class Updated Successfully');
      return response()->json([
         'status' => true,
      ]);
   }


   public function destroy(Request $request) {
       $classId = $request->id;
      $class = ClassModel::where('id',$classId);
      $class->delete();

      session()->flash('success', 'Class Deleted Successfully');
      return response()->json([
         'status' => true,
      ]);
   }
}
