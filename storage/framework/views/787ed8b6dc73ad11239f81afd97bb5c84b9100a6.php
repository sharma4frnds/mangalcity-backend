<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $__env->yieldContent('title'); ?></title>
    <meta name="base-url" content="<?php echo e(url('/')); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width">

	<link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo e(asset('favicon/apple-icon-60x60.png')); ?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo e(asset('favicon/apple-icon-72x72.png')); ?> ">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo e(asset('favicon/apple-icon-76x76.png')); ?> ">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo e(asset('favicon/apple-icon-114x114.png')); ?> ">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo e(asset('favicon/apple-icon-120x120.png')); ?> ">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo e(asset('favicon/apple-icon-144x144.png')); ?> ">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo e(asset('favicon/apple-icon-152x152.png')); ?> ">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('favicon/apple-icon-180x180.png')); ?> ">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo e(asset('favicon/android-icon-192x192.png')); ?> ">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('favicon/favicon-32x32.png')); ?> ">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo e(asset('favicon/favicon-96x96.png')); ?> ">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('favicon/favicon-16x16.png')); ?> ">

    <?php echo e(Html::style('public/css/bootstrap.css')); ?>

    <?php echo e(Html::style('public/css/bootstrap-theme.css')); ?>

    <?php echo e(Html::style('public/css/world-style.css')); ?>

    <?php echo e(Html::style('public/css/reset.css')); ?>

    <?php echo e(Html::style('public/css/fontface/font.css')); ?>


	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<?php echo $__env->yieldContent('header_css'); ?>
</head>
<body>
	<header>
		<div class="top-header">
			<div class="box">
			<div class="row">
				<div class="col-md-6">
					<nav>
						<ul>
							<?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<li><a href="<?php echo e(url('page/'.$page->url)); ?>"><?php echo e(ucfirst($page->name)); ?></a></li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</ul>
					</nav>
				</div>
				<div class="col-md-6 text-right">
					<nav>
						<ul class="register">
							<?php if(Route::has('login')): ?>
							<?php if(auth()->guard()->check()): ?>
							<li><a href="#"><?php echo e(ucfirst(Auth::user()->first_name)); ?></a></li>
						  	<li><a href="<?php echo e(route('logout')); ?>"  onclick="event.preventDefault();  document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                    
	                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
	                        <?php echo e(csrf_field()); ?>

	                        </form></li>
	                        <?php else: ?>
	                        <li><a href="<?php echo e(url('login')); ?>">Login</a></li>
							<li><a href="<?php echo e(url('register')); ?>">Register</a></li>
	                       <?php endif; ?>
						  <?php endif; ?>
						</ul>
						<ul class="social pull-right">
							<li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook-f"></i></a></li>
							<li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-twitter"></i></a></li>
							<li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-linkedin"></i></a></li>
							<li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-youtube"></i></a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
		</div>
	</header>
	<div class="page-contant">
		<div class="left-side-menu relative-fix">
			<div class="sidbar-fix">
				<div class="logo"><a href="<?php echo e(url('/')); ?>"><?php echo e(Html::image('public/images/logo.png','logo',array('class'=>'img-responsive'))); ?> </a></div>
				<menu>
				<ul>
					<li><a href="<?php echo e(url('/')); ?>">Home</a></li>
					<?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<li><a href="<?php echo e(url('category/'.$cat->url)); ?>"><?php echo e($cat->name); ?></a></li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul>
			</menu>
			</div>
		</div>
		<!-- Content -->
		<?php echo $__env->yieldContent('content'); ?>

		<!-- End Content -->
		<footer>
        <div class="box-footer">
            <div class="row">
                <div class="col-md-4">
                    <h4>About Us</h4>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                </div>
                <div class="col-md-4">
                    <h4>Our Offer</h4>
                    <ul class="offer">
                        <li>Lorem Ipsum is simply dummy text</li>
                        <li>Lorem Ipsum is simply dummy text</li>
                        <li>Lorem Ipsum is simply dummy text</li>
                        <li>Lorem Ipsum is simply dummy text</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4>Our Address</h4>
                    <div class="addresss-icon">
   
                        <?php echo e(Html::image('public/images/location-icon.png','',array('class'=>'img-responsive'))); ?>

                        <span>C - 28, Ground Floor, Sector - 2, Noida, Uttar Pradesh, INDIA. 201301</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="footer-bottom">
        <div class="box-footer">
            <div class="row">
            <div class="col-md-8">
                <p>All content © 2018. All rights reserved. Develop By <a href="#">Clamour Technologies</a></p>
            </div>
            <div class="col-md-4 text-right">
                <a href="#" class="scrollToTop"><i class="fa fa-angle-up"></i></a>
            </div>
        </div>
        </div>
    </div>
	</div>
	</div>
	<script type="text/javascript" src="<?php echo e(asset('public/js/jquery-3.3.1.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('public/js/bootstrap.min.js')); ?>"></script>
	<?php echo $__env->yieldContent('footer_script'); ?>