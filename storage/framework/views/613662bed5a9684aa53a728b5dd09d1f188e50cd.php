            <?php $__currentLoopData = $city_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city_post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 
                // echo '<pre>';
                 //print_r($city_post);
                
            
            ?>

            <div class="col-md-12 col-sm-4 col-xs-12 box-shd top-pd-20" id="postdiv<?php echo e($city_post->id); ?>">
                <div class="col-md-6">
                 <div class="pro1">
                    <a href="<?php echo e(url('profile/'.$city_post->user->url)); ?>">
                        <?php echo e(Html::image('public/images/user/'.$city_post->user->image,'img',array('class'=>'img-responsive'))); ?></a>
                    </div>  
                 <span class="pro-name"> <a href="<?php echo e(url('profile/'.$city_post->user->url)); ?>"><?php echo e($city_post->user->first_name); ?> <?php echo e($city_post->user->last_name); ?></a></span></br>
                <span class="post-time">
                  <?php echo Helper::dateFormate($city_post->created_at);; ?>

                </span> 
                </div>
                <div class="col-md-6">
                    <div class="dropdown">
                     <i data-toggle="dropdown" class="fa dropdown-toggle fa fa-ellipsis-v"></i>
                     <ul class="dropdown-menu side-fix">
                        <?php if($city_post->user_id==Auth::user()->id): ?>
                        <li><a onclick="delete_post_popup(<?php echo e($city_post->id); ?>)">Delete</a></li>
                       <?php endif; ?>
                       <li>
                        <a data-toggle="modal" href="<?php echo e(url('/reportFeedback/'.$city_post->id)); ?>" data-target="#myModal">
                            Report spam</a>
                        </li>
                     </ul>
                   </div>
                </div>

                  <p class="post-txt"><?php echo e($city_post->message); ?></p>

                  <?php if($city_post->type=='image'): ?>
                    <div class="post-img">
                        <a  data-toggle="modal" href="<?php echo e(url('image_popup/'.$city_post->id)); ?>" data-target="#myModal">
                         <?php echo e(Html::image('public/images/post/post_image/'.$city_post->value,'img',array('class'=>'img-responsive'))); ?>  
                     </a>
                    </div>
                 <?php endif; ?>

                   <?php if($city_post->type=='video'): ?>
                    <div class="post-video">
                       <video width="100%" height="315" controls><source src="public/images/post/post_video/<?php echo e($city_post->value); ?>" type="video/mp4"></video>   
                    </div>  
                 <?php endif; ?>
                <?php if($city_post->type=='audio'): ?>
                    <div class="post-audio">
                       <audio controls > <source src="public/images/post/post_audio/<?php echo e($city_post->value); ?>"></audio>
                    </div>  
                 <?php endif; ?>
                <div class="share-area">

                    <ul>

                     <li><a onclick="doLike(<?php echo e($city_post->id); ?>,0)" id="dolike<?php echo e($city_post->id); ?>" > 
                      <?php if(isset($city_post->like)): ?>
                            <?php if($city_post->like->type==0): ?>
                                 <i class="fa fa-thumbs-up"></i> <?php echo e($city_post->likes); ?> 
                                <?php else: ?>
                                 <i class="fa fa-thumbs-o-up"></i> <?php echo e($city_post->likes); ?>

                                <?php endif; ?>
                           
                            <?php else: ?>
                            <i class="fa fa-thumbs-o-up"></i> <?php echo e($city_post->likes); ?>

                            <?php endif; ?>
                         </a> 
                     </li>

                     <li>
                        <a onclick="dodislikes(<?php echo e($city_post->id); ?>,1)" id="dodislikes<?php echo e($city_post->id); ?>" > 
                           <?php if(isset($city_post->like)): ?>
                                <?php if($city_post->like->type==1): ?>
                                <i class="fa fa-thumbs-down"></i> <?php echo e($city_post->dislikes); ?>

                                <?php else: ?>
                                <i class="fa fa-thumbs-o-down"></i> <?php echo e($city_post->dislikes); ?>

                                <?php endif; ?>
                            <?php else: ?>
                            <i class="fa fa-thumbs-o-down"></i> <?php echo e($city_post->dislikes); ?>

                            <?php endif; ?>
                          </a>
                     </li>
                      <li><a onclick="focus_form(<?php echo e($city_post->id); ?>)"> <i class="fa fa-comment" aria-hidden="true"></i> Comment</i> </a></li>   
                   
                      <li><a onclick="share_post_popup(<?php echo e($city_post->id); ?>)">  <i class="fa fa-share-alt" aria-hidden="true"></i> Share</i></a></li>
                      
                     <?php if($city_post->type=='image'): ?>
                       <li><a href="<?php echo e(url('download_image/'.$city_post->value)); ?>"><i class="fa fa-cloud-download" aria-hidden="true"></i>Download</a></li>
                       <?php endif; ?>

                    </ul>
                </div>

                <div class="hr"></div>

                <div id="comment_section<?php echo e($city_post->id); ?>">
                <?php if(isset($city_post->comment[0])): ?>
                <?php $__currentLoopData = $city_post->comment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cmnt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($cmnt->parent_id==0): ?>
                <div class="col-md-12 col-sm-4 col-xs-12 top-pd-20 cmnt-pnl" id="commentDiv<?php echo e($cmnt->id); ?>">
                <div class="col-md-11 cmnt-pnl-ped">

                <div class="pro1">
                    <?php if($city_post->user->id==Auth::user()->id): ?>
                    <?php echo e(Html::image('public/images/user/'.$cmnt->user->image,'img',array('class'=>'img-responsive'))); ?>

                    <?php else: ?>
                    <a href="<?php echo e(url('profile/'.$cmnt->user->url)); ?>"><?php echo e(Html::image('public/images/user/'.$cmnt->user->image,'img',array('class'=>'img-responsive'))); ?></a>
                    <?php endif; ?>
                </div> 

                 <div class="cmnt-box">
                 <span class="pro-name"><b><?php echo e($cmnt->user->first_name.' '.$cmnt->user->last_name); ?>:</b> <?php echo e($cmnt->message); ?></span><br>
                    
                <span class="post-time">
                   <i class="fa fa-clock-o" aria-hidden="true"></i> 
                    <?php echo Helper::dateFormate($cmnt->created_at);; ?> <span class="rpl<?php echo e($cmnt->id); ?>"><a onclick="showReplydiv(<?php echo e($cmnt->id); ?>)">Reply</a></span>
                </span> 

                </div>
                </div>
                <?php if($cmnt->user_id==Auth::user()->id): ?>
                <div class="dropdown">
                 <i data-toggle="dropdown" class="fa dropdown-toggle fa-angle-down"></i>
                 <ul class="dropdown-menu side-fix">
                   <li><a onclick="deleteComment(<?php echo e($city_post->id); ?>,<?php echo e($cmnt->id); ?>)">Delete</a></li>
                 </ul>
               </div>
               <?php endif; ?>
              <!-- reply -->
              <?php $replies=count($cmnt->replies); ?>
                <?php if($replies>0): ?>
                <div class="rply">
                <div id="comment_section_reply<?php echo e($cmnt->id); ?>">    
                <?php $__currentLoopData = $cmnt->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $replie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-12 col-sm-4 col-xs-12 top-pd-20 cmnt-pnl" id="commentDiv<?php echo e($replie->id); ?>">
                <div class="col-md-11 cmnt-pnl-ped" >
            
                <div class="pro1">
                    <?php if($replie->user->id==Auth::user()->id): ?>
                    <?php echo e(Html::image('public/images/user/'.$replie->user->image,'img',array('class'=>'img-responsive'))); ?>

                    <?php else: ?>
                    <a href="<?php echo e(url('profile/'.$replie->user->url)); ?>"><?php echo e(Html::image('public/images/user/'.$replie->user->image,'img',array('class'=>'img-responsive'))); ?></a>
                    <?php endif; ?>
                </div> 
                 <div class="cmnt-box">
                 <span class="pro-name"><b><?php echo e($replie->user->first_name.' '.$replie->user->last_name); ?>:</b>  : <?php echo e($replie->message); ?></span><br>
                 <span class="post-time">
                   <i class="fa fa-clock-o" aria-hidden="true"></i> 
                    <?php echo Helper::dateFormate($replie->created_at);; ?>

                </span> 
                </div>
                </div>
               
                 <?php if($replie->user->id==Auth::user()->id): ?>
                    <div class="dropdown">
                     <i data-toggle="dropdown" class="fa dropdown-toggle fa-angle-down"></i>
                     <ul class="dropdown-menu side-fix">
                       <li><a onclick="deleteComment(<?php echo e($city_post->id); ?>,<?php echo e($replie->id); ?>)">Delete</a></li>
                     </ul>
                    </div>
                <?php endif; ?>
               </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                    <div class="col-md-12 cmnt-pnl-ped ped-2" id="rply<?php echo e($cmnt->id); ?>" style="display:none">
                        <div class="pro1"><?php echo e(Html::image('public/images/user/'.Auth::user()->image,'img',array('class'=>'img-responsive'))); ?> </div>  
                     <div class="cmnt-box">
                        <textarea rows="2" cols="90" name="comment" form="usrform" id="comment-form_reply<?php echo e($cmnt->id); ?>" placeholder="write a reply..."> </textarea>
                        <button class="post-bt" onclick="postComment(<?php echo e($city_post->id); ?>,<?php echo e($cmnt->id); ?>)">Reply</button>
                    </div>
                    </div>
                 </div>
                <?php else: ?>
                <!-- if no reply -->
                 <div class="rply" id="rply<?php echo e($cmnt->id); ?>" style="display:none">
                    <div id="comment_section_reply<?php echo e($cmnt->id); ?>"> </div>
                    <div class="col-md-12 cmnt-pnl-ped ped-2">
                        <div class="pro1"><?php echo e(Html::image('public/images/user/'.Auth::user()->image,'img',array('class'=>'img-responsive'))); ?> </div>  
                     <div class="cmnt-box">
                        <textarea rows="2" cols="90" name="comment" form="usrform" id="comment-form_reply<?php echo e($cmnt->id); ?>" placeholder="write a reply..."> </textarea>
                        <button class="post-bt" onclick="postComment(<?php echo e($city_post->id); ?>,<?php echo e($cmnt->id); ?>)">Reply</button>
                    </div>
                    </div>
                 </div>
                <!-- end no reply -->

                <?php endif; ?>
                <!-- End Reply -->
            </div>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
         </div>
        
           
            <div class="col-md-12 col-sm-4 col-xs-12 top-pd-20 cmnt-pnl">
                <div class="col-md-12 cmnt-pnl-ped">
                 <div class="pro1"><?php echo e(Html::image('public/images/user/'.Auth::user()->image,'img',array('class'=>'img-responsive'))); ?> </div>  
                 <div class="cmnt-box">
                    <textarea rows="2" cols="100" name="comment" id="comment-form<?php echo e($city_post->id); ?>" placeholder="Leave a comment..."></textarea>
                    <button class="post-bt" onclick="postComment(<?php echo e($city_post->id); ?>,0)">Post</button>
                </div>
                </div>
            </div>

            </div>



            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>