<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class message extends Model
{
    use Notifiable;

    protected $fillable = [
        'sender', 'id', 'con_id','message',
    ];
    
    public function conversation(){
        return $this->belongsTo('App\conversation', 'con_id');
    }
}
