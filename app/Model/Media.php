<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
     public $timestamps = true;
     protected $fillable = ['id','post_id' ,'name',];
}
