<div class="search-filtter">
<div class="wrapper">
	<div class="row">    
		<div class="col-md-12">
			<form name="search" action="<?php echo e(url('search')); ?>">
			<div class="input-group">    
				<div class="form-select col-md-6 search-icon" >
					<input type="text" class="form-control serch-border" name="q" id="search_text" placeholder="Enter Keyword..."  autocomplete="off">
					<span><i class="fa fa-search"></i></span>
				</div>
				<div class="form-select col-md-2">
					<select class="form-control" name="city" id="city">
						<option selected="selected" value="all" >All cities</option>
						<?php $__currentLoopData = $citys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e($city->city); ?>"><?php echo e($city->city); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
				</div>
				<div class="form-select col-md-2"  >
					<select class="form-control" id="area" name="area">
						<option selected="selected" value="all">All areas</option>
					</select>
				</div>
				<div class="form-select col-md-2">
					<div class="dropdown">
    <button class="btn btn-default" type="button" id="menu1">Advance
    <span class="caret"></span></button>
    <ul class="dropdown-menu list-out" role="menu" aria-labelledby="menu1">
      <label for="sel1">Property Type</label>
      	<select class="form-control" name="type">
				<option selected="selected" value="">All </option>
				<option  value="buy">Buy</option>
				<option  value="sale">Sale</option>
		</select>
      <input class="prize-labal" type="number" name="price_from" placeholder="Min-Price">
  <input class="prize-labal" type="number" name="price_to" placeholder="Max-Price">
      <label for="sel1">Property Status</label>
      <select class="form-control" id="sel1" name="status">
        <option  value="active">Active</option>
		<option  value="inactive">Inactive</option>
      </select>
      
    </ul>
  </div>
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