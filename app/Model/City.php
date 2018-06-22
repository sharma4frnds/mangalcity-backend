<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
         public $timestamps = true;
     protected $fillable = [
       'id','name' ,'district_id',
    ];


    public function district()
    {
        return $this->hasOne('App\Model\District','id','district_id');
    }
}
