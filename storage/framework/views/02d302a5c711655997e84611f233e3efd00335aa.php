            <?php $__currentLoopData = $activity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-md-12 col-sm-4 col-xs-12 box-shd activity">
              <div class="col-md-4">
              <?php if($act->type=='post'): ?>
                <span class="activity-name"><?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?> 
                  <span class="name-seprter">updated his status.</span>
               </span>
              <?php elseif($act->type=='like'): ?>
                <span class="activity-name"><?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?> 
                  <span class="name-seprter">likes on</span>
                  <?php if($act->user_id==$act->post->user_id): ?> his own 
                  <?php else: ?>
                  <?php echo e($act->post->user->first_name); ?> <?php echo e($act->post->user->last_name); ?>

                  <?php endif; ?>
                </span>

                <?php elseif($act->type=='dislike'): ?>
                <span class="activity-name"><?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?> 
                  <span class="name-seprter">dislike on</span>
                  <?php if($act->user_id==$act->post->user_id): ?> his own 
                  <?php else: ?>
                  <?php echo e($act->post->user->first_name); ?> <?php echo e($act->post->user->last_name); ?>

                  <?php endif; ?>
                </span>

                <?php elseif($act->type=='share'): ?>
                <span class="activity-name"><?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?> 
                  <span class="name-seprter">share on</span>
                  <?php if($act->user_id==$act->post->user_id): ?> his own 
                  <?php else: ?>
                  <?php echo e($act->post->user->first_name); ?> <?php echo e($act->post->user->last_name); ?>

                  <?php endif; ?>
                </span>

              <?php elseif($act->type=='comment'): ?>
                <span class="activity-name"><?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?> 
                  <span class="name-seprter">commented on</span>
                  <?php if($act->user_id==$act->post->user_id): ?> his own 
                  <?php else: ?>
                  <?php echo e($act->post->user->first_name); ?> <?php echo e($act->post->user->last_name); ?>

                  <?php endif; ?>
                </span>
              <?php elseif($act->type): ?>                
               <?php endif; ?>
              <span class="activity-date"><?php echo e($act->created_at); ?></span>
              </div>
              <div class="col-md-7">
              <div class="activity-img">
             <?php if($act->type=='post' || $act->type=='like' || $act->type=='dislike' || $act->type=='comment' || $act->type=='share'): ?>
              <ul>
                <?php if($act->post->type=='image'): ?>
                  <li><?php echo e(Html::image('public/images/post/post_image/'.$act->post->value,'img',array('class'=>'img-responsive'))); ?> </li>
                <?php endif; ?>

                  <?php if($act->post->type=='video'): ?>
                  <li> <video width="100%" height="315" controls><source src="public/images/post/post_video/<?php echo e($act->post->value); ?>" type="video/mp4"></video> </li>
                  <?php endif; ?>

                 <?php if($act->post->type=='audio'): ?>
                  <li>
                       <audio controls > <source src="public/images/post/post_audio/<?php echo e($act->post->value); ?>"></audio>
                   </li>
                  <?php endif; ?>  

                  <li><p class="post-txt"><?php echo e($act->post->message); ?></p></li>
                  <?php if($act->type=='comment'): ?>
                  <li> </li>
                  <?php endif; ?>
              </ul>
              <?php endif; ?>
              </div>
              </div>
              <?php if($act->type=='share'): ?>
              <div class="col-md-1">    
              <div class="dropdown">
              <i class="fa fa-pencil dropdown-toggle" type="button" data-toggle="dropdown" aria-hidden="true"></i>
              <ul class="dropdown-menu">
               <li><a onclick="delete_post_popup(<?php echo e($act->post->id); ?>)">Delete</a></li>
              </ul>
              </div>
              </div>
               <?php endif; ?>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>