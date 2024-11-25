<?php

namespace App\Models;

use App\Models\Week;
use App\Models\ClassSubjectTimetable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssignClassTeacher extends Model
{
    use HasFactory;

    static public function getMyTimeTable($class_id, $subject_id) {
        $getWeek = Week::getWeekUsingName(date('l'));
       return ClassSubjectTimetable::where(['class_id' =>$class_id, 'subject_id' => $subject_id, 'week_id'=>$getWeek->id])->first();
    }
}
