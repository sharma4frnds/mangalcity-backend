<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Spam_tags extends Model
{
     public $timestamps = true;
     protected $fillable = ['id','name'];
}
