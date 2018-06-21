@extends('layouts.master')
@section('title','Mangalcity')

@section('content')
      <section class="think-pnl post-pnl">
        <div class="container">
          <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="profile">

                    <div class="pro">
                    	<a href="{{url('user/profile')}}">{{Html::image('public/images/user/'.Auth::user()->image)}}</a>
                    </div> 
                    <h4><a href="{{url('user/profile')}}">{{Auth::user()->first_name}} {{Auth::user()->last_name}} </a></h4>
                   
                    <p><a href="#">Activity Log</a></p>
                    <p><a href="{{url('user/profile')}}">Update Profile</a></p>
                    <p><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" > Logout </a>
                    </p>

                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>

                </div>
                <button type="button" class="btn hme btn-warning">switch to home location</button>

                

            </div>
            <div class="col-md-9 col-sm-4 col-xs-12">

                <form method="POST" enctype="multipart/form-data" id="feedForm" action="post">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                 <div class="col-md-12 col-sm-4 col-xs-12 box-shd top-pd-20">
                    <div class="col-md-6 pd0">
                     <div class="pro1">{{Html::image('public/images/user/'.Auth::user()->image,'img',array('class'=>'img-responsive'))}}  
                    </div>  
                     <span class="pro-name">Update Your Status</span><br>
                    </div>

                  
                      <textarea name="message" cols="30" rows="1" class="form-control" placeholder="Write what you wish"></textarea>
                      <div id="queued-files" style="display: none;">1 image selected</div>
                    <div class="share-area">
                        <div class="up-img"><input type="file" id="npimage" name="image" accept="image/*" onchange="displayImage(this);"></div>
                        <div class="up-vid"><input type="file" name="video" id="npvideo" accept="video/*" onchange="displayVideo(this);"></div>
                        <ul>
                         <li><i class="fa fa-file-image-o" aria-hidden="true"></i></li>   
                         <li><i class="fa fa-video-camera" aria-hidden="true"></i></li> 
                         <li style="float: right;">
                            
                            <input type="submit" value="Post" class="post-bt"  /> 
                            </li> 
                        </ul>
                    </div>

                </div>

                 <div class="alert alert-info fade in" id="error_div" style="display: none"></div>

            </form>

            <div class="col-md-12 col-sm-4 col-xs-12 box-shd">
            <div class="row org">
                <div class="col-md-9">
                    <h3>country</h3>
                </div>
                <div class="col-md-3">
                    <!-- Controls -->
                    <div class="controls pull-right hidden-xs">
                        <a class="left fa fa-chevron-left btn btn-success" href="#carousel-example" data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-success" href="#carousel-example" data-slide="next"></a>
                    </div>
                </div>
            </div>

            <div id="carousel-example" class="carousel slide hidden-xs" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active">
                        <div class="row">
                        @foreach($country_posts as $cposts)
                        <div class="col-sm-3 ped-crsl">
                            <div class="col-item">
                                <div class="photo">
                                   
                              @if($cposts->type=='image')
                                <div class="post-img">
                                     {{Html::image('public/images/post/post_image/'.$cposts->value,'img',array('class'=>'img-responsive'))}}  
                                </div>
                             @elseif($cposts->type=='video')
                              <div class="post-video">
                                   <video width="100%" height="150" controls><source src="public/images/post/post_video/{{$cposts->value}}" type="video/mp4"></video>   
                                </div>  
                             @else
                                <p class="post-txt">{{str_limit($cposts->message, 25)}}</p>
                             @endif

                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-12">
                                            <h5>{{$cposts->user->first_name}} {{$cposts->user->last_name}} <br>
                                              {!! Helper::dateFormate($cposts->created_at); !!}

                                               </h5>
                                        </div>
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        </div>
                    </div>
                 
                </div>
            </div>
            </div>

	<div class="col-md-12 col-sm-4 col-xs-12 box-shd">
        <div class="row org">
            <div class="col-md-9">
                <h3>state</h3>
            </div>
            <div class="col-md-3">
                <!-- Controls -->
                <div class="controls pull-right hidden-xs">
                    <a class="left fa fa-chevron-left btn btn-success" href="#carousel-example1" data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-success" href="#carousel-example1" data-slide="next"></a>
                </div>
            </div>
        </div>
        <div id="carousel-example1" class="carousel slide hidden-xs" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">

                     @foreach($state_posts as $sposts)
                        <div class="col-sm-3 ped-crsl">
                            <div class="col-item">
                                <div class="photo">
                                   
                              @if($sposts->type=='image')
                                <div class="post-img">
                                     {{Html::image('public/images/post/post_image/'.$sposts->value,'img',array('class'=>'img-responsive'))}}  
                                </div>
                             @elseif($sposts->type=='video')
                              <div class="post-video">
                                   <video width="100%" height="150" controls><source src="public/images/post/post_video/{{$sposts->value}}" type="video/mp4"></video>   
                                </div>  
                             @else
                                <p class="post-txt">{{str_limit($sposts->message, 25)}}</p>
                             @endif

                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-12">
                                            <h5>{{$sposts->user->first_name}} {{$sposts->user->last_name}} <br>{!! Helper::dateFormate($sposts->created_at); !!} </h5>
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                      
 
                    </div>
                </div>
               
            </div>
        </div>
    </div>


	<div class="col-md-12 col-sm-4 col-xs-12 box-shd">

        <div class="row org">
            <div class="col-md-9">
                <h3>district</h3>
            </div>
            <div class="col-md-3">
                <!-- Controls -->
                <div class="controls pull-right hidden-xs">
                    <a class="left fa fa-chevron-left btn btn-success" href="#carousel-example2" data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-success" href="#carousel-example2" data-slide="next"></a>
                </div>
            </div>
        </div>
        <div id="carousel-example2" class="carousel slide hidden-xs" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">
                        @foreach($district_posts as $dposts)
                        <div class="col-sm-3 ped-crsl">
                            <div class="col-item">
                                <div class="photo">
                                   
                              @if($dposts->type=='image')
                                <div class="post-img">
                                     {{Html::image('public/images/post/post_image/'.$dposts->value,'img',array('class'=>'img-responsive'))}}  
                                </div>
                             @elseif($dposts->type=='video')
                              <div class="post-video">
                                   <video width="100%" height="150" controls><source src="public/images/post/post_video/{{$dposts->value}}" type="video/mp4"></video>   
                                </div>  
                             @else
                                <p class="post-txt">{{str_limit($dposts->message, 100)}}</p>
                             @endif

                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-12">
                                            <h5>{{$dposts->user->first_name}} {{$dposts->user->last_name}} <br>{!! Helper::dateFormate($dposts->created_at); !!} </h5>
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
               
                      
                
                    </div>
                </div>
   
            </div>
        </div>
    </div>

        <!-- Button trigger modal -->



            
            <!--City  post -->
            <div id="currentMessage"></div>
            @foreach($city_posts as $city_post)
            <?php 
                // echo '<pre>';
                 //print_r($city_post);
                
            
            ?>

            <div class="col-md-12 col-sm-4 col-xs-12 box-shd top-pd-20" id="postdiv{{$city_post->id}}">
                <div class="col-md-6">
                 <div class="pro1">
                   {{Html::image('public/images/user/'.$city_post->user->image,'img',array('class'=>'img-responsive'))}}
                    </div>  
                 <span class="pro-name">{{$city_post->user->first_name}} {{$city_post->user->last_name}}</span></br>
                <span class="post-time">
                  {!! Helper::dateFormate($city_post->created_at); !!}


                </span> 
                </div>
                <div class="col-md-6">
                    <div class="dropdown">
                     <i data-toggle="dropdown" class="fa dropdown-toggle fa fa-ellipsis-v"></i>
                     <ul class="dropdown-menu side-fix">
                        @if($city_post->user_id==Auth::user()->id)
                        <li><a onclick="delete_post_popup({{$city_post->id}})">Delete</a></li>
                       @endif
                       <li>
                        <a data-toggle="modal" href="{{url('/reportFeedback/'.$city_post->id)}}" data-target="#myModal">
                            Give Feedback on This Post</a>
                        </li>
                     </ul>
                   </div>
                </div>

                  <p class="post-txt">{{$city_post->message}}</p>

                  @if($city_post->type=='image')
                    <div class="post-img">
                         {{Html::image('public/images/post/post_image/'.$city_post->value,'img',array('class'=>'img-responsive'))}}  
                    </div>
                 @endif

                   @if($city_post->type=='video')
                    <div class="post-video">
                       <video width="100%" height="315" controls><source src="public/images/post/post_video/{{$city_post->value}}" type="video/mp4"></video>   
                    </div>  
                 @endif
                <div class="share-area">

                    <ul>

                     <li><a onclick="doLike({{$city_post->id}},0)" id="dolike{{$city_post->id}}" > 
                      @if(isset($city_post->like))
                            @if($city_post->like->type==0)
                                 <i class="fa fa-thumbs-up"></i> {{$city_post->likes}} 
                                @else
                                 <i class="fa fa-thumbs-o-up"></i> {{$city_post->likes}}
                                @endif
                           
                            @else
                            <i class="fa fa-thumbs-o-up"></i> {{$city_post->likes}}
                            @endif
                         </a> 
                     </li>

                     <li>
                        <a onclick="dodislikes({{$city_post->id}},1)" id="dodislikes{{$city_post->id}}" > 
                           @if(isset($city_post->like))
                                @if($city_post->like->type==1)
                                <i class="fa fa-thumbs-down"></i> {{$city_post->dislikes}}
                                @else
                                <i class="fa fa-thumbs-o-down"></i> {{$city_post->dislikes}}
                                @endif
                            @else
                            <i class="fa fa-thumbs-o-down"></i> {{$city_post->dislikes}}
                            @endif
                          </a>
                     </li>
                      <li ><a onclick="focus_form({{$city_post->id}})"><i class="fa fa-comment" aria-hidden="true"></i> Comment</i> </a></li>   
                   
                      <li><a onclick="share_post_popup({{$city_post->id}})"> <i class="fa fa-share-alt" aria-hidden="true"></i> Share</i></a></li>
                 


                    </ul>
                </div>

                <div class="hr"></div>

                <div id="comment_section{{$city_post->id}}">
                @if(isset($city_post->comment[0]))
                @foreach($city_post->comment as $cmnt)
                
                <div class="col-md-12 col-sm-4 col-xs-12 top-pd-20 cmnt-pnl" id="commentDiv{{$cmnt->id}}">
                <div class="col-md-11 cmnt-pnl-ped">
                 
                <div class="pro1">
                   {{Html::image('public/images/user/'.$cmnt->image,'img',array('class'=>'img-responsive'))}}
                </div>   
                 <div class="cmnt-box">
                 <span class="pro-name"><b>{{$cmnt->first_name.' '.$cmnt->last_name}}:</b> {{$cmnt->message}}</span><br>
                <span class="post-time">
                   <i class="fa fa-clock-o" aria-hidden="true"></i> 
                    {!! Helper::dateFormate($city_post->created_at); !!}
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
              
            </div>
            @endforeach
            @endif
         </div>
        
           
            <div class="col-md-12 col-sm-4 col-xs-12 top-pd-20 cmnt-pnl">
                <div class="col-md-12 cmnt-pnl-ped">
                 <div class="pro1">{{Html::image('public/images/user/'.$city_post->user->image,'img',array('class'=>'img-responsive'))}}</div>  
                 <div class="cmnt-box">
                    <textarea rows="2" cols="100" name="comment" id="comment-form{{$city_post->id}}" placeholder="Leave a comment..."></textarea>
                    <button class="post-bt" onclick="postComment({{$city_post->id}})">Post</button>
                </div>
                </div>
            </div>

            </div>
            @endforeach

            <!-- post -->
        
          </div>
        </div>
        
      </section>

<!-- Remote popup -->
<div id="myModal" class="modal fade">
<div class="modal-dialog">
    <div class="modal-content">
        <!-- Content will be loaded here from "remote.php" file -->
    </div>
</div>
</div>

<script type="text/javascript">
    $('body').on('hidden.bs.modal', '.modal', function () {
      $(this).removeData('bs.modal');
    });
</script>
<!-- End Remote popup -->
@endsection
@section('footer_script')
{{ Html::script('public/js/jquery.form.js') }}

@endsection