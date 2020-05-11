<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'conduct_lecturer','description','module_code','module_name','status','target_student_category'
    ];
}
