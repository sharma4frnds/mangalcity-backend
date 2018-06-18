<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mangalcity</title>

    <!-- Bootstrap -->
    
    <?php echo e(Html::style('public/admin/bootstrap/dist/css/bootstrap.min.css')); ?>

    <!-- Font Awesome -->
    
    <?php echo e(Html::style('public/admin/font-awesome/css/font-awesome.min.css')); ?>

    <!-- NProgress -->
        <?php echo e(Html::style('public/admin/nprogress/nprogress.css')); ?>

    <!-- Animate.css -->
    
    <!-- Custom Theme Style -->
    
    <?php echo e(Html::style('public/admin/build/css/custom.min.css')); ?>

  </head>

  <body class="login" style="right: 0px; margin: 0px auto; margin-top: 5%;">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo e(HTML::image('public/img/logo.png')); ?></div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo e(csrf_field()); ?>

     
                        <div class="clearfix"></div>
                        <br/>
                        <br/>
                        <div class="form-group<?php echo e($errors->has('mobile') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">Phone</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="mobile" value="<?php echo e(old('mobile')); ?>" required autofocus>

                                <?php if($errors->has('mobile')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('mobile')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>
  </body>


</html>