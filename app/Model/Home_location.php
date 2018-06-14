<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Home_location extends Model
{
     public $timestamps = true;
     protected $fillable = ['id','user_id' ,'home_country','home_state','home_district','home_city'];
}
