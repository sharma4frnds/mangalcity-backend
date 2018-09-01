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
use App\Model\Activity;
use Session;
use Helper;
use App\user;
use App\Model\City;
use App\Model\State;
use App\Model\District;
use App\Model\Media;
use File;

class PostController extends Controller
{

   public function feeds(Request $request)
   {

    //set location
    $home_location=Session::get('home_location');
      $city=''; $district=''; $state='';
      if($home_location){ $city=$home_location['home_city']; $district=$home_location['home_district']; $state=$home_location['home_state']; }else{ $city=Auth::user()->city; $district=Auth::user()->district; $state=Auth::user()->state;
      }

      //get city post
      $city_posts=Post::with(['user','media','like' => function ($query) {
      $query->where('user_id', Auth::user()->id);}])->where('status',1)->where('tag',1)->where('city',$city)->orderBy('id', 'DESC')->paginate(10);


  //   $city_posts=Post::with(['user','like' => function ($query) {
  //   $query->where('user_id', Auth::user()->id);},'comments'=>function($query) 
  //   {
  //     $query->leftJoin('users', 'users.id', '=', 'comments.user_id');
  //     $query->select('comments.*', 'users.first_name','users.last_name','users.image');
  //   }
  // ])->where('status',1)->where('tag',1)->where('city',$city)->orderBy('id', 'DESC')->paginate(10);


  
  if($request->ajax())
  {
    $view = view('feed',compact('city_posts'))->render();
    return response()->json(['html'=>$view]);
  }

  $city_name=City::where('id',Auth::user()->city)->first();

  $country_posts=Post::with('media')->where('status',1)->where('tag',4)->orderBy('likes','DESC')->limit(10)->get();
  $state_posts=Post::with('media')->where('status',1)->where('tag',3)->where('state',$state)->orderBy('likes','DESC')->limit(10)->get();
  $district_posts=Post::with('media')->where('status',1)->where('tag',2)->where('district',$district)->orderBy('likes','DESC')->limit(10)->get();

  return view('post',compact('city_posts','district_posts','state_posts','country_posts','city_name'));
   }

   public function profile(Request $request,$url)
   {
      //get city post
      $profile=User::where('url',$url)->where('status','active')->first();
      
      if(!$profile) abort(403, 'Unauthorized action.');

      $state_name=State::where('id',$profile->state)->first();
      $district_name=District::where('id',$profile->district)->first();
      $city_name=City::where('id',$profile->city)->first();


    $country_posts=Post::where('status',1)->where('tag',4)->limit(10)->get();
    $state_posts=Post::where('status',1)->where('tag',3)->limit(10)->get();
    $district_posts=Post::where('status',1)->where('tag',2)->limit(10)->get();

   	return view('profile',compact('district_posts','state_posts','country_posts','profile','city_name','state_name','district_name'));
   }


   //post data
   public function posts(Request $request)
   {
   
      	$validator = Validator::make($request->all(), ['message'=>'max:1500']);
       
       if($request->file('image')){
          $validator = Validator::make($request->all(), ['image.*' =>'image|mimes:jpeg,png,jpg,gif,svg,|max:5048']);
         }

          if($request->file('video')){
          $validator = Validator::make($request->all(), ['video' => 'mimes:flv,mp4,mpeg,mov,avi,wmv|max:25000']);
         }

        if(!empty($request->file('audio'))) {
          $validator = Validator::make($request->all(), ['audio' =>'mimes:mp3,mpga,wav,ogg,oga,mogg,3gp,aiff,m4a,m4b,m4p|max:25000']);
         }

  	 if ($validator->fails())
        {
            return Response::json(array(
        	'success' => false,
        	'errors' => $validator->getMessageBag()->toArray()

    		), 400); // 400 being the HTTP code for an invalid request.
        }

    if(empty($request->message) && empty($request->file('image')) && empty($request->file('video')) && empty($request->file('audio')))
    {
        return Response::json(array('success' => false,'errors' =>array('message' =>'Please enter some text,image, video or audio')), 400);
    }
    
    $message = isset($request->message) ? $request->message : '';
     $value='';
       try{
            $post=Post::create([
            'user_id' => Auth::user()->id,
            'message'=> $message ,
            'tag' => '1',
            'type' => '',
            'value' => '',
            'status'=>'1',
            'likes'=>'0',
            'dislikes'=>'0',
            'spam'=>0,
            'state'=>Auth::user()->state,
            'district'=>Auth::user()->district,
            'city'=>Auth::user()->city
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
            $value=$images;
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
       
        $user_image=URL::to('public/images/user/'.Auth::user()->image);

      
        if($type=='video') $value=URL::to('public/images/post/post_video/'.$post->value);
        if($type=='audio') $value=URL::to('public/images/post/post_audio/'.$post->value);

          Helper::ActivityAdd(Auth::user()->id,$post->id,'post'); 

          $pdata=array('id'=>$post->id,'user_id'=>$post->user_id,'message'=>$post->message,'type'=>$post->type,'value'=>$value,'likes'=>$post->likes,'created_at'=>date('d-M-Y', strtotime($post->created_at)) ,'name'=>Auth::user()->first_name.' '.Auth::user()->last_name,'image'=>$user_image);

        echo json_encode(array('success'=>true,'pdata'=>$pdata));


   }

   /*
    show country highlights post 
    post stase change ofter like dislike and share

   */

   public function highlights(Request $request,$slug)
   {

    //set location
    $home_location=Session::get('home_location');
      $city=''; $district=''; $state='';
      if($home_location){ $city=$home_location['home_city']; $district=$home_location['home_district']; $state=$home_location['home_state']; }else{ $city=Auth::user()->city; $district=Auth::user()->district; $state=Auth::user()->state;
      }

    if($slug=='country')
    {
      $city_posts=Post::with(['user','like' => function ($query) {
      $query->where('user_id', Auth::user()->id);}])->where('status',1)->where('tag',4)->orderBy('id', 'DESC')->paginate(10);
    }

    if($slug=='state')
    {
         $city_posts=Post::with(['user','like' => function ($query) {
      $query->where('user_id', Auth::user()->id);}])->where('status',1)->where('tag',3)->where('state',$state)->orderBy('id', 'DESC')->paginate(10);
    }

    if($slug=='district')
    {
      $city_posts=Post::with(['user','like' => function ($query) {
      $query->where('user_id', Auth::user()->id);}])->where('status',1)->where('tag',2)->where('district',$district)->orderBy('id', 'DESC')->paginate(10);
    }
  

    if($request->ajax())
    {
      $view = view('feed',compact('city_posts'))->render();
      return response()->json(['html'=>$view]);
    }

    $city_name=City::where('id',Auth::user()->city)->first();

  $country_posts=Post::with('media')->where('status',1)->where('tag',4)->orderBy('likes','DESC')->limit(10)->get();
  $state_posts=Post::with('media')->where('status',1)->where('tag',3)->where('state',$state)->orderBy('likes','DESC')->limit(10)->get();
  $district_posts=Post::with('media')->where('status',1)->where('tag',2)->where('district',$district)->orderBy('likes','DESC')->limit(10)->get();

    return view('highlights',compact('city_posts','district_posts','state_posts','country_posts','city_name'));

   }





   //dolikes
   public function dolikes(Request $request)
   {

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
          $like=Like::where('post_id',$request->post_id)->where('user_id',Auth::user()->id)->first();
           $post=Post::where('id',$request->post_id)->select('id','dislikes','likes')->first();

          if($like === null)
          {   $type=1;
              Like::create(['post_id' => $request->post_id,'user_id'=>Auth::user()->id,'type'=>0]);
              Post::where('id',$request->post_id)->increment('likes');
              Helper::ActivityAdd(Auth::user()->id,$post->id,'like');
          }else
          {
                if($like->type=='0')
                {
                   $type=0;
                   Like::where('post_id',$request->post_id)->where('user_id',Auth::user()->id)->where('type',0)->delete();
                  Post::where('id',$request->post_id)->decrement('likes');
                  Helper::ActivityDelete(Auth::user()->id,$post->id,'like');
                }

                if($like->type=='1')
                {
                  $type=1;
                  Like::where('post_id',$request->post_id)->where('user_id',Auth::user()->id)->update(['type'=>0]);
                  Post::where('id',$request->post_id)->decrement('dislikes');
                  Post::where('id',$request->post_id)->increment('likes');

                  Helper::ActivityAdd(Auth::user()->id,$post->id,'like');
                  Helper::ActivityDelete(Auth::user()->id,$post->id,'dislike');
                }
          }

          $post1=Post::where('id',$request->post_id)->select('id','dislikes','likes','share')->first();
         
        
          Helper::postStageChange($request->post_id,$post1->share,$post1->likes,$post1->dislikes); 

           return response()->json(['success'=>true,'lcount'=>$post1->likes,'dcount'=>$post1->dislikes,'type'=>$type], 200);

        }else{
        return response()->json(['success'=>success,'errors'=>'invalid parameter'], 400);
        }
          
      }

  //dodislikes
   public function dodislikes(Request $request)
   {
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
          $like=Like::where('post_id',$request->post_id)->where('user_id',Auth::user()->id)->first();
           $post=Post::where('id',$request->post_id)->select('id','dislikes','likes')->first();

          if($like === null)
          {   $type=1;
              Like::create(['post_id' => $request->post_id,'user_id'=>Auth::user()->id,'type'=>1]);
              Post::where('id',$request->post_id)->increment('dislikes');
               Helper::ActivityAdd(Auth::user()->id,$post->id,'dislike');
          }else
          {
                if($like->type=='1')
                {
                   $type=0;
                   Like::where('post_id',$request->post_id)->where('user_id',Auth::user()->id)->where('type',1)->delete();
                  
                  Post::where('id',$request->post_id)->decrement('dislikes');

                   Helper::ActivityDelete(Auth::user()->id,$post->id,'dislike');
                }

                if($like->type=='0')
                {
                  $type=1;
                  Like::where('post_id',$request->post_id)->where('user_id',Auth::user()->id)->update(['type'=>1]);
                  Post::where('id',$request->post_id)->decrement('likes');
                  Post::where('id',$request->post_id)->increment('dislikes');

                  Helper::ActivityAdd(Auth::user()->id,$post->id,'dislike');
                  Helper::ActivityDelete(Auth::user()->id,$post->id,'like');
                }
          }

          $post1=Post::where('id',$request->post_id)->select('id','dislikes','likes')->first();
          Helper::postStageChange($request->post_id,$post1->share,$post1->likes,$post1->dislikes);
           return response()->json(['success'=>true,'lcount'=>$post1->likes,'dcount'=>$post1->dislikes,'type'=>$type], 200);

        }else{
        return response()->json(['success'=>success,'errors'=>'invalid parameter'], 400);
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

    //post Comment
    function postComment(Request $request)
    {

      $validator = Validator::make($request->all(), ['post_id'=>'required','comment'=>'required|string|max:500']);

      if($validator->fails())
        {
            return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()

        ), 422); // 400 being the HTTP code for an invalid request.
        }

        if(Post::where('id',$request->post_id)->count() > 0)
        {
           $comment=Comment::create(['post_id' => $request->post_id,'parent_id' => $request->comment_id,'user_id'=>Auth::user()->id,'message'=>$request->comment,'like'=>0]);

            $image=URL::to('public/images/user/'.Auth::user()->image);
         
              Helper::ActivityAdd(Auth::user()->id,$request->post_id,'comment');
                

           return response()->json(['success'=>true,'comment_id'=>$comment->id,'comment'=>$request->comment,'post_id'=>$request->post_id,'user_image'=>$image,'name'=>Auth::user()->first_name.' '.Auth::user()->last_name,'date'=>'just now'], 200);
        }

    }

    //deleteComment
    function deleteComment(Request $request)
    {
        $validator = Validator::make($request->all(), ['post_id'=>'required','comment_id'=>'required']);

      if($validator->fails())
        {
            return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()

        ), 400); // 400 being the HTTP code for an invalid request.
        }

       if(Comment::where('id',$request->comment_id)->where('post_id',$request->post_id)->where('user_id',Auth::user()->id)->count() > 0)
        {
           Comment::where('id',$request->comment_id)->delete();
           Comment::where('parent_id',$request->comment_id)->delete();
           Helper::ActivityDelete(Auth::user()->id,$request->post_id,'comment');
           return response()->json(['success'=>true,'message'=>'Successfully Removed'], 200);
        }

    }

    //PostController
    function reportPopup(Request $request)
    {
      $id=$request->post_id;
      $spam_tags=Spam_tag::where('status','active')->get();
      return view('reportPopup',compact('id','spam_tags'));
    }

    function reportFeedback(Request $request)
    {
      $validator = Validator::make($request->all(), ['post_id'=>'required','spam_tags'=>'required']);

      if($validator->fails())
        {
          return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()
        ), 400);
        }

        if(Post::where('id',$request->post_id)->count() > 0)
        {
          Feedbacks::insert(['user_id'=>Auth::user()->id,'post_id'=>$request->post_id,'spam_tag'=>$request->spam_tags]);
        }

        return response()->json(['success'=>true,'message'=>'Successfully'], 200);
    }
   
    //delete_post_popup
    function delete_post_popup(Request $request)
    {
      $validator = Validator::make($request->all(), ['post_id'=>'required']);
      $id=$request->post_id;
        if($validator->fails())
        {
            return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()

        ), 400); // 400 being the HTTP code for an invalid request.
        }
      return view('delete_post_popup',compact('id'));
    }

    /*
      delete user post
      detete comment

    */
    function delete_post(Request $request)
    {
      $validator = Validator::make($request->all(), ['post_id'=>'required']);
         if($validator->fails())
        {
            return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()

        ), 400); // 400 being the HTTP code for an invalid request.
        }

        if(Post::where('id',$request->post_id)->where('user_id',Auth::user()->id)->count() > 0)
        {
          $post=Post::where('id',$request->post_id)->first();

          
           Comment::where('post_id',$request->post_id)->where('user_id',Auth::user()->id)->delete();
           Like::where('post_id',$request->post_id)->delete();
        
            if($post->type=='image')
            {
              $medias= Media::where('post_id',$post->id)->get();
              
              foreach ($medias as $media) 
              {
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

            if($post->type=='audio')
            {
                $file='public/images/post/post_audio/'.$post->value;
                if(file_exists($file))
                {
                   @unlink($file);
                }
            }

            Post::where('id',$request->post_id)->delete();
           return response()->json(['success'=>true,'message'=>'Successfully Removed'], 200);
        }else{
            return response()->json(['success'=>false,'message'=>'invalid post'], 405);
        }


    }

//share_post_popup
  function share_post_popup(Request $request)
  {
      $validator = Validator::make($request->all(), ['post_id'=>'required']);
      $id=$request->post_id;
        if($validator->fails())
        {
            return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()

        ), 400); // 400 being the HTTP code for an invalid request.
        }

        if(Post::where('id',$request->post_id)->count() > 0)
        {
           $post=post::with('media')->where('id',$request->post_id)->first();
           return view('share_post_popup',compact('post'));
        }else
        {
            return response()->json(['success'=>false,'message'=>'invalid post'], 405);
        }
     
  }   

    //share_post
    function share_post(Request $request)
    {
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
          Post::where('id',$request->post_id)->increment('share');
          $post=post::where('id',$request->post_id)->first();

        if(empty($request->share_message) && empty($post->type) )
        {
          return Response::json(array('success' => false,'errors' =>array('message' =>'Please enter some text,image, video or audio')), 400);
        }


       $type='';
       $value='';


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

      if($post->type=='image')
      {
        $type='image';
        $renameFile='';
      }

     $newpost= post::create(['user_id'=>Auth::user()->id,'message'=>$request->share_message,'type'=>$type,'value'=>$value,'likes'=>'0','dislikes'=>'0','tag'=>1,'spam'=>0, 'status' => 1, 'state'=>Auth::user()->state,'district'=>Auth::user()->district,'city'=>Auth::user()->city]);
 
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
          $images[]=URL::to('public/images/post/post_image/'.$renameFile);
         }
      }

        Helper::ActivityAdd(Auth::user()->id,$newpost->id,'share');
        Helper::postStageChange($request->post_id,$post->share,$post->likes,$post->dislikes);

    

        $type=$newpost->type;
        
        $user_image=URL::to('public/images/user/'.Auth::user()->image);

        if($type=='image') $value=$images;
        if($type=='video') $value=URL::to('public/images/post/post_video/'.$newpost->value);
        if($type=='audio') $value=URL::to('public/images/post/post_audio/'.$newpost->value);

        $pdata=array('id'=>$newpost->id,'user_id'=>$newpost->user_id,'message'=>$newpost->message,'type'=>$type,'value'=>$value,'likes'=>$newpost->likes,'created_at'=>date('d-M-Y', strtotime($newpost->created_at)) ,'name'=>Auth::user()->first_name.' '.Auth::user()->last_name,'image'=>$user_image);

        echo json_encode(array('success'=>true,'pdata'=>$pdata,'message'=>'Successfully share'),200);
         
        }else
        {
            return response()->json(['success'=>false,'message'=>'invalid post'], 405);
        }
     
    }


    public function post_view($id)
    {
      $id=decrypt($id);
          //set location
      $home_location=Session::get('home_location');
      $city=''; $district=''; $state='';
      if($home_location){ $city=$home_location['home_city']; $district=$home_location['home_district']; $state=$home_location['home_state']; }else{ $city=Auth::user()->city; $district=Auth::user()->district; $state=Auth::user()->state;}

   
       $city_posts=Post::with(['user','media','like' => function ($query) {
        $query->where('user_id', Auth::user()->id);}])->where('status',1)->where('id',$id)->get();


      $country_posts=Post::with('media')->where('status',1)->where('tag',4)->orderBy('likes','DESC')->limit(10)->get();
      $state_posts=Post::with('media')->where('status',1)->where('tag',3)->where('state',$state)->orderBy('likes','DESC')->limit(10)->get();
      $district_posts=Post::with('media')->where('status',1)->where('tag',2)->where('district',$district)->orderBy('likes','DESC')->limit(10)->get();


      return view('post_view',compact('city_posts','country_posts','state_posts','district_posts'));
    }

    public function likeuser(Request $request)
    {
       $validator = Validator::make($request->all(), ['post_id'=>'required','type'=>'required']);

      if($validator->fails())
        {
          return Response::json(array(
          'success' => false,
          'errors' => $validator->getMessageBag()->toArray()
        ), 400);
        }

        $users=Like::with(['user'])->where('post_id',$request->post_id)->where('type',$request->type)->get();
        if($request->type==0) $typet='Like';
        else $typet='Dislike';
        $html='<div><span> '.$typet.' </span><br/>';
        foreach ($users as $key => $value) {
              $html .= "<span>".$value->user->first_name.' '.$value->user->last_name."</span><br/>";
        }
      $html .='<div>';
      echo $html;
    }


    public function all_comment(Request $request)
    {
        $city_posts=Post::with(['user','like' => function ($query) {
        $query->where('user_id', Auth::user()->id);}])->where('status',1)->where('id',$request->post_id)->get();
       
          if($request->ajax())
          {
          $view = view('comment_all',compact('city_posts'))->render();
          return response()->json(['html'=>$view]);
          }

    }

  public function imageload(Request $request)
  {
    $post_id=e($request->post_id);
    if(!$post_id && $post_id == '') return response()->json(array(), 400);
    $medias=Media::where('post_id',$post_id)->get();
    $data=array();
    foreach ($medias as $media) {
      $image=URL::to('/public/images/post/post_image/full_'.$media->name);
      $post_id="$post_id";
      $url=URL::to('download_image/'.$media->name);
      $href='<a href='.$url.'><i class="fa fa-cloud-download" aria-hidden="true"></i>Download</a>';
      $data[]=array('src'=> $image,'opts'=>array('caption'=>$href));
    }
    return $data;
  }

}
