<?php $__env->startSection('title','Login'); ?>
<?php $__env->startSection('content'); ?>

    <!-- login -->
    <section class="login">
        <div class="container">
            <div class="flt-left">
            <div class="login-box">
                <h2>Login</h2>
                <?php if(Session::has('message')): ?>
                <p class="alert alert-info"><?php echo e(Session::get('message')); ?></p>
                <?php endif; ?>
            <?php $__currentLoopData = ['danger', 'warning', 'success', 'info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <?php if(Session::has($key)): ?>
                 <p class="alert alert-<?php echo e($key); ?>"><?php echo e(Session::get($key)); ?></p>
             <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <form class="form-horizontal" method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo e(csrf_field()); ?>

                <input type="text" id="emial" placeholder="Email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
                   <?php if($errors->has('email')): ?>
                        <span class="help-block"> <strong><?php echo e($errors->first('email')); ?></strong> </span>
                  <?php endif; ?>
                <input type="password" id="password" placeholder="Password" class="form-control" name="password" required autofocus>
                   <?php if($errors->has('password')): ?> <span class="help-block"> <strong><?php echo e($errors->first('password')); ?></strong></span> <?php endif; ?>
                <div class="btn-top"><button>login</button></div>

                <div class="fb"><a href="<?php echo e(url('login/facebook')); ?>"><lable><span> <i class="fa fa-facebook" aria-hidden="true"></i></span>Sign in with Facebook</lable>
                    <div class="clear"></div></a>
                </div>

                <div class="google"><a href="<?php echo e(url('login/google')); ?>"><lable><span> <i class="fa fa-google-plus" aria-hidden="true"></i></span>Sign in with Google+</lable>
                    <div class="clear"></div></a>
                </div>
                 <a href="<?php echo e(route('password.request')); ?>" class="forget">Forgot Password?</a>
            </br>
            <span class="no-ac">Don't have an account?</span> <a href="<?php echo e(url('register')); ?>" class="forget" > Sign up here</a>
            </form>
            </div>
            </div>
        </div>
    </section>
    <!-- login -->


<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_script'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>