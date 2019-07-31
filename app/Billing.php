<?php

namespace App;
use Illuminate\Database\Eloquent\Model;


class Billing extends Model
{
    protected $fillable=array('usertype','typeservice','tpid','cost','email','paymenttype','status','traid','job_id','startdate','enddate');

}