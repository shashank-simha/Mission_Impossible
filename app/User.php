<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'team', 'participant1', 'mobile_no1', 'participant2', 'mobile_no2', 'password', 'stage1', 'stage2', 'stage3', 'stage4', 'login_time', 'stage1_time', 'stage2_time', 'stage3_time', 'stage3_time', 'stage1_attempts', 'stage2_attempts', 'stage3_attempts', 'stage4_attempts'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = md5($value);
    }
}
