
<?php $__env->startSection('title','world opportuniti'); ?>
<?php $__env->startSection('content'); ?>
<div class="right-side-contant light-bg">
<div class="content">
<?php echo $__env->make('search_panel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;
<div class="product-list">
	<div class="wrapper">
		<div class="row">
			<div class="col-md-12">
				<div class="nav-grid">
					<div class="row">
						<div class="col-md-9">
							<div class="page-link">
								<span><a href="<?php echo e(url('/')); ?>">Home</a> <i class="fa fa-angle-right"></i>
								<?php if(isset($property[0]->category->name)): ?> <a href="<?php echo e(url('category/'.$property[0]->category->url)); ?>"><?php echo e($property[0]->category->name); ?></a> <?php endif; ?>
								  <i class="fa fa-angle-right"></i> <?php echo e($property[0]->name); ?></span>
								<h4><?php if(isset($property[0]->category->name)): ?> <?php echo e($property[0]->category->name); ?> <?php endif; ?>

								<?php if($property[0]->freatured=='yes'): ?><span class="btn btn-xs btn-info">Featured</span>
								<?php elseif($property[0]->recently=='yes'): ?><span class="btn btn-xs btn-danger">Recently</span>
								<?php else: ?> <?php endif; ?>

								</h4>

								<p><?php echo e($property[0]->area); ?>, <?php echo e($property[0]->city); ?>, <?php echo e($property[0]->state); ?> <?php echo e($property[0]->pin); ?> , <?php echo e($property[0]->coumtry); ?> </p>
							</div>
						</div>
						<div class="col-md-3 text-right">
							<div class="detals-head-colmn">
								<div class="over-icon1">
									<ul>
										<li><a href="#"><i class="fa fa-share-alt"></i></a></li>
										<li><a href="#"><i class="fa fa-heart"></i></a></li>
										<li><a href="#"><i class="fa fa-print"></i></a></li>
									</ul>
								</div>
								<h4>$<?php echo e($property[0]->price); ?></h4>
								<h3><?php echo e($property[0]->property_size); ?>/Sq Ft</h3>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="row change">
					<div class="col-md-12">
						<div class="product-detals-slide">
							<div id='carousel-custom' class='carousel slide' data-ride='carousel'>
								<div class='carousel-outer'>
									<!-- me art lab slider -->
									<div class='carousel-inner'>
										<?php $pimages=json_decode($property[0]->images); $ci=0; ?>
										<?php if(!empty($pimages)): ?>
										<?php $__currentLoopData = $pimages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div class='item <?php if($ci==0): ?>active <?php endif; ?>' >
										<?php echo e(Html::image('public/property_images/'.$pimage,'image',array('class'=>'img-responsive','id'=>'zoom_05'))); ?>	
									
											<div class="produt-overlay">
												<div class="over-icon overlay-top">
													<ul>
														<li><a href="#"><i class="fa fa-camera"></i></a></li>
														<li><a href="#"><i class="fa fa-map"></i></a></li>
														<li><a href="#"><i class="fa fa-street-view"></i></a></li>
													</ul>
												</div>
											</div>
										</div>
										<?php $ci++;?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<?php else: ?>
										<?php echo e(Html::image('public/property_images/default.png','image',array('class'=>'img-responsive'))); ?>

										<?php endif; ?>
						
								<script>
							  $("#zoom_05").elevateZoom({ zoomType    : "inner", cursor: "crosshair" });
							</script>
									</div>

									<!-- sag sol -->
									<a class='left carousel-control' href='#carousel-custom' data-slide='prev'>
										<i class="fa fa-angle-left"></i>
									</a>
									<a class='right carousel-control' href='#carousel-custom' data-slide='next'>
										<i class="fa fa-angle-right"></i>
									</a>
								</div>

								<!-- thumb -->
								<ol class='carousel-indicators mCustomScrollbar meartlab'>
									<?php if(!empty($pimages)): ?>
									<?php $ti=0;?>
									<?php $__currentLoopData = $pimages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<li data-target='#carousel-custom' data-slide-to='<?php echo e($ti); ?> ?>' class='<?php if($ti): ?> active <?php endif; ?>'>
									<?php echo e(Html::image('public/property_images/'.$pimage,'image')); ?>

									<?php $ti++;?>
									</li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php endif; ?>
								</ol>
							</div>
						</div>
						<div class="product">
							<div class="description">
								<div class="des-head">
									<h4>Description</h4>
								</div>
								<div class="des-paragraph">
									<?php if(isset($property[0]->description->description)): ?>  <?php echo $property[0]->description->description; ?> <?php endif; ?>
								</div>
							</div>
						</div>
						<div class="product-detail-colmn">
							<div class="description">
								<div class="des-head">
									<h4>Schedule a tour</h4>
								</div>
								<div class="des-paragraph">
									<form action="" method="post">
										<div class="row margin-top-30">
											<div class="col-md-6">
												<div class="form-group">
													<label>Date</label>
													<input type="text" class="form-control date form_date" data-date-format="dd MM yyyy" placeholder="Select tour date" required="required">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Time</label>
													<input type="text" class="form-control form_time" data-date-format="hh:ii" placeholder="hh:ii" required="required">
												</div>
											</div>
										</div>
										<div class="des-head margin-top-30">
											<h4>Description</h4>
										</div>
										<div class="row margin-top-30">
											<div class="col-md-4">
												<div class="form-group">
													<input type="text" class="form-control" placeholder="Your Name" required="required">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<input type="text" class="form-control" placeholder="Phone" required="required">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<input type="text" class="form-control" placeholder="Email" required="required">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<textarea class="form-control" placeholder="Message" rows="5"></textarea>
												</div>
											</div>
										</div>
										
										<div class="form-group">
											<button type="submit" class="btn btn-primary custom-btn">Submit</button>
										</div>       
									</form>
								</div>
							</div>
						</div>
						<div class="product-detail-colmn">
							<div class="description">
								<div class="des-head">
									<h4>Address</h4>
									<span><a href="#">Open on Google Map <i class="fa fa-map-marker"></i></a></span>
								</div>
								<div class="des-paragraph">
									<ul>
										<li>Area: <span><?php echo e($property[0]->area); ?></span></li>
										<li>City: <span><?php echo e($property[0]->city); ?></span></li>
										<li>Zip/Postal Code: <span><?php echo e($property[0]->zip); ?></span></li>
									</ul>
								<div style="width: 100%"><iframe width="100%" height="400" src="https://maps.google.com/maps?width=100%&height=300&hl=en&q=<?php echo e($property[0]->area); ?>,<?php echo e($property[0]->city); ?>&ie=UTF8&t=&z=14&iwloc=B&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div><br />
								</div>
							</div>
						</div>
						<div class="product-detail-colmn">
							<div class="description">
								<div class="des-head">
									<h4>Details</h4>
									<!-- <span>Update on January 20,2018 7:27 pm</span> -->
								</div>
								<div class="des-paragraph">
									<div class="add-details">
										<ul>
											<li>Propery ID: <span><?php echo e($property[0]->property_id); ?></span></li>
											<li>Bathrooms: <span><?php echo e($property[0]->bathroom); ?></span></li>
											<li>Propery Type: <span><?php echo e($property[0]->category->name); ?></span></li>
											<li>Price: <span><?php echo e($property[0]->price); ?></span></li>
											<li>Garage: <span><?php echo e($property[0]->garage); ?></span></li>
											<li>Propery Size: <span><?php echo e($property[0]->property_size); ?> Sq Ft</span></li>
											<li>Garage Size: <span><?php echo e($property[0]->garage_size); ?> Sq Ft</span></li>
											<li>Bathroom: <span><?php echo e($property[0]->bedroom); ?></span></li>
											<li>Year Build: <span><?php echo e($property[0]->year_built); ?></span></li>
										</ul>
										<ul>
											<li>Area: <span><?php echo e($property[0]->area); ?></span></li>
											<li>City: <span><?php echo e($property[0]->city); ?></span></li>
											<li>Zip/Postal Code: <span><?php echo e($property[0]->zip); ?></span></li>
										</ul>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="des-head margin-top-30">
									<h4>Additional Details</h4>
								</div>
								<div class="des-paragraph">
								 <?php if(isset($property[0]->description->detail)): ?> <?php echo $property[0]->description->detail; ?> <?php endif; ?>
								</div>
							</div>
						</div>
						<div class="product-detail-colmn">
							<div class="description">
								<div class="des-head">
									<h4>Features</h4>
								</div>
								<div class="des-paragraph">
								<?php if(isset($property[0]->description->feature)): ?>  <?php echo $property[0]->description->feature; ?>  <?php endif; ?>
								</div>
							</div>
						</div>
						<div class="product-detail-colmn">
							<div class="description">
								<div class="des-head">
									<h4>Video</h4>
								</div>
								<div class="des-paragraph">
								<?php echo $property[0]->vedio; ?>

								</div>
							</div>
						</div>
					</div>
	

					<?php $__currentLoopData = $freatured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pfreatured): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="col-md-12">
						<div class="product">
							<div class="col-md-4">
								<div class="pro-img">
									<?php $pfimages=json_decode($pfreatured->images); ?>
									<?php if(!empty($pfimages[0])): ?>
									<?php echo e(Html::image('public/property_images/'.$pfimages[0],'image',array('class'=>'img-responsive'))); ?>

									<?php else: ?>
									<?php echo e(Html::image('public/property_images/default.png','image',array('class'=>'img-responsive'))); ?>

									<?php endif; ?>
									<div class="produt-overlay">

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
										
										<h4><?php echo e($pfreatured->name); ?></h4>
									</div>
									<div class="price text-right">
										<h4>$<?php echo e($pfreatured->price); ?></h4>
										
									</div>
									<div class="clearfix"></div>
									<p class="location"><?php echo e($pfreatured->area); ?>, <?php echo e($pfreatured->city); ?></p>
									<div class="feature-property">
										<ul>
											<li>Beds:<span><?php echo e($pfreatured->bedroom); ?></span></li>
											<li>Baths:<span><?php echo e($pfreatured->bathroom); ?></span></li>
											<li>Sq Ft:<span><?php echo e($pfreatured->property_size); ?></span></li>
										</ul>
									</div>
									<p class="type-apartment">Single Family House</p>
									<div class="timing-product">
										<div class="timing-detal">
											<ul>
												<li><i class="fa fa-user"></i>All Americal Real Estate</li>
												<li><i class="fa fa-calendar"></i>Built <?php echo e($pfreatured->year_built); ?></li>
											</ul>
										</div>
										<div class="product-detal-btn text-right">
											<a href="<?php echo e(url('/detail/'.$pfreatured->url)); ?>" class="btn-detail btn-info">Details<i class="fa fa-angle-right"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


				
				</div>
			</div>
			<?php echo $__env->make('right_panel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;
		</div>
	</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_script'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>