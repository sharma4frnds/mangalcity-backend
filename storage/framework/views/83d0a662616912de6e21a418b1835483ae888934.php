<?php $__env->startSection('title','Ragister'); ?>
<?php $__env->startSection('content'); ?>

    <!-- login -->
    <section class="login">
        <div class="container">
            <div class="flt-left">
            <div class="login-box signup">
                <h2>Signup</h2>
                <form class="" method="POST" action="<?php echo e(route('register')); ?>">
                 <?php echo e(csrf_field()); ?>

                <div class="sign">
                <label>First Name</label>
                <input type="text" name="first_name" id="first_name" value="<?php echo e(old('first_name')); ?>" placeholder="First Name" class="form-control<?php echo e($errors->has('first_name') ? ' has-error' : ''); ?>">
                   <?php if($errors->has('first_name')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('first_name')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="sign">
                <label>Last Name</label>
                <input type="text" name="last_name" id="last_name" value="<?php echo e(old('last_name')); ?>" placeholder="Last Name" class="form-control<?php echo e($errors->has('last_name') ? ' has-error' : ''); ?>">
                  <?php if($errors->has('last_name')): ?>
                        <span class="help-block"><strong><?php echo e($errors->first('last_name')); ?></strong> </span>
                    <?php endif; ?>
                </div>

                <div class="sign">
                <label>Email Id</label>
                <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>" placeholder="Email" class="form-control<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                  <?php if($errors->has('email')): ?> <span class="help-block"><strong><?php echo e($errors->first('email')); ?></strong></span><?php endif; ?>
                </div>
                <div class="sign">
                <label>Mobile</label>
                <input type="text" name="mobile" id="mobile" value="<?php echo e(old('mobile')); ?>" placeholder="mobile No" class="form-control<?php echo e($errors->has('mobile') ? ' has-error' : ''); ?>">
                    <?php if($errors->has('mobile')): ?> <span class="help-block"><strong><?php echo e($errors->first('mobile')); ?></strong></span><?php endif; ?>
                </div>
                <div class="sign">
                <label>Password</label>
                <input type="password" name="password" id="password" placeholder="Password" class="form-control<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                 <?php if($errors->has('password')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="sign">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" class="form-control<?php echo e($errors->has('password_confirmation') ? ' has-error' : ''); ?>">
                 <?php if($errors->has('password_confirmation')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="btn-top"><button>Register</button></div>
                </form>
                <div class="login-fix">
                <div class="fb"><a href="<?php echo e(url('login/facebook')); ?>"><lable><span> <i class="fa fa-facebook" aria-hidden="true"></i></span>Sign in with Facebook</lable>
                    <div class="clear"></div></a>
                </div>
                <div class="google"><a href="<?php echo e(url('login/google')); ?>"><lable><span> <i class="fa fa-google-plus" aria-hidden="true"></i></span>Sign in with Google+</lable>
                    <div class="clear"></div></a>
                </div>
            </div>
            </br>
            <span class="no-ac">Are you registered?</span> <a href="<?php echo e(url('login')); ?>" class="forget"> Sign in here</a>
            </div>
            </div>
        </div>
    </section>
    <!-- login -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>