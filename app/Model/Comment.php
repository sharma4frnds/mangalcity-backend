<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	public $timestamps = true;
    protected $fillable = [
       'id','post_id' ,'user_id','message','likes','parent_id'
    ];
}
