<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applied_job extends Model
{
     protected $fillable=['job_id','jobseeker_id','employer_id','expected_salary'];

     public function job(){
        return $this->belongsTo('App\job');
     }

     public function personaldetails(){
         return $this->belongsTo('App\personaldetails', 'jobseeker_id', 'jobseeker_id');
      }
}
