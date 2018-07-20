<?php $__env->startSection('title','Mangalcity'); ?>

<?php $__env->startSection('content'); ?>

<section class="think-pnl post-pnl">
      <div class="container">
        <div class="row">
          <!-- left-pro -->
          <div class="col-md-9">
          <div class="col-md-12 cv-relt">
              <div class="cover">
                  <div class="over-ic1"><a data-toggle="modal" href="<?php echo e(url('/coverpopup/')); ?>" data-target="#myModal"><i class=" ovr fa fa-camera" aria-hidden="true"></i></a>
                  </div>

                  <?php echo e(Html::image('public/images/user/cover/'.$profile->cover_image,'img',array('class'=>'img-responsive'))); ?>

              </div>
              <div class="cover-pro">

                  <div class="over-ic">
                      <a data-toggle="modal" href="<?php echo e(url('/imagepopup/')); ?>" data-target="#myModal">
                          <i class=" ovr fa fa-camera" aria-hidden="true"></i></a>
                  </div>
                  <?php echo e(Html::image('public/images/user/'.$profile->image,'img',array('class'=>'img-responsive'))); ?>


                  <div class="c-cover-pnl">
                      <span class="cover-user-name"><?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?></span><br>
                      <span class="cover-user-name"><?php echo e($city_name->name); ?></span>
                      <br>
                  </div>
              </div>
          </div>
          <?php echo $__env->make('left_bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <div class="col-md-8 col-sm-6 col-xs-12">

            <!-- start activity -->
            <br>
            <h2> Profile</h2>
              <dl class="dl-horizontal">
                  <dt> Name</dt> <dd><?php echo e($profile->first_name); ?> <?php echo e($profile->last_name); ?></dd>
                  <dt> Email</dt> <dd> <?php echo e($profile->email); ?> </dd>
                  <?php if($profile->mobile_hidden=='0'): ?>
                  <dt> Mobile</dt> <dd><?php echo e($profile->mobile); ?> </dd>
                   <?php endif; ?>
                   <?php if($profile->dob_hidden=='0'): ?>
                  <dt> DOB</dt> <dd><?php echo e($profile->dob); ?> </dd>
                   <?php endif; ?>
                  <dt> Gender</dt> <dd><?php echo e($profile->gender); ?> </dd>
                  <dt> Marital status</dt> <dd><?php echo e($profile->marital_status); ?> </dd>
                  <dt> Profession</dt> <dd><?php echo e($profile->profession); ?> </dd>
                  <dt> Address</dt> <dd><?php echo e($profile->address); ?>, <?php echo e($city_name->name); ?>, <?php echo e($state_name->name); ?>, <?php echo e($city_name->name); ?>, India</dd>
                </dl>
          
      
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

<script type="text/javascript">
  $('body').on('hidden.bs.modal', '.modal', function () {
    $(this).removeData('bs.modal');
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