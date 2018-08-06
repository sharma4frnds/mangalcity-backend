<div class="sticky-myright-side">
<div class="rg-one">
<!-- Country -->
 <div class="col-md-3 col-sm-3 col-xs-12 bg-sld">

<div class="slide-three">
  <div id="myCarousel2" class="carousel slide" data-ride="carousel">
    
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1" class=""></li>
      <li data-target="#myCarousel" data-slide-to="2" class=""></li>
    </ol>

    <!-- Wrapper for slides -->
    <h4><a href="<?php echo e(url('highlights/country')); ?>" >Country Highlights</a></h4>
    <div class="carousel-inner">
     
      <?php $i=0; ?>
       <?php $__currentLoopData = $country_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cposts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="item <?php if($i==0): ?>active <?php endif; ?>">
          <?php if($cposts->type=='image'): ?>
          <?php $cposts_img=''; if(isset($cposts->media[0])) $cposts_img=$cposts->media[0]->name; ?>
            <span><?php echo e(str_limit($cposts->message, 30)); ?></span>
          <a class="post_view_t"  href="<?php echo e(url('post_view/'.encrypt($cposts->id))); ?>" >
              <?php echo e(Html::image('public/images/post/post_image/'.$cposts_img,'img',array('class'=>'img-responsive'))); ?>  </a>

         <?php elseif($cposts->type=='video'): ?>
          <span><?php echo e(str_limit($cposts->message, 30)); ?></span>
            <video width="100%" height="150" controls><source src="public/images/post/post_video/<?php echo e($cposts->value); ?>" type="video/mp4"></video>  
         <?php else: ?>
            <p><?php echo e(str_limit($cposts->message, 210)); ?></p>
         <?php endif; ?>

          <a class="post_view_t"  href="<?php echo e(url('post_view/'.encrypt($cposts->id))); ?>"> View More </a>

      </div>

      <?php  $i=$i+1; ?>

       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel2" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel2" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
  </div>

<div class="col-md-3 col-sm-3 col-xs-12 bg-sld">

<div class="slide-three">
  <h4><a href="<?php echo e(url('highlights/state')); ?>">State Highlights</a></h4>
  <div id="myCarousel3" class="carousel slide" data-ride="carousel">
    
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <?php $i=0; ?>
       <?php $__currentLoopData = $state_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sposts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="item <?php if($i==0): ?>active <?php endif; ?>">

          <?php if($sposts->type=='image'): ?>
          <?php $spost_img=''; if(isset($sposts->media[0])) $spost_img=$sposts->media[0]->name; ?>
            <span><?php echo e(str_limit($sposts->message, 30)); ?></span>
            <a class="post_view_t"  href="<?php echo e(url('post_view/'.encrypt($sposts->id))); ?>" >
              <?php echo e(Html::image('public/images/post/post_image/'.$spost_img,'img',array('class'=>'img-responsive'))); ?>  </a>

         <?php elseif($sposts->type=='video'): ?>
         <span><?php echo e(str_limit($sposts->message, 30)); ?></span>
            <video width="100%" height="150" controls><source src="public/images/post/post_video/<?php echo e($sposts->value); ?>" type="video/mp4"></video>  
         <?php else: ?>
            <p><?php echo e(str_limit($sposts->message, 210)); ?></p>
         <?php endif; ?>
         <a class="post_view_t" data-toggle="modal" href="<?php echo e(url('post_view/'.encrypt($sposts->id))); ?>" >View More</a>
      </div>
      <?php  $i=$i+1; ?>

       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel3" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel3" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
</div>
</div>
<!-- side-2 -->
<!-- side-3 -->
<div id="sidebar">
<div class="col-md-3 col-sm-3 col-xs-12 bg-sld sidebar__inner">

<div class="slide-three">
    <h4><a href="<?php echo e(url('highlights/district')); ?>">District Highlights</a></h4>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
  
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
    
      <?php $i=0; ?>
       <?php $__currentLoopData = $district_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dposts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

      <div class="item <?php if($i==0): ?>active <?php endif; ?>">
          <?php if($dposts->type=='image'): ?>
           <span><?php echo e(str_limit($dposts->message, 30)); ?></span>
          <?php $dpost_img=''; if(isset($dposts->media[0])) $dpost_img=$dposts->media[0]->name; ?>
          <a class="post_view_t" data-toggle="modal" href="<?php echo e(url('post_view/'.encrypt($dposts->id))); ?>" >
              <?php echo e(Html::image('public/images/post/post_image/'.$dpost_img,'img',array('class'=>'img-responsive'))); ?>  </a>
         <?php elseif($dposts->type=='video'): ?>
          <span><?php echo e(str_limit($dposts->message, 30)); ?></span>
            <video width="100%" height="150" controls><source src="public/images/post/post_video/<?php echo e($dposts->value); ?>" type="video/mp4"></video>  
         <?php else: ?>
            <p><?php echo e(str_limit($dposts->message, 210)); ?></p>
         <?php endif; ?>
          <a class="post_view_t" data-toggle="modal" href="<?php echo e(url('post_view/'.encrypt($dposts->id))); ?>" >View More</a>
      </div>
      <?php $i=$i+1; ?>

       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
  
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

</div>


</div>
<div class="col-md-3 col-sm-3 col-xs-12 bg-sld">
    <div class="t-post">
<img src="http://emergingncr.com/mangalcity/public/images/post/post_image/t1.jpg" class="img-responsive" alt="img">
</div>
<div class="t-post">
<img src="http://emergingncr.com/mangalcity/public/images/post/post_image/t2.jpg" class="img-responsive" alt="img">
</div>
</div>
</div>
</div>
<!-- side-3 -->

<!-- search -->


