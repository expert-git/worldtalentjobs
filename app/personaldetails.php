<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class personaldetails extends Model
{

	public function jobseeker(){
		return $this->belongsTo('App\Jobseeker');
	}
	// protected $fillable=['profile_img'];

	public function educations(){
		return $this->hasMany('App\Education', 'person_id');
	}

	public function experiences(){
		return $this->hasMany('App\Workexperience', 'person_id');
	}

	public function skillsets(){
		return $this->hasMany('App\SkillSet', 'person_id');
	}
	
	public function cvs(){
		return $this->hasMany('App\cv', 'person_id');
	}

	public function applied_jobs(){
		return $this->hasMany('App\Applied_job', 'jobseeker_id', 'jobseeker_id');
	}

}
