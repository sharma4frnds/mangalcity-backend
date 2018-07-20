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
                       
                        <form class="text-left" role="form" id="forget_password" name="forget_password" method="POST" >
                          <div class="login-form-main-message"></div>
                          <div class="main-login-form">
                            <div class="login-group">
                              <div class="form-group">
                                <label for="lg_mobile" class="sr-only">Mobile No</label>
                                <input type="text" class="form-control" id="lg_mobile" name="lg_mobile" placeholder="Mobile number" value="">
                                <span class="help-block"><strong id="forget-errors-mobile"> </strong></span>
                              </div>
                                                          
                            </div>
                         
                             <button type="submit" class="login-button" id="s">Send</button>
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