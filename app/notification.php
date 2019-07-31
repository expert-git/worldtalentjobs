<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    public function job(){
        return $this->belongsTo('App\job');
    }
   
    public function jobseeker(){
        return $this->belongsTo('App\Jobseeker');
    }
}
