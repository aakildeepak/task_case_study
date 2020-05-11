<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendanceSheet extends Model
{
    protected $fillable = [
        'lecturer_id','course_type','course_id','hours','date','status'
    ];
}
