<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Laravel\Facades\Image;

class TeacherController extends Controller
{
    public function index(Request $request) {
     $teachers = User::orderBy('created_at','desc')->where(['user_type' => 2]);
      if(!empty($request->keyword)) {
        $teachers = $teachers->where('name', 'like', '%'.$request->keyword.'%');  
        $teachers = $teachers->orWhere('mobile_number', 'like', '%'.$request->keyword.'%');  
        $teachers = $teachers->orWhere('email', 'like', '%'.$request->keyword.'%'); 
  

      }

     $teachers = $teachers->paginate(10);

     return view('admin.teacher.list',[
        'teachers' => $teachers,
        'header_title' => 'Teacher List'
     ]);
    }


    public function create() {
      $data['header_title'] = 'New Teacher Create';
       return view('admin.teacher.create',$data);
    }


    public function store(Request $request) {
      $validator = Validator::make($request->all(),[
           'first_name' => 'required',
           'last_name' => 'required',
           'email' => 'required|email|unique:users,email',
           'password' => 'required',
           'image' => 'nullable|image',
      ]);

      if($validator->fails()) {
         return redirect()->back()->withInput()->withErrors($validator);
      }

    
          $image = $request->image;
          $ext = $image->getClientOriginalExtension();
          $imageName = time(). '.'.$ext;
          $image->move(public_path('uploads/profile_pic'),$imageName);
          $teachers = new User();
         
    
    
          // create profile Pic thumb
          $ImageLocation = public_path().'/uploads/profile_pic/'.$imageName;
          $imagePath = Image::read($ImageLocation);
          $imageSave = public_path('/uploads/profile_pic/thumb/');
          $imagePath->cover(150,150);
          $imagePath->save($imageSave.$imageName);
   

      $teachers = new User();
      $teachers->name = $request->first_name;
      $teachers->last_name = $request->last_name;
      $teachers->email = $request->email;
      $teachers->mobile_number = $request->mobile_number;
      $teachers->password = Hash::make($request->password);
      $teachers->gender = $request->gender;
      $teachers->user_type = 2;
      $teachers->profile_pic = $imageName;
      $teachers->date_of_birth = $request->date_of_birth;
      $teachers->admission_date = $request->joining_date;
      $teachers->address = $request->current_address;
      $teachers->permanent_address = $request->permanent_address;
      $teachers->qualification = $request->qualification;
      $teachers->work_experience = $request->work_experience;
      $teachers->note = $request->note;
      $teachers->marital_status = $request->marital_status;
      $teachers->status = $request->status;
      $teachers->save();

      return redirect()->route('teacher.list')->with('success', 'New Teacher successfully inserted');
    }

  
    public function edit(string $id) {
      $teachers  = User::findOrFail($id);
      $data['teachers'] = $teachers;
      $data['header_title'] = 'Teacher Edit';
      return view('admin.teacher.edit',$data);
    }

    public function update(Request $request, string $id) {
      $teachers  = User::findOrFail($id);
      $validator = Validator::make($request->all(),[
         'first_name' => 'required',
         'last_name' => 'required',
         'email' => 'required|email|unique:users,email,'.$id.',id',
         'image' => 'image',
    ]);

    if($validator->fails()) {
       return redirect()->back()->withInput()->withErrors($validator);
    }

    if(!empty($request->image)) {
      // old image deleted
      File::delete('uploads/profile_pic/'.$teachers->profile_pic);
      File::delete('uploads/profile_pic/thumb/'.$teachers->profile_pic);

      $image = $request->image;
      $ext = $image->getClientOriginalExtension();
      $imageName = time(). '.'.$ext;
      $image->move(public_path('uploads/profile_pic'),$imageName);
      $teachers->profile_pic = $imageName;
      $teachers->save();
  
      // create profile Pic thumb
      $ImageLocation = public_path().'/uploads/profile_pic/'.$imageName;
      $imagePath = Image::read($ImageLocation);
      $imageSave = public_path('/uploads/profile_pic/thumb/');
      $imagePath->cover(150,150);
      $imagePath->save($imageSave.$imageName);

    }
   

    $teachers->name = $request->first_name;
    $teachers->last_name = $request->last_name;
    $teachers->email = $request->email;
    $teachers->mobile_number = $request->mobile_number;
    if(!empty($teachers->password)) {
      $teachers->password = Hash::make($request->password);
    }
    $teachers->gender = $request->gender;
    $teachers->user_type = 2;
    $teachers->date_of_birth = $request->date_of_birth;
    $teachers->admission_date = $request->joining_date;
    $teachers->address = $request->current_address;
    $teachers->permanent_address = $request->permanent_address;
    $teachers->qualification = $request->qualification;
    $teachers->work_experience = $request->work_experience;
    $teachers->note = $request->note;
    $teachers->marital_status = $request->marital_status;
    $teachers->status = $request->status;
    $teachers->save();

    return redirect()->route('teacher.list')->with('success', 'Teacher successfully Updated');

    }


    public function destroy(Request $request) {

      $id = $request->id;
      $teachers = User::findOrFail($id);
      $teachers->delete();
      
      // old image deleted
      File::delete('uploads/profile_pic/'.$teachers->profile_pic);
      File::delete('uploads/profile_pic/thumb/'.$teachers->profile_pic);

      session()->flash('success', 'Teacher Record successfully Deleted');
      return response()->json([
          'status' => true
      ]);

    }
}
