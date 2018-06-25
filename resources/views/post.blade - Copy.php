@extends('layouts.master')
@section('title','Mangalcity')

@section('content')



      <section class="think-pnl post-pnl">
        <div class="container">
          <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="profile">

                    <div class="pro">
                    	<a href="{{url('user/profile')}}">{{Html::image('public/images/user/'.Auth::user()->image)}}</a>
                    </div> 
                    <h4><a href="{{url('user/profile')}}">{{Auth::user()->first_name}} {{Auth::user()->last_name}} </a></h4>
                   
                    <p><a href="#">Activity Log</a></p>
                    <p><a href="{{url('user/profile')}}">Update Profile</a></p>
                    <p><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" > Logout </a>
                    </p>

                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>

                </div>
                <button type="button" class="btn hme btn-warning">switch to home location</button>

                

            </div>
            <div class="col-md-9 col-sm-4 col-xs-12">

                <form method="POST" enctype="multipart/form-data" id="feedForm" action="post">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                 <div class="col-md-12 col-sm-4 col-xs-12 box-shd top-pd-20">
                    <div class="col-md-6 pd0">
                     <div class="pro1">{{Html::image('public/images/user/'.Auth::user()->image,'img',array('class'=>'img-responsive'))}}  
                    </div>  
                     <span class="pro-name">Update Your Status</span><br>
                    </div>

                  
                      <textarea name="message" cols="30" rows="1" class="form-control" placeholder="Write what you wish"></textarea>
                      <div id="queued-files" style="display: none;">1 image selected</div>
                    <div class="share-area">
                        <div class="up-img"><input type="file" id="npimage" name="image" accept="image/*" onchange="displayImage(this);"></div>
                        <div class="up-vid"><input type="file" name="video" id="npvideo" accept="video/*" onchange="displayVideo(this);"></div>
                        <ul>
                         <li><i class="fa fa-file-image-o" aria-hidden="true"></i></li>   
                         <li><i class="fa fa-video-camera" aria-hidden="true"></i></li> 
                         <li style="float: right;">
                            
                            <input type="submit" value="Post" class="post-bt"  /> 
                            </li> 
                        </ul>
                    </div>

                </div>

                 <div class="alert alert-info fade in" id="error_div" style="display: none"></div>

            </form>

            <div class="col-md-12 col-sm-4 col-xs-12 box-shd">
            <div class="row org">
                <div class="col-md-9">
                    <h3>country</h3>
                </div>
                <div class="col-md-3">
                    <!-- Controls -->
                    <div class="controls pull-right hidden-xs">
                        <a class="left fa fa-chevron-left btn btn-success" href="#carousel-example" data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-success" href="#carousel-example" data-slide="next"></a>
                    </div>
                </div>
            </div>

            <div id="carousel-example" class="carousel slide hidden-xs" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active">
                        <div class="row">
                        @foreach($country_posts as $cposts)
                        <div class="col-sm-3 ped-crsl">
                            <div class="col-item">
                                <div class="photo">
                                   
                              @if($cposts->type=='image')
                                <div class="post-img">
                                     {{Html::image('public/images/post/post_image/'.$cposts->value,'img',array('class'=>'img-responsive'))}}  
                                </div>
                             @elseif($cposts->type=='video')
                              <div class="post-video">
                                   <video width="100%" height="150" controls><source src="public/images/post/post_video/{{$cposts->value}}" type="video/mp4"></video>   
                                </div>  
                             @else
                                <p class="post-txt">{{str_limit($cposts->message, 25)}}</p>
                             @endif

                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-12">
                                            <h5>{{$cposts->user->first_name}} {{$cposts->user->last_name}} <br>
                                              {!! Helper::dateFormate($cposts->created_at); !!}

                                               </h5>
                                        </div>
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        </div>
                    </div>
                 
                </div>
            </div>
            </div>

	<div class="col-md-12 col-sm-4 col-xs-12 box-shd">
        <div class="row org">
            <div class="col-md-9">
                <h3>state</h3>
            </div>
            <div class="col-md-3">
                <!-- Controls -->
                <div class="controls pull-right hidden-xs">
                    <a class="left fa fa-chevron-left btn btn-success" href="#carousel-example1" data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-success" href="#carousel-example1" data-slide="next"></a>
                </div>
            </div>
        </div>
        <div id="carousel-example1" class="carousel slide hidden-xs" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">

                     @foreach($state_posts as $sposts)
                        <div class="col-sm-3 ped-crsl">
                            <div class="col-item">
                                <div class="photo">
                                   
                              @if($sposts->type=='image')
                                <div class="post-img">
                                     {{Html::image('public/images/post/post_image/'.$sposts->value,'img',array('class'=>'img-responsive'))}}  
                                </div>
                             @elseif($sposts->type=='video')
                              <div class="post-video">
                                   <video width="100%" height="150" controls><source src="public/images/post/post_video/{{$sposts->value}}" type="video/mp4"></video>   
                                </div>  
                             @else
                                <p class="post-txt">{{str_limit($sposts->message, 25)}}</p>
                             @endif

                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-12">
                                            <h5>{{$sposts->user->first_name}} {{$sposts->user->last_name}} <br>{!! Helper::dateFormate($sposts->created_at); !!} </h5>
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                      
 
                    </div>
                </div>
               
            </div>
        </div>
    </div>


	<div class="col-md-12 col-sm-4 col-xs-12 box-shd">

        <div class="row org">
            <div class="col-md-9">
                <h3>district</h3>
            </div>
            <div class="col-md-3">
                <!-- Controls -->
                <div class="controls pull-right hidden-xs">
                    <a class="left fa fa-chevron-left btn btn-success" href="#carousel-example2" data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-success" href="#carousel-example2" data-slide="next"></a>
                </div>
            </div>
        </div>
        <div id="carousel-example2" class="carousel slide hidden-xs" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">
                        @foreach($district_posts as $dposts)
                        <div class="col-sm-3 ped-crsl">
                            <div class="col-item">
                                <div class="photo">
                                   
                              @if($dposts->type=='image')
                                <div class="post-img">
                                     {{Html::image('public/images/post/post_image/'.$dposts->value,'img',array('class'=>'img-responsive'))}}  
                                </div>
                             @elseif($dposts->type=='video')
                              <div class="post-video">
                                   <video width="100%" height="150" controls><source src="public/images/post/post_video/{{$dposts->value}}" type="video/mp4"></video>   
                                </div>  
                             @else
                                <p class="post-txt">{{str_limit($dposts->message, 100)}}</p>
                             @endif

                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-12">
                                            <h5>{{$dposts->user->first_name}} {{$dposts->user->last_name}} <br>{!! Helper::dateFormate($dposts->created_at); !!} </h5>
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
               
                      
                
                    </div>
                </div>
   
            </div>
        </div>
    </div>

        <!-- Button trigger modal -->



            
            <!--City  post -->
            <div id="currentMessage"></div>
            <!-- post -->
            <div  id="post-data">
              @include('feed');
              </div>
            <!-- post -->
        <div class="ajax-load text-center" style="display:none">
           <p>
            {{Html::image('public/img/loader.gif')}} Loading More post</p>
        </div>
          </div>
        </div>
        
      </section>
<style type="text/css">
      .ajax-load{
        background: #e1e1e1;
        padding: 10px 0px;
        width: 100%;
      }
    </style>
<!-- Remote popup -->
<div id="myModal" class="modal fade">
<div class="modal-dialog">
    <div class="modal-content">
        <!-- Content will be loaded here from "remote.php" file -->
    </div>
</div>
</div>

<script type="text/javascript">
    $('body').on('hidden.bs.modal', '.modal', function () {
      $(this).removeData('bs.modal');
    });
</script>
<!-- End Remote popup -->
@endsection
@section('footer_script')
{{ Html::script('public/js/jquery.form.js') }}


<script type="text/javascript">
  var page = 1;
  $(window).scroll(function() {
      if($(window).scrollTop() + $(window).height() >= $(document).height()) {
          page++;
          loadMoreData(page);
      }
  });


  function loadMoreData(page){
    $.ajax(
          {
              url: '?page=' + page,
              type: "get",
              cache: false,
              async:false,
              beforeSend: function()
              {
                  $('.ajax-load').show();
              }
          })
          .done(function(data)
          {
              if(data.html == " "){
                  $('.ajax-load').html("No more records found");
                  return;
              }
              $('.ajax-load').hide();
              $("#post-data").append(data.html);
          })
          .fail(function(jqXHR, ajaxOptions, thrownError)
          {
            alert('server not responding...');
          });
  }
</script>


@endsection