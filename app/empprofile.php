<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class empprofile extends Model
{
  protected $fillable=array('employer_id','companyname','altcompanyname','contactperson','designation','industrytype','companyaddress');
  public function jobs(){
    return $this->hasMany('App\job');
  }
  public function employer(){
    return $this->belongsTo('App\Employer');
  }
}
