<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudyGroup extends Model
{
    protected $fillable = [
        'conducted_lecturer','description','group_code','std_category','group_name','status'
    ];
}
