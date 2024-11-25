<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
   public function index(Request $request) {
     $users = User::latest();
     if(!empty($request->keyword)) {
          $users = $users->where('name','like', '%'.$request->keyword.'%');
          $users = $users->orWhere('email','like', '%'.$request->keyword.'%');

     }
     $users = $users->paginate(10);
    return view('admin.admin.list',[
     'users' => $users,
     'header_title' => 'Admin List'
    ]);
   }

   public function create() {
     $data['header_title'] = 'Admin Create';
     return view('admin.admin.create',$data);
   }

   public function store(Request $request) {
     $validator = Validator::make($request->all(),[
          'name' => 'required',
          'email' => 'required|email|unique:users,email',
          'password' => 'required',
          'confirm_password' => 'required|same:password'
     ]);

     if($validator->fails()) {
        return response()->json([
             'status' => false,
             'errors' => $validator->errors()
        ]);
    }
        $users = new User();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->user_type = $request->user_type;
        $users->password = Hash::make($request->password);
        $users->save();

        session()->flash('success', 'New Admin Successfully Inserted');
        return response()->json([
               'status' => true
        ]);
    
   }


  public function edit(string $id) {
     $users = User::findOrFail($id);
     return view('admin.admin.edit',[
          'users' => $users,
          'header_title' => 'Admin Edit'
     ]);
  }


  public function update(Request $request, string $id) {
     $users = User::findOrFail($id);
     $validator = Validator::make($request->all(),[
          'name' => 'required',
          'email' => 'required|email|unique:users,email,'.$id.',id',
     ]);

     if($validator->fails()) {
          return response()->json([
               'status' => false,
               'errors' => $validator->errors()
          ]);

     }
          $users->name = $request->name;
          $users->email = $request->email;
          $users->user_type = $request->user_type;

          if(!empty($users->password )) {
          $users->password = Hash::make($request->password);

          }
          $users->save();

        session()->flash('success', 'Admin Updated Successfully');
        return response()->json([
               'status' => true
        ]);

  }


  public function destroy(Request $request) {
     
     $userId = $request->id;

     $users = User::where('id',$userId);
     $users->delete();

     session()->flash('success', 'Admin Successfully Deleted');
     return response()->json([
            'status' => true
     ]);

  }
}
