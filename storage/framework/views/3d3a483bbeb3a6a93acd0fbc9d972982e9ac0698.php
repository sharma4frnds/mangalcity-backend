<div class="search-filtter">
<div class="wrapper">
	<div class="row">    
		<div class="col-md-12">
			<form name="search" action="<?php echo e(url('search')); ?>">
			<div class="input-group">    
				<div class="form-select col-md-6 search-icon" >
					<input type="text" class="form-control serch-border" name="q" placeholder="Enter Keyword..." required="">
					<span><i class="fa fa-search"></i></span>
				</div>
				<div class="form-select col-md-2">
					<select class="form-control" name="city">
						<option selected="selected" value="all" >All cities</option>
						<?php $__currentLoopData = $citys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e($city->city); ?>"><?php echo e($city->city); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
				</div>
				<div class="form-select col-md-2" name="area">
					<select class="form-control">
						<option selected="selected" value="all">All areas</option>
					</select>
				</div>
				<div class="form-select col-md-2 search-icon advances-padding">
					<input type="text" class="form-control" id="inputWarning"  placeholder="Advanced">
					<span><i class="fa fa-cog"></i></span>
				</div>
				<span class="input-group-btn">
					<button class="btn btn-primary serch-border-right" type="submit">Go</button>
				</span>
			</div>
			</form>
		</div>
	</div>
</div>
</div>