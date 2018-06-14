<?php $__env->startSection('title','world opportuniti'); ?>
<?php $__env->startSection('content'); ?>
<div class="right-side-contant">

<div class="content text-center body-penals">
    <div class="col-md-4 col-md-offset-4 margin-top-60">
        <div class="panel panel-default">
            <!--<div class="panel-heading">Login</div>-->
            <div class="panel-body">
                <div class="login-form">
                    <form class="form-horizontal" method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <h2 class="text-center">Login</h2>    
                        <hr class="colorgraph">
                         <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <div class="col-md-12">
                                <input id="email" type="email" placeholder="E-Mail Address" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            
                            <div class="col-md-12">
                                <input id="password" type="password" placeholder="password" class="form-control" name="password" required>
                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Log in</button>
                        </div></div>
                        <div class="clearfix">
                            <label class="pull-left checkbox-inline"> <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Remember Me </label>
                            <a href="<?php echo e(route('password.request')); ?>" class="pull-right">Forgot Password?</a>
                        </div>        
                    </form>
                    <p class="text-center"><a href="<?php echo e(url('register')); ?>">Create an Account</a></p>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_script'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>