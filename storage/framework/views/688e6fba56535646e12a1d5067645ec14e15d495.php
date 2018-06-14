<?php $__env->startSection('title','world opportuniti'); ?>
<?php $__env->startSection('content'); ?>
<div class="right-side-contant">

<div class="content text-center body-penals">
<div class="col-md-6 col-md-offset-3 margin-top-60">
    <div class="panel panel-default">
        <!--<div class="panel-heading">Login</div>-->
        <div class="panel-body">
            <div class="login-form">
             <form class="" method="POST" action="<?php echo e(route('register')); ?>">
                 <?php echo e(csrf_field()); ?>

                <h2 class="text-center">Please Sign Up</h2>
                <hr class="colorgraph">
             
                <div class="form-group<?php echo e($errors->has('first_name') ? ' has-error' : ''); ?>">
                    <input type="text" name="first_name" id="first_name" value="<?php echo e(old('first_name')); ?>" class="form-control" placeholder="First Name" tabindex="3">
                      <?php if($errors->has('first_name')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('first_name')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                 <div class="form-group<?php echo e($errors->has('last_name') ? ' has-error' : ''); ?>">
                    <input type="text" name="last_name" id="last_name" value="<?php echo e(old('last_name')); ?>" class="form-control" placeholder="Last Name" tabindex="3">
                      <?php if($errors->has('last_name')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('last_name')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                    <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>" class="form-control" placeholder="Email Address" tabindex="4">
                     <?php if($errors->has('email')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                 <div class="form-group<?php echo e($errors->has('mobile') ? ' has-error' : ''); ?>">
                    <input type="text" name="mobile" id="mobile" value="<?php echo e(old('mobile')); ?>" class="form-control" placeholder="Mobile" tabindex="3">
                      <?php if($errors->has('mobile')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('mobile')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                 <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" tabindex="5">
                     <?php if($errors->has('password')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="form-group<?php echo e($errors->has('password_confirmation') ? ' has-error' : ''); ?>">
                  <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password" tabindex="5">
                   <?php if($errors->has('password_confirmation')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>


                <hr class="colorgraph">
                <div class="row">
                    <div class="col-xs-12 col-md-6"><input type="submit" value="Register" class="btn btn-primary btn-block" tabindex="7"></div>
                    <div class="col-xs-12 col-md-6"><a href="<?php echo e(url('login')); ?>" class="btn btn-success btn-block">Sign In</a></div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>