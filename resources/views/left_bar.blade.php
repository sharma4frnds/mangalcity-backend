<?php $route_nmae=Request::path(); ?>

<!-- other user profile show -->
@if(strpos($route_nmae,'profile/') !== false) 

<div class="col-md-12 cv-relt ped-15-0">
    <div class="cover">
       
        {{Html::image('public/images/user/cover/'.$profile->cover_image,'img',array('class'=>'img-responsive'))}}
    </div>
    <div class="cover-pro">

       
        <a data-toggle="modal" href="{{url('/show_imagepopup/')}}" data-target="#myModal">
        {{Html::image('public/images/user/'.$profile->image,'img',array('class'=>'img-responsive'))}}</a>

      

    </div>
      <div class="col-md-12 c-cover-pnl">
      <span class="cover-user-name">{{$profile->first_name}} {{$profile->last_name}}</span>
  </div>
</div>

@else
<!-- login user profile show -->
<div class="col-md-12 cv-relt ped-15-0">
    <div class="cover">
        <div class="over-ic1"><a data-toggle="modal" href="{{url('/coverpopup/')}}" data-target="#myModal_large"><i class=" ovr fa fa-camera" aria-hidden="true"></i></a>
        </div>

        {{Html::image('public/images/user/cover/'.Auth::user()->cover_image,'img',array('class'=>'img-responsive'))}}
    </div>
    <div class="cover-pro">

        <div class="over-ic">
            <a data-toggle="modal" href="{{url('/imagepopup/')}}" data-target="#myModal">
                <i class=" ovr fa fa-camera" aria-hidden="true"></i></a>
        </div>
        <a data-toggle="modal" href="{{url('/show_imagepopup/')}}" data-target="#myModal">
        {{Html::image('public/images/user/'.Auth::user()->image,'img',array('class'=>'img-responsive'))}}</a>

      

    </div>
      <div class="col-md-12 c-cover-pnl">
      <span class="cover-user-name">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
          
      @if(Session::has('clocation'))
       <?php  $clocation=Session::get('clocation');  //print_r($clocation);?>
        <span class="cover-user-name">({{$clocation['set_location']}})</span>
      @endif

  </div>
</div>

@endif



<div class="col-md-4 col-sm-3 col-xs-12 ped-0 media-releases-menu" id="getFixed">
      <div class="profile">

          
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
<img src="{{url('public/img/nt1.jpg')}}" class="img-responsive" alt="img">
</div>
<div class="t-post">
<img src="{{url('public/img/nt2.jpg')}}" class="img-responsive" alt="img">
</div>
</div>
</div>  

