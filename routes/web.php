<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\ExaminationsController;
use App\Http\Controllers\ClassTimetableController;
use App\Http\Controllers\AssignClassTeacherController;


Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/authenticate',[AuthController::class, 'authenticate'])->name('authenticate');
// Forgot Password
Route::get('/forgotPassword', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
Route::post('/process-forgotPassword', [AuthController::class, 'processForgotPassword'])->name('processForgotPassword');
Route::get('/resetPassword/{token}', [AuthController::class, 'resetPassword'])->name('resetPassword');
Route::post('/resetPassword', [AuthController::class, 'processResetPassword'])->name('processResetPassword');
Route::get('/logout',[AuthController::class, 'logout'])->name('logout');




// Admin Middlware and route  
Route::group(['middleware' => 'admin'], function() {
Route::prefix("admin")->group(function(){
  Route::get('/dashboard',[DashboardController::class, 'dashboard'])->name('admin.dashboard');
  Route::get('/admin/list',[AdminController::class, 'index'])->name('admin.list');
  Route::get('/admin/create',[AdminController::class, 'create'])->name('admin.create');
  Route::post('/admin/store',[AdminController::class, 'store'])->name('admin.store');
  Route::get('/admin/edit/{id}',[AdminController::class, 'edit'])->name('admin.edit');
  Route::put('/admin/update/{id}',[AdminController::class, 'update'])->name('admin.update');
  Route::delete('/admin/destroy',[AdminController::class, 'destroy'])->name('admin.destroy');




  // change Password user
  Route::get('/change-password',[UserController::class, 'changePassword'])->name('admin.changePassword');
  Route::post('/change-password',[UserController::class, 'processChangePassword']);


    // Teacher route
    Route::get('/teacher/list',[TeacherController::class, 'index'])->name('teacher.list');
    Route::get('/teacher/create',[TeacherController::class, 'create'])->name('teacher.create');
    Route::post('/teacher/store',[TeacherController::class, 'store'])->name('teacher.store');
    Route::get('/teacher/edit/{id}',[TeacherController::class, 'edit'])->name('teacher.edit');
    Route::put('/teacher/update/{id}',[TeacherController::class, 'update'])->name('teacher.update');
    Route::delete('/teacher/destroy',[TeacherController::class, 'destroy'])->name('teacher.destroy');

    // Student route
    Route::get('/student/list',[StudentController::class, 'index'])->name('student.list');
    Route::get('/student/create',[StudentController::class, 'create'])->name('student.create');
    Route::post('/student/store',[StudentController::class, 'store'])->name('student.store');
    Route::get('/student/edit/{id}',[StudentController::class, 'edit'])->name('student.edit');
    Route::put('/student/update/{id}',[StudentController::class, 'update'])->name('student.update');
    Route::delete('/student/destroy',[StudentController::class, 'destroy'])->name('student.destroy');
  

    // Parent route
    Route::get('/parent/list',[ParentController::class, 'index'])->name('parent.list');
    Route::get('/parent/create',[ParentController::class, 'create'])->name('parent.create');
    Route::post('/parent/store',[ParentController::class, 'store'])->name('parent.store');
    Route::get('/parent/edit/{id}',[ParentController::class, 'edit'])->name('parent.edit');
    Route::put('/parent/update/{id}',[ParentController::class, 'update'])->name('parent.update');
    Route::delete('/parent/destroy',[ParentController::class, 'destroy'])->name('parent.destroy');

    Route::get('/parent/my-student/{id}',[ParentController::class, 'myStudent'])->name('parent.myStudent');

    Route::get('/parent/assign-student-parent/{student_id}/{parent_id}',[ParentController::class, 'AssignStudentParent'])->name('assign_student_parent');

    Route::delete('/parent/assign-student-parent/delete',[ParentController::class, 'AssignStudentParentDelete'])->name('assign_student_parent.delete');

  // Class route
  Route::get('/class/list',[ClassController::class, 'index'])->name('class.list');
  Route::get('/class/create',[ClassController::class, 'create'])->name('class.create');
  Route::post('/class/store',[ClassController::class, 'store'])->name('class.store');
  Route::get('/class/edit/{id}',[ClassController::class, 'edit'])->name('class.edit');
  Route::put('/class/update/{id}',[ClassController::class, 'update'])->name('class.update');
  Route::delete('/class/destroy',[ClassController::class, 'destroy'])->name('class.destroy');


  
  // Subject route
  Route::get('/subject/list',[SubjectController::class, 'index'])->name('subject.list');
  Route::get('/subject/create',[SubjectController::class, 'create'])->name('subject.create');
  Route::post('/subject/store',[SubjectController::class, 'store'])->name('subject.store');
  Route::get('/subject/edit/{id}',[SubjectController::class, 'edit'])->name('subject.edit');
  Route::put('/subject/update/{id}',[SubjectController::class, 'update'])->name('subject.update');
  Route::delete('/subject/destroy',[SubjectController::class, 'destroy'])->name('subject.destroy');

  
    // assign_subject route
    Route::get('/assign_subject/list',[ClassSubjectController::class, 'index'])->name('assign_subject.list');
    Route::get('/assign_subject/create',[ClassSubjectController::class, 'create'])->name('assign_subject.create');
    Route::post('/assign_subject/store',[ClassSubjectController::class, 'store'])->name('assign_subject.store');
    Route::get('/assign_subject/edit/{id}',[ClassSubjectController::class, 'edit'])->name('assign_subject.edit');
    Route::put('/assign_subject/update/{id}',[ClassSubjectController::class, 'update'])->name('assign_subject.update');
    Route::delete('/assign_subject/destroy',[ClassSubjectController::class, 'destroy'])->name('assign_subject.destroy');

    // edit single assign subject route
    Route::get('/assign_subject/edit_single/{id}',[ClassSubjectController::class, 'edit_single'])->name('assign_subject.edit_single');
    Route::put('/assign_subject/update_single/{id}',[ClassSubjectController::class, 'update_single'])->name('assign_subject.update_single');



  // assign class Teacher route
 Route::get('/assign-class-teacher/list',[AssignClassTeacherController::class, 'index'])->name('assign-class-teacher.list');
 Route::get('/assign-class-teacher/create',[AssignClassTeacherController::class, 'create'])->name('assign-class-teacher.create');
 Route::post('/assign-class-teacher/store',[AssignClassTeacherController::class, 'store'])->name('assign-class-teacher.store');
 Route::get('/assign-class-teacher/edit/{id}',[AssignClassTeacherController::class, 'edit'])->name('assign-class-teacher.edit');
 Route::put('/assign-class-teacher/update/{id}',[AssignClassTeacherController::class, 'update'])->name('assign-class-teacher.update');
 Route::delete('/assign-class-teacher/destroy',[AssignClassTeacherController::class, 'destroy'])->name('assign-class-teacher.destroy');

  // edit single assign class Teacher route
  Route::get('/assign-class-teacher/edit_single/{id}',[AssignClassTeacherController::class, 'edit_single'])->name('assign-class-teacher.edit_single');
  Route::put('/assign-class-teacher/update_single/{id}',[AssignClassTeacherController::class, 'update_single'])->name('assign-class-teacher.update_single');


    // Class Timetable
    Route::get('/class-timetable/list',[ClassTimetableController::class, 'index'])->name('class-timetable.list');
    Route::get('/class-timetable/get_subject',[ClassTimetableController::class, 'get_subject'])->name('class-timetable.get_subject');


    Route::post('/class-timetable/store',[ClassTimetableController::class, 'insert_update'])->name('class-timetable.store');

       // Class Timetable
       Route::get('/examinations/exam/list',[ExaminationsController::class, 'index'])->name('exam.list');
       Route::get('/examinations/exam/create',[ExaminationsController::class, 'create'])->name('exam.create');
       Route::post('/examinations/exam/store',[ExaminationsController::class, 'store'])->name('exam.store');
       Route::get('/examinations/exam/edit/{id}',[ExaminationsController::class, 'edit'])->name('exam.edit');
       Route::put('/examinations/exam/update/{id}',[ExaminationsController::class, 'update'])->name('exam.update');
       Route::delete('/examinations/exam/destory',[ExaminationsController::class, 'destory'])->name('exam.destory');





  // Account setting
  Route::get('/account-setting',[UserController::class, 'MyAccount'])->name('MyAccount.admin');
  Route::post('/account-setting',[UserController::class, 'UpdateMyAccountAdmin']);


  // my profile
  Route::get('/my-profile',[UserController::class, 'MyProfileAdmin'])->name('MyProfileAdmin');


});



});

// Teacher Middlware and route
Route::group(['middleware' => 'teacher'], function() {
  Route::prefix("teacher")->group(function(){
  Route::get('/dashboard',[DashboardController::class, 'dashboard'])->name('teacher.dashboard');
  // change Password user
  Route::get('/change-password',[UserController::class, 'changePassword'])->name('teacher.changePassword');
  Route::post('/change-password',[UserController::class, 'processChangePassword']);

  // Account setting
  Route::get('/account-setting',[UserController::class, 'MyAccount'])->name('MyAccount.teacher');
  Route::post('/account-setting',[UserController::class, 'UpdateMyAccount']);

  // my profile
  Route::get('/my-profile',[UserController::class, 'MyProfile'])->name('MyProfile');


   // my class subject
  Route::get('/my-class-subject',[AssignClassTeacherController::class, 'MyClassSubject'])->name('my_class_subject');

    // my Student
    Route::get('/my-student',[StudentController::class, 'MyStudent'])->name('my_student');


      // my time table
      Route::get('/my-class-timetable/class-timetable/{class_id}/{subject_id}',[ClassTimetableController::class, 'MyTimetableTeacher'])->name('MyTimetableTeacher');

  });

  
  


});

// Student Middlware and route
Route::group(['middleware' => 'student'], function() {
  Route::prefix("student")->group(function(){
  Route::get('/dashboard',[DashboardController::class, 'dashboard'])->name('student.dashboard');

  // change Password user
  Route::get('/change-password',[UserController::class, 'changePassword'])->name('student.changePassword');
  Route::post('/change-password',[UserController::class, 'processChangePassword']);

    // Account setting
    Route::get('/account-setting',[UserController::class, 'MyAccount'])->name('MyAccount');
    Route::post('/account-setting',[UserController::class, 'UpdateMyAccountStudent']);
  
  // my profile
  Route::get('/my-profile-student',[UserController::class, 'MyProfileStudent'])->name('MyProfile.Student');

  // my subject
  Route::get('/my-subject',[SubjectController::class, 'MySubject'])->name('MySubject');

    // my timetable
    Route::get('/my-timetable',[ClassTimetableController::class, 'MyTimetable'])->name('MyTimetable');
});



});

// Parent Middlware and route
Route::group(['middleware' => 'parent'], function() {
  Route::prefix("parent")->group(function(){
  Route::get('/dashboard',[DashboardController::class, 'dashboard'])->name('parent.dashboard');

  // change Password user
  Route::get('/change-password',[UserController::class, 'changePassword'])->name('parent.changePassword');
  Route::post('/change-password',[UserController::class, 'processChangePassword']);

  // Account setting
  Route::get('/account-setting',[UserController::class, 'MyAccount'])->name('MyAccount');
  Route::post('/account-setting',[UserController::class, 'UpdateMyAccountParent']);

    // my profile
    Route::get('/my-profile-parent',[UserController::class, 'MyProfileParent'])->name('MyProfile.Parent');


  // my student
  Route::get('/my-student',[ParentController::class, 'MyStudentParent'])->name('MyStudentParent');

  Route::get('/my-student/subject/{studentId}',[SubjectController::class, 'ParentStudentSubject'])->name('ParentStudentSubject');

  // my timetable
  Route::get('/my-student/subject/class-timetable/{class_id}/{subject_id}/{student_id}',[ClassTimetableController::class, 'MyStudentTimetableParent'])->name('MyTimetableParent');

});

});


