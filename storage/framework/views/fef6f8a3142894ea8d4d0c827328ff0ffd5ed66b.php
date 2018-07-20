<?php $__env->startSection('title','Mangalcity'); ?>

<?php $__env->startSection('content'); ?>
      <section class="think-pnl post-pnl updates">
        <div class="container">
          <div class="row">
        
          <?php echo $__env->make('left_bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <div class="col-md-8 col-sm-6 col-xs-12">
              <div class="col-md-12 col-sm-4 col-xs-12 box-shd top-pd-20">

            <h1>Change password</h1>
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
                        <div class=" col-sm-12">
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