<!-- Modal -->
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Share on Your Timeline</h4>
  </div>
  <div class="modal-body">
    <form class="form-horizontal">
       <?php echo e(csrf_field()); ?>

      <div class="">
       
          <textarea  class="post-txt form-control" id="share_message" placeholder="Write something here.. "><?php echo e($post->message); ?></textarea>
   
             <?php if($post->type=='image'): ?>
                <?php   $imgCount= count($post->media);?>
                <div class="image-layout-<?php if($imgCount>5): ?>5 <?php else: ?><?php echo e($imgCount); ?><?php endif; ?>">
                  <?php $im=1; $imid=''; $spim=''; ?>
                  <?php $__currentLoopData = $post->media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <?php if($im==5 && $imgCount>5  ): ?> <?php $imid='moreImgDef'; $rim=$imgCount-5; $spim="<span>$rim+</span>";?> <?php endif; ?>
                      <div class="post-img2" id="<?php echo e($imid); ?>" style="background-image: url(<?php echo e(url('public/images/post/post_image/'.$media->name)); ?>);"><?php echo $spim; ?></div>
                  <?php if($im==5): ?> <?php break; ?> <?php endif; ?>
                  <?php $im=$im+1;?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>

            <?php endif; ?>


             <?php if($post->type=='video'): ?>
              <div class="post-video">
                 <video width="100%" height="315" controls><source src="public/images/post/post_video/<?php echo e($post->value); ?>" type="video/mp4"></video>   
              </div>  
           <?php endif; ?>

        <?php if($post->type=='audio'): ?>
           <div class="post-audio">
              <audio controls="" > <source src="public/images/post/post_audio/<?php echo e($post->value); ?>"></audio>;
            </div>
        <?php endif; ?>
      </div>
    
       <input type="hidden" name="post_id" value="<?php echo e($post->id); ?>">
       
  </form>

  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-primary" onclick="sharePost(<?php echo e($post->id); ?>)">Share</button>
  </div>
