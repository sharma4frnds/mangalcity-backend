<?php $__env->startSection('title','Mangalcity'); ?>

<?php $__env->startSection('content'); ?>

<section class="think-pnl post-pnl">
      <div class="container">
        <div class="row">
          <!-- left-pro -->
          <div class="col-md-9 ped-0">
          <div class="col-md-12 cv-relt ped-15-0">
              <div class="cover">
                 <?php if($profile->id==Auth::user()->id): ?>
                  <div class="over-ic1"><a data-toggle="modal" href="<?php echo e(url('/coverpopup/')); ?>" data-target="#myModal_large"><i class=" ovr fa fa-camera" aria-hidden="true"></i></a>
                  </div>
                <?php endif; ?>

                  <?php echo e(Html::image('public/images/user/cover/'.$profile->cover_image,'img',array('class'=>'img-responsive'))); ?>

              </div>
              <div class="cover-pro">
                  <?php if($profile->id==Auth::user()->id): ?>
                  <div class="over-ic">
                      <a data-toggle="modal" href="<?php echo e(url('/imagepopup/')); ?>" data-target="#myModal_large">
                          <i class=" ovr fa fa-camera" aria-hidden="true"></i></a>
                  </div>
                  <?php endif; ?>
                  <?php echo e(Html::image('public/images/user/'.$profile->image,'img',array('class'=>'img-responsive'))); ?>


                
              </div>
                <div class="col-md-12 c-cover-pnl est">
                      <span class="cover-user-name"><?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?></span>
                      <span class="cover-user-name">(<?php echo e($city_name->name); ?>)</span>
                      <br>
                  </div>
          </div>
          <?php echo $__env->make('left_bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <div class="col-md-8 col-sm-6 col-xs-12">

            <div class="profile-bg">
            <h2> Personal Details </h2>
              <dl class="dl-horizontal">
                  <dt> Name</dt> <dd><?php echo e($profile->first_name); ?> <?php echo e($profile->last_name); ?></dd>
                  
                 
                   <?php if($profile->dob_hidden=='0'): ?>
                  <dt> DOB</dt> <dd><?php echo e($profile->dob); ?> </dd>
                   <?php endif; ?>
                  <dt> Gender</dt> <dd><?php echo e($profile->gender); ?> </dd>
                  <dt> Marital status</dt> <dd><?php echo e($profile->marital_status); ?> </dd>
                  <dt> Profession</dt> <dd><?php echo e($profile->profession); ?> </dd>
                  
                </dl>
            <h2>Contact Details</h2>
            <dl class="dl-horizontal">
               <?php if($profile->mobile_hidden=='0'): ?>
                  <dt> Mobile</dt> <dd><?php echo e($profile->mobile); ?> </dd>
                   <?php endif; ?>
            <dt> Email</dt> <dd> <?php echo e($profile->email); ?> </dd>
            <dt> Address</dt> <dd><?php echo e($profile->address); ?>, <?php echo e($city_name->name); ?>, <?php echo e($state_name->name); ?>, <?php echo e($city_name->name); ?>, India</dd>
          </dl>
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
  </div>
</div>
</div>

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

  $('#myModal_large').on('hidden.bs.modal', function () {
            $('.modal-content').html('<div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title"> </h4></div><div class="modal-body"><p class="text-center"><?php echo e(Html::image("public/img/bx_loader.gif")); ?> </p></div><div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>');
  });
</script>
<!-- End Remote popup -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_script'); ?>

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