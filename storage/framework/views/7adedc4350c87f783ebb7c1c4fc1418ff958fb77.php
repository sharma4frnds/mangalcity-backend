<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   <title>
        <?php $__env->startSection('title'); ?> Mangalcity  <?php echo $__env->yieldSection(); ?>
    </title>
    <!-- Bootstrap -->
    <?php echo e(Html::style('public/admin/bootstrap/dist/css/bootstrap.min.css')); ?>

    
    <!-- Font Awesome -->
    <?php echo e(Html::style('public/admin/font-awesome/css/font-awesome.min.css')); ?>

    
    <!-- NProgress -->
     <?php echo e(Html::style('public/admin/nprogress/nprogress.css')); ?>

    
    <!-- iCheck -->
     <?php echo e(Html::style('public/admin/iCheck/skins/flat/green.css')); ?>

    
    <!-- bootstrap-progressbar -->
     <?php echo e(Html::style('public/admin/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')); ?>

    
  
    <!-- Custom Theme Style1 -->
     <?php echo e(Html::style('public/admin/build/css/custom.min.css')); ?>

     <?php echo e(Html::style('public/admin/build/css/custom.css')); ?>


    <!--page level css-->
    <?php echo $__env->yieldContent('header_styles'); ?>
    <!--end of page level css-->

     <meta id="token" name="token" content="<?php echo e(csrf_token()); ?>">
     </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo e(url('admin/dashboard')); ?>" class="site_title"><i class="fa fa-paw"></i> <span>Mangalcity </span></a>
            </div>

            <div class="clearfix"></div>

          

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3></h3>
                <ul class="nav side-menu">
                  <li><a href="<?php echo e(URL::to('admin/dashboard')); ?>"><i class="fa fa-home"></i> Home </a>  </li>
                  <li><a><i class="fa fa-edit"></i> Setting <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(url('admin/tags')); ?>">Tags</a></li>
                   
                    </ul>
                  </li>

                  <li><a><i class="fa fa-user"></i>User Management <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo e(url('admin/users')); ?>">User List </a></li>
                    </ul>
                  </li>


                    <li><a><i class="fa fa-building"></i> Feedback <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                      <li><a href="<?php echo e(url('admin/feedback ')); ?>">Feedback</a></li>

                      </ul>
                    </li>

                    <li><a><i class="fa fa-file"></i> Add City <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                      <li><a href="<?php echo e(url('admin/city')); ?>">City</a></li>

                      </ul>
                    </li>
              
               
                </ul>
              </div>
            
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

                    Admin
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li>
                         <a href="<?php echo e(route('logout')); ?>"
                              onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                              <i class="fa fa-sign-out pull-right"></i>Logout
                          </a>

                          <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                              <?php echo e(csrf_field()); ?>

                          </form>

                    </li>
                  </ul>
                </li>

              
              </ul>
            </nav>
          </div>
        </div>

  <!-- page content -->

<?php echo $__env->yieldContent('content'); ?>
    <!-- /page content -->





        <!-- footer content -->
        <footer>
          <div class="pull-right">
             <a href="#">mangalcity</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
     <?php echo e(Html::script('public/admin/jquery/dist/jquery.min.js')); ?>

        <!-- Bootstrap -->
     <?php echo e(Html::script('public/admin/bootstrap/dist/js/bootstrap.min.js')); ?>

    
   
        <!-- NProgress -->
    <?php echo e(Html::script('public/admin/nprogress/nprogress.js')); ?>


    
    <!-- bootstrap-progressbar -->
    <?php echo e(Html::script('public/admin/bootstrap-progressbar/bootstrap-progressbar.min.js')); ?>

   
    <!-- iCheck -->
    <?php echo e(Html::style('public/admin/iCheck/icheck.min.js')); ?>

        <!-- JQVMap -->

        <!-- bootstrap-daterangepicker -->
    <?php echo e(Html::script('public/admin/js/datepicker/daterangepicker.js')); ?>

    <?php echo e(Html::script('public/admin/js/moment/moment.min.js')); ?>

   
    <!-- Custom Theme Scripts -->
    <?php echo e(Html::script('public/admin/build/js/custom.min.js')); ?>



    <!-- Flot -->
  <script type="text/javascript">
    $(document).ready(function() 
    { 
        $(document).ajaxStart(function() {
            $("#loader").css("display","block"); 
        }).ajaxSuccess(function() { 
             $("#loader").css("display","none");
        });     
     
});
</script>

<!-- ajax Tokan -->
    <script type="text/javascript">
      $(document).ready(function() { 
      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
        }
      });
      });
    </script>

<!-- LOADER HTML -->

    <div id="loader" style="display:none;">
        <div class="loader_innner">
             <?php echo e(Html::image('public/images/ajax-loader.gif')); ?>

        </div>
    </div>
<!--End LOADER HTML -->
     <?php echo $__env->yieldContent('footerscript'); ?>
  </body>
</html>
   <!-- /top navigation -->