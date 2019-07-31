<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class conversation extends Model
{
    //
    protected $fillable=['employer','jobseeker','employer_name','jobseeker_name'];

    public function messages(){
        return $this->hasMany('App\message', 'con_id');
    }

    public function employer_(){
        return $this->belongsTo('App\Employer', 'employer');
    }

    public function jobseeker_(){
        return $this->belongsTo('App\Jobseeker', 'jobseeker');
    }
}
