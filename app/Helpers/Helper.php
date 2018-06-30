<?php namespace App\Helpers;
use App\Model\Activity;
use App\Model\Post;

class Helper
{
	//date convert
    public static function dateFormate($time_ago)
    {
		$time_ago = strtotime($time_ago);
		     $cur_time   = time();
		     $time_elapsed   = $cur_time - $time_ago;
		     $seconds    = $time_elapsed ;
		     $minutes    = round($time_elapsed / 60 );
		     $hours      = round($time_elapsed / 3600);
		     $days       = round($time_elapsed / 86400 );
		     $weeks      = round($time_elapsed / 604800);
		     $months     = round($time_elapsed / 2600640 );
		     $years      = round($time_elapsed / 31207680 );
		     // Seconds
		     if($seconds <= 60){
		         return "just now";
		     }
		   //Minutes
		   else if($minutes <=60){
		       if($minutes==1){
		           return "one minute ago";
		       }
		       else{
		           return "$minutes minutes ago";
		       }
		   }
		//Hours
		else if($hours <=24){
		if($hours==1){
		   return "an hour ago";
		}else{
		   return "$hours hrs ago";
		}
		}
		//Days
		else if($days <= 7){
		if($days==1){
		   return "yesterday";
		}else{
		   return "$days days ago";
		}
		}
		//Weeks
		else if($weeks <= 4.3){
		if($weeks==1){
		   return "a week ago";
		}else{
		   return "$weeks weeks ago";
		}
		}
		//Months
		else if($months <=12){
		if($months==1){
		   return "a month ago";
		}else{
		   return "$months months ago";
		}
		}
		//Years
		else{
		if($years==1){
		   return "one year ago";
		}else{
		   return "$years years ago";
		}
		}
  	}
  	//End date convert

	//insert activity
	public static function ActivityAdd($user_id,$post_id,$type)
	{
		Activity::insert(['user_id'=>$user_id,'post_id'=>$post_id,'type'=>$type]);
		return;
	}

	//delete activity
	public static function ActivityDelete($user_id,$post_id,$type)
	{
		Activity::where(['user_id'=>$user_id,'type'=>$type])->delete();
		return;
	}

	public static function postStageChange($post_id,$share,$like,$dislike)
	{
	   $country_like=20;
       $state_like=15;
       $district_like=10;

       $clike=($share*2+($like-$dislike));
       
       if($clike>=$country_like){
         Post::where('id',$post_id)->update(['tag'=>'4']);
        }
        elseif($clike>=$state_like){
           Post::where('id',$post_id)->update(['tag'=>'3']);
        }
        elseif($clike>=$district_like){
         Post::where('id',$post_id)->update(['tag'=>'2']);
        }
        else{
           return;
        }
        return;
	}

}