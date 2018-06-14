
<?php $__env->startSection('title','world opportuniti'); ?>
<?php $__env->startSection('content'); ?>
<div class="right-side-contant light-bg">
<div class="content">
<?php echo $__env->make('search_panel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;
<div class="product-list">
	<div class="wrapper">
		<div class="row">
			<div class="col-md-9">
				<div class="nav-grid">
					<div class="row">
						<div class="col-md-12">
							<div class="page-link">
								<span><a href="<?php echo e(url('/')); ?>">Home</a> <i class="fa fa-angle-right"></i> <?php echo e($pageCategory->name); ?></span>
							</div>
						</div>
						<div class="col-md-12 text-right">
							<h3><?php echo e($pageCategory->name); ?></h3>
							<ul>
								<li><a href="javascript:void(0)" class="list"><i class="fa fa-th-large"></i></a></li>
								<li><a href="javascript:void(0)" class="row"><i class="fa fa-columns"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				
				<div class="row change">
				 <?php $__empty_1 = true; $__currentLoopData = $property; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
				<?php $images= json_decode($pro->images);?>
					<div class="col-md-12">
						<div class="product">
							<div class="col-md-4">
								<div class="pro-img">
								<?php if(isset($images[0])): ?>
								<?php echo e(Html::image('public/property_images/'.$images[0],'image',array('class'=>'img-responsive'))); ?>

								<?php else: ?>
								<?php echo e(Html::image('public/property_images/default.png','image',array('class'=>'img-responsive'))); ?>	
								<?php endif; ?>
									<div class="produt-overlay">
									<?php if($pro->freatured=='yes'): ?><span class="btn btn-xs btn-info">Featured</span>
									<?php elseif($pro->recently=='yes'): ?><span class="btn btn-xs btn-danger">Recently</span>
									<?php else: ?> <?php endif; ?>

										<div class="over-icon">
											<ul>
												<li><a href="#"><i class="fa fa-heart"></i></a></li>
												<li><a href="#"><i class="fa fa-camera"></i></a></li>
												<li><a href="#"><i class="fa fa-plus"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-8">
								<div class="pro-list-desc">
									<div class="sale">
									<?php if($pro->freatured=='yes'): ?><span class="btn btn-xs btn-info">Featured</span>
									<?php elseif($pro->recently=='yes'): ?><span class="btn btn-xs btn-danger">Recently</span>
									<?php else: ?> <?php endif; ?>
										<h4><?php echo e($pro->name); ?></h4>
									</div>
									<div class="price text-right">
										<h4>$<?php echo e($pro->price); ?></h4>
										<span>$1,0000</span>
									</div>
									<div class="clearfix"></div>
									<p class="location"><?php echo e($pro->area); ?>, <?php echo e($pro->city); ?></p>
									<div class="feature-property">
										<ul>
											<li>Beds:<span><?php echo e($pro->bedroom); ?></span></li>
											<li>Baths:<span><?php echo e($pro->bathroom); ?></span></li>
											<li>Sq Ft:<span><?php echo e($pro->property_size); ?> </span></li>
										</ul>
									</div>
									<p class="type-apartment">Single Family House</p>
									<div class="timing-product">
										<div class="timing-detal">
											<ul>
												 <li><i class="fa fa-user"></i>All Americal Real Estate</li> 
												<li><i class="fa fa-calendar"></i>Built <?php echo e($pro->year_built); ?></li>
											</ul>
										</div>
										<div class="product-detal-btn text-right">
											<a href="<?php echo e(url('detail/'.$pro->url )); ?>" class="btn-detail btn-info">Details<i class="fa fa-angle-right"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
					<div class="clearfix"></div> <br/>
					<h3>Oh Snap! Zero Results found for your search.</h3>
					<?php endif; ?>

				</div>
			</div>
			<?php echo $__env->make('right_panel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;
		</div>
	</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_script'); ?>
<script>
$(document).ready(function(){
	$('.nav-grid li a.list').click(function(){
		$('.change .col-md-12').addClass('col-md-6 listing');
		$('.change .col-md-4').css({'width':'100%', 'padding':'0px'});
		$('.change .col-md-8').css({'width':'100%', 'padding':'0px'});
	});
	$('.nav-grid li a.row').click(function(){
		$('.change .col-md-12').removeClass('col-md-6 listing');
		$('.change .col-md-4').css({'width':'', 'padding':''});
		$('.change .col-md-8').css({'width':'', 'padding':''});
	});
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>