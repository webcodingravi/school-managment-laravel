<?php

namespace App\Models;

use App\Models\Week;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Week extends Model
{
    use HasFactory;

    static public function getWeekUsingName($weekname) {
        return Week::where('name', '=', $weekname)->first();
    }
}
