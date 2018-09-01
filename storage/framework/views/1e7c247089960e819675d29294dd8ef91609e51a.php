<?php $__env->startSection('title','Mangalcity'); ?>

<?php $__env->startSection('content'); ?>
<section class="think-pnl post-pnl">
<div class="container">
  <div class="row">
  	<div class="text-center text-center">
  		<h1 class="error-number">500</h1>
  		<h4>The requested page is temporary unavailable. Please return to <a href="<?php echo e(url('home')); ?>">Home</a></h4>
  	</div>
  </div>

</section>


<!-- End Remote popup -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_script'); ?>
<?php echo e(Html::script('public/js/jquery.form.js')); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>