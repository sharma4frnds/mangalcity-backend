<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public $timestamps = true;
     protected $fillable = [
       'id','post_id' ,'user_id','type'
    ];

    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }
    
}
