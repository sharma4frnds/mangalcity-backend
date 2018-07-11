<div class="col-md-4 col-sm-3 col-xs-12">
      <div class="profile">

          <div class="pro">
          	<a href="<?php echo e(url('profile/'.Auth::user()->url)); ?>"><?php echo e(Html::image('public/images/user/'.Auth::user()->image)); ?></a>
          </div> 
          <h4><a href="<?php echo e(url('profile/'.Auth::user()->url)); ?>"><?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?> </a></h4>
         <p><a href="<?php echo e(url('home')); ?>">Home</a></p>
          <p><a href="<?php echo e(url('activity')); ?>">Activity Log</a></p>
          <p><a href="<?php echo e(url('user/profile')); ?>">Update Profile</a></p>
          <p><a href="<?php echo e(url('user/change_password')); ?>">Change Password</a></p>
          <p><a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" > Logout </a>
          </p>

          <form id="frm-logout" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
              <?php echo e(csrf_field()); ?>

          </form>

      </div>
       <?php $home_location=Session::get('home_location'); print_r($home_location); ?>
       <?php if($home_location): ?>
        <a href="<?php echo e(url('change_location')); ?>"> <button type="button" class="btn hme btn-warning">switch to Current location</button></a>
        <?php else: ?>
         <a href="<?php echo e(url('change_location')); ?>"> <button type="button" class="btn hme btn-warning">switch to home location</button></a>
        <?php endif; ?>
</div>  