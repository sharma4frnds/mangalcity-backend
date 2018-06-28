<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment_like extends Model
{
      public $timestamps = true;
     protected $fillable = [
       'id','comment_id' ,'user_id','type'
    ];
}
