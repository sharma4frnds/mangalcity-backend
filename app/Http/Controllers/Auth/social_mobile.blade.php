@extends('layouts.master_home')
@section('title','Mangalcity')

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
                          <p>एक एसा नेटवर्क जो आपको आपके गाओ के साथ जोधता है</p>
                        </div>

                        <div class="item">
                           <p>एक एसा नेटवर्क जो आपको आपके गाओ के साथ जोधता है</p>
                        </div>
                      
                        <div class="item">
                           <p>एक एसा नेटवर्क जो आपको आपके गाओ के साथ जोधता है</p>
                        </div>
                      </div>
                    </div>
                  </div>
     
              {{Html::image('public/img/think.png','man',array('class'=>'think'))}}
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
          
                <!-- Tab panes -->
                <div class="tab-content">
          
                 <!-- Tab panes -->
                <div class="tab-content forgt">
                    <div role="tabpanel" class="tab-pane active" id="Section1">
                      <h1 class="hone"><span class="no-text">Please verify your mobile number</span></h1>

                        @if(Session::has('message'))
                        <div class="alert alert-danger alert-dismissible"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            {{ Session::get('message') }}
                          </div>
                        @endif

          


                        <form id="social_mobileform" class="text-left">
                          <div class="login-form-main-message"></div>
                          <div class="main-login-form">
                            <div class="login-group">
                              <div class="form-group" id="lg_mobile_div">
                                <label for="lg_mobile" class="sr-only">Mobile No</label>
                                <input type="text" class="form-control" id="sl_mobile" name="sl_mobile" placeholder="Mobile number" value="">
                              </div>
                              <div id="social_mobile_error"></div>

                                                          
                            </div>
                            <div class="gif-loader" style="display:none;">
                              {{Html::image('public/img/bx_loader.gif')}}
                            </div>
                             <button type="submit" class="login-button" id="social_resendotp">Submit</button>
                            
                             <br><br>
                            <a href="{{url('login')}}" class="forget"> Sign in here</a>
                          </div>  
                        </form>

                          <form id="social_otpform" class="text-left" style="display:none;">
                          <div class="login-form-main-message"></div>
                          <div class="main-login-form">
                            <div class="login-group">
                             
                              <div class="form-group" id="lg_otp_div" >
                                <label for="lg_mobile" class="sr-only">  Enter otp</label>
                                <input type="text" class="form-control" id="sl_otp" name="sl_otp" placeholder="OTP" value="">
                              </div>
                              <div id="social_otp_error"></div>
                                                          
                            </div>

                              <div class="gif-loader1" style="display:none;">{{Html::image('public/img/bx_loader.gif')}} </div>
                             
                              <button type="submit" class="login-button" >Submit</button>
                             <br><br>
                            <a href="{{url('login')}}" class="forget"> Sign in here</a>
                          </div>  
                        </form>
    
                    </div>
                </div>

                </div>
            </div>
            </div>
          </div>
        </div>
        
      </section>

@endsection
@section('footer_script')
<script type="text/javascript">
  
</script>
@endsection