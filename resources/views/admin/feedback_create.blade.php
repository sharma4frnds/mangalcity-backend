@extends('admin.master')


@section('content')
 <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>feedback</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                 
                </div>
              </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                   <h2>{{$post->user->first_name}} {{$post->user->last_name}}<small> {!! Helper::dateFormate($post->created_at); !!}</small></h2>
                  <div class="x_content">
                   
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      
                      <div class="form-group">

                       <p>{{$post->message}}</p>
                      </div>

                        <div class="form-group">
                          @if($post->type=='image')
                          <div class="post-img">
                             {{Html::image('public/images/post/post_image/'.$post->value,'img',array('class'=>'img-responsive'))}}  
                          </div>
                          @endif

                        @if($post->type=='video')
                          <div class="post-video">
                           <video width="100%" height="315" controls><source src="public/images/post/post_video/{{$post->value}}" type="video/mp4"></video>   
                          </div>  
                        @endif

                         </div>
                      </div>

              <div class="col-md-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>feedback users </h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <ul class="list-unstyled msg_list">
                    @foreach($feedback as $row)
                    <li>
                      <a><span><span> {{$row->user->first_name}} {{$row->user->last_name}}</span><span class="time">{!! Helper::dateFormate($row->created_at); !!}</span></span>
                        <span class="message">
                         {{$row->tag->name}}
                        </span>
                      </a>
                    </li>
                @endforeach
                 
             
                  </ul>
                </div>
              </div>
            </div>

               

  
                   
                      <div class="ln_solid"></div>
                      
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

          </div>
         </div>
@endsection
