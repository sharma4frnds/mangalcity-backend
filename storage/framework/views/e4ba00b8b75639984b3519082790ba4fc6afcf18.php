
<?php $__env->startSection('title','world opportuniti'); ?>
<?php $__env->startSection('content'); ?>
<div class="right-side-contant">
    <div class="content body-penals-content">
                <div class="wrapper">
                    <div class="row">
                        <div class="nav-grid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="page-link">
                                        <span><a href="<?php echo e(url('/')); ?>">Home</a>  &nbsp;<i class="fa fa-angle-right"></i> <?php echo e(ucfirst($page->name)); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="page-heading">
                                        <h3><?php echo e(ucfirst($page->name)); ?></h3>
                                    </div>
                                    <div class="paragraph">
                                     <?php echo $page->description; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
  

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_script'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>