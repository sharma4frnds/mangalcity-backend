<?php $__env->startSection('title','Mangalcity'); ?>

<?php $__env->startSection('content'); ?>
      <section class="think-pnl post-pnl updates">
        <div class="container">
          <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="profile">

                    <div class="pro">
                      <?php echo e(Html::image('public/images/user/'.Auth::user()->image)); ?>

                    </div> 
                    <h4><?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?></h4>
                     <p><a href="<?php echo e(url('home')); ?>">Home</a></p>
                    <p><a href="#">Activity Log</a></p>
                    <p><a href="<?php echo e(url('user/profile')); ?>">Update Profile</a></p>
                    <p><a href="<?php echo e(url('user/change_password')); ?>">Change Password</a></p>
                    <p><a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" > Logout </a>
                    </p>

                    <form id="frm-logout" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo e(csrf_field()); ?>

                    </form>
                </div>
                  <?php $home_location=Session::get('home_location'); ?>
                 <?php if($home_location): ?>
                  <a href="<?php echo e(url('change_location')); ?>"> <button type="button" class="btn hme btn-warning">switch to Current location</button></a>
                  <?php else: ?>
                   <a href="<?php echo e(url('change_location')); ?>"> <button type="button" class="btn hme btn-warning">switch to home location</button></a>
                  <?php endif; ?>

              
            </div>

            <div class="col-md-9 col-sm-4 col-xs-12">
              <div class="col-md-12 col-sm-4 col-xs-12 box-shd top-pd-20">

            <h1>Update Profile</h1>
            <section>
              <?php echo Form::open(array('url' => 'user/change_password','method' => 'POST','class' => '','files' => true)); ?>


              <?php if(!$errors->passwordErrors->isEmpty()): ?>
              <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->passwordErrors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
              <?php endif; ?>

              <?php if(session()->has('passwordMessages')): ?>
                <div class="alert alert-success">
                  <?php echo e(session()->get('passwordMessages')); ?>

                </div>
              <?php endif; ?>

                <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Old Password</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" placeholder="Old Password" name="old_password" required="">
                        </div>
                  </div>
                <div class="clearfix"></div>
                 <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">New Password</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" placeholder="New Password" name="password" required="">
                      </div>
                    </div>
                         
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Confirm Password</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required="">
                        </div>
                      </div>

                       <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class=" upd btn btn-primary">Update</button>
                        </div>
                      </div>
              </form>
            </section>


          
       
                <!-- tab -->



                  
              </div>
              </div>
             
            <!-- post -->
          </div>
        </div>
        
      </section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_script'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>