<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public $timestamps = true;
     protected $fillable = [
       'id','name' ,'country_id',
    ];
}
