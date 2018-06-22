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
   	 
   	   $validator = Validator::make($request->all(), ['message'=>'max:500','image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048','video' => 'mimes:flv,mp4,mpeg,mov,avi,wmv|max:2048']);

  	 if ($validator->fails())
        {
            return Response::json(array('success' => false,'errors' => $validator->getMessageBag()->toArray()), 400); 
            // 400 being the HTTP code for an invalid request.
        }

        if(empty($request->message) && empty($request->file('image')) && empty($request->file('video')))
        {
            return Response::json(array('success' => false,'errors' =>array('message' =>'Please enter some text,image or video')), 400);
        }

          try{
      		if(!$user = JWTAuth::toUser($request->token)) {
      			 return  json_encode(array('success'=>false,'errors'=>array('error'=>'User Not Found')),404);
     		}
          $message = isset($request->message) ? $request->message : '';
        	$userId = $user->id;
            $post=Post::create([
            'user_id' => $user->id,
            'message'=> $message,
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
            //echo $e->getMessage();   // insert query
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

    $city_posts=Post::with(['user','like' => function ($query)use ($user) {
    $query->where('user_id', $user->id);}
   ])->where('status',1)->where('tag',1)->where('city',$user->city)->orderBy('id', 'DESC')->get();

    $country_posts=Post::with('user')->where('status',1)->where('tag',4)->limit(10)->get();
    $state_posts=Post::with('user')->where('status',1)->where('tag',3)->limit(10)->get();
    $district_posts=Post::with('user')->where('status',1)->where('tag',2)->limit(10)->get();


  echo json_encode(array('success'=>true,'city_posts'=>$city_posts,'district_posts'=>$district_posts,'state_posts'=>$state_posts,'country_posts'=>$country_posts),200);
  
   }

  public function dolikes(Request $request)
   {
     $user = JWTAuth::toUser($request->token);

    $validator = Validator::make($request->all(), ['post_id'=>'required']);
     if($validator->fails())
      {
          return response()->json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray()], 400);
      }


        if(Post::where('id',$request->post_id)->count() > 0)
        {
          $type='';
          $like=Like::where('post_id',$request->post_id)->where('user_id',$user->id)->first();
           $post=Post::where('id',$request->post_id)->select('id','dislikes','likes')->first();

          if($like === null)
          {   $type=1;
              Like::create(['post_id' => $request->post_id,'user_id'=>$user->id,'type'=>0]);
              Post::where('id',$request->post_id)->increment('likes');
          }else
          {
                if($like->type=='0')
                {
                   $type=0;
                   Like::where('post_id',$request->post_id)->where('user_id',$user->id)->where('type',0)->delete();
                  Post::where('id',$request->post_id)->decrement('likes');
                }

                if($like->type=='1')
                {
                  $type=1;
                  Like::where('post_id',$request->post_id)->where('user_id',$user->id)->update(['type'=>0]);
                  Post::where('id',$request->post_id)->decrement('dislikes');
                  Post::where('id',$request->post_id)->increment('likes');
                }
          }

          $post1=Post::where('id',$request->post_id)->select('id','dislikes','likes')->first();
         
          $this->postStageChange($request->post_id,$post1->likes);

           return response()->json(['success'=>true,'lcount'=>$post1->likes,'dcount'=>$post1->dislikes,'type'=>$type], 200);

        }else{
        return response()->json(['success'=>false,'errors'=>'invalid parameter'], 400);
        }
   }

  //dislike
   public function dodislikes(Request $request)
   {
    $user = JWTAuth::toUser($request->token);

      $validator = Validator::make($request->all(), ['post_id'=>'required']);
     if ($validator->fails())
        {
            return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()

        ), 400); // 400 being the HTTP code for an invalid request.
        }


        if(Post::where('id',$request->post_id)->count() > 0)
        {
          $type='';
          $like=Like::where('post_id',$request->post_id)->where('user_id',$user->id)->first();
           $post=Post::where('id',$request->post_id)->select('id','dislikes','likes')->first();

          if($like === null)
          {   $type=1;
              Like::create(['post_id' => $request->post_id,'user_id'=>$user->id,'type'=>1]);
              Post::where('id',$request->post_id)->increment('dislikes');
          }else
          {
                if($like->type=='1')
                {
                   $type=0;
                   Like::where('post_id',$request->post_id)->where('user_id',$user->id)->where('type',1)->delete();
                  Post::where('id',$request->post_id)->decrement('dislikes');
                }

                if($like->type=='0')
                {
                  $type=1;
                  Like::where('post_id',$request->post_id)->where('user_id',$user->id)->update(['type'=>1]);
                  Post::where('id',$request->post_id)->decrement('likes');
                  Post::where('id',$request->post_id)->increment('dislikes');
                }
          }

          $post1=Post::where('id',$request->post_id)->select('id','dislikes','likes')->first();
         
           return response()->json(['success'=>true,'lcount'=>$post1->likes,'dcount'=>$post1->dislikes,'type'=>$type], 200);

        }else{
        return response()->json(['success'=>false,'errors'=>'invalid parameter'], 400);
        }
          
      }

    //Post Stage change 
    function postStageChange($post_id,$clike)
    {
       $country_like=10;
       $state_like=5;
       $district_like=2;


       if($clike>=$country_like){
         Post::where('id',$post_id)->update(['tag','4']);
        }
        elseif($clike>=$state_like){
           Post::where('id',$post_id)->update(['tag','3']);
        }
        elseif($clike>=$district_like){
         Post::where('id',$post_id)->update(['tag' =>2]);
        }
        else{
           return;
        }
        return;
    }



    //share_post
    function share_post(Request $request)
    {
      $user = JWTAuth::toUser($request->token);
      $validator = Validator::make($request->all(), ['post_id'=>'required']);
      if($validator->fails())
      {
          return Response::json(array(
        'success' => false,
        'errors' => $validator->getMessageBag()->toArray()

      ), 400); // 400 being the HTTP code for an invalid request.
      }
        
      if(Post::where('id',$request->post_id)->count() > 0)
      {
      
      $post=post::where('id',$request->post_id)->first();
       $type='';
       $value='';
      if($post->type=='image')
      {
        $file=base_path('public/images/post/post_image/'.$post->value);
        $ext =explode('.', $post->value);
        $extension=end($ext);
        $renameFile=round(microtime(true) * 1000).'.'.$extension;
        $newFile=base_path('public/images/post/post_image/'.$renameFile);
        copy($file,$newFile);
        $type='image';
        $value=$renameFile;
      }

      if($post->type=='video')
      {

        $file=base_path('public/images/post/post_video/'.$post->value);
        $ext =explode('.', $post->value);
        $extension=end($ext);
        $renameFile=round(microtime(true) * 1000).'.'.$extension;
        $newFile=base_path('public/images/post/post_video/'.$renameFile);
        copy($file,$newFile);
        $type='video';
        $value=$renameFile;
      }

      post::insert(['user_id'=>$user->id,'message'=>$post->message,'type'=>$type,'value'=>$value,'likes'=>'0','dislikes'=>'0','tag'=>1,'spam'=>0, 'status' => 1,'state'=>$user->state,'district'=>$user->district,'city'=>$user->city]);

            return response()->json(['success'=>true,'message'=>'Successfully share'], 200);
         
        }else
        {
            return response()->json(['success'=>false,'message'=>'invalid post'], 405);
        }
     
    }

  //delete post
    function delete_post(Request $request)
    {
      $user = JWTAuth::toUser($request->token);

      $validator = Validator::make($request->all(), ['post_id'=>'required']);
        if($validator->fails())
        {
            return response()->json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray()], 200);
        }

        if(Post::where('id',$request->post_id)->where('user_id',$user->id)->count() > 0)
        {
          $post=Post::where('id',$request->post_id)->first();

           Post::where('id',$request->post_id)->delete();
           Comment::where('post_id',$request->post_id)->where('user_id',$user->id)->delete();
           Like::where('post_id',$request->post_id)->delete();

            if($post->type=='image')
            {
              $file='public/images/post/post_image/'.$post->value;
              if(file_exists($file))
              {
                 @unlink($file);
              }
            }

            if($post->type=='video')
            {
                $file='public/images/post/post_video/'.$post->value;
                if(file_exists($file))
                {
                   @unlink($file);
                }
            }

           return response()->json(['success'=>true,'message'=>'Successfully Removed'], 200);
        }else{
            return response()->json(['success'=>false,'message'=>'invalid post'], 405);
        }


    }





}
