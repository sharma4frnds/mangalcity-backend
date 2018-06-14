<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <title>admin </title>

    {{ Html::style('public/admin/bootstrap/dist/css/bootstrap.min.css') }}
    
    <!-- Font Awesome -->
    {{ Html::style('public/admin/font-awesome/css/font-awesome.min.css') }}
    
    <!-- NProgress -->
     {{ Html::style('public/admin/nprogress/nprogress.css') }}
    
    <!-- iCheck -->
     {{ Html::style('public/admin/iCheck/skins/flat/green.css') }}
    
    <!-- bootstrap-progressbar -->
     {{ Html::style('public/admin/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}
    
  
    <!-- Custom Theme Style1 -->
     {{ Html::style('public/admin/build/css/custom.min.css') }}
     {{ Html::style('public/admin/build/css/custom.css') }}
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- page content -->
        <div class="col-md-12">
          <div class="col-middle">
            <div class="text-center">
              <h1 class="error-number">500</h1>
              <h2>Internal Server Error</h2>
              <p>We track these errors automatically, but if the problem persists feel free to contact us. In the meantime, try refreshing. <a href="#">Report this?</a>
              </p>
              <div class="mid_center">
                <h3>Search</h3>
                <form>
                  <div class="col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Search for...">
                      <span class="input-group-btn">
                              <button class="btn btn-default" type="button">Go!</button>
                          </span>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
      </div>
    </div>

    <!-- jQuery -->
     {{ Html::script('public/admin/jquery/dist/jquery.min.js') }}
        <!-- Bootstrap -->
     {{ Html::script('public/admin/bootstrap/dist/js/bootstrap.min.js') }}
    
   
        <!-- NProgress -->
    {{ Html::script('public/admin/nprogress/nprogress.js') }}

    
    <!-- bootstrap-progressbar -->
    {{ Html::script('public/admin/bootstrap-progressbar/bootstrap-progressbar.min.js') }}
   
    <!-- iCheck -->
    {{ Html::style('public/admin/iCheck/icheck.min.js') }}
        <!-- JQVMap -->

        <!-- bootstrap-daterangepicker -->
    {{ Html::script('public/admin/js/datepicker/daterangepicker.js') }}
    {{ Html::script('public/admin/js/moment/moment.min.js') }}
   
    <!-- Custom Theme Scripts -->
    {{ Html::script('public/admin/build/js/custom.min.js') }}
  </body>
</html>