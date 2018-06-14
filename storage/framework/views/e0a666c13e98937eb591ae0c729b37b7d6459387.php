<?php $__env->startSection('content'); ?>

<p style="float:left; width:100%; font-size:16px; color:#000;">Welcome <strong style="font-weight:bold;">Abhay Parashar</strong></p>
<p>Thank you for your message. We will get back to you ASAP!</p>
<p>Your message details are shown below</p>
<p><a href="#" target="_blank" style="background: #b39e45; color:#fff; padding:5px 20px; border-radius:5px; text-decoration: none; margin-top: 15px;margin-bottom: 15px; display: inline-block;">SHOW MESSAGE SENT / DETAILS </a></p>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('emails.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>