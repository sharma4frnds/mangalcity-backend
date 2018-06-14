<?php $__env->startSection('content'); ?>
 <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Change Logo </h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

             <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                    <br/>
                       <?php if(count($errors) > 0): ?>
                      <div class="alert alert-danger">
                      <ul class='text'>
                          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <li><?php echo e($error); ?></li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </ul>
                  </div>
               <?php endif; ?>

              <?php if(Session::has('success')): ?>
               <div class="alert-box success">
                 <h2 style="color:red;"><?php echo e(Session::get('success')); ?></h2>
              </div>
              <?php endif; ?>

                    <?php echo e(Form::open(array('url'=>'admin/logo','files' => true))); ?>

                     
                     
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Images </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="" class="form-control col-md-7 col-xs-12" type="file" name="logo">
                        </div>
                      </div>
                      <div class="clearfix"></div>
                        <br/>
                      <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Current Logo </label>
                       <div class="col-md-6 col-sm-6 col-xs-12">

                     
                       <?php echo e(Html::image('public/images/logo.png','logo not Found',array( 'width' =>270 , 'height' => 90 ))); ?>   
                        </div>
                      </div>

                           <div class="clearfix"></div>
                        <br/>  
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                         <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    <?php echo e(Form::close()); ?>

                  </div>
                </div>
              </div>
            </div>

          </div>
         </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>