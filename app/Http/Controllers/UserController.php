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

class UserController extends Controller
{
     public function changePassword() {
        return view('profile.change-password');
     }


     public function processChangePassword(Request $request) {
       $validator = Validator::make($request->all(),[
             'old_password' => 'required',
             'new_password' => 'required',
             'confirm_password' => 'required|same:new_password',
       ]);

       if($validator->fails()) {
         return redirect()->back()->withInput()->withErrors($validator);

   

      }
      
         if(Hash::check($request->old_password, Auth::user()->password) == false){
            session()->flash('error', 'Your old password is incorrect');
            return redirect()->back()->with("error",'Your old password is incorrect');

   
         }
   
         $user = User::find(Auth::user()->id);
         $user->password = Hash::make($request->new_password);
         $user->save();

         return redirect()->back()->with("success",'Password updated successfully');
  
      
     }

     public function MyProfile() {
      $data['getRecord'] = User::findOrFail(Auth::user()->id);
      return view('teacher.my-profile',$data);
      
     }

     public function MyProfileStudent() {
      $id = Auth::user()->id;
      $data['getRecord'] = User::select('users.*','classes.name as className')
      ->leftJoin('classes','classes.id', 'users.class_id')->where(['users.id' => $id])->first();
      return view('student.my-profile',$data);
      
     }


     public function MyProfileParent() {
      $data['getRecord'] = User::findOrFail(Auth::user()->id);
      return view('parent.my-profile',$data);

     }
     
     public function MyProfileAdmin() {
      $data['getRecord'] = User::findOrFail(Auth::user()->id);
      return view('admin.my-profile',$data);

     }

     


     public function MyAccount() {
      $data['getRecord'] = User::findOrFail(Auth::user()->id);
      $data['header_title'] = 'Account Setting';

      if(Auth::user()->user_type == 1) {
        return view('admin.my-account',$data);

      }elseif(Auth::user()->user_type == 2) {
         return view('teacher.my-account',$data);
         
       }elseif(Auth::user()->user_type == 3) {
         return view('student.my-account',$data);
       }elseif(Auth::user()->user_type == 4) {
        return view('parent.my-account',$data);
       }
     
     }

     public function UpdateMyAccountAdmin(Request $request){
      $id = Auth::user()->id;
      $users = User::findOrFail($id);
     $validator = Validator::make($request->all(),[
          'name' => 'required',
          'email' => 'required|email|unique:users,email,'.$id.',id',
          'image' => 'image'
     ]);

     if($validator->fails()) {
      return redirect()->back()->withInput()->withErrors($validator);

     }
        
    if(!empty($request->image)) {
      // old image deleted
      File::delete('uploads/profile_pic/'.$users->profile_pic);
      File::delete('uploads/profile_pic/thumb/'.$users->profile_pic);

      $image = $request->image;
      $ext = $image->getClientOriginalExtension();
      $imageName = time(). '.'.$ext;
      $image->move(public_path('uploads/profile_pic'),$imageName);
      $users ->profile_pic = $imageName;
      $users->save();
  
      // create profile Pic thumb
      $ImageLocation = public_path().'/uploads/profile_pic/'.$imageName;
      $imagePath = Image::read($ImageLocation);
      $imageSave = public_path('/uploads/profile_pic/thumb/');
      $imagePath->cover(150,150);
      $imagePath->save($imageSave.$imageName);

      }

      $users->name = $request->name;
      $users->email = $request->email;
      $users->save();

     return redirect()->back()->with('success', 'Account successfully Updated');


     }

     
     public function UpdateMyAccount(Request $request) {
      $id = Auth::user()->id;

      $teachers = User::findOrFail($id);
      
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
    $teachers->date_of_birth = $request->date_of_birth;
    $teachers->address = $request->current_address;
    $teachers->permanent_address = $request->permanent_address;
    $teachers->qualification = $request->qualification;
    $teachers->work_experience = $request->work_experience;
    $teachers->marital_status = $request->marital_status;
    $teachers->save();

    return redirect()->back()->with('success', 'Account successfully Updated');

     }


     public function UpdateMyAccountStudent(Request $request) {

      $id = Auth::user()->id;

      $students = User::findOrFail($id);
      
      $validator = Validator::make($request->all(),[
         'first_name' => 'required',
         'last_name' => 'required',
         'email' => 'required|email|unique:users,email,'.$id.',id',
         'gender' => 'required',
         'religion' => 'required',
         'date_of_birth' => 'required',
         'caste' => 'required',
         'mobile_number' => 'required',
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
    
    $students->gender = $request->gender;
    $students->date_of_birth = $request->date_of_birth;
    $students->caste = $request->caste;
    $students->blood_group = $request->blood_group;
    $students->height = $request->height;
    $students->weight = $request->weight;
    $students->save();
    
    return redirect()->back()->with('success', 'Account successfully Updated');

     }


   

     public function UpdateMyAccountParent(Request $request) {
      $id = Auth::user()->id;
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
    File::delete('uploads/profile_pic/'.$parents->profile_pic);
    File::delete('uploads/profile_pic/thumb/'.$parents->profile_pic);
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
   $parents->gender = $request->gender;
   $parents->occupation = $request->occupation;
   $parents->address = $request->address;
   $parents->save();


   return redirect()->back()->with('success', 'Account successfully Updated');

   }
     }
   



