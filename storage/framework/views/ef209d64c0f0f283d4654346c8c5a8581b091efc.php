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
       <?php 
     
      
      //  Session::forget('key');
      //  Session::forget('clocation');
      //  Session::flush('clocation');
      //   $clocation=Session::get('clocation');
      //  print_r($clocation); exit;
      
      // if (Session::has('clocation'))
      // {
      //   $clocation=Session::get('clocation');
      //   print_r($clocation);
      //     echo 'test'; exit;
      // }
      //  exit;
       ?>

       <?php if(Session::has('clocation')): ?>
       <?php  $clocation=Session::get('clocation');  print_r($clocation);?>
       <?php if($clocation['no_of_location']==2): ?>
        <?php if($clocation['current_location']=='home'): ?>
        <a href="<?php echo e(url('change_location')); ?>"> <button type="button" class="btn hme btn-warning">switch to <?php echo e($clocation['current_city']); ?> location</button></a>
       
        <?php else: ?>
        <a href="<?php echo e(url('change_location')); ?>"> <button type="button" class="btn hme btn-warning">switch to <?php echo e($clocation['home_city']); ?> location</button></a>
        <?php endif; ?>
        <?php endif; ?>
        <?php endif; ?>
</div>  