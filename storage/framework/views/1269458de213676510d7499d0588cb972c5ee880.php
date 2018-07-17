<!--right Side bar -->
<!-- Country -->
 <div class="col-md-3 col-sm-3 col-xs-12 bg-sld">
<div class="roted">
  <h2>Country Highlights</h2>
</div>
<div class="slide-three">
  <div id="myCarousel2" class="carousel slide" data-ride="carousel">
    
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1" class=""></li>
      <li data-target="#myCarousel" data-slide-to="2" class=""></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
     <h4><a href="<?php echo e(url('highlights/country')); ?>" >Country Highlights</a></h4>
      <?php $i=0; ?>
       <?php $__currentLoopData = $country_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cposts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="item <?php if($i==0): ?>active <?php endif; ?>">
          <?php if($cposts->type=='image'): ?>
              <?php echo e(Html::image('public/images/post/post_image/'.$cposts->value,'img',array('class'=>'img-responsive'))); ?>  

         <?php elseif($cposts->type=='video'): ?>
            <video width="100%" height="150" controls><source src="public/images/post/post_video/<?php echo e($cposts->value); ?>" type="video/mp4"></video>  
         <?php else: ?>
            <p><?php echo e(str_limit($cposts->message, 25)); ?></p>
         <?php endif; ?>
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
<div class="roted">
  <h2>State Highlights</h2>
</div>
<div class="slide-three">
  <div id="myCarousel3" class="carousel slide" data-ride="carousel">
    
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <h4><a href="<?php echo e(url('highlights/state')); ?>">State Highlights</a></h4>
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <?php $i=0; ?>
       <?php $__currentLoopData = $state_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sposts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="item <?php if($i==0): ?>active <?php endif; ?>">
          <?php if($sposts->type=='image'): ?>
              <?php echo e(Html::image('public/images/post/post_image/'.$sposts->value,'img',array('class'=>'img-responsive'))); ?>  

         <?php elseif($sposts->type=='video'): ?>
            <video width="100%" height="150" controls><source src="public/images/post/post_video/<?php echo e($sposts->value); ?>" type="video/mp4"></video>  
         <?php else: ?>
            <p><?php echo e(str_limit($sposts->message, 25)); ?></p>
         <?php endif; ?>
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
<!-- side-2 -->
<!-- side-3 -->
<div class="col-md-3 col-sm-3 col-xs-12 bg-sld">
<div class="roted">
  <h2>District Highlights</h2>
</div>
<div class="slide-three">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <h4><a href="<?php echo e(url('highlights/district')); ?>">District Highlights</a></h4>
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
              <?php echo e(Html::image('public/images/post/post_image/'.$dposts->value,'img',array('class'=>'img-responsive'))); ?>  

         <?php elseif($dposts->type=='video'): ?>
            <video width="100%" height="150" controls><source src="public/images/post/post_video/<?php echo e($dposts->value); ?>" type="video/mp4"></video>  
         <?php else: ?>
            <p><?php echo e(str_limit($dposts->message, 25)); ?></p>
         <?php endif; ?>
      </div>
      <?php  $i=$i+1; ?>

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

<!-- side-3 -->
<!-- search -->
<div class="col-md-3 col-sm-3 col-xs-12 bg-sld">
<div class="form-group">
  
  <?php echo Form::text('search_text', null, array('placeholder' => 'Search Text','class' => 'form-control','id'=>'search_text')); ?>

</div>
</div>

<!-- end right Side bar -->