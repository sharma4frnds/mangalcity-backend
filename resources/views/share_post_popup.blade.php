<!-- Modal -->
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Share on Your Timeline</h4>
  </div>
  <div class="modal-body">
    <form class="form-horizontal">
       {{ csrf_field() }}
      <div class="">
       
          <textarea  class="post-txt form-control" id="share_message" placeholder="Write something here.. ">{{$post->message}}</textarea>
   
             @if($post->type=='image')
                <?php   $imgCount= count($post->media);?>
                <div class="image-layout-@if($imgCount>5)5 @else{{$imgCount}}@endif">
                  <?php $im=1; $imid=''; $spim=''; ?>
                  @foreach ($post->media as $media)
                     @if($im==5 && $imgCount>5  ) <?php $imid='moreImgDef'; $rim=$imgCount-5; $spim="<span>$rim+</span>";?> @endif
                      <div class="post-img2" id="{{$imid}}" style="background-image: url({{url('public/images/post/post_image/'.$media->name)}});">{!! $spim !!}</div>
                  @if($im==5) @break @endif
                  <?php $im=$im+1;?>
                  @endforeach
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
      </div>
    
       <input type="hidden" name="post_id" value="{{$post->id}}">
       
  </form>

  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-primary" onclick="sharePost({{$post->id}})">Share</button>
  </div>
