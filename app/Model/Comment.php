<?php

namespace App\Model;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	public $timestamps = true;
    protected $fillable = [
       'id','post_id' ,'user_id','message','likes','parent_id'
    ];

 protected $with=['replies'];

	//return $this->comments()->with('user')->get()->threaded();

     public function post(){
        return $this->belongsTo('App\Model\Post');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

   public function comment_like(){
        return $this->hasMany('App\Model\Comment_like');
    }


    public function replies() 
    {
		return $this->hasMany('App\Model\Comment', 'parent_id')->with(['user']);
    }


}
