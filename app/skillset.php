<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SkillSet extends Model
{

	public function personaldetail(){
		return $this->belongsTo('App\personaldetails');
	}

	protected $table = 'skillsets';
	public $timestamps = false;
}
