            @foreach($activity as $act)
              <div class="col-md-12 col-sm-4 col-xs-12 box-shd activity">
              <div class="col-md-4">
              @if($act->type=='post')
                <span class="activity-name">{{Auth::user()->first_name}} {{Auth::user()->last_name}} 
                  <span class="name-seprter">updated his status.</span>
               </span>
              @elseif($act->type=='like')
                <span class="activity-name">{{Auth::user()->first_name}} {{Auth::user()->last_name}} 
                  <span class="name-seprter">likes on</span>
                  @if($act->user_id==$act->post->user_id) his own 
                  @else
                  {{$act->post->user->first_name}} {{$act->post->user->last_name}}
                  @endif
                </span>

                @elseif($act->type=='dislike')
                <span class="activity-name">{{Auth::user()->first_name}} {{Auth::user()->last_name}} 
                  <span class="name-seprter">dislike on</span>
                  @if($act->user_id==$act->post->user_id) his own 
                  @else
                  {{$act->post->user->first_name}} {{$act->post->user->last_name}}
                  @endif
                </span>

                @elseif($act->type=='share')
                <span class="activity-name">{{Auth::user()->first_name}} {{Auth::user()->last_name}} 
                  <span class="name-seprter">share on</span>
                  @if($act->user_id==$act->post->user_id) his own 
                  @else
                  {{$act->post->user->first_name}} {{$act->post->user->last_name}}
                  @endif
                </span>

              @elseif($act->type=='comment')
                <span class="activity-name">{{Auth::user()->first_name}} {{Auth::user()->last_name}} 
                  <span class="name-seprter">commented on</span>
                  @if($act->user_id==$act->post->user_id) his own 
                  @else
                  {{$act->post->user->first_name}} {{$act->post->user->last_name}}
                  @endif
                </span>
              @elseif($act->type)                
               @endif
              <span class="activity-date">{{$act->created_at}}</span>
              </div>
              <div class="col-md-7">
              <div class="activity-img">
             @if($act->type=='post' || $act->type=='like' || $act->type=='dislike' || $act->type=='comment' || $act->type=='share')
              <ul>
                @if($act->post->type=='image')
                  <li>{{Html::image('public/images/post/post_image/'.$act->post->value,'img',array('class'=>'img-responsive'))}} </li>
                @endif

                  @if($act->post->type=='video')
                  <li> <video width="100%" height="315" controls><source src="public/images/post/post_video/{{$act->post->value}}" type="video/mp4"></video> </li>
                  @endif
                  <li><p class="post-txt">{{$act->post->message}}</p></li>
                  @if($act->type=='comment')
                  <li> </li>
                  @endif
              </ul>
              @endif
              </div>
              </div>
              @if($act->type=='share')
              <div class="col-md-1">    
              <div class="dropdown">
              <i class="fa fa-pencil dropdown-toggle" type="button" data-toggle="dropdown" aria-hidden="true"></i>
              <ul class="dropdown-menu">
               <li><a onclick="delete_post_popup({{$act->post->id}})">Delete</a></li>
              </ul>
              </div>
              </div>
               @endif
              </div>
            @endforeach