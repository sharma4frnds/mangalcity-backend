<!-- Modal -->
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">City:@if(isset($city_name->name)) {{$city_name->name}} @endif    <span class="post-time">
                   <i class="fa fa-clock-o" aria-hidden="true"></i> 
                    {!! Helper::dateFormate($post->created_at); !!}
                </span> </h4>
  </div>
  <div class="modal-body">

          <p class="post-txt">{{$post->message}}</p>
            @if($post->type=='image')
              <div class="post-img">
                   {{Html::image('public/images/post/post_image/'.$post->value,'img',array('class'=>'img-responsive'))}}  
              </div>
           @endif

             @if($post->type=='video')
              <div class="post-video">
                 <video width="100%" height="315" controls><source src="public/images/post/post_video/{{$post->value}}" type="video/mp4"></video>   
              </div>  
           @endif

        @if($post->type=='audio')
           <div class="post-audio">
              <audio controls="" > <source src="public/images/post/post_audio/{{$post->value}}"></audio>;
            </div>
        @endif
   
    
       <input type="hidden" name="post_id" value="{{$post->id}}">


  </div>
  <div class="modal-footer">
    <i class="fa fa-thumbs-o-up"></i> {{$post->likes}}
    <i class="fa fa-thumbs-o-down"></i> {{$post->dislikes}}

  </div>
