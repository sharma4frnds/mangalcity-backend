@extends('layouts.master_home')
@section('title','Mangalcity')
@section('header_css')
<!-- <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css"> -->
@endsection
@section('content')

     <section class="think-pnl">
        <div class="container">
          <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-12">
                   <div class="text-slide">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                      </ol>

                      <!-- Wrapper for slides -->
                      <div class="carousel-inner">
                        <div class="item active">
                          <p>एक ऐसा नेटवर्क जो आपको आपके गाँव के साथ जोड़ता है</p>
                        </div>

                        <div class="item">
                           <p>एक ऐसा नेटवर्क जो आपको आपके गाँव के साथ जोड़ता है</p>
                        </div>
                      
                        <div class="item">
                           <p>एक ऐसा नेटवर्क जो आपको आपके गाँव के साथ जोड़ता है</p>
                        </div>
                      </div>
                    </div>
                  </div>
     
              {{Html::image('public/img/think.png','man',array('class'=>'think'))}}
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active one-tb"><a href="#Section1" aria-controls="home" role="tab" data-toggle="tab">LOGIN</a></li>
                    <li role="presentation" class="two-tb"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab">REGISTER</a></li> 
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="Section1">
                      <h1 class="hone">login</h1>
                
                        <form class="text-left" id="login_form"   method="POST" action="{{ route('login') }}">
                              {{ csrf_field() }}
                            <div class="alert alert-success" id="form-login-success" style="display: none"></div>
                            <div class="alert alert-danger" id="form-login-error" style="display: none"></div>
                              @foreach (['danger', 'warning', 'success', 'info'] as $key)
                               @if(Session::has($key))
                                   <p class="alert alert-{{ $key }}">{{ Session::get($key) }}</p>
                               @endif
                              @endforeach
                          <div class="main-login-form">
                            <div class="login-group">
                              <div class="form-group">
                                <label for="lg_username" class="sr-only">Mobile</label>
                                <input type="text" class="form-control" id="lg_username" autocomplete="off" name="mobile" placeholder="Mobile Number" >
                               @if ($errors->has('mobile'))
                                  <span class="help-block"> <strong>{{ $errors->first('mobile') }}</strong> </span>
                                  @endif
                              </div>
                              <div class="form-group">
                                <label for="lg_password" class="sr-only">Password</label>
                                <input type="password" autocomplete="off" class="form-control" id="lg_password" name="password" placeholder="Password">
                                 @if ($errors->has('password')) <span class="help-block"> <strong>{{ $errors->first('password') }}</strong></span> @endif
                              </div>
                             
                            </div>
                        @if(Session::has('message'))
                        <p class="alert alert-info">{{ Session::get('message') }}</p>
                        @endif


                         <button type="submit" class="login-button">submit</button>
                         <div class="clearfix"></div>
                          <br/>
                        <div class="fb"><a class="btn btn-primary btn-sm" href="{{url('login/facebook')}}"><lable><span> <i class="fa fa-facebook" aria-hidden="true"></i></span>Sign in with Facebook</lable>
                              <div class="clear"></div></a>
                          </div>
                          
                          <div class="google"><a class="btn btn-primary btn-sm" href="{{url('login/google')}}"><lable><span> <i class="fa fa-google-plus" aria-hidden="true"></i></span>Sign in with Google+</lable>
                              <div class="clear"></div></a>
                          </div>

                        <div class="etc-login-form">
                        <p> <a href="{{url('/forgot')}}">forgot password?</a></p>
                      </div>

                         
                          </div>  
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="Section2">
                       <h1 class="hone">register</h1>
                       
                        <form class="text-left" role="form" id="registerForm" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}
                          <div class="login-form-main-message"></div>
                          <div class="main-login-form">
                            <div class="login-group">
                              <div class="form-group">
                                <input type="text" class="form-control required" autocomplete="off" id="rg_firstname" name="first_name" placeholder="First Name" >
                                   <span class="help-block"><strong id="register-errors-first_name"> </strong></span>
                              </div>

                                <div class="form-group">
                                <input type="text" class="form-control required" autocomplete="off" id="rg_lastname" name="last_name" placeholder="Last name">
                                   <span class="help-block"><strong id="register-errors-last_name"> </strong></span>
                              </div>

                              <div class="form-group">
                                <input type="text" class="form-control required mobile" autocomplete="off" id="rg_mobile" name="mobile" placeholder="Mobile No" >
                                <span class="help-block"><strong id="register-errors-mobile"> </strong></span>
                              </div>
                              <div class="form-group">
                                <input type="text" class="form-control" id="rg_email" autocomplete="off" name="email" placeholder="Email id">
                                <span class="help-block"><strong id="register-errors-email"> </strong></span>
                              </div>
                              <div class="form-group">
                                <input type="password" class="form-control required" autocomplete="off" id="rg_password" name="password" placeholder="Password">
                                <span class="help-block"><strong id="register-errors-password"> </strong></span>
                              </div>
                              <div class="form-group">
                                <input type="password" class="form-control required" autocomplete="off" id="rg_cpassword" name="password_confirmation" placeholder="Confirm Password">
                                <span class="help-block"><strong id="register-errors-password_confirmation"> </strong></span>
                              </div>
                              <span class="tm"><input type="checkbox" checked="checked" required="" name="agree"> <a  data-toggle="modal" data-target="#myModal">I agree to the terms and conditions</a></span>
                              
                               <div class="form-group" id="register-errors">
                                    <span class="help-block">
                                        <strong id="form-register-errors"></strong>
                                    </span>
                                </div>

                            </div>
                            <button type="submit" class="login-button">submit</button>
                          </div>

                        <br/>
                        <div class="fb"><a class="btn btn-primary btn-sm" href="{{url('login/facebook')}}"><lable><span> <i class="fa fa-facebook" aria-hidden="true"></i></span>Sign in with Facebook</lable>
                              <div class="clear"></div></a>
                          </div>
                          <div class="google"><a class="btn btn-primary btn-sm" href="{{url('login/google')}}"><lable><span> <i class="fa fa-google-plus" aria-hidden="true"></i></span>Sign in with Google+</lable>
                              <div class="clear"></div></a>
                          </div>
                    

                          <div class="etc-login-form">
                            <p>Already have an account ? <a href="{{url('/')}}">SignIn</a></p>
                          </div>
                        </form>

                         <form class="text-left" role="form" id="otpForm" method="POST" action="{{ route('ragisterOtp') }}" style="display:none">
                            {{ csrf_field() }}
           
                            <div class="form-group" id="otp-errors">
                                    <span class="help-block">
                                        <strong id="form-otp-errors"></strong>
                                    </span>
                            </div>

                          <div class="main-login-form">
                            <div class="login-group">
                              <div class="form-group">
                                <input type="text" class="form-control" id="op_username" name="otp" placeholder="Enter OTP" >

                                <input type="hidden" id="otp_mobile" name="mobile" value="" >
                                
                              </div>
                              <div id="resend_otp" class="resend_otp">
                                <a onclick="resend_otp()" class="pointer"><span class="tm"> Resend Otp</span></a>
                               </div>

                            </div>
                            <button type="submit" class="login-button">submit</button>
                          </div>
                          <div class="etc-login-form">
                            <p>Already have an account ? <a href="{{url('/')}}">SignIn</a></p>
                          </div>
                        </form>


                    </div>
                </div>
            </div>
            </div>
          </div>
        </div>
        
      </section>

@endsection
@section('footer_script')
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Terms of Service</h4>
      </div>
      <div class="modal-body">
       
        <h3> Welcome to mangalcity! </h3>
        <p>Our mission is to give people the power to build community and bring the world closer together. To help advance this mission, we provide the Products and services described below to you:</p>
        <p>Our mission is to give people the power to build community and bring the world closer together. To help advance this mission, we provide the Products and services described below to you:</p>
        <p>Our mission is to give people the power to build community and bring the world closer together. To help advance this mission, we provide the Products and services described below to you:</p>
        <p>Our mission is to give people the power to build community and bring the world closer together. To help advance this mission, we provide the Products and services described below to you:</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@endsection