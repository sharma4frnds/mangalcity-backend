<?php $__env->startSection('title','Mangalcity'); ?>

<?php $__env->startSection('header_css'); ?>
 <?php echo e(Html::style('public/css/dropzone.css')); ?>

 <?php echo e(Html::style('public/css/fancybox.css')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<section class="think-pnl post-pnl">
      <div class="container">
        <div class="row">
          <!-- left-pro -->
          <div class="col-md-9 ped-0">
           
          <div class="col-md-12 cv-relt ped-15-0">
              <div class="cover">
                  <div class="over-ic1"><a data-toggle="modal" href="<?php echo e(url('/coverpopup/')); ?>" data-target="#myModal_large"><i class=" ovr fa fa-camera" aria-hidden="true"></i></a>
                  </div>

                  <?php echo e(Html::image('public/images/user/cover/'.Auth::user()->cover_image,'img',array('class'=>'img-responsive'))); ?>

              </div>
              <div class="cover-pro">

                  <div class="over-ic">
                      <a data-toggle="modal" href="<?php echo e(url('/imagepopup/')); ?>" data-target="#myModal">
                          <i class=" ovr fa fa-camera" aria-hidden="true"></i></a>
                  </div>
                  <?php echo e(Html::image('public/images/user/'.Auth::user()->image,'img',array('class'=>'img-responsive'))); ?>


                

              </div>
                <div class="col-md-12 c-cover-pnl">
                      <span class="cover-user-name"><?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?></span>
                    
                      <span class="cover-user-name">(<?php echo e($city_name->name); ?>)</span>
                  </div>
          </div>
          <?php echo $__env->make('left_bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <div class="col-md-8 col-sm-6 col-xs-12 scrl">
                     
                  <?php echo Form::open(['url' => 'post', 'class' => 'dropzone', 'files'=>true, 'id'=>'real-dropzone']); ?>


                    <span class="pro-name new-dt">Update Your Status</span>
                 <div class="col-md-12 col-sm-4 col-xs-12 box-shd top-pd-20">

                    <div class="col-md-12 pd0">

                     <div class="pro1"><?php echo e(Html::image('public/images/user/'.Auth::user()->image,'img',array('class'=>'img-responsive'))); ?>  
                    </div>  
                       <textarea name="message" id="npmessage" cols="30" rows="1" class="form-control" placeholder="Write something here..."></textarea>

                       <ul> <li> 
                            <div class="dz-message"></div>
                           <div class="dropzone-previews" id="dropzonePreview"></div>
                         </li></ul>
                    </div>

                   
                      <div id="queued-files" style="display: none;">1 image selected</div>
                     
                    <div class="share-area">

                      <div class="up-img" "> <div class="fallback"> <input name="image[]" type="file" multiple /> </div></div>
                      <div class="up-vid"><input type="file" name="video" id="npvideo" accept="video/*" onchange="displayVideo(this);"></div>
                         <div class="up-aud"><input type="file" name="audio" accept="audio/*" id="npaudio" onchange="displayAudio(this);" capture></div>
                     
                        <ul>
                       <li><i class="fa fa-file-image-o" aria-hidden="true" id="npimage"></i></li>   
                         <li><i class="fa fa-video-camera" aria-hidden="true"></i></li> 
                         <li><i class="fa fa-music" aria-hidden="true"></i></li> 
                     
                         <li> 
                            <div class="dz-message"></div>
                           <div class="dropzone-previews" id="dropzonePreview"></div>
                         </li>
                       

                         <li style="float: right;">
                            <input type="submit" name="submit" value="Post" class="post-bt" id="submitfiles" /> 

                            </li> 
                              <li style="float: right; display: none;" id="mloader"><?php echo e(Html::image('public/img/bx_loader.gif')); ?></li>
                        </ul>
                    </div>

                </div>

                 <div class="alert alert-info fade in" id="error_div" style="display: none"></div>
                    <span class="fileupload-process">
                    <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                        <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                    </div>
                  </span>

            </form>
          <!-- Dropzone Preview Template -->
          <div id="preview-template" style="display: none;">
              <div class="dz-preview dz-file-preview">
                  <div class="dz-image"><img data-dz-thumbnail=""></div>
                  <div class="dz-details">
                      <div class="dz-error-mark"><span></span></div>
                      <div class="dz-error-message"><span data-dz-errormessage></span></div>
                  </div>
              </div>
          </div>


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
<div id="myModal" class="modal fade">
<div class="modal-dialog">
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
            $('.modal-content').html('<div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title"> </h4></div><div class="modal-body"><p class="text-center"><?php echo e(Html::image("public/img/bx_loader.gif")); ?> </p></div><div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>');
    });

  $('#myModal_large').on('hidden.bs.modal', function () {
            $('.modal-content').html('<div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title"> </h4></div><div class="modal-body"><p class="text-center"><?php echo e(Html::image("public/img/bx_loader.gif")); ?> </p></div><div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>');
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
<script type="text/javascript">

    var a = new StickySidebar('#sidebar', {
      topSpacing: 20,
      bottomSpacing: 20,
      containerSelector: '.rg-one',
      innerWrapperSelector: '.sidebar__inner'
    });
  </script>
  <script type="text/javascript">
  	$(window).scroll(function(){
	    if ($(this).scrollTop() > 500) {
	       $('#sidebar').addClass('newClass');
	    } else {
	       $('#sidebar').removeClass('newClass');
	    }
	});
  </script>

  <?php echo e(Html::style('public/js/jquery-ui.css')); ?>

  <?php echo HTML::script('public/js/dropzone.js'); ?>

  <?php echo HTML::script('public/js/sticky-sidebar.js'); ?>

  <?php echo HTML::script('/public/js/dropzone-config.js'); ?>

  <?php echo HTML::script('/public/js/jquery.fancybox.js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>