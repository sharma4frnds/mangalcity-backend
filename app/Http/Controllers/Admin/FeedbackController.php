<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Spam_tag;
use App\Model\Feedbacks;
use App\Model\Post;
use App\Model\City ;
use App\Model\State;
use App\Model\District;


class FeedbackController extends Controller
{

    function index()
    {
    	$feedbacks=Feedbacks::with('user','tag')->orderBy('updated_at', 'desc')->get();

    	return view('admin/feedback',compact('feedbacks'));
    }

    public function show($id)
    {
    	 $post=Post::where('id',$id)->first();

         $state=State::where('id',$post->state)->first();
         $district=District::where('id',$post->district)->first();
         $city=City::where('id',$post->city)->first();

    	 $feedback=Feedbacks::with('user','tag')->where('post_id',$post->id)->get();

         return view('admin.feedback_create',compact('post','feedback','state','district','city'));
    }

    public function edit($id)
    {
    	$feedback=Feedbacks::find($id);
    	if($feedback->status=='inactive')
    	{
    	   	$feedback->status='active';
    		$feedback->save();
    		Post::where('id',$feedback->post_id)->update(['status'=>1]);
    	}else
    	{
	    	$feedback->status='inactive';
	    	$feedback->save();
	    	Post::where('id',$feedback->post_id)->update(['status'=>0]);
    	}
    
    	 return redirect('/admin/feedback');
    }


}
