<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\User;
use JWTAuthException;
use Validator;
use Response;
use App\Model\Post;
use App\Model\Like;
use App\Model\Comment;
use Auth;
use URL;
use Image;
use Carbon\Carbon;

class PostController extends Controller
{
   public function posts(Request $request)
   {
   	 
   	   $validator = Validator::make($request->all(), ['message'=>'required|max:500','image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048','video' => 'mimes:flv,mp4,mpeg,mov,avi,wmv|max:2048']);

  	 if ($validator->fails())
        {
            return Response::json(array('success' => false,'errors' => $validator->getMessageBag()->toArray()), 400); 
            // 400 being the HTTP code for an invalid request.
        }


          try{
      		if(!$user = JWTAuth::toUser($request->token)) {
      			 return  json_encode(array('success'=>false,'errors'=>array('error'=>'User Not Found')),404);
     		}

        	$userId = $user->id;
            $post=Post::create([
            'user_id' => $user->id,
            'message'=> $request->message,
            'tag' => '1',
            'type' => '',
            'value' => '',
            'status'=>'1',
            'likes'=>'0',
            'dislikes'=>'0',
            'spam'=>0,
            'state'=>$user->state,
            'district'=>$user->district,
            'city'=>$user->city
            ]);
          }
          catch(\Exception $e){
             // do task when error
            echo $e->getMessage();   // insert query
              echo json_encode(array('success'=>false,'errors'=>array('error'=>'Oops! there was an unexpected error. please try again later'))); exit;
          }


        if($request->file('image'))
        {
            $imageName = time(). '.' .$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(base_path() . '/public/images/post/post_image/', $imageName);
            $post->type='image';	
            $post->value=$imageName;
            $post->save();
        }

        if($request->file('video'))
        {
            $videoName = time(). '.' .$request->file('video')->getClientOriginalExtension();
            $request->file('video')->move(base_path() . '/public/images/post/post_video/', $videoName);
            $post->type='video';	
            $post->value=$videoName;
            $post->save();
        }

        $type=$post->type;
        $value='';
        $user_image=URL::to('public/images/user/'.$user->image);

        if($type=='image') $value=URL::to('public/images/post/post_image/'.$post->value);
        if($type=='video') $value=URL::to('public/images/post/post_video/'.$post->value);
      
          $pdata=array('id'=>$post->id,'user_id'=>$post->user_id,'message'=>$post->message,'type'=>$post->type,'value'=>$value,'likes'=>$post->likes,'dislikes'=>$post->dislikes,'tag'=>1,'created_at'=>$post->created_at ,'name'=>$user->first_name.' '.$user->last_name,'image'=>$user_image);

        echo json_encode(array('success'=>true,'pdata'=>$pdata),200);


   }


  public function feeds(Request $request)
   {
     $user = JWTAuth::toUser($request->token);

    $city_posts=Post::with(['user','like' => function ($query,$user) {
    $query->where('user_id', $user->id);},'comment'=>function($query) 
    {
      $query->leftJoin('users', 'users.id', '=', 'comments.user_id');
      $query->select('comments.*', 'users.first_name','users.last_name','users.image');
    }
   ])->where('status',1)->where('tag',1)->where('city',$user->city)->orderBy('id', 'DESC')->get();

  $country_posts=Post::where('status',1)->where('tag',4)->limit(10)->get();
  $state_posts=Post::where('status',1)->where('tag',3)->limit(10)->get();
  $district_posts=Post::where('status',1)->where('tag',2)->limit(10)->get();


  echo json_encode(array('success'=>true,'city_posts'=>$city_posts,'district_posts'=>$district_posts,'state_posts'=>$state_posts,'country_posts'=>$country_posts),200);
  
   }



}
