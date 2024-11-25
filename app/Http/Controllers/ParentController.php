<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Laravel\Facades\Image;

class ParentController extends Controller
{
   public function index(Request $request) {

    $parents = User::orderBy('created_at','desc')->where(['user_type'=> 4]);

    if(!empty($request->keyword)) {
        $parents = $parents->where('name','like', '%'.$request->keyword.'%'); 
        $parents = $parents->orWhere('mobile_number','like', '%'.$request->keyword.'%'); 
        $parents = $parents->orWhere('gender','like', '%'.$request->keyword.'%'); 
        $parents = $parents->orWhere('email','like', '%'.$request->keyword.'%'); 
        $parents = $parents->orWhere('address','like', '%'.$request->keyword.'%'); 
    
    }

    $parents = $parents->paginate(10);

     return view('admin.parent.list',[
        'parents' => $parents,
         'header_title' => 'Parent List'
     ]);
   }

   public function create() {
      $data['header_title'] = 'Parent Create';
      return view('admin.parent.create',$data);
   }


   public function store(Request $request) {
    $validator = Validator::make($request->all(),[
          'first_name' => 'required',
          'email' => 'required|unique:users,email',
          'mobile_number' => 'required',
          'gender' => 'required',
          'occupation' => 'required',
          'image' => 'image',
          'password' => 'required'
    ]);

    if($validator->fails()) {
        return redirect()->back()->withInput()->withErrors($validator);
    }

    
    $image = $request->image;
    $ext = $image->getClientOriginalExtension();
    $imageName = time(). '.'.$ext;
    $image->move(public_path('uploads/profile_pic'),$imageName);


    // create profile Pic thumb
    $ImageLocation = public_path().'/uploads/profile_pic/'.$imageName;
    $imagePath = Image::read($ImageLocation);
    $imageSave = public_path('/uploads/profile_pic/thumb/');
    $imagePath->cover(150,150);
    $imagePath->save($imageSave.$imageName);

     $parents = new User();
     $parents->name = $request->first_name;
     $parents->last_name = $request->last_name;
     $parents->email = $request->email;
     $parents->mobile_number = $request->mobile_number;
     $parents->password = Hash::make($request->password);
     $parents->profile_pic = $imageName;
     $parents->user_type = 4;
     $parents->gender = $request->gender;
     $parents->occupation = $request->occupation;
     $parents->address = $request->address;
     $parents->status = $request->status;
     $parents->save();


    return redirect()->route('parent.list')->with('success','New Parent Successfully Inserted');

   }

   public function edit(string $id) {
    $parents  = User::findOrFail($id);

    return view('admin.parent.edit',[
        'parents' => $parents,
        'header_title' => 'Parent Edit'
    ]);
   }

   public function update(Request $request, string $id) {
    $parents  = User::findOrFail($id);


    $validator = Validator::make($request->all(),[
        'first_name' => 'required',
        'email' => 'required|unique:users,email,'.$id.',id',
        'mobile_number' => 'required',
        'gender' => 'required',
        'occupation' => 'required',
        'image' => 'image',
  ]);

  if($validator->fails()) {
      return redirect()->back()->withInput()->withErrors($validator);
  }

  
  if(!empty($request->image)) {
      // old image deleted
      File::delete('uploads/profile_pic/'.$parents ->profile_pic);
      File::delete('uploads/profile_pic/thumb/'.$parents ->profile_pic);
    $image = $request->image;
    $ext = $image->getClientOriginalExtension();
    $imageName = time(). '.'.$ext;
    $image->move(public_path('uploads/profile_pic'),$imageName);
    $parents->profile_pic = $imageName;
    $parents->save();

  
  
    // create profile Pic thumb
    $ImageLocation = public_path().'/uploads/profile_pic/'.$imageName;
    $imagePath = Image::read($ImageLocation);
    $imageSave = public_path('/uploads/profile_pic/thumb/');
    $imagePath->cover(150,150);
    $imagePath->save($imageSave.$imageName);
  }
 

   $parents->name = $request->first_name;
   $parents->last_name = $request->last_name;
   $parents->email = $request->email;
   $parents->mobile_number = $request->mobile_number;
   if(!empty($request->password)) {
    $parents->password = Hash::make($request->password);
   }
   $parents->user_type = 4;
   $parents->gender = $request->gender;
   $parents->occupation = $request->occupation;
   $parents->address = $request->address;
   $parents->status = $request->status;
   $parents->save();


  return redirect()->route('parent.list')->with('success','Parent Updated Successfully');

   }

   public function destroy(Request $request) {
    $id = $request->id;
    $parents = User::findOrFail($id);
    $parents->delete();

       // old image deleted
       File::delete('uploads/profile_pic/'.$parents->profile_pic);
       File::delete('uploads/profile_pic/thumb/'.$parents->profile_pic);


       
      session()->flash('success', 'success','Parent Successfully Deleted');
      return response()->json([
          'status' => true
      ]);


   }


   public function myStudent(Request $request, string $id) {

    $getSingleParent = User::findOrFail($id);
    $parent_id = $id;
    $getSearchStudent = User::select('users.*','parent.name as parent_name')
    ->leftJoin('users as parent','parent.id', '=', 'users.parent_id')
    ->where('users.user_type', '=', 3);

    if(!empty($request->id) || !empty($request->name) || !empty($request->last_name) || !empty($request->email)) {
        if(!empty($request->id)) {
            $getSearchStudent = $getSearchStudent->where('users.id','like', '%'.$request->id.'%'); 
 
        }

        if(!empty($request->name)) {
            $getSearchStudent = $getSearchStudent->where('users.name','like', '%'.$request->name.'%'); 
 
        }

        if(!empty($request->last_name)) {
            $getSearchStudent = $getSearchStudent->where('users.last_name','like', '%'.$request->last_name.'%'); 
 
        }


        if(!empty($request->email)) {
            $getSearchStudent = $getSearchStudent->where('users.email','like', '%'.$request->email.'%'); 
 
        }
      
    }
           $getSearchStudent = $getSearchStudent->orderBy('users.created_at','desc')->paginate(10);


        // parent record 
        $getRecordParents = User::select('users.*','parent.name as parent_name')
        ->leftJoin('users as parent','parent.id', '=', 'users.parent_id')
        ->where(['users.user_type' => 3, 'users.parent_id' => $parent_id])
        ->orderBy('users.created_at','desc')->get();
        
 
  


    return view('admin.parent.my_student',[
        'getSearchStudent' => $getSearchStudent,
        'getRecordParents' => $getRecordParents,
        'getSingleParent' =>  $getSingleParent,
         'parent_id' => $parent_id,
           'header_title' => 'Parent Student List'
         

    ]);

   }



   public function AssignStudentParent($student_id, $parent_id) {
           $student = User::findOrFail($student_id);
           $student->parent_id = $parent_id;
           $student->save();

           return redirect()->back()->with('success', 'Student Successfully Assign');
   }


   public function AssignStudentParentDelete(Request $request) {

    $student_id = $request->id;
    $student = User::findOrFail($student_id);
    $student->delete();

    return redirect()->back()->with('success', 'Student Successfully Assign Deleted');
}


// parent side

public function MyStudentParent() {
    $id = Auth::user()->id;
    $getRecordStudent = User::select('users.*','classes.name as className')
    ->leftjoin('classes','classes.id','users.class_id')
    ->where(['users.user_type' => 3, 'users.parent_id' => $id])
    ->orderBy('users.created_at','desc')->get();



    return view('parent.my-student',[
        'getRecordStudent' => $getRecordStudent,
           'header_title' => 'Parent Student List'
    ]);
}


}
