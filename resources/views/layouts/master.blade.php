<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="base-url" content="{{url('/')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{ Html::style('public/css/bootstrap.min.css')}}
    {{ Html::style('public/css/style.css')}}
    <script type="text/javascript" src="{{ asset('public/js/jquery-1.9.1.min.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <title>@yield('title')</title>
    @yield('header_css')
  </head>
  <body style="background: #e9ebee;">
    <div class="main-pnl "  style="background: #e9ebee;">
      <header class="header">
        <div class="container">
          <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-12">
           
                 <a class="m-logo" href="{{url('/home')}}">{{Html::image('public/img/logo.png','logo')}}</a>
            </div>
             <div class="col-md-4 col-sm-4 col-xs-12">
                 <i class="fa fa-search tp-srh" aria-hidden="true"></i>
        <div class="form-group">
          
          {!! Form::text('search_text', null, array('placeholder' => 'Search Text','class' => 'form-control','id'=>'search_text')) !!}
        </div>
             </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="tagline">
                एक ऐसा नेटवर्क जो आपको आपके गाँव के साथ जोड़ता है
              </div>
            </div>
          </div>
        </div>
      </header>
    
      <!-- contener -->
      	@yield('content')
      <!-- end contener -->
     </div>


    <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script type="text/javascript" src="{{ asset('public/js/bootstrap.min.js')}}"></script>
   <link href="http://demo.expertphp.in/css/jquery.ui.autocomplete.css" rel="stylesheet">
   <script src="http://demo.expertphp.in/js/jquery-ui.min.js"></script>
  <script type="text/javascript" src="{{ asset('public/js/app.js')}}"></script>
  <script src="{{ asset('public/js/toastr.min.js') }}"></script>
  <link href="{{ asset('public/css/toastr.min.css') }}" rel="stylesheet">
  {{ Html::script('public/js/croppie.js') }}
  {{ Html::style('public/css/croppie.css')}}

  {!! Toastr::render() !!}

    @yield('footer_script')
</body>
</html>