<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style.css">
 <meta name="base-url" content="<?php echo e(url('/')); ?>">
 <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <?php echo e(Html::style('public/css/style.css')); ?>

  <?php echo e(Html::style('public/css/owl.carousel.css')); ?>

  <?php echo e(Html::style('public/css/owl.theme.css')); ?>

  <?php echo e(Html::style('public/css/owl.transitions.css')); ?>



<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title><?php echo $__env->yieldContent('title'); ?></title>
<?php echo $__env->yieldContent('header_css'); ?>
</head>
<body>
<!-- main-content -->
<div id="main-content">
	<!-- top-header -->
	<section class="top-header">
		<div class="container">
			<div class="col-50">
				<p><i class="fa fa-phone" aria-hidden="true"></i> + 91 90488 33 222</p>
			</div>
			<div class="col-50">
			<div class="right-flt">
				<ul class="social-media-top"> 
				<li> <a href="#"><i class="fa fa-facebook"></i></a></li>
				<li> <a href="#"><i class="fa fa-twitter"></i></a></li> 
				<li> <a href="#"><i class="fa fa-google-plus"></i></a></li>
				<li> <a href="#"><i class="fa fa-linkedin"></i></a></li> 
				</ul>
				<ul class="login-top"> 
				<li> <a href="#"><i class="fa fa-globe"></i></a>
					<select class="countries" name="countries">	
						<option value="India">India</option> 
						<option value="United States">United States</option> 
					</select>
				</li>

				<?php if(Route::has('login')): ?>
				<?php if(auth()->guard()->check()): ?>
				<li><a href="#"><?php echo e(ucfirst(Auth::user()->first_name)); ?></a></li>
					<li><a href="<?php echo e(route('logout')); ?>"  onclick="event.preventDefault();  document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>

				<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
				<?php echo e(csrf_field()); ?>

				</form></li>
				<?php else: ?>
				<li><a href="<?php echo e(url('login')); ?>"><i class="fa fa-sign-in"></i>Login</a></li>
				
				<?php endif; ?>
				<?php endif; ?>			
				</ul>
			</div>
			</div>
		</div>
	</section> 
	<div class="cl"></div>
	<!-- top-header -->
	<!-- top-header -->
	<section class="mid-header">
		<div class="container">
			<div class="col-50">
				<div class="logo"><?php echo e(Html::image('public/img/logo.png','logo')); ?></div>
			</div>
			<div class="col-50">
				<nav class="menu">
					<ul>
						<li><a href="#">home</a></li>
						<li><a href="#">astrologers</a></li>
						<li><a href="#">textmonial</a></li>
						<li><a href="#">articles</a></li>
						<li><a href="#">sign up</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</section> 
	<div class="cl"></div>
	<!-- top-header -->
		<!-- Content -->
		<?php echo $__env->yieldContent('content'); ?>

		<!-- End Content -->

		<div class="cl"></div>
		<footer>
			<div class="container">
				<div class="col-30">
					<h5>About Us</h5>
					<div class="line"></div>
					<p>Making it look like readable English.The point of using Lorem Ipsum is that it has a more-or less normal distribution of letters.</p>
					<img class="app" src="img/app.jpg" alt="app" />
				</div>
				<div class="col-20 change-text">
					<h5>Our Services</h5>
					<div class="line"></div>
					<p>Home</p>
					<p>Astrologers</p>
					<p>Articles</p>
					<p>sign Up</p>
				</div>
				<div class="col-20 change-text">
					<h5>Quick Links</h5>
					<div class="line"></div>
					<p>Home</p>
					<p>Astrologers</p>
					<p>Articles</p>
					<p>sign Up</p>
				</div>
				<div class="col-30 change-text">
					<h5>Get In Touch</h5>
					<div class="line"></div>
						<p><i class="fa fa-home" aria-hidden="true"></i> 2794, Astrologers MI 48302</p>
						<p><i class="fa fa-envelope" aria-hidden="true"></i> info@astrologers.com</p>
						<p><i class="fa fa-phone" aria-hidden="true"></i> +91 9048833 222</p>
					
				</div>
			</div>
			
		</footer>
		<div class="cl"></div>
		<div class="copyright">© Copyright 2018, All Rights Reserved, Astrology</div>
</div>
<!-- main-content -->
<script type="text/javascript" src="<?php echo e(asset('public/js/jquery-1.9.1.min.js')); ?>"></script>


<?php echo $__env->yieldContent('footer_script'); ?>


</body>
</html>