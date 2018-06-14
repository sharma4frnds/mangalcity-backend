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
                 <div class="col-md-12 col-sm-4 col-xs-12 box-shd top-pd-20">


                   <!-- tab -->
            <div class="tab_container">
            <input id="tab1" type="radio" name="tabs" checked>
            <label class="tb" for="tab1">Update Profile</label>

            <input id="tab2" type="radio" name="tabs">
            <label class="tb" for="tab2">Change Password</label>

            <input id="tab3" type="radio" name="tabs">
            <label class="tb" for="tab3">Change Profile</label>

            

            <section id="content1" class="tab-content">
                  @if(session()->has('message'))
                      <div class="alert alert-success">
                          {{ session()->get('message') }}
                      </div>
                  @endif

                  @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif

                 {!! Form::open(array('url' => 'user/profile','method' => 'POST','class' => 'form-horizontal' )) !!}
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">First name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control"  placeholder="first name" name="first_name" required="" value="{{Auth::user()->first_name}}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Last name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control"  placeholder="last name" name="last_name" required="" value="{{Auth::user()->last_name}}">
                        </div>
                      </div>
                        <h4 class="upd-h4">Current Location</h4>
                        <div class="form-group">
                        <label  class="col-sm-2 control-label">Country</label>
                        <div class="col-sm-10">
                           <select class="form-control" name="country">
                            <option value="101">India</option>
                          </select>
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">State</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="state" id="state_id" onChange="getDistrict()">
                              <option value="">-State-</option>
                              @foreach($states as $state)
                              <option value="{{$state->id}}" @if(Auth::user()->state==$state->id) selected @endif>{{$state->name}}</option>
                              @endforeach
                            </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">District</label>
                        <div class="col-sm-10">
                           <select class="form-control" name="district" id="district" onChange="getCity()">
                             <option value="">-district-</option>
                              @foreach($districts as $dis)
                              <option value="{{$dis->id}}" @if(Auth::user()->district==$dis->id) selected @endif>{{$dis->name}}</option>
                              @endforeach
                            </select>
                        </div>
                      </div>

                        <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label" >City</label>
                        <div class="col-sm-10">
                          <select class="form-control" name="city" id="city">
                              <option value="">-city-</option>
                             @foreach($citys as $city)
                              <option value="{{$city->id}}" @if(Auth::user()->city==$city->id) selected @endif>{{$city->name}}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>


                      <h4 class="upd-h4">Home Location</h4>
                      <div class="form-group">
                       
                        <div class="col-sm-12">
                            <div class="checkbox">
                              <input type="checkbox" value="active" name="current_location" id="current_location" @if(isset($home_location->home_city)) @else  checked="checked" @endif >
                              <sapn style="padding-left: 15px;">Set your home location as current location</sapn>

                            </div>
                        </div>
                      </div>
                        
                        <div class="clearfix"></div>
                        <div  @if(isset($home_location->home_city))  @else style="display:none"  @endif   id="homeDiv">
                        <div class="form-group">
                        <label class="col-sm-2 control-label">Country</label>
                        <div class="col-sm-10">
                           <select class="form-control" name="home_country">
                            <option value="101">India</option>
                           </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">State</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="home_state" id="home_state" onChange="gethomeDistrict()">
                              <option value="">-State-</option>
                              @foreach($states as $state)
                                <option value="{{$state->id}}" @if(isset($home_location->home_state)) @if($home_location->home_state==$state->id) selected @endif @endif>{{$state->name}}</option>
                              @endforeach
                           
                            </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">District</label>
                        <div class="col-sm-10">
                           <select class="form-control" name="home_district" id="home_district" onChange="gethomeCity()">
                            <option value="">-district-</option>
                              @foreach($hdistricts as $dis)
                              <option value="{{$dis->id}}" @if(isset($home_location->home_district)) 
                                @if($home_location->home_district==$dis->id) selected @endif @endif>{{$dis->name}}</option>
                              @endforeach
                            </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">City</label>
                        <div class="col-sm-10">
                          <select class="form-control" name="home_city" id="home_city">
                                <option value="">-city-</option>
                                  @foreach($hcitys as $city)
                                  <option value="{{$city->id}}"  @if(isset($home_location->home_city))  @if($home_location->home_city==$city->id) selected @endif @endif>{{$city->name}}
                                  </option>
                                  @endforeach
                                </select>
                        </div>
                      </div>
                    </div>
                     <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                      </div>
                </form>
            </section>

            <section id="content2" class="tab-content">
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

            <section id="content3" class="tab-content">
                {!! Form::open(array('url' => 'user/change_image','method' => 'POST','class' => 'form-horizontal','files' => true )) !!}

                 @if(!$errors->imageErrors->isEmpty())
                  <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->imageErrors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                  @endif


               @if(session()->has('imagesMessages'))
                <div class="alert alert-success">
                  {{ session()->get('imagesMessages') }}
                </div>
              @endif

                <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Image Upload</label>
                        <div class="col-sm-10">
                          <input type="file" class="file form-control" placeholder="" name="image" required="">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class=" upd btn btn-primary">Update</button>
                        </div>
                      </div>
                </form>

                <hr>
                {!! Form::open(array('url' => 'user/change_cover_image','method' => 'POST','class' => 'form-horizontal','files' => true )) !!}

                 @if(!$errors->cover_imageErrors->isEmpty())
                  <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->cover_imageErrors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                  @endif


               @if(session()->has('cover_imageMessages'))
                <div class="alert alert-success">
                  {{ session()->get('cover_imageMessages') }}
                </div>
              @endif

                <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Cover image</label>
                        <div class="col-sm-10">
                          <input type="file" class="file form-control" placeholder="" name="cover_image" required="">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class=" upd btn btn-primary">Update</button>
                        </div>
                      </div>
                </form>


            </section>

            

          
        </div>
                <!-- tab -->



                  
              </div>
              </div>
             
            <!-- post -->
          </div>
        </div>
        
      </section>

@endsection
@section('footer_script')
<script type="text/javascript">
$(document).ready(function() {
   $('input[type="checkbox"]').click(function() {

    if($(this).prop("checked") == true){
        $('#homeDiv').hide();          
       }
       else {
         $('#homeDiv').show();   
       }
   });
});



 function getDistrict()
 {
  var siteUrl=$('meta[name=base-url]').attr("content");
       var id=$("#state_id").val();
          $.ajax({
          url:siteUrl+'/getdistict/'+id,
          type:'POST',
          beforeSend: function(xhr){
          xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr('content'));},
          cache: false,
          async:false,
          data:{'id':id},
          success:function(data){
          var x;
          $("#city").html('');
          jQuery(data).each(function(i, item){
             x += '<option value="'+item.id+'">' + item.name + '</option>';
            });
            $("#district").html(x);

          }
          });
  }

 function getCity()
 {
  var siteUrl=$('meta[name=base-url]').attr("content");
       var id=$("#district").val();
          $.ajax({
          url:siteUrl+'/getcity/'+id,
          type:'POST',
          beforeSend: function(xhr){
          xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr('content'));},
          cache: false,
          async:false,
          data:{'id':id},
          success:function(data){
            var x;
            $("#city").html('');
            jQuery(data).each(function(i, item){
               x += '<option value="'+item.id+'">' + item.name + '</option>';
              });
              $("#city").html(x);
            }
          });
  }


 function gethomeDistrict()
 {
  var siteUrl=$('meta[name=base-url]').attr("content");
       var id=$("#home_state").val();
          $.ajax({
          url:siteUrl+'/getdistict/'+id,
          type:'POST',
          beforeSend: function(xhr){
          xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr('content'));},
          cache: false,
          async:false,
          data:{'id':id},
          success:function(data){
          var x;
          $("#home_city").html('');
          jQuery(data).each(function(i, item){
             x += '<option value="'+item.id+'">' + item.name + '</option>';
            });
            $("#home_district").html(x);

          }
          });
  }

 function gethomeCity()
 {
  var siteUrl=$('meta[name=base-url]').attr("content");
       var id=$("#home_district").val();
          $.ajax({
          url:siteUrl+'/getcity/'+id,
          type:'POST',
          beforeSend: function(xhr){
          xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr('content'));},
          cache: false,
          async:false,
          data:{'id':id},
          success:function(data){
            var x;
            $("#home_city").html('');
            jQuery(data).each(function(i, item){
               x += '<option value="'+item.id+'">' + item.name + '</option>';
              });
              $("#home_city").html(x);
            }
          });
  }

</script>
@endsection