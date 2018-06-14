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
                      <h1 class="hone"><span class="no-text">Choose a new password</span></h1>
                        <form id="login-form" class="text-left">
                          <div class="login-form-main-message"></div>
                            <div class="main-login-form">
                            <div class="login-group">
                               <div class="form-group">
                                <input type="text" class="form-control" id="otp" name="otp" placeholder="otp">
                              </div>

                              <div class="form-group">
                                <input type="text" class="form-control" id="password" name="password" placeholder="New Password">
                              </div>
                              <div class="form-group">
                                <input type="text" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                              </div>
                                                          
                            </div>
                          

                              <button type="button" class="login-button" id="change_password_btn">Submit</button>
                            
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

@endsection