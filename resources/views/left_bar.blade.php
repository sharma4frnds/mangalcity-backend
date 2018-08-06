<div class="col-md-4 col-sm-3 col-xs-12 ped-0 media-releases-menu" id="getFixed">
      <div class="profile">

          <div class="pro">
          	<a href="{{url('profile/'.Auth::user()->url)}}">{{Html::image('public/images/user/'.Auth::user()->image)}}</a>
          </div> 
          <h4><a href="{{url('profile/'.Auth::user()->url)}}">{{Auth::user()->first_name}} {{Auth::user()->last_name}} </a></h4>
         <p><a href="{{url('home')}}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></p>
          <p><a href="{{url('activity')}}"><i class="fa fa-history" aria-hidden="true"></i> Activity Log</a></p>
          <p><a href="{{url('user/profile')}}"><i class="fa fa-user" aria-hidden="true"></i> Update Profile</a></p>
          <p><a href="{{url('user/change_password')}}"><i class="fa fa-key" aria-hidden="true"></i> Change Password</a></p>
          <p><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" > <i class="fa fa-sign-out" aria-hidden="true"></i> Logout </a>
          </p>

          <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>

      </div>
            @if(Session::has('clocation'))
       <?php  $clocation=Session::get('clocation');  //print_r($clocation);?>
       @if($clocation['no_of_location']==2)
        @if($clocation['current_location']=='home')
        <a href="{{url('change_location')}}"> <button type="button" class="btn hme btn-warning">switch to {{$clocation['current_city']}} location</button></a>
       
        @else
        <a href="{{url('change_location')}}"> <button type="button" class="btn hme btn-warning">switch to {{$clocation['home_city']}} location</button></a>
        @endif
        @endif
        @endif

<div class="col-md-12 col-sm-12 col-xs-12 left-pst">
<div class="t-post">
<img src="http://emergingncr.com/mangalcity/public/images/post/post_image/nt1.jpg" class="img-responsive" alt="img">
</div>
<div class="t-post">
<img src="http://emergingncr.com/mangalcity/public/images/post/post_image/nt2.jpg" class="img-responsive" alt="img">
</div>
</div>
</div>  

