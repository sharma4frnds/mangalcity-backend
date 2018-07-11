@extends('layouts.master')
@section('title','Mangalcity')

@section('content')


<section class="think-pnl post-pnl">
      <div class="container">
        <div class="row">
          <!-- left-pro -->
          <div class="col-md-9">
          <div class="col-md-12 cv-relt">
              <div class="cover">
                  <div class="over-ic1"><a data-toggle="modal" href="{{url('/coverpopup/')}}" data-target="#myModal"><i class=" ovr fa fa-camera" aria-hidden="true"></i></a>
                  </div>

                  {{Html::image('public/images/user/cover/'.Auth::user()->cover_image,'img',array('class'=>'img-responsive'))}}
              </div>
              <div class="cover-pro">

                  <div class="over-ic">
                      <a data-toggle="modal" href="{{url('/imagepopup/')}}" data-target="#myModal">
                          <i class=" ovr fa fa-camera" aria-hidden="true"></i></a>
                  </div>
                  {{Html::image('public/images/user/'.Auth::user()->image,'img',array('class'=>'img-responsive'))}}

                  <div class="c-cover-pnl">
                      <span class="cover-user-name">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
                      <br>
                      <span class="cover-user-name">{{$city_name->name}}</span>
                  </div>
              </div>
          </div>
          @include('left_bar')
          <div class="col-md-8 col-sm-6 col-xs-12">
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
                         <div class="up-vid"><input type="file" name="audio" id="npaudio" onchange="displayAudio(this);"></div>
                        <ul>
                         <li><i class="fa fa-file-image-o" aria-hidden="true"></i></li>   
                         <li><i class="fa fa-video-camera" aria-hidden="true"></i></li> 
                         <li><i class="fa fa-music" aria-hidden="true"></i></li> 
                         <li> 
                            <div id="imagePreviewDiv" style="display: none;"><img id="imagePreview" class="prv" />

                             </div> 
                         </li>

                         <li style="float: right;">
                            <input type="submit" value="Post" class="post-bt"  /> 
                            </li> 
                        </ul>
                    </div>

                </div>

                 <div class="alert alert-info fade in" id="error_div" style="display: none"></div>

            </form>
            <!--City  post -->
            <div id="currentMessage"></div>
            <!-- post -->
            <div  id="post-data">
              @include('feed')
              </div>
            <!-- post -->
              <br/>
            <div class="ajax-load text-center" style="display:none">
               <p>{{Html::image('public/img/loader.gif')}} Loading More post</p>
            </div>
      
          </div>
        </div>

    <!-- left-pro -->
@include('right_bar')
</div>


</section>

<style type="text/css">

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

$(window).on("scroll", function() {
var scrollHeight = $(document).height();
var scrollPosition = $(window).height() + $(window).scrollTop();
if((scrollHeight - scrollPosition) / scrollHeight === 0) {
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
            if(data.html == ""){
                $('.ajax-load').html("No more records found");
                return;
            }
            //$('.ajax-load').hide();
            $("#post-data").append(data.html);
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
          alert('server not responding...');
        });
}
</script>


@endsection