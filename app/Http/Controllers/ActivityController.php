<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Response;
use App\Model\Post;
use App\Model\Like;
use App\Model\Comment;
use Auth;
use URL;
use Image;
use Carbon\Carbon;
use App\Model\Spam_tag;
use App\Model\Feedbacks;
use Session;
use App\Model\Activity;
use App\Model\Media;
class ActivityController extends FrontController
{

    public function allactivity(Request $request)
    {
    	 $home_location=Session::get('home_location');
      	$city=''; $district=''; $state='';

      	if($home_location){ $city=$home_location['home_city']; $district=$home_location['home_district']; $state=$home_location['home_state']; }
      	else{ 
      		$city=Auth::user()->city; $district=Auth::user()->district; $state=Auth::user()->state; }


          $activity=Activity::with('post')->where('user_id',Auth::user()->id)->orderBy('id', 'DESC')->paginate(5);

            if($request->ajax())
            {
              $view = view('activity_feed',compact('activity'))->render();
              return response()->json(['html'=>$view]);
            }

          $country_posts=Post::with('media')->where('status',1)->where('tag',4)->orderBy('id','DESC')->limit(10)->get();
          $state_posts=Post::with('media')->where('status',1)->where('tag',3)->orderBy('id','DESC')->limit(10)->get();
          $district_posts=Post::with('media')->where('status',1)->where('tag',2)->orderBy('id','DESC')->limit(10)->get();


	   	return view('allactivity',compact('district_posts','state_posts','country_posts','activity'));

 	}
    


}
