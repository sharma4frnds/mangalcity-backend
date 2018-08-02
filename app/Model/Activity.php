<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Activity extends Model
{
      public $timestamps = true;
     protected $fillable = [ 'id','user_id' ,'post_id','type'];

    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }

     public function post()
     {
        return $this->belongsTo('App\Model\Post')->with(['user','like','comment','media']);

    }




  //   $query->where('user_id', Auth::user()->id);},'comments'=>function($query) 
  //   {
  //     $query->leftJoin('users', 'users.id', '=', 'comments.user_id');
  //     $query->select('comments.*', 'users.first_name','users.last_name','users.image');
  //   }
 }
