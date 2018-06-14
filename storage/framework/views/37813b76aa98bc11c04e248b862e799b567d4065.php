<div class="col-md-3 no-left-pdg">
	<div class="margin-top-<?php if(isset($dpage)): ?><?php echo e('10'); ?><?php else: ?><?php echo e('90'); ?><?php endif; ?>">
		<div class="right-section">
			

<?php if(isset($dpage)): ?>
<div class="recent-view">
	<div class="recent-img">

		<?php if(!empty($pimages[0])): ?>
		<?php echo e(Html::image('public/property_images/'.$pimages[0],'image',array('class'=>'img-responsive'))); ?>	
		<?php else: ?>
		<?php echo e(Html::image('public/property_images/default.png','image',array('class'=>'img-responsive'))); ?>

		<?php endif; ?>
		
	</div>
	<div class="recent-content">
		<p><i class="fa fa-user"></i>Ajay Sharma</p>
		<p><i class="fa fa-phone"></i> 21 000 00....</p>
		
	</div>
	<div class="clearfix"></div>
	<form action="" method="post" class="margin-top-30">
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Your Name" required="required">
		</div>
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Phone" required="required">
		</div> 
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Email" required="required">
		</div> 
		<div class="form-group">
			<textarea class="form-control" role="4" placeholder="Hello...."></textarea>
		</div> 
		<div class="form-group">
			<button type="submit" class="btn btn-primary btn-block custom-btn">Request Info</button>
		</div> 
		<div class="form-group">
			<button type="submit" class="btn btn-primary btn-block custom-border-btn">Send Direct Message</button>
		</div> 
	</form>
</div>
<?php endif; ?>
<div class="right-heading">
	<h4>Freatured Property</h4>
</div>

			<div class="slide-side">
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
				 <!-- Wrapper for slides -->
				  <div class="carousel-inner">
				  	<?php $fc=0?>
				  		<?php $__currentLoopData = $freatured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<a href="<?php echo e(url('/detail/'.$fre->url)); ?>"><div class="item <?php if($fc==0): ?>active <?php endif; ?>">
							
							<?php if(isset($img[0])): ?>
							 <?php echo e(Html::image('public/property_images/'.$img[0],'image',array('class'=>'img-responsive'))); ?>

							<?php else: ?>
							 <?php echo e(Html::image('public/property_images/default.jpg','image',array('class'=>'img-responsive'))); ?>	
							<?php endif; ?> 
						  <div class="produt-overlay">
								 <span class="btn btn-xs btn-info"><?php echo e($fre->name); ?></span>
								<span class="price-feature">$<?php echo e($fre->price); ?></span>
								<div class="over-icon">
									<ul>
										<li><a href="#"><i class="fa fa-camera"></i></a></li>
									</ul>
								</div>
							</div>
						</div></a>
						<?php $fc++;?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>		
					
				  </div>

				  <!-- Left and right controls -->
				  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
					<i class="fa fa-angle-left"></i>
					<span class="sr-only">Previous</span>
				  </a>
				  <a class="right carousel-control" href="#myCarousel" data-slide="next">
					<i class="fa fa-angle-right"></i>
					<span class="sr-only">Next</span>
				  </a>
				</div>
				 <!-- Indicators -->
				  <ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
					<li data-target="#myCarousel" data-slide-to="2"></li>
				  </ol>
			</div>
		</div>
		<div class="right-section">
			<div class="right-heading">
				<h4>Recently Property</h4>
			</div>
			<?php $__currentLoopData = $recently; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php $images= json_decode($rec->images);?>
		
			<div class="recent-view">
				<div class="recent-img"><a href="<?php echo e(url('detail/'.$rec->url)); ?>" >
				<?php if(isset($images[0])): ?>
				 <?php echo e(Html::image('public/property_images/'.$images[0],'image',array('class'=>'img-responsive'))); ?>

				<?php else: ?>
				 <?php echo e(Html::image('public/property_images/default.jpg','image',array('class'=>'img-responsive'))); ?>	
				<?php endif; ?></a>
				</div>
				<div class="recent-content">
					<p><a href="<?php echo e(url('detail/'.$rec->url)); ?>"><?php echo e($rec->name); ?></a></p>
					<p>$<?php echo e($rec->price); ?></p>
					<span>2 beds * 2 baths * 2150 Sq Ft</span>
					<span>Villa</span>
				</div>
			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		</div>
	</div>
</div>