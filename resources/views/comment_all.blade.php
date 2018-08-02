@foreach($city_posts as $city_post)
@if(isset($city_post->comment[0]))
<?php $cmnt_cout=0; $tcomment= count($city_post->comment); ?>

@foreach($city_post->comment as $cmnt)

@if($cmnt->parent_id==0)
<div class="col-md-12 col-sm-4 col-xs-12 top-pd-20 cmnt-pnl" id="commentDiv{{$cmnt->id}}">
<div class="col-md-11 cmnt-pnl-ped">
<div class="pro1">
    @if($city_post->user->id==Auth::user()->id)
    {{Html::image('public/images/user/'.$cmnt->user->image,'img',array('class'=>'img-responsive'))}}
    @else
    <a href="{{url('profile/'.$cmnt->user->url)}}">{{Html::image('public/images/user/'.$cmnt->user->image,'img',array('class'=>'img-responsive'))}}</a>
    @endif
</div> 
 <div class="cmnt-box">
 <span class="pro-name"><b>{{$cmnt->user->first_name.' '.$cmnt->user->last_name}}:</b> {{$cmnt->message}}</span>
<span class="post-time">
   <i class="fa fa-clock-o" aria-hidden="true"></i> 
    {!! Helper::dateFormate($cmnt->created_at); !!} <span class="rpl{{$cmnt->id}}"><a onclick="showReplydiv({{$cmnt->id}})">Reply</a></span>
</span> 
</div>
</div>
@if($cmnt->user_id==Auth::user()->id)
<div class="dropdown">
 <i data-toggle="dropdown" class="fa dropdown-toggle fa-angle-down"></i>
 <ul class="dropdown-menu side-fix">
   <li><a onclick="deleteComment({{$city_post->id}},{{$cmnt->id}})">Delete</a></li>
 </ul>
</div>
@endif
<?php $replies=count($cmnt->replies); ?>
@if($replies>0)
<div class="rply">
<div id="comment_section_reply{{$cmnt->id}}">    
@foreach($cmnt->replies as $replie)
<div class="col-md-12 col-sm-4 col-xs-12 top-pd-20 cmnt-pnl" id="commentDiv{{$replie->id}}">
<div class="col-md-11 cmnt-pnl-ped" >
<div class="pro1">
    @if($replie->user->id==Auth::user()->id)
    {{Html::image('public/images/user/'.$replie->user->image,'img',array('class'=>'img-responsive'))}}
    @else
    <a href="{{url('profile/'.$replie->user->url)}}">{{Html::image('public/images/user/'.$replie->user->image,'img',array('class'=>'img-responsive'))}}</a>
    @endif
</div> 
 <div class="cmnt-box">
 <span class="pro-name"><b>{{$replie->user->first_name.' '.$replie->user->last_name}}:</b>  : {{$replie->message}}</span>
 <span class="post-time">
   <i class="fa fa-clock-o" aria-hidden="true"></i> 
    {!! Helper::dateFormate($replie->created_at); !!}
</span> 
</div>
</div>
 @if($replie->user->id==Auth::user()->id)
    <div class="dropdown">
     <i data-toggle="dropdown" class="fa dropdown-toggle fa-angle-down"></i>
     <ul class="dropdown-menu side-fix">
       <li><a onclick="deleteComment({{$city_post->id}},{{$replie->id}})">Delete</a></li>
     </ul>
    </div>
@endif
</div>
@endforeach
</div>
    <div class="col-md-12 cmnt-pnl-ped ped-2" id="rply{{$cmnt->id}}" style="display:none">
        <div class="pro1">{{Html::image('public/images/user/'.Auth::user()->image,'img',array('class'=>'img-responsive'))}} </div>  
     <div class="cmnt-box">
        <textarea rows="1" cols="90" name="comment" form="usrform" id="comment-form_reply{{$cmnt->id}}" placeholder="write a reply..."> </textarea>
        <input type="hidden" name="cmnt_post_id"  value="{{$city_post->id}}">
        <input type="hidden" name="cmnt_comment_id" value="{{$cmnt->id}}">
    </div>
    </div>
 </div>
@else
<!-- if no reply -->
 <div class="rply" id="rply{{$cmnt->id}}" style="display:none">
    <div id="comment_section_reply{{$cmnt->id}}"> </div>
    <div class="col-md-12 cmnt-pnl-ped ped-2">
        <div class="pro1">{{Html::image('public/images/user/'.Auth::user()->image,'img',array('class'=>'img-responsive'))}} </div>  
     <div class="cmnt-box">
        <textarea rows="1" cols="90" name="comment" form="usrform" id="comment-form_reply{{$cmnt->id}}" placeholder="write a reply..."> </textarea>    
         <input type="hidden" name="cmnt_post_id"  value="{{$city_post->id}}">
        <input type="hidden" name="cmnt_comment_id" value="{{$cmnt->id}}">
    </div>
    </div>
 </div>
@endif
</div>
@endif
@endforeach
@endif
@endforeach