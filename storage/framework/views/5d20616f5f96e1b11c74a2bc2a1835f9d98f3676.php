<?php $__env->startSection('title','Mangalcity'); ?>

<?php $__env->startSection('content'); ?>


<section class="think-pnl post-pnl">
      <div class="container">
        <div class="row">
          <!-- left-pro -->
          <div class="col-md-9">
            <div class="col-md-12 col-sm-12 col-xs-12 bg-sld">
              <i class="fa fa-search tp-srh" aria-hidden="true"></i>
<div class="form-group">
  
  <?php echo Form::text('search_text', null, array('placeholder' => 'Search Text','class' => 'form-control','id'=>'search_text')); ?>

</div>
</div>
          <div class="col-md-12 cv-relt">
              <div class="cover">
                  <div class="over-ic1"><a data-toggle="modal" href="<?php echo e(url('/coverpopup/')); ?>" data-target="#myModal_large"><i class=" ovr fa fa-camera" aria-hidden="true"></i></a>
                  </div>

                  <?php echo e(Html::image('public/images/user/cover/'.Auth::user()->cover_image,'img',array('class'=>'img-responsive'))); ?>

              </div>
              <div class="cover-pro">
                  <div class="over-ic">
                      <a data-toggle="modal" href="<?php echo e(url('/imagepopup/')); ?>" data-target="#myModal_large">
                          <i class=" ovr fa fa-camera" aria-hidden="true"></i></a>
                  </div>
                  <?php echo e(Html::image('public/images/user/'.Auth::user()->image,'img',array('class'=>'img-responsive'))); ?>


                  <div class="c-cover-pnl">
                      <span class="cover-user-name"><?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?></span>
                  </div>
              </div>
          </div>
 
          <?php echo $__env->make('left_bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <div class="col-md-8 col-sm-6 col-xs-12">
                <form method="POST" enctype="multipart/form-data" id="feedForm" action="post">
                    <input name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>"/>
                 <div class="col-md-12 col-sm-4 col-xs-12 box-shd top-pd-20">
                    <div class="col-md-6 pd0">
                     <div class="pro1"><?php echo e(Html::image('public/images/user/'.Auth::user()->image,'img',array('class'=>'img-responsive'))); ?>  
                    </div>  
                     <span class="pro-name">Update Your Status</span><br>
                    </div>

                      <textarea name="message" cols="30" rows="1" class="form-control" placeholder="Write something here..."></textarea>
                      <div id="queued-files" style="display: none;">1 image selected</div>
                    <div class="share-area">
                        <div class="up-img"><input type="file" id="npimage" name="image" accept="image/*" onchange="displayImage(this);"></div>
                        <div class="up-vid"><input type="file" name="video" id="npvideo" accept="video/*" onchange="displayVideo(this);"></div>
                         <div class="up-aud"><input type="file" name="audio" accept="audio/*" id="npaudio" onchange="displayAudio(this);"></div>
                        <ul>
                         <li><i class="fa fa-file-image-o" aria-hidden="true"></i></li>   
                         <li><i class="fa fa-video-camera" aria-hidden="true"></i></li> 
                         <li><i class="fa fa-music" aria-hidden="true"></i></li> 
                         <li > 
                            <div id="imagePreviewDiv" style="display: none;"><img id="imagePreview" class="prv" />

                             </div> 
                         </li>
                       

                         <li style="float: right;">
                            <input type="submit" value="Post" class="post-bt"  /> 
                            </li> 
                              <li style="float: right; display: none;" id="mloader"><?php echo e(Html::image('public/img/bx_loader.gif')); ?></li>
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
        </div>

    <!-- left-pro -->
<?php echo $__env->make('right_bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>


</section>

<style type="text/css">

  </style>
<!-- Remote popup -->
<div id="myModal" class="modal fade ">
<div class="modal-dialog ">
  <div class="modal-content">
      <!-- Content will be loaded here from "remote.php" file -->
      <p class="text-center"><?php echo e(Html::image('public/img/bx_loader.gif')); ?></p>
  </div>
</div>
</div>

<!-- Remote popup large -->
<div id="myModal_large" class="modal fade">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <p class="text-center"><?php echo e(Html::image('public/img/bx_loader.gif')); ?></p>
      <!-- Content will be loaded here from "remote.php" file -->
  </div>
</div>
</div>

<script type="text/javascript">
  $('body').on('hidden.bs.modal', '.modal', function () {
    $(this).removeData('bs.modal');
  });
</script>
<script type="text/javascript">
  $('#myModal').on('hidden.bs.modal', function () {
            $('.modal-content').html('<div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title"></h4></div><div class="modal-body"><p class="text-center"><?php echo e(Html::image("public/img/bx_loader.gif")); ?> </p></div><div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>');
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