<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Laravel\Facades\Image;

class StudentController extends Controller
{
   public function index(Request $request) {

    $students = User::select('users.*','classes.name as className', 
    'parent.name as parent_name', 'parent.last_name as parent_lastName')
    ->leftJoin('users as parent','parent.id', '=', 'users.parent_id')
   ->leftjoin('classes','classes.id','users.class_id')->where(['users.user_type' => 3]);
  

   if(!empty($request->keyword)) {
    $students = $students->where('users.name','like', '%'.$request->keyword.'%'); 
    $students = $students->orWhere('users.mobile_number','like', '%'.$request->keyword.'%'); 
    $students = $students->orWhere('users.email','like', '%'.$request->keyword.'%'); 
    $students = $students->orWhere('users.roll_number','like', '%'.$request->keyword.'%'); 
    $students = $students->orWhere('users.admission_number','like', '%'.$request->keyword.'%'); 
    $students = $students->orWhere('classes.name','like', '%'.$request->keyword.'%'); 

}

    $students = $students->orderBy('users.created_at')->paginate(10);
     return view('admin.student.list',[
      'students' => $students,
      'header_title' => 'Student List'
     ]);
   }

   public function create() {
    $classes = ClassModel::orderBy('name','asc')->where(['status' => 1])->get();
     return view('admin.student.create',[
        'classes' => $classes,
        'header_title' => 'Student Create'
     ]);
   }

   public function store(Request $request) {
    $validator = Validator::make($request->all(),[
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required',
            'email' => 'required|email|unique:users,email',
            'admission_number' => 'required',
            'roll_number' => 'required',
            'religion' => 'required',
            'class_id' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required',
            'caste' => 'required',
            'mobile_number' => 'required',
            'admission_date' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'blood_group' => 'required',
            'image' => 'image',

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

    $students = new User();
    $students->name = $request->first_name;
    $students->last_name = $request->last_name;
    $students->email = $request->email;
    $students->mobile_number = $request->mobile_number;
    $students->religion = $request->religion;
    $students->password = Hash::make($request->password);
    $students->admission_number = $request->admission_number;
    $students->admission_date = $request->admission_date;
    $students->roll_number = $request->roll_number;
    $students->class_id = $request->class_id;
    $students->profile_pic = $imageName;
    $students->gender = $request->gender;
    $students->date_of_birth = $request->date_of_birth;
    $students->caste = $request->caste;
    $students->blood_group = $request->blood_group;
    $students->height = $request->height;
    $students->weight = $request->weight;
    $students->status = $request->status;
    $students->save();


    return redirect()->route('student.list')->with('success','New Student Successfully Inserted');


   }



   public function edit(string $id) {
    $students = User::findOrFail($id);
    $classes = ClassModel::orderBy('name','asc')->where(['status' => 1])->get();

     return view('admin.student.edit',[
      'students' => $students,
      'classes' => $classes,
      'header_title' => 'Student Edit'
     ]);
   }


   public function update(Request $request, string $id) {

    $students = User::findOrFail($id);

    $validator = Validator::make($request->all(),[
      'first_name' => 'required',
      'last_name' => 'required',
      'email' => 'required|email|unique:users,email,'.$id.',id',
      'admission_number' => 'required',
      'roll_number' => 'required',
      'class_id' => 'required',
      'gender' => 'required',
      'religion' => 'required',
      'date_of_birth' => 'required',
      'caste' => 'required',
      'mobile_number' => 'required',
      'admission_date' => 'required',
      'height' => 'required',
      'weight' => 'required',
      'blood_group' => 'required',
      'image' => 'image',

]);

if($validator->fails()) {
 return redirect()->back()->withInput()->withErrors($validator);
}


if(!empty($request->image)) {
  // old image deleted
File::delete('uploads/profile_pic/'.$students->profile_pic);
File::delete('uploads/profile_pic/thumb/'.$students->profile_pic);

$image = $request->image;
$ext = $image->getClientOriginalExtension();
$imageName = time(). '.'.$ext;
$image->move(public_path('uploads/profile_pic'),$imageName);
 $students->profile_pic = $imageName;
 $students->save();


// create profile Pic thumb
$ImageLocation = public_path().'/uploads/profile_pic/'.$imageName;
$imagePath = Image::read($ImageLocation);
$imageSave = public_path('/uploads/profile_pic/thumb/');
$imagePath->cover(150,150);
$imagePath->save($imageSave.$imageName);


}

$students->name = $request->first_name;
$students->last_name = $request->last_name;
$students->email = $request->email;
$students->mobile_number = $request->mobile_number;
$students->religion = $request->religion;

if(!empty($request->password)) {
$students->password = Hash::make($request->password);
}

$students->admission_number = $request->admission_number;
$students->admission_date = $request->admission_date;
$students->roll_number = $request->roll_number;
$students->class_id = $request->class_id;
$students->gender = $request->gender;
$students->date_of_birth = $request->date_of_birth;
$students->caste = $request->caste;
$students->blood_group = $request->blood_group;
$students->height = $request->height;
$students->weight = $request->weight;
$students->status = $request->status;
$students->save();




return redirect()->route('student.list')->with('success','Student Successfully Updated');
   }

   public function destroy(Request $request) {
      $id = $request->id;
      $students = User::findOrFail($id);
      $students->delete();

      // old image deleted
      File::delete('uploads/profile_pic/'.$students->profile_pic);
      File::delete('uploads/profile_pic/thumb/'.$students->profile_pic);

      session()->flash('success', 'Student Record successfully Deleted');
      return response()->json([
          'status' => true
      ]);
   }


   // Teacher side work

   public function MyStudent() {
      $students = User::select('users.*','classes.name as className')
     ->leftjoin('classes','classes.id','users.class_id')
     ->leftJoin('assign_class_teachers','assign_class_teachers.class_id', '=','classes.id')
     ->where(['users.user_type' => 3, 'assign_class_teachers.teacher_id' => Auth::user()->id, 
     'assign_class_teachers.status' => 1])
     ->orderBy('users.created_at')->paginate(10);
    
     $data['students'] = $students;
      $data['header_title'] = 'My Student List';

      return view('teacher.my-student',$data);

   }
}
