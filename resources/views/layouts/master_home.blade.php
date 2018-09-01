<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

 <meta name="base-url" content="{{url('/')}}">
 <meta name="csrf-token" content="{{ csrf_token() }}">
  {{ Html::style('public/css/bootstrap.min.css')}}
  {{ Html::style('public/css/style.css')}}

 <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css?family=Kalam:300,400,700" rel="stylesheet">
<title>@yield('title')</title>
<link rel="icon" href="{{ asset('public/img/fav.png') }}" type="image/x-icon">
@yield('header_css')
</head>
<body>
  <div class="main-pnl">
      <header class="header">
        <div class="container">
          <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-12">
              <a href="{{url('/')}}">{{Html::image('public/img/logo.png','logo')}}</a>
            </div>
            <div class="col-md-10 col-sm-10 col-xs-12">
              <div class="tagline hm-txt">
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

	<script type="text/javascript" src="{{ asset('public/js/jquery-1.9.1.min.js')}}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="{{ asset('public/js/bootstrap.min.js')}}"></script>
     <script type="text/javascript" src="{{ asset('public/js/login.js')}}"></script>
       <script src="{{ asset('public/js/toastr.min.js') }}"></script>
  <link href="{{ asset('public/css/toastr.min.css') }}" rel="stylesheet">
   <script type="text/javascript" src="{{ asset('public/js/jquery.validate.js')}}"></script>

  {!! Toastr::render() !!}
    @yield('footer_script')
</body>
</html>