<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Model\Like;
use App\Model\Comment;

class Post extends Model
{
     public $timestamps = true;
     protected $fillable = [
       'id','user_id' ,'message','tag','type','value','value','status','likes','dislikes','spam','state','district','city'
   ];


    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }

    public function like()
    {
        return $this->hasOne('App\Model\Like','post_id','id');
    }

    public function comment()
    {
        return $this->hasMany('App\Model\Comment','post_id','id');
    }


}
