<?php $__env->startSection('title','world opportuniti'); ?>
<?php $__env->startSection('content'); ?>
<div class="right-side-contant">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="http://world-opportunities.com/public/images//bnr1.jpg">
      </div>

      <div class="item">
       <img src="http://world-opportunities.com/public/images//bnr2.jpg">
      </div>
    
      <div class="item">
        <img src="http://world-opportunities.com/public/images//bnr3.jpg">
      </div>
    </div>

    
  </div>
    <div class="content text-center home-bg">

        <div class="icon-logo">
        <?php echo e(Html::image('public/images//logo-icon.png')); ?>

     </div>
        <div class="welcome">
        <h2>Welcome to the</h2>
        <h2>World of Opportunities</h2>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        <a href="#our-services"><div class="downArrow bounce"><?php echo e(Html::image('public/images/down-icon.png')); ?> </div></a>
    </div>
    </div>
    <div class="content text-center services-bg" id="our-services">
        <div class="services">
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
            <h2>Our Services</h2>
            <div class="services-colmn text-center">
                <div class="col-md-12">
                    <div class="colmn-serv serv-colmn">
                        <a href="category/real-estate">
                            <div class="icon-box">
                                 <?php echo e(Html::image('public/images/real-estate.png','',array('class'=>'img-responsive'))); ?>

                            </div>
                            <h4>Real Estate</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                        </a>
                    </div>
                    <div class="colmn-serv serv-colmn">
                        <a href="category/hospitality">
                            <div class="icon-box">
                                <?php echo e(Html::image('public/images/hospitality.png','',array('class'=>'img-responsive'))); ?>

                            </div>
                            <h4>Hospitality</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                        </a>
                    </div>
                    <div class="colmn-serv serv-colmn">
                        <a href="category/construction">
                            <div class="icon-box">
                                <?php echo e(Html::image('public/images/construction.png','',array('class'=>'img-responsive'))); ?>

                            </div>
                            <h4>Construction</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                        </a>
                    </div>
                    <div class="colmn-serv serv-colmn">
                        <a href="category/scrap-metals">
                            <div class="icon-box">
                                 <?php echo e(Html::image('public/images/scrap-metal.png','',array('class'=>'img-responsive'))); ?>

                            </div>
                            <h4>Scrap Metals</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                        </a>
                    </div>
                    <div class="colmn-serv serv-colmn">
                        <a href="category/factories">
                            <div class="icon-box">
                                <?php echo e(Html::image('public/images/factories.png','',array('class'=>'img-responsive'))); ?>

                            </div>
                            <h4>Factories</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                        </a>
                    </div>
                    <div class="colmn-serv serv-colmn">
                        <a href="category/franchise">
                            <div class="icon-box">
                                <?php echo e(Html::image('public/images/franchise.png','',array('class'=>'img-responsive'))); ?>

                            </div>
                            <h4>Franchise</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                        </a>
                    </div>
                    <div class="colmn-serv serv-colmn">
                        <a href="category/other">
                            <div class="icon-box">
                                <?php echo e(Html::image('public/images/other.png','',array('class'=>'img-responsive'))); ?>

                            </div>
                            <h4>Others</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_script'); ?>
<script>
$(document).ready(function(){
  $("a").on('click', function(event) {
    if (this.hash !== "") {
      event.preventDefault();
      var hash = this.hash;
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
        window.location.hash = hash;
      });
    } 
  });
});
    </script>
    <script>
$(document).ready(function(){
    $(".selected").click(function(){
        $(".selected1").hide();
    });
    $(".selected").click(function(){
        $(".selected1").show();
    });
});
</script>
<script>
$(document).ready(function(){
    $("#menu1").click(function(){
        $(".list-out").toggle();
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>