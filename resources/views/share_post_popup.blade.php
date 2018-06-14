<!-- Modal -->
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Share on Your Timeline</h4>
  </div>
  <div class="modal-body">
    <form class="form-horizontal">
       {{ csrf_field() }}
      <div class="">
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
      </div>
    
       <input type="hidden" name="post_id" value="{{$post->id}}">
       
  </form>

  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-primary" onclick="sharePost({{$post->id}})">Share</button>
  </div>
