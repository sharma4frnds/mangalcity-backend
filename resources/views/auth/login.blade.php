@extends('layouts.master')
@section('title','Login')
@section('content')

    <!-- login -->
    <section class="login">
        <div class="container">
            <div class="flt-left">
            <div class="login-box">
                <h2>Login</h2>
                @if(Session::has('message'))
                <p class="alert alert-info">{{ Session::get('message') }}</p>
                @endif
            @foreach (['danger', 'warning', 'success', 'info'] as $key)
             @if(Session::has($key))
                 <p class="alert alert-{{ $key }}">{{ Session::get($key) }}</p>
             @endif
            @endforeach
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <input type="text" id="emial" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                   @if ($errors->has('email'))
                        <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span>
                  @endif
                <input type="password" id="password" placeholder="Password" class="form-control" name="password" required autofocus>
                   @if ($errors->has('password')) <span class="help-block"> <strong>{{ $errors->first('password') }}</strong></span> @endif
                <div class="btn-top"><button>login</button></div>

                <div class="fb"><a href="{{url('login/facebook')}}"><lable><span> <i class="fa fa-facebook" aria-hidden="true"></i></span>Sign in with Facebook</lable>
                    <div class="clear"></div></a>
                </div>

                <div class="google"><a href="{{url('login/google')}}"><lable><span> <i class="fa fa-google-plus" aria-hidden="true"></i></span>Sign in with Google+</lable>
                    <div class="clear"></div></a>
                </div>
                 <a href="{{ route('password.request') }}" class="forget">Forgot Password?</a>
            </br>
            <span class="no-ac">Don't have an account?</span> <a href="{{url('register')}}" class="forget" > Sign up here</a>
            </form>
            </div>
            </div>
        </div>
    </section>
    <!-- login -->


@endsection

@section('footer_script')
@endsection
