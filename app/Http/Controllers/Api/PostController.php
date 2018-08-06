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
use Helper;
use App\Model\Feedbacks;
use App\Model\Activity;
use App\Model\Media;

class PostController extends Controller
{
   public function posts(Request $request)
   {
   	 
   	   $validator = Validator::make($request->all(), ['message'=>'max:1500','image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5048','video' => 'mimes:flv,mp4,mpeg,mov,avi,wmv,3gp|max:25000','audio' =>'mimes:mp3,mpga,wav,ogg,oga,mogg,3gp,aiff,m4a,m4b,m4p|max:25000']);

  	 if ($validator->fails())
        {
            return Response::json(array('success' => false,'errors' => $validator->getMessageBag()->toArray())); 
            // 400 being the HTTP code for an invalid request.
        }

        if(empty($request->message) && empty($request->file('image')) && empty($request->file('video')) && empty($request->file('audio')))
        {
            return Response::json(array('success' => false,'errors' =>array('message' =>'Please enter some text,image, audio or video')));
        }
          $value='';
          $media='';
          try{
      		if(!$user = JWTAuth::toUser($request->token)) {
      			 return  json_encode(array('success'=>false,'errors'=>array('error'=>'User Not Found')));
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


        if($files=$request->file('image'))
        {

           $i=0;  $images=array();
          foreach($files as $file){
           $imageName = time().$i. '.' .$file->getClientOriginalExtension();


         //cropping

          Image::make($file->getRealPath())->resize(null, 400, function ($constraint) {
          $constraint->aspectRatio();
          })->save('public/images/post/post_image/'.$imageName);


          //origin file
           $imageName_origin='full_'.$imageName;
           $file->move(base_path() . '/public/images/post/post_image/', $imageName_origin);

          //store
          Media::create(['post_id'=> $post->id,'name'=>$imageName]);
          $images[]=URL::to('public/images/post/post_image/'.$imageName);
          $i++;
          }

          $media=Media::where('post_id',$post->id)->get();
          $post->type='image';  
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

        if($request->file('audio'))
        {
            $audioName = time(). '.' .$request->file('audio')->getClientOriginalExtension();
            $request->file('audio')->move(base_path() . '/public/images/post/post_audio/', $audioName);
            $post->type='audio';  
            $post->value=$audioName;
            $post->save();
        }

        $type=$post->type;
     
        $user_image=URL::to('public/images/user/'.$user->image);

        if($type=='video') $value=URL::to('public/images/post/post_video/'.$post->value);
        if($type=='audio') $value=URL::to('public/images/post/post_audio/'.$post->value);
      
          $pdata=array('id'=>$post->id,'user_id'=>$post->user_id,'message'=>$post->message,'type'=>$post->type,'value'=>$value,'media'=>$media,'likes'=>$post->likes,'dislikes'=>$post->dislikes,'tag'=>1,'created_at'=>$post->created_at ,'name'=>$user->first_name.' '.$user->last_name,'image'=>$user_image);
 
        Helper::ActivityAdd($user->id,$post->id,'post'); 
        echo json_encode(array('success'=>true,'pdata'=>$pdata),200);


   }


  public function feeds(Request $request)
   {
     $user=JWTAuth::toUser($request->token);
     $city=$user->city; $district=$user->district; $state=$user->state;
    if($request->home_location==1){
       $location=Home_location::where('user_id',$user->id)->first();
       if($location){$city=$location->home_city; $district=$location->home_district; $state=$location->home_state; }
      }

    $city_posts=Post::with(['user','media','like' => function ($query)use ($user) {
    $query->where('user_id', $user->id);},'comment'=>function($query) 
   {
       $query->leftJoin('users', 'users.id', '=', 'comments.user_id');
       $query->select('comments.*', 'users.first_name','users.last_name','users.image');
    }

   ])->where('status',1)->where('tag',1)->where('city',$city)->orderBy('id', 'DESC')->paginate(10);;
    //->paginate(10);


  echo json_encode(array('success'=>true,'city_posts'=>$city_posts),200);
  
   }

  public function district_feeds(Request $request)
   {
     $user=JWTAuth::toUser($request->token);

     $city=$user->city; $district=$user->district; $state=$user->state;
    if($request->home_location==1){
       $location=Home_location::where('user_id',$user->id)->first();
       if($location){$city=$location->home_city; $district=$location->home_district; $state=$location->home_state; }
      }

    $district_posts=Post::with(['user','like' => function ($query)use ($user) {
    $query->where('user_id', $user->id);}])->where('status',1)->where('tag',2)->paginate(10);

    echo json_encode(array('success'=>true,'district_posts'=>$district_posts),200);
   }

  public function state_feeds(Request $request)
   {
     $user=JWTAuth::toUser($request->token);
     
     $city=$user->city; $district=$user->district; $state=$user->state;
    if($request->home_location==1){
       $location=Home_location::where('user_id',$user->id)->first();
       if($location){$city=$location->home_city; $district=$location->home_district; $state=$location->home_state; }
      }

     $state_posts=Post::with(['user','like' => function ($query)use ($user) {
    $query->where('user_id', $user->id);}])->where('status',1)->where('tag',3)->paginate(10);

    echo json_encode(array('success'=>true,'state_posts'=>$state_posts),200);
   }

  public function country_feeds(Request $request)
   {
     $user=JWTAuth::toUser($request->token);
     
     $city=$user->city; $district=$user->district; $state=$user->state;
    if($request->home_location==1){
       $location=Home_location::where('user_id',$user->id)->first();
       if($location){$city=$location->home_city; $district=$location->home_district; $state=$location->home_state; }
      }

    $country_posts=Post::with(['user','like' => function ($query)use ($user) {
    $query->where('user_id', $user->id);}])->where('status',1)->where('tag',4)->paginate(10);

    echo json_encode(array('success'=>true,'country_posts'=>$country_posts),200);
   }


   public function profile(Request $request)
   {
       $user = JWTAuth::toUser($request->token);
      $validator = Validator::make($request->all(), ['url'=>'required']);

       if($validator->fails())
        {
          return Response::json(array('success' => false, 'errors' => $validator->getMessageBag()->toArray())); 
        }
         $profile=User::where('url',$request->url)->where('status','active')->first();
        if($profile)
        {
          $city_posts=Post::with(['user','like' => function ($query) use($profile) {
         $query->where('user_id', $profile->id);}])->where('status',1)->where('user_id',$profile->id)->orderBy('id', 'DESC')->paginate(10);
          echo json_encode(array('success'=>true,'city_posts'=>$city_posts),200);
        }

      echo json_encode(array('success'=>false,'city_posts'=>''),200);

   }




  public function dolikes(Request $request)
   {
     $user = JWTAuth::toUser($request->token);

    $validator = Validator::make($request->all(), ['post_id'=>'required']);
     if($validator->fails())
      {
          return response()->json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray()]);
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
              Helper::ActivityAdd($user->id,$post->id,'like');
          }else
          {
                if($like->type=='0')
                {
                   $type=0;
                   Like::where('post_id',$request->post_id)->where('user_id',$user->id)->where('type',0)->delete();
                  Post::where('id',$request->post_id)->decrement('likes');
                  Helper::ActivityDelete($user->id,$post->id,'like');
                }

                if($like->type=='1')
                {
                  $type=1;
                  Like::where('post_id',$request->post_id)->where('user_id',$user->id)->update(['type'=>0]);
                  Post::where('id',$request->post_id)->decrement('dislikes');
                  Post::where('id',$request->post_id)->increment('likes');

                   Helper::ActivityAdd($user->id,$post->id,'like');
                  Helper::ActivityDelete($user->id,$post->id,'dislike');
                }
          }

          $post1=Post::where('id',$request->post_id)->select('id','share','dislikes','likes')->first();
         
            Helper::postStageChange($request->post_id,$post1->share,$post1->likes,$post1->dislikes); 

           return response()->json(['success'=>true,'lcount'=>$post1->likes,'dcount'=>$post1->dislikes,'type'=>$type], 200);

        }else{
        return response()->json(['success'=>false,'errors'=>'invalid parameter']);
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

        )); // 400 being the HTTP code for an invalid request.
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
               Helper::ActivityAdd($user->id,$post->id,'dislike');
          }else
          {
                if($like->type=='1')
                {
                   $type=0;
                   Like::where('post_id',$request->post_id)->where('user_id',$user->id)->where('type',1)->delete();
                  Post::where('id',$request->post_id)->decrement('dislikes');

                   Helper::ActivityDelete($user->id,$post->id,'dislike');
                }

                if($like->type=='0')
                {
                  $type=1;
                  Like::where('post_id',$request->post_id)->where('user_id',$user->id)->update(['type'=>1]);
                  Post::where('id',$request->post_id)->decrement('likes');
                  Post::where('id',$request->post_id)->increment('dislikes');

                   Helper::ActivityAdd($user->id,$post->id,'dislike');
                  Helper::ActivityDelete($user->id,$post->id,'like');
                }
          }

          $post1=Post::where('id',$request->post_id)->select('id','share','dislikes','likes')->first();

         Helper::postStageChange($request->post_id,$post1->share,$post1->likes,$post1->dislikes);

           return response()->json(['success'=>true,'lcount'=>$post1->likes,'dcount'=>$post1->dislikes,'type'=>$type], 200);

        }else{
        return response()->json(['success'=>false,'errors'=>'invalid parameter']);
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

      )); // 400 being the HTTP code for an invalid request.
      }
        
      if(Post::where('id',$request->post_id)->count() > 0)
      {
      Post::where('id',$request->post_id)->increment('share');
      $post=post::where('id',$request->post_id)->first();

      if(empty($request->share_message) && empty($post->type) )
      {
        return Response::json(array('success' => false,'errors' =>array('message' =>'Please enter some text,image, video or audio')));
      }


       $type='';
       $value='';
       $media='';
       $share_message='';

       $share_message=$request->share_message?$request->share_message :'';

      if($post->type=='image')
      {
        $medias=Media::where('post_id',$request->post_id)->get();
        foreach ($medias as $media) {
        $file=base_path('public/images/post/post_image/'.$media->name);
        $ext =explode('.', $media->name);
        $extension=end($ext);
        $renameFile=round(microtime(true) * 1000).'.'.$extension;
        $newFile=base_path('public/images/post/post_image/'.$renameFile);
        copy($file,$newFile);

        $full_file=base_path('public/images/post/post_image/full_'.$media->name);
        $newFileFull=base_path('public/images/post/post_image/full_'.$renameFile);  
        copy($full_file,$newFileFull);

        $type='image';
        $value=$renameFile;

          Media::create(['post_id'=> $newpost->id,'name'=>$renameFile]); 
         }
          $media=Media::where('post_id',$post->id)->get();
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

      if($post->type=='audio')
      {
        $file=base_path('public/images/post/post_audio/'.$post->value);
        $ext =explode('.', $post->value);
        $extension=end($ext);
        $renameFile=round(microtime(true) * 1000).'.'.$extension;
        $newFile=base_path('public/images/post/post_audio/'.$renameFile);
        copy($file,$newFile);
        $type='audio';
        $value=$renameFile;
      }
      
      $newpost=post::create(['user_id'=>$user->id,'message'=>$request->share_message,'type'=>$type,'value'=>$value,'media'=>$media,'likes'=>'0','dislikes'=>'0','tag'=>1,'spam'=>0, 'status' => 1,'state'=>$user->state,'district'=>$user->district,'city'=>$user->city]);

       Helper::ActivityAdd($user->id,$newpost->id,'share');

       Helper::postStageChange($request->post_id,$post->share,$post->likes,$post->dislikes);

            return response()->json(['success'=>true,'message'=>'Successfully share'], 200);
         
        }else
        {
            return response()->json(['success'=>false,'message'=>'invalid post']);
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
              $medias= Media::where('post_id',$post->id)->get();
              foreach ($medias as $media) {
                $file='public/images/post/post_image/'.$media->name;
                if(file_exists($file))
                {
                   @unlink($file);
                }

                $file1='public/images/post/post_image/full_'.$media->name;
                if(file_exists($file1))
                {
                   @unlink($file1);
                }

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
            return response()->json(['success'=>false,'message'=>'invalid post']);
        }


    }

    //spam report
    function reportFeedback(Request $request)
    {
      $validator = Validator::make($request->all(), ['post_id'=>'required','spam_tags'=>'required']);
      $user = JWTAuth::toUser($request->token);

      if($validator->fails())
        {
          return response()->json(array('success' =>false,'errors' => $validator->getMessageBag()->toArray()));
        }

        if(Post::where('id',$request->post_id)->count() > 0)
        {
          Feedbacks::insert(['user_id'=>$user->id,'post_id'=>$request->post_id,'spam_tag'=>$request->spam_tags]);
        }

        return response()->json(['success'=>true,'message'=>'Successfully'], 200);
    }


    //post Comment
    function postComment(Request $request)
    {
      $user = JWTAuth::toUser($request->token);
      $validator = Validator::make($request->all(), ['post_id'=>'required','comment'=>'required|string|max:500']);

      if($validator->fails())
      {
            return Response::json(array('success' => false, 'errors' => $validator->getMessageBag()->toArray())); 
            // 400 being the HTTP code for an invalid request.
      }

        if(Post::where('id',$request->post_id)->count() > 0)
        {
           $comment=Comment::create(['post_id' => $request->post_id,'parent_id' => $request->comment_id,'user_id'=>$user->id,'message'=>$request->comment,'like'=>0]);

            $image=URL::to('public/images/user/'.$user->image);
         
            Helper::ActivityAdd($user->id,$request->post_id,'comment');
                
           return response()->json(['success'=>true,'comment_id'=>$comment->id,'comment'=>$request->comment,'post_id'=>$request->post_id,'user_image'=>$image,'name'=>$user->first_name.' '.$user->last_name,'date'=>'just now'], 200);
        }

    }

    //deleteComment
    function deleteComment(Request $request)
    {
      $user = JWTAuth::toUser($request->token);
        $validator = Validator::make($request->all(), ['post_id'=>'required','comment_id'=>'required']);

      if($validator->fails())
        {
            return Response::json(array('success' => false,'errors' => $validator->getMessageBag()->toArray() )); // 400 being the HTTP code for an invalid request.
        }

       if(Comment::where('id',$request->comment_id)->where('post_id',$request->post_id)->where('user_id',$user->id)->count() > 0)
        {
           Comment::where('id',$request->comment_id)->delete();
           Comment::where('parent_id',$request->comment_id)->delete();
           Helper::ActivityDelete($user->id,$request->post_id,'comment');
           return response()->json(['success'=>true,'message'=>'Successfully Removed'], 200);
        }

    }

    public function allactivity(Request $request)
    {
       $user = JWTAuth::toUser($request->token);
      $activity=Activity::with('post')->where('user_id',$user->id)->orderBy('id', 'DESC')->paginate(10);
      echo json_encode(array('success'=>true,'activity'=>$activity),200);
  }



}
