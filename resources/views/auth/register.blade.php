@extends('layouts.master')
@section('title','Ragister')
@section('content')

    <!-- login -->
    <section class="login">
        <div class="container">
            <div class="flt-left">
            <div class="login-box signup">
                <h2>Signup</h2>
                <form class="" method="POST" action="{{ route('register') }}">
                 {{ csrf_field() }}
                <div class="sign">
                <label>First Name</label>
                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" placeholder="First Name" class="form-control{{ $errors->has('first_name') ? ' has-error' : '' }}">
                   @if ($errors->has('first_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="sign">
                <label>Last Name</label>
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" placeholder="Last Name" class="form-control{{ $errors->has('last_name') ? ' has-error' : '' }}">
                  @if ($errors->has('last_name'))
                        <span class="help-block"><strong>{{ $errors->first('last_name') }}</strong> </span>
                    @endif
                </div>

                <div class="sign">
                <label>Email Id</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Email" class="form-control{{ $errors->has('email') ? ' has-error' : '' }}">
                  @if ($errors->has('email')) <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>@endif
                </div>
                <div class="sign">
                <label>Mobile</label>
                <input type="text" name="mobile" id="mobile" value="{{ old('mobile') }}" placeholder="mobile No" class="form-control{{ $errors->has('mobile') ? ' has-error' : '' }}">
                    @if ($errors->has('mobile')) <span class="help-block"><strong>{{ $errors->first('mobile') }}</strong></span>@endif
                </div>
                <div class="sign">
                <label>Password</label>
                <input type="password" name="password" id="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' has-error' : '' }}">
                 @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="sign">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" class="form-control{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                 @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="btn-top"><button>Register</button></div>
                </form>
                <div class="login-fix">
                <div class="fb"><a href="{{url('login/facebook')}}"><lable><span> <i class="fa fa-facebook" aria-hidden="true"></i></span>Sign in with Facebook</lable>
                    <div class="clear"></div></a>
                </div>
                <div class="google"><a href="{{url('login/google')}}"><lable><span> <i class="fa fa-google-plus" aria-hidden="true"></i></span>Sign in with Google+</lable>
                    <div class="clear"></div></a>
                </div>
            </div>
            </br>
            <span class="no-ac">Are you registered?</span> <a href="{{url('login')}}" class="forget"> Sign in here</a>
            </div>
            </div>
        </div>
    </section>
    <!-- login -->

@endsection
