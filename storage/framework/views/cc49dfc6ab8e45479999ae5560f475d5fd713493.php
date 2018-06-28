<?php $__env->startSection('title','Mangalcity'); ?>

<?php $__env->startSection('content'); ?>
<section class="think-pnl post-pnl">
<div class="container">
  <div class="row">
  	<h1 class="error-number">404</h1>
  </div>

</section>


<!-- End Remote popup -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_script'); ?>
<?php echo e(Html::script('public/js/jquery.form.js')); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>