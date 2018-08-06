@extends('layouts.master')
@section('title','Mangalcity')

@section('header_css')
{{ Html::style('public/css/fancybox.css')}}
@endsection

@section('content')

<section class="think-pnl post-pnl">
    <div class="container">
      <div class="row">
        <!-- left-pro -->
        <div class="col-md-9">
        <div class="col-md-12 cv-relt">
            <div class="cover">
                <div class="over-ic1"><a data-toggle="modal" href="{{url('/coverpopup/')}}" data-target="#myModal_large"><i class=" ovr fa fa-camera" aria-hidden="true"></i></a>
                </div>

                {{Html::image('public/images/user/cover/'.Auth::user()->cover_image,'img',array('class'=>'img-responsive'))}}
            </div>
            <div class="cover-pro lt-pro">

                <div class="over-ic">
                    <a data-toggle="modal" href="{{url('/imagepopup/')}}" data-target="#myModal">
                        <i class=" ovr fa fa-camera" aria-hidden="true"></i></a>
                </div>
                {{Html::image('public/images/user/'.Auth::user()->image,'img',array('class'=>'img-responsive'))}}

                
            </div>
            <div class="col-md-12 c-cover-pnl">
                    <span class="cover-user-name">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
                
                </div>
        </div>
        @include('left_bar')
        <div class="col-md-8 col-sm-6 col-xs-12">
          <!-- start activity -->
          <div id="post-data">
            @include('feed')
        <!-- end  activity -->
          </div>
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


<!-- Remote popup large -->
<div id="myModal_large" class="modal fade">
<div class="modal-dialog modal-lg">
<div class="modal-content">
  <p class="text-center">{{Html::image('public/img/bx_loader.gif')}}</p>
    <!-- Content will be loaded here from "remote.php" file -->
</div>
</div>
</div>

<script type="text/javascript">
$('body').on('hidden.bs.modal', '.modal', function () {
  $(this).removeData('bs.modal');
});
</script>
<script type="text/javascript">
$('#myModal').on('hidden.bs.modal', function () {
          $('.modal-content').html('<div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title"> </h4></div><div class="modal-body"><p class="text-center">{{Html::image("public/img/bx_loader.gif")}} </p></div><div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>');
  });

$('#myModal_large').on('hidden.bs.modal', function () {
          $('.modal-content').html('<div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title"> </h4></div><div class="modal-body"><p class="text-center">{{Html::image("public/img/bx_loader.gif")}} </p></div><div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>');
  });
</script>
<!-- End Remote popup -->
@endsection
@section('footer_script')

<script type="text/javascript">


</script>
{{ Html::style('public/js/jquery-ui.css')}}
 {!! HTML::script('/public/js/jquery.fancybox.js') !!}
@endsection