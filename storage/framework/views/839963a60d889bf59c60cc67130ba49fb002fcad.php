<!-- Modal -->
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Share on Your Timeline</h4>
  </div>
  <div class="modal-body">
    <form class="form-horizontal">
       <?php echo e(csrf_field()); ?>

      <div class="">
          <p class="post-txt"><?php echo e($post->message); ?></p>
            <?php if($post->type=='image'): ?>
              <div class="post-img">
                   <?php echo e(Html::image('public/images/post/post_image/'.$post->value,'img',array('class'=>'img-responsive'))); ?>  
              </div>
           <?php endif; ?>

             <?php if($post->type=='video'): ?>
              <div class="post-video">
                 <video width="100%" height="315" controls><source src="public/images/post/post_video/<?php echo e($post->value); ?>" type="video/mp4"></video>   
              </div>  
           <?php endif; ?>
      </div>
    
       <input type="hidden" name="post_id" value="<?php echo e($post->id); ?>">
       
  </form>

  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-primary" onclick="sharePost(<?php echo e($post->id); ?>)">Share</button>
  </div>
