<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
      public $timestamps = true;
     protected $fillable = [
       'id','name' ,'state_id',
    ];
}
