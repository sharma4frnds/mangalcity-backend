<div class="col-md-4 col-sm-3 col-xs-12">
      <div class="profile">

          <div class="pro">
          	<a href="{{url('user/profile')}}">{{Html::image('public/images/user/'.Auth::user()->image)}}</a>
          </div> 
          <h4><a href="{{url('user/profile')}}">{{Auth::user()->first_name}} {{Auth::user()->last_name}} </a></h4>
         <p><a href="{{url('home')}}">Home</a></p>
          <p><a href="{{url('activity')}}">Activity Log</a></p>
          <p><a href="{{url('user/profile')}}">Update Profile</a></p>
          <p><a href="{{url('user/change_password')}}">Change Password</a></p>
          <p><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" > Logout </a>
          </p>

          <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>

      </div>
       <?php $home_location=Session::get('home_location'); print_r($home_location); ?>
       @if($home_location)
        <a href="{{url('change_location')}}"> <button type="button" class="btn hme btn-warning">switch to Current location</button></a>
        @else
         <a href="{{url('change_location')}}"> <button type="button" class="btn hme btn-warning">switch to home location</button></a>
        @endif
</div>  