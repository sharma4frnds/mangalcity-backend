<?php $__env->startSection('title','Mangalcity'); ?>

<?php $__env->startSection('content'); ?>
      <section class="think-pnl post-pnl">
        <div class="container">
          <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="profile">

                    <div class="pro">
                    	<a href="<?php echo e(url('user/profile')); ?>"><?php echo e(Html::image('public/images/user/'.Auth::user()->image)); ?></a>
                    </div> 
                    <h4><a href="<?php echo e(url('user/profile')); ?>"><?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?> </a></h4>
                   
                    <p><a href="#">Activity Log</a></p>
                    <p><a href="<?php echo e(url('user/profile')); ?>">Update Profile</a></p>
                    <p><a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" > Logout </a>
                    </p>

                    <form id="frm-logout" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo e(csrf_field()); ?>

                    </form>

                </div>
                <button type="button" class="btn hme btn-warning">switch to home location</button>

                

            </div>
            <div class="col-md-9 col-sm-4 col-xs-12">

                <form method="POST" enctype="multipart/form-data" id="feedForm" action="post">
                    <input name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>"/>
                 <div class="col-md-12 col-sm-4 col-xs-12 box-shd top-pd-20">
                    <div class="col-md-6 pd0">
                     <div class="pro1"><?php echo e(Html::image('public/images/user/'.Auth::user()->image,'img',array('class'=>'img-responsive'))); ?>  
                    </div>  
                     <span class="pro-name">Update Your Status</span><br>
                    </div>

                  
                      <textarea name="message" cols="30" rows="1" class="form-control" placeholder="Write what you wish"></textarea>
                      <div id="queued-files" style="display: none;">1 image selected</div>
                    <div class="share-area">
                        <div class="up-img"><input type="file" id="npimage" name="image" accept="image/*" onchange="displayImage(this);"></div>
                        <div class="up-vid"><input type="file" name="video" id="npvideo" accept="video/*" onchange="displayVideo(this);"></div>
                        <ul>
                         <li><i class="fa fa-file-image-o" aria-hidden="true"></i></li>   
                         <li><i class="fa fa-video-camera" aria-hidden="true"></i></li> 
                         <li style="float: right;">
                            
                            <input type="submit" value="Post" class="post-bt"  /> 
                            </li> 
                        </ul>
                    </div>

                </div>

                 <div class="alert alert-danger" id="error_div" style="display: none"></div>

            </form>

            <div class="col-md-12 col-sm-4 col-xs-12 box-shd">
            <div class="row org">
                <div class="col-md-9">
                    <h3>country</h3>
                </div>
                <div class="col-md-3">
                    <!-- Controls -->
                    <div class="controls pull-right hidden-xs">
                        <a class="left fa fa-chevron-left btn btn-success" href="#carousel-example" data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-success" href="#carousel-example" data-slide="next"></a>
                    </div>
                </div>
            </div>

            <div id="carousel-example" class="carousel slide hidden-xs" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active">
                        <div class="row">
                        <?php $__currentLoopData = $country_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cposts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-sm-3 ped-crsl">
                            <div class="col-item">
                                <div class="photo">
                                   
                              <?php if($cposts->type=='image'): ?>
                                <div class="post-img">
                                     <?php echo e(Html::image('public/images/post/post_image/'.$cposts->value,'img',array('class'=>'img-responsive'))); ?>  
                                </div>
                             <?php elseif($cposts->type=='video'): ?>
                              <div class="post-video">
                                   <video width="100%" height="150" controls><source src="public/images/post/post_video/<?php echo e($cposts->value); ?>" type="video/mp4"></video>   
                                </div>  
                             <?php else: ?>
                                <p class="post-txt"><?php echo e(str_limit($cposts->message, 25)); ?></p>
                             <?php endif; ?>

                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-12">
                                            <h5><?php echo e($cposts->user->first_name); ?> <?php echo e($cposts->user->last_name); ?> <br>
                                              <?php echo Helper::dateFormate($cposts->created_at);; ?>


                                               </h5>
                                        </div>
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                 
                </div>
            </div>
            </div>

	<div class="col-md-12 col-sm-4 col-xs-12 box-shd">
        <div class="row org">
            <div class="col-md-9">
                <h3>state</h3>
            </div>
            <div class="col-md-3">
                <!-- Controls -->
                <div class="controls pull-right hidden-xs">
                    <a class="left fa fa-chevron-left btn btn-success" href="#carousel-example1" data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-success" href="#carousel-example1" data-slide="next"></a>
                </div>
            </div>
        </div>
        <div id="carousel-example1" class="carousel slide hidden-xs" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">

                     <?php $__currentLoopData = $state_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sposts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-sm-3 ped-crsl">
                            <div class="col-item">
                                <div class="photo">
                                   
                              <?php if($sposts->type=='image'): ?>
                                <div class="post-img">
                                     <?php echo e(Html::image('public/images/post/post_image/'.$sposts->value,'img',array('class'=>'img-responsive'))); ?>  
                                </div>
                             <?php elseif($sposts->type=='video'): ?>
                              <div class="post-video">
                                   <video width="100%" height="150" controls><source src="public/images/post/post_video/<?php echo e($sposts->value); ?>" type="video/mp4"></video>   
                                </div>  
                             <?php else: ?>
                                <p class="post-txt"><?php echo e(str_limit($sposts->message, 25)); ?></p>
                             <?php endif; ?>

                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-12">
                                            <h5><?php echo e($sposts->user->first_name); ?> <?php echo e($sposts->user->last_name); ?> <br><?php echo Helper::dateFormate($sposts->created_at);; ?> </h5>
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      
 
                    </div>
                </div>
               
            </div>
        </div>
    </div>


	<div class="col-md-12 col-sm-4 col-xs-12 box-shd">

        <div class="row org">
            <div class="col-md-9">
                <h3>district</h3>
            </div>
            <div class="col-md-3">
                <!-- Controls -->
                <div class="controls pull-right hidden-xs">
                    <a class="left fa fa-chevron-left btn btn-success" href="#carousel-example2" data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-success" href="#carousel-example2" data-slide="next"></a>
                </div>
            </div>
        </div>
        <div id="carousel-example2" class="carousel slide hidden-xs" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">
                        <?php $__currentLoopData = $district_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dposts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-sm-3 ped-crsl">
                            <div class="col-item">
                                <div class="photo">
                                   
                              <?php if($dposts->type=='image'): ?>
                                <div class="post-img">
                                     <?php echo e(Html::image('public/images/post/post_image/'.$dposts->value,'img',array('class'=>'img-responsive'))); ?>  
                                </div>
                             <?php elseif($dposts->type=='video'): ?>
                              <div class="post-video">
                                   <video width="100%" height="150" controls><source src="public/images/post/post_video/<?php echo e($dposts->value); ?>" type="video/mp4"></video>   
                                </div>  
                             <?php else: ?>
                                <p class="post-txt"><?php echo e(str_limit($dposts->message, 100)); ?></p>
                             <?php endif; ?>

                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-12">
                                            <h5><?php echo e($dposts->user->first_name); ?> <?php echo e($dposts->user->last_name); ?> <br><?php echo Helper::dateFormate($dposts->created_at);; ?> </h5>
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               
                      
                
                    </div>
                </div>
   
            </div>
        </div>
    </div>

        <!-- Button trigger modal -->



            
            <!--City  post -->
            <div id="currentMessage"></div>
            <?php $__currentLoopData = $city_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city_post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 
                // echo '<pre>';
                 //print_r($city_post);
                
            
            ?>

            <div class="col-md-12 col-sm-4 col-xs-12 box-shd top-pd-20" id="postdiv<?php echo e($city_post->id); ?>">
                <div class="col-md-6">
                 <div class="pro1">
                   <?php echo e(Html::image('public/images/user/'.$city_post->user->image,'img',array('class'=>'img-responsive'))); ?>

                    </div>  
                 <span class="pro-name"><?php echo e($city_post->user->first_name); ?> <?php echo e($city_post->user->last_name); ?></span></br>
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
                            Give Feedback on This Post</a>
                        </li>
                     </ul>
                   </div>
                </div>

                  <p class="post-txt"><?php echo e($city_post->message); ?></p>

                  <?php if($city_post->type=='image'): ?>
                    <div class="post-img">
                         <?php echo e(Html::image('public/images/post/post_image/'.$city_post->value,'img',array('class'=>'img-responsive'))); ?>  
                    </div>
                 <?php endif; ?>

                   <?php if($city_post->type=='video'): ?>
                    <div class="post-video">
                       <video width="100%" height="315" controls><source src="public/images/post/post_video/<?php echo e($city_post->value); ?>" type="video/mp4"></video>   
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
                      <li ><a onclick="focus_form(<?php echo e($city_post->id); ?>)"><i class="fa fa-comment" aria-hidden="true"></i> Comment</i> </a></li>   
                   
                      <li><a onclick="share_post_popup(<?php echo e($city_post->id); ?>)"> <i class="fa fa-share-alt" aria-hidden="true"></i> Share</i></a></li>
                 


                    </ul>
                </div>

                <div class="hr"></div>

                <div id="comment_section<?php echo e($city_post->id); ?>">
                <?php if(isset($city_post->comment[0])): ?>
                <?php $__currentLoopData = $city_post->comment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cmnt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <div class="col-md-12 col-sm-4 col-xs-12 top-pd-20 cmnt-pnl" id="commentDiv<?php echo e($cmnt->id); ?>">
                <div class="col-md-11 cmnt-pnl-ped">
                 
                <div class="pro1">
                   <?php echo e(Html::image('public/images/user/'.$cmnt->image,'img',array('class'=>'img-responsive'))); ?>

                </div>   
                 <div class="cmnt-box">
                 <span class="pro-name"><b><?php echo e($cmnt->first_name.' '.$cmnt->last_name); ?>:</b> <?php echo e($cmnt->message); ?></span><br>
                <span class="post-time">
                   <i class="fa fa-clock-o" aria-hidden="true"></i> 
                    <?php echo Helper::dateFormate($city_post->created_at);; ?>

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
              
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
         </div>
        
           
            <div class="col-md-12 col-sm-4 col-xs-12 top-pd-20 cmnt-pnl">
                <div class="col-md-12 cmnt-pnl-ped">
                 <div class="pro1"><?php echo e(Html::image('public/images/user/'.$city_post->user->image,'img',array('class'=>'img-responsive'))); ?></div>  
                 <div class="cmnt-box">
                    <textarea rows="2" cols="100" name="comment" id="comment-form<?php echo e($city_post->id); ?>" placeholder="Leave a comment..."></textarea>
                    <button class="post-bt" onclick="postComment(<?php echo e($city_post->id); ?>)">Post</button>
                </div>
                </div>
            </div>

            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <!-- post -->
        
          </div>
        </div>
        
      </section>

<!-- Remote popup -->
<div id="myModal" class="modal fade">
<div class="modal-dialog">
    <div class="modal-content">
        <!-- Content will be loaded here from "remote.php" file -->
    </div>
</div>
</div>

<script type="text/javascript">
    $('body').on('hidden.bs.modal', '.modal', function () {
      $(this).removeData('bs.modal');
    });
</script>
<!-- End Remote popup -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_script'); ?>
<?php echo e(Html::script('public/js/jquery.form.js')); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>