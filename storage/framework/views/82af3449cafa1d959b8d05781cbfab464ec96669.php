<!-- Modal -->
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">City:<?php if(isset($city_name->name)): ?> <?php echo e($city_name->name); ?> <?php endif; ?>    <span class="post-time">
                   <i class="fa fa-clock-o" aria-hidden="true"></i> 
                    <?php echo Helper::dateFormate($post->created_at);; ?>

                </span> </h4>
  </div>
  <div class="modal-body">

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

        <?php if($post->type=='audio'): ?>
           <div class="post-audio">
              <audio controls="" > <source src="public/images/post/post_audio/<?php echo e($post->value); ?>"></audio>;
            </div>
        <?php endif; ?>
   
    
       <input type="hidden" name="post_id" value="<?php echo e($post->id); ?>">


  </div>
  <div class="modal-footer">
    <i class="fa fa-thumbs-o-up"></i> <?php echo e($post->likes); ?>

    <i class="fa fa-thumbs-o-down"></i> <?php echo e($post->dislikes); ?>


  </div>
