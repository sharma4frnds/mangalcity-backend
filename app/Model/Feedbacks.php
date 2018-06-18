<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Feedbacks;

class Feedbacks extends Model
{
    public $timestamps = true;
    protected $fillable = ['user_id','post_id','spam_tag','total_spam','status'];

    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }

    public function tag()
    {
        return $this->hasOne('App\Model\Spam_tag','id','spam_tag');
    }

}
