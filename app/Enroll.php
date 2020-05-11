<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{
    protected $fillable = [
        'course_id','course_type','enroll','student_id','status'
    ];
}
