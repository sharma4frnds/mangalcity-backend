<h1> Welcome To mangalcity</h1>
<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" >
				<?php echo e(csrf_field()); ?>

				<input type="submit" name="logout" value="logout">
				</form>