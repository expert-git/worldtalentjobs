<?php

namespace App;

// use App\Traits\Enums;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    // use Enums;
    // public static $enumDegrees = [
    //     'high' => "High school or equivalent",
    //     'diploma' => "Diploma",
    //     'bachelor' => "Bachelor's degree",
    //     'higherdiploma' => "Higher diploma",
    //     'master' => "Master's degree",
    //     'doctorate' => "Doctorate"
    // ];

    //
    // protected $fillable=['id','degree','details'];
    // protected $fillable=['person_id', 'edu_no', 'degree', 'certificates', 'major_stream', 'start_date', 'end_date'];

    public function certificates(){
        return $this->hasMany('App\Certificate');
    }
}
