<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

Class Privilege extends Model
{

    /**
     * @var string
     *
     */
    protected  $table ="privileges";

    public  function Inspector()
    {
        return $this->hasMany('App\Inspector');
    }
}