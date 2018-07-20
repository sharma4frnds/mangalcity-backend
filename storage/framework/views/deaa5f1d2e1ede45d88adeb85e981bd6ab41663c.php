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
                          <p>एक एसा नेटवर्क जो आपको आपके गाओ के साथ जोधता है</p>
                        </div>

                        <div class="item">
                           <p>एक एसा नेटवर्क जो आपको आपके गाओ के साथ जोधता है</p>
                        </div>
                      
                        <div class="item">
                           <p>एक एसा नेटवर्क जो आपको आपके गाओ के साथ जोधता है</p>
                        </div>
                      </div>
                    </div>
                  </div>
     
              <?php echo e(Html::image('public/img/think.png','man',array('class'=>'think'))); ?>

            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
          
                <!-- Tab panes -->
                <div class="tab-content">
          
                 <!-- Tab panes -->
                <div class="tab-content forgt">
                    <div role="tabpanel" class="tab-pane active" id="Section1">
                      <h1 class="hone"><span class="no-text">Please enter your mobile number</span></h1>

                        <?php if(Session::has('message')): ?>
                        <div class="alert alert-danger alert-dismissible"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <?php echo e(Session::get('message')); ?>

                          </div>
                        <?php endif; ?>
<form class="cmxform" id="commentForm" method="get" action="">
  <fieldset>
    <legend>Please provide your name, email address (won't be published) and a comment</legend>
    <p>
      <label for="cname">Name (required, at least 2 characters)</label>
      <input id="cname" name="name" minlength="2" type="text" required>
    </p>
    <p>
      <label for="cemail">E-Mail (required)</label>
      <input id="cemail" type="email" name="email" required>
    </p>
    <p>
      <label for="curl">URL (optional)</label>
      <input id="curl" type="url" name="url">
    </p>
    <p>
      <label for="ccomment">Your comment (required)</label>
      <textarea id="ccomment" name="comment" required></textarea>
    </p>
    <p>
      <input class="submit" type="submit" value="Submit">
    </p>
  </fieldset>
</form>
                      
                        <form class="cmxform" id="commentForm1" method="get" action="">
                          <div class="login-form-main-message"></div>
                          <div class="main-login-form">
                            <div class="login-group">
                              <div class="form-group" id="lg_mobile_div">
                                <label for="lg_mobile" class="sr-only">Mobile No</label>
                                <input type="text" class="form-control" id="sl_mobile" name="sl_mobile" placeholder="Mobile number" value="" required="">
                              </div>

                              <div class="form-group" id="lg_otp_div" style="display:none;">
                                <label for="lg_mobile" class="sr-only">  Enter otp</label>
                                <input type="text" class="form-control" id="sl_otp" name="sl_otp" placeholder="OTP" value="">
                              </div>
                                                          
                            </div>
                               <button type="submit" >Submit1</button>
                              <button type="button" class="login-button" id="social_resendotp">Submit</button>
                              <button type="button" class="login-button" id="social_submit_otp" style="display:none;">Submit</button>
                             <br><br>
                            <a href="<?php echo e(url('login')); ?>" class="forget"> Sign in here</a>
                          </div>  
                        </form>
                    </div>
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