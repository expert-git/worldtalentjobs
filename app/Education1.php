<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education1 extends Model
{
    protected $fillable=['id','degree','details'];
    protected $table = "education1";
}
