<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
    protected $fillable = [
        'conducted_date','conducted_lecturer','description','seminar_name','status','std_category'
    ];
}
