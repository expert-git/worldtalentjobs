<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Utils\Utils;
use DateTime;

class job extends Model
{
    //
    public function create_ago() {
        $createat = DateTime::createFromFormat('Y-m-d H:i:s', $this->created_at);
        return Utils::ago($createat);
    }

    public function expire_after() {
        $expire = DateTime::createFromFormat('Y-m-d', $this->deadline);
        return Utils::after($expire);
    }

    public function employer(){
        return $this->belongsTo('App\Employer');
    }

    public function cdateformat(){
        return date_format(DateTime::createFromFormat('Y-m-d H:i:s', $this->created_at), "F j");
    }

    public function applied_jobs(){
        return $this->hasMany('App\Applied_job');
    }

    public function notification(){
        return $this->hasMany('App\notification');
    }
}
