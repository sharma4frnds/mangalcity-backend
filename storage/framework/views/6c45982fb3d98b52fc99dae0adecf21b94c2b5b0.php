<?php $__env->startSection('title','Mangalcity'); ?>

<?php $__env->startSection('content'); ?>

     <section class="think-pnl">
        <div class="container">
          <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-12">
                   <div class="text-slide">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                      </ol>

                      <!-- Wrapper for slides -->
                      <div class="carousel-inner">
                        <div class="item active">
                          <p>एक ऐसा नेटवर्क जो आपको आपके गाँव के साथ जोड़ता है</p>
                        </div>

                        <div class="item">
                           <p>एक ऐसा नेटवर्क जो आपको आपके गाँव के साथ जोड़ता है</p>
                        </div>
                      
                        <div class="item">
                           <p>एक ऐसा नेटवर्क जो आपको आपके गाँव के साथ जोड़ता है</p>
                        </div>
                      </div>
                    </div>
                  </div>
     
              <?php echo e(Html::image('public/img/think.png','man',array('class'=>'think'))); ?>

            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active one-tb"><a href="#Section1" aria-controls="home" role="tab" data-toggle="tab">LOGIN</a></li>
                    <li role="presentation" class="two-tb"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab">REGISTER</a></li> 
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="Section1">
                      <h1 class="hone">login</h1>
                
                        <form class="text-left" id="login_form"   method="POST" action="<?php echo e(route('login')); ?>">
                              <?php echo e(csrf_field()); ?>

                            <div class="alert alert-success" id="form-login-success" style="display: none"></div>
                            <div class="alert alert-danger" id="form-login-error" style="display: none"></div>
                              <?php $__currentLoopData = ['danger', 'warning', 'success', 'info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <?php if(Session::has($key)): ?>
                                   <p class="alert alert-<?php echo e($key); ?>"><?php echo e(Session::get($key)); ?></p>
                               <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <div class="main-login-form">
                            <div class="login-group">
                              <div class="form-group">
                                <label for="lg_username" class="sr-only">Mobile</label>
                                <input type="text" class="form-control" id="lg_username" name="mobile" placeholder="Mobile Number" >
                               <?php if($errors->has('mobile')): ?>
                                  <span class="help-block"> <strong><?php echo e($errors->first('mobile')); ?></strong> </span>
                                  <?php endif; ?>
                              </div>
                              <div class="form-group">
                                <label for="lg_password" class="sr-only">Password</label>
                                <input type="password" class="form-control" id="lg_password" name="password" placeholder="Password">
                                 <?php if($errors->has('password')): ?> <span class="help-block"> <strong><?php echo e($errors->first('password')); ?></strong></span> <?php endif; ?>
                              </div>
                             
                            </div>
                        <?php if(Session::has('message')): ?>
                        <p class="alert alert-info"><?php echo e(Session::get('message')); ?></p>
                        <?php endif; ?>


                         <button type="submit" class="login-button">submit</button>
                         <div class="clearfix"></div>
                          <br/>
                        <div class="fb"><a class="btn btn-primary btn-sm" href="<?php echo e(url('login/facebook')); ?>"><lable><span> <i class="fa fa-facebook" aria-hidden="true"></i></span>Sign in with Facebook</lable>
                              <div class="clear"></div></a>
                          </div>
                          
                          <div class="google"><a class="btn btn-primary btn-sm" href="<?php echo e(url('login/google')); ?>"><lable><span> <i class="fa fa-google-plus" aria-hidden="true"></i></span>Sign in with Google+</lable>
                              <div class="clear"></div></a>
                          </div>

                        <div class="etc-login-form">
                        <p> <a href="<?php echo e(url('/forgot')); ?>">forgot password?</a></p>
                      </div>

                         
                          </div>  
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="Section2">
                       <h1 class="hone">register</h1>
                       
                        <form class="text-left" role="form" id="registerForm" method="POST" action="<?php echo e(route('register')); ?>">
                            <?php echo e(csrf_field()); ?>

                          <div class="login-form-main-message"></div>
                          <div class="main-login-form">
                            <div class="login-group">
                              <div class="form-group">
                                <input type="text" class="form-control" id="rg_firstname" name="first_name" placeholder="First Name" >
                                   <span class="help-block"><strong id="register-errors-first_name"> </strong></span>
                              </div>

                                <div class="form-group">
                                <input type="text" class="form-control" id="rg_lastname" name="last_name" placeholder="Last name">
                                   <span class="help-block"><strong id="register-errors-last_name"> </strong></span>
                              </div>

                              <div class="form-group">
                                <input type="text" class="form-control" id="rg_mobile" name="mobile" placeholder="Mobile No">
                                <span class="help-block"><strong id="register-errors-mobile"> </strong></span>
                              </div>
                              <div class="form-group">
                                <input type="text" class="form-control" id="rg_email" name="email" placeholder="Email id">
                                <span class="help-block"><strong id="register-errors-email"> </strong></span>
                              </div>
                              <div class="form-group">
                                <input type="password" class="form-control" id="rg_password" name="password" placeholder="Password">
                                <span class="help-block"><strong id="register-errors-password"> </strong></span>
                              </div>
                              <div class="form-group">
                                <input type="password" class="form-control" id="rg_cpassword" name="password_confirmation" placeholder="Confirm Password">
                                <span class="help-block"><strong id="register-errors-password_confirmation"> </strong></span>
                              </div>
                              <span class="tm"><input type="checkbox" checked="checked" required="">  I agree to the terms and conditions</span>
                              
                               <div class="form-group" id="register-errors">
                                    <span class="help-block">
                                        <strong id="form-register-errors"></strong>
                                    </span>
                                </div>

                            </div>
                            <button type="submit" class="login-button">submit</button>
                          </div>

                        <br/>
                        <div class="fb"><a class="btn btn-primary btn-sm" href="<?php echo e(url('login/facebook')); ?>"><lable><span> <i class="fa fa-facebook" aria-hidden="true"></i></span>Sign in with Facebook</lable>
                              <div class="clear"></div></a>
                          </div>
                          <div class="google"><a class="btn btn-primary btn-sm" href="<?php echo e(url('login/google')); ?>"><lable><span> <i class="fa fa-google-plus" aria-hidden="true"></i></span>Sign in with Google+</lable>
                              <div class="clear"></div></a>
                          </div>
                    

                          <div class="etc-login-form">
                            <p>Already have an account ? <a href="<?php echo e(url('/')); ?>">SignIn</a></p>
                          </div>
                        </form>

                         <form class="text-left" role="form" id="otpForm" method="POST" action="<?php echo e(route('ragisterOtp')); ?>" style="display:none">
                            <?php echo e(csrf_field()); ?>

           
                            <div class="form-group" id="otp-errors">
                                    <span class="help-block">
                                        <strong id="form-otp-errors"></strong>
                                    </span>
                            </div>

                          <div class="main-login-form">
                            <div class="login-group">
                              <div class="form-group">
                                <input type="text" class="form-control" id="op_username" name="otp" placeholder="Enter OTP" >

                                <input type="hidden" id="otp_mobile" name="mobile" value="" >
                                
                              </div>
                              <div id="resend_otp" class="resend_otp">
                                <a onclick="resend_otp()" class="pointer"><span class="tm"> Resend Otp</span></a>
                               </div>

                            </div>
                            <button type="submit" class="login-button">submit</button>
                          </div>
                          <div class="etc-login-form">
                            <p>Already have an account ? <a href="<?php echo e(url('/')); ?>">SignIn</a></p>
                          </div>
                        </form>


                    </div>
                </div>
            </div>
            </div>
          </div>
        </div>
        
      </section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_script'); ?>
 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master_home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>