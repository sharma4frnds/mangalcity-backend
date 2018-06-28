<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name','email','mobile', 'password','provider','provider_id','is_admin','address','  gender','marital_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','is_admin','provider','provider_id'
    ];


    public function verifyUser()
    {
        return $this->hasOne('App\Model\VerifyUser');
    }
}
