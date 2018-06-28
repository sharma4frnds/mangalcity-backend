<?php $__env->startSection('title','Mangalcity'); ?>

<?php $__env->startSection('content'); ?>
<!-- pro-pnl -->
<section class="pro-pnl">
 <div class="container">
 <div class="row">
  <div class="col-md-9 cv-relt">
    <div class="cover">
<div class="over-ic1"><a data-toggle="modal" href="<?php echo e(url('/coverpopup/')); ?>" data-target="#myModal"><i class=" ovr fa fa-camera" aria-hidden="true"></i></a>
</div>
  
   <?php echo e(Html::image('public/images/user/cover/'.Auth::user()->cover_image,'img',array('class'=>'img-responsive'))); ?>  
    </div>
<div class="cover-pro">

<div class="over-ic">
<a data-toggle="modal" href="<?php echo e(url('/imagepopup/')); ?>" data-target="#myModal">
 <i class=" ovr fa fa-camera" aria-hidden="true"></i></a>
</div>
<?php echo e(Html::image('public/images/user/'.Auth::user()->image,'img',array('class'=>'img-responsive'))); ?>


 <div class="c-cover-pnl">
<span class="cover-user-name"><?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?></span><br>
</div>
</div>
  </div>
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

</div>
</div>
</section>

<!-- pro-pnl -->

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
                    <p><a href="<?php echo e(url('user/change_password')); ?>">Change Password</a></p>
                    <p><a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" > Logout </a>
                    </p>

                    <form id="frm-logout" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo e(csrf_field()); ?>

                    </form>

                </div>
                 <?php $home_location=Session::get('home_location'); ?>
                 <?php if($home_location): ?>
                  <a href="<?php echo e(url('change_location')); ?>"> <button type="button" class="btn hme btn-warning">switch to Current location</button></a>
                  <?php else: ?>
                   <a href="<?php echo e(url('change_location')); ?>"> <button type="button" class="btn hme btn-warning">switch to home location</button></a>
                  <?php endif; ?>
              

                

            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">

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
                         <li><img id="imagePreview" class="prv"  /> </li>

                         <li style="float: right;">
                            <input type="submit" value="Post" class="post-bt"  /> 
                            </li> 
                        </ul>
                    </div>

                </div>

                 <div class="alert alert-info fade in" id="error_div" style="display: none"></div>

            </form>



            
            <!--City  post -->
            <div id="currentMessage"></div>
            <!-- post -->
            <div  id="post-data">
              <?php echo $__env->make('feed', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
              </div>
            <!-- post -->
          <br/>
        <div class="ajax-load text-center" style="display:none">
           <p><?php echo e(Html::image('public/img/loader.gif')); ?> Loading More post</p>
        </div>

        </div>

  <!-- side-3 -->
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

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <?php $i=0; ?>
       <?php $__currentLoopData = $state_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sposts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="item <?php if($i==0): ?>active <?php endif; ?>">
          <?php if($cposts->type=='image'): ?>
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

</br>

  </br>
  <div class="col-md-3 col-sm-3 col-xs-12 bg-sld">
<div class="roted">
  <h2>District Highlights</h2>
</div>
<div class="slide-three">
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








        </div>
        
      </section>
<style type="text/css">
 
    </style>
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



<script type="text/javascript">
  var page = 1;

$(window).on("scroll", function() {
  var scrollHeight = $(document).height();
  var scrollPosition = $(window).height() + $(window).scrollTop();
  if((scrollHeight - scrollPosition) / scrollHeight === 0) {
        page++;
        loadMoreData(page);
  }
});



  function loadMoreData(page){
    $.ajax(
          {
              url: '?page=' + page,
              type: "get",
              cache: false,
              async:false,
              beforeSend: function()
              {
                  $('.ajax-load').show();
              }
          })
          .done(function(data)
          {
              if(data.html == ""){
                  $('.ajax-load').html("No more records found");
                  return;
              }
              //$('.ajax-load').hide();
              $("#post-data").append(data.html);
          })
          .fail(function(jqXHR, ajaxOptions, thrownError)
          {
            alert('server not responding...');
          });
  }
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>