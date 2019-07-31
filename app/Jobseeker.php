<?php

namespace App;

use App\Notifications\JobseekerResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Jobseeker extends Authenticatable
{
    use Notifiable;
    use \HighIdeas\UsersOnline\Traits\UsersOnlineTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','verifyToken'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new JobseekerResetPassword($token));
    }

    public function user()
    {
        return $this->morphOne('App\User', 'userable');
    }

    public function personaldetails(){
        return $this->hasOne('App\personaldetails');
    }
}
