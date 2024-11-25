<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ForgotPasswordEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
      public function login() {
        if(!empty(Auth::check())) {
            if(Auth::user()->user_type == 1) {
                return redirect()->route('admin.dashboard');

            }else if(Auth::user()->user_type == 2) {
                return redirect()->route('teacher.dashboard');

            }else if(Auth::user()->user_type == 3) {
                return redirect()->route('student.dashboard');

            }else if(Auth::user()->user_type == 4) {
                return redirect()->route('parent.dashboard');

            }
        }
        return view('login');
      }

      public function authenticate(Request $request) {
        $validator = Validator::make($request->all(),[
             'email' => 'required|email|exists:users,email',
             'password' => 'required',
        ]);


        if($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        
        $remember = !empty($request->remember) ? true : false;
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password],$remember)) {

            if(Auth::user()->user_type == 1) {
                return redirect()->route('admin.dashboard');

            }else if(Auth::user()->user_type == 2) {
                return redirect()->route('teacher.dashboard');

            }else if(Auth::user()->user_type == 3) {
                return redirect()->route('student.dashboard');

            }else if(Auth::user()->user_type == 4) {
                return redirect()->route('parent.dashboard');

            }
            
            
        }else{

            return redirect()->back()->with('error','Either Email / Password Not Correct');
        }


      }

      public function logout() {
        Auth::logout();

        return redirect()->route('login')->with('success','Logout Successfully');
      }
    

      public function forgotPassword() {
        return view('forgotPassword.forgotPassword');
      }

      public function processForgotPassword(Request $request) {
          $validator = Validator::make($request->all(),[
             'email' => 'required|email|exists:users,email'
          ]);

           if($validator->fails()) {
             return redirect()->back()->withInput()->withErrors($validator);
           }

         
           $token = Str::random(60);

           DB::table('password_reset_tokens')->where('email',$request->email)->delete();

           DB::table('password_reset_tokens')->insert([
               'email' => $request->email,
               'token' => $token,
               'created_at' => now()
           ]);

        //    Send mail
          $user = User::where('email',$request->email)->first();
        $mailData = [
              'user' => $user,
              'token' => $token,
              'subject' => 'You have requested to change your password.'
              
        ];
        Mail::to($user->email)->send(new ForgotPasswordEmail($mailData));

           return redirect()->back()->with('success', 'Please Check Your Email Inbox');
      }



      public function resetPassword(string $tokenString) {
         $token = DB::table('password_reset_tokens')->where('token', $tokenString)->first();

         if($token == null) {
            return redirect()->back()->with('error','Invalid Token');
         }
        return view('forgotPassword.resetPassword',[
            'tokenString' => $tokenString
        ]);
      }

      public function processResetPassword(Request $request) {
        $token = DB::table('password_reset_tokens')->where('token', $request->tokenString)->first();

        if($token == null) {
           return redirect()->back()->with('error','Invalid Token');
        }


        $validator = Validator::make($request->all(),[
           'new_password' => 'required',
           'confirm_password' => 'required|same:new_password'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        User::where('email',$token->email)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('login')->with('success','You have successfully changed your password');
      }
}


 