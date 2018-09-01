            @foreach($city_posts as $city_post)
            <?php 
                // echo '<pre>';
                 //print_r($city_post);
                
            
            ?>

            <div class="col-md-12 col-sm-4 col-xs-12 box-shd top-pd-20" id="postdiv{{$city_post->id}}">
                <div class="col-md-6 ped-0">
                 <div class="pro1">
                    <a href="{{url('profile/'.$city_post->user->url)}}">
                        {{Html::image('public/images/user/'.$city_post->user->image,'img',array('class'=>'img-responsive'))}}</a>
                    </div>  
                 <span class="pro-name"> <a href="{{url('profile/'.$city_post->user->url)}}">{{$city_post->user->first_name}} {{$city_post->user->last_name}}</a></span>
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
                            Report spam</a>
                        </li>
                     </ul>
                   </div>
                </div>

                  <p class="post-txt">{{$city_post->message}}</p>

                  @if($city_post->type=='image')
                    <div class="post-img">
                        <a  data-toggle="modal" href="{{url('image_popup/'.$city_post->id)}}" data-target="#myModal">
                         {{Html::image('public/images/post/post_image/'.$city_post->value,'img',array('class'=>'img-responsive'))}}  
                     </a>
                    </div>
                 @endif

                   @if($city_post->type=='video')
                    <div class="post-video">
                       <video width="100%" height="315" controls><source src="public/images/post/post_video/{{$city_post->value}}" type="video/mp4"></video>   
                    </div>  
                 @endif
                @if($city_post->type=='audio')
                    <div class="post-audio">
                       <audio controls > <source src="public/images/post/post_audio/{{$city_post->value}}"></audio>
                    </div>  
                 @endif
                <div class="share-area">

                    <ul>


                     <li><a  onclick="doLike({{$city_post->id}},0)" id="dolike{{$city_post->id}}" > 
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

                     <li> <div class='content_like'>
                            <span title='Please wait..' id='clike_{{$city_post->id}}'>Like </span>
                        </div>
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
                     
                     <li>
                        <div class='content_dislike'>
                            <span title='Please wait..' id='cdislike_{{$city_post->id}}'>Dislike </span>
                        </div>
                     </li>
                    
                      <li><a onclick="focus_form({{$city_post->id}})"> <i class="fa fa-comment" aria-hidden="true"></i> Comment</i> </a></li>   
                   
                      <li><a onclick="share_post_popup({{$city_post->id}})">  <i class="fa fa-share-alt" aria-hidden="true"></i> Share</i></a></li>
                      
                     @if($city_post->type=='image')
                       <li><a href="{{url('download_image/'.$city_post->value)}}"><i class="fa fa-cloud-download" aria-hidden="true"></i>Download</a></li>
                       @endif

                    </ul>
                </div>

                <div class="hr"></div>

                <div id="comment_section{{$city_post->id}}">
                @if(isset($city_post->comment[0]))
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
              <!-- reply -->
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
                        <textarea rows="2" cols="90" name="comment" form="usrform" id="comment-form_reply{{$cmnt->id}}" placeholder="write a reply..."> </textarea>
                        <button class="post-bt" onclick="postComment({{$city_post->id}},{{$cmnt->id}})">Reply</button>
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
                        <textarea rows="2" cols="90" name="comment" form="usrform" id="comment-form_reply{{$cmnt->id}}" placeholder="write a reply..."> </textarea>    
                         <input type="hidden" name="cmnt_post_id"  value="{{$city_post->id}}">
                        <input type="hidden" name="cmnt_comment_id" value="{{$cmnt->id}}">
                    </div>
                    </div>
                 </div>
                <!-- end no reply -->

                @endif
                <!-- End Reply -->
            </div>
            @endif
            @endforeach
            @endif
         </div>
        
           
            <div class="col-md-12 col-sm-4 col-xs-12 top-pd-20 cmnt-pnl">
                <div class="col-md-12 cmnt-pnl-ped">
                 <div class="pro1">{{Html::image('public/images/user/'.Auth::user()->image,'img',array('class'=>'img-responsive'))}} </div>  
                <div class="cmnt-box">
                    <textarea rows="2" cols="100" name="comment" id="comment-form{{$city_post->id}}" placeholder="Leave a comment..."></textarea>
                    <input type="hidden" name="cmnt_post_id"  value="{{$city_post->id}}">
                    <input type="hidden" name="cmnt_comment_id" value="0">
                 
                </div>
                </div>
            </div>

            </div>



            @endforeach