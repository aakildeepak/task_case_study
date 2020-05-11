<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
   
  //  protected $table = 'attendances';
    protected $fillable = [
        'attendance','sheet_id','status','lec_hours','student_id','course_id','course_type'
    ];
}
