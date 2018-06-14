<?php $__env->startSection('content'); ?>

 <p style="float:left; width:100%; font-size:16px; color:#000;"><strong style="font-weight:bold;"> Thank you for using <a href="<?php echo e(url('/')); ?>"> Heyasia </a>to make a reservation.</strong></p>
<p>Here is a copy of your reservation for your reference.</p>
<table width="100%" cellpadding="0" cellspacing="0">

<tr><td>Property Name:</td><td><?php echo e($property_name); ?> </td></tr>
<tr><td>Name:</td><td><?php echo e($name); ?> </td></tr>
<tr><td>Email:</td><td><?php echo e($email); ?> </td></tr>
<tr><td>Phone:</td><td><?php echo e($phone); ?> </td></tr>
<tr><td>Date:</td><td><?php echo e($date); ?> </td></tr>
<tr><td>Time:</td><td><?php echo e($time); ?> </td></tr>
<tr><td>Message:</td><td><?php echo e($message); ?> </td></tr>
</table>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('emails.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>