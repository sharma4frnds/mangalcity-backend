@extends('layouts.master')
@section('title','Mangalcity')

@section('content')
      <section class="think-pnl post-pnl updates">
        <div class="container">
          <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="profile">

                    <div class="pro">
                      {{Html::image('public/images/user/'.Auth::user()->image)}}
                    </div> 
                    <h4>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h4>
                     <p><a href="{{url('home')}}">Home</a></p>
                    <p><a href="#">Activity Log</a></p>
                    <p><a href="{{url('user/profile')}}">Update Profile</a></p>
                    <p><a href="{{url('user/change_password')}}">Change Password</a></p>
                    <p><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" > Logout </a>
                    </p>

                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
                  <?php $home_location=Session::get('home_location'); ?>
                 @if($home_location)
                  <a href="{{url('change_location')}}"> <button type="button" class="btn hme btn-warning">switch to Current location</button></a>
                  @else
                   <a href="{{url('change_location')}}"> <button type="button" class="btn hme btn-warning">switch to home location</button></a>
                  @endif

              
            </div>

            <div class="col-md-9 col-sm-4 col-xs-12">
              <div class="col-md-12 col-sm-4 col-xs-12 box-shd top-pd-20">

            <h1>Update Profile</h1>
            <section>
              {!! Form::open(array('url' => 'user/change_password','method' => 'POST','class' => '','files' => true)) !!}

              @if(!$errors->passwordErrors->isEmpty())
              <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->passwordErrors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              @endif

              @if(session()->has('passwordMessages'))
                <div class="alert alert-success">
                  {{ session()->get('passwordMessages') }}
                </div>
              @endif

                <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Old Password</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" placeholder="Old Password" name="old_password" required="">
                        </div>
                  </div>
                <div class="clearfix"></div>
                 <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">New Password</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" placeholder="New Password" name="password" required="">
                      </div>
                    </div>
                         
                      <div class="clearfix"></div>
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Confirm Password</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required="">
                        </div>
                      </div>

                       <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class=" upd btn btn-primary">Update</button>
                        </div>
                      </div>
              </form>
            </section>


          
       
                <!-- tab -->



                  
              </div>
              </div>
             
            <!-- post -->
          </div>
        </div>
        
      </section>

@endsection
@section('footer_script')

@endsection