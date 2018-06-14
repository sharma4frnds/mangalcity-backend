<?php $__env->startSection('title','Mangalcity'); ?>

<?php $__env->startSection('content'); ?>
      <section class="think-pnl post-pnl updates">
        <div class="container">
          <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="profile">

                    <div class="pro">
                      <?php echo e(Html::image('public/images/user/'.Auth::user()->image)); ?>

                    </div> 
                    <h4><?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?></h4>
                    <p><a href="#">Activity Log</a></p>
                    <p><a href="<?php echo e(url('user/profile')); ?>">Update Profile</a></p>
                    <p><a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" > Logout </a>
                    </p>

                    <form id="frm-logout" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo e(csrf_field()); ?>

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
                  <?php if(session()->has('message')): ?>
                      <div class="alert alert-success">
                          <?php echo e(session()->get('message')); ?>

                      </div>
                  <?php endif; ?>

                  <?php if($errors->any()): ?>
                      <div class="alert alert-danger">
                          <ul>
                              <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <li><?php echo e($error); ?></li>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </ul>
                      </div>
                  <?php endif; ?>

                 <?php echo Form::open(array('url' => 'user/profile','method' => 'POST','class' => 'form-horizontal' )); ?>

                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">First name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control"  placeholder="first name" name="first_name" required="" value="<?php echo e(Auth::user()->first_name); ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Last name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control"  placeholder="last name" name="last_name" required="" value="<?php echo e(Auth::user()->last_name); ?>">
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
                              <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($state->id); ?>" <?php if(Auth::user()->state==$state->id): ?> selected <?php endif; ?>><?php echo e($state->name); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">District</label>
                        <div class="col-sm-10">
                           <select class="form-control" name="district" id="district" onChange="getCity()">
                             <option value="">-district-</option>
                              <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($dis->id); ?>" <?php if(Auth::user()->district==$dis->id): ?> selected <?php endif; ?>><?php echo e($dis->name); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                      </div>

                        <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label" >City</label>
                        <div class="col-sm-10">
                          <select class="form-control" name="city" id="city">
                              <option value="">-city-</option>
                             <?php $__currentLoopData = $citys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($city->id); ?>" <?php if(Auth::user()->city==$city->id): ?> selected <?php endif; ?>><?php echo e($city->name); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                        </div>
                      </div>


                      <h4 class="upd-h4">Home Location</h4>
                      <div class="form-group">
                       
                        <div class="col-sm-12">
                            <div class="checkbox">
                              <input type="checkbox" value="active" name="current_location" id="current_location" <?php if(isset($home_location->home_city)): ?> <?php else: ?>  checked="checked" <?php endif; ?> >
                              <sapn style="padding-left: 15px;">Set your home location as current location</sapn>

                            </div>
                        </div>
                      </div>
                        
                        <div class="clearfix"></div>
                        <div  <?php if(isset($home_location->home_city)): ?>  <?php else: ?> style="display:none"  <?php endif; ?>   id="homeDiv">
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
                              <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($state->id); ?>" <?php if(isset($home_location->home_state)): ?> <?php if($home_location->home_state==$state->id): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e($state->name); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           
                            </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">District</label>
                        <div class="col-sm-10">
                           <select class="form-control" name="home_district" id="home_district" onChange="gethomeCity()">
                            <option value="">-district-</option>
                              <?php $__currentLoopData = $hdistricts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($dis->id); ?>" <?php if(isset($home_location->home_district)): ?> 
                                <?php if($home_location->home_district==$dis->id): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e($dis->name); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">City</label>
                        <div class="col-sm-10">
                          <select class="form-control" name="home_city" id="home_city">
                                <option value="">-city-</option>
                                  <?php $__currentLoopData = $hcitys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($city->id); ?>"  <?php if(isset($home_location->home_city)): ?>  <?php if($home_location->home_city==$city->id): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e($city->name); ?>

                                  </option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
              <?php echo Form::open(array('url' => 'user/change_password','method' => 'POST','class' => '','files' => true)); ?>


              <?php if(!$errors->passwordErrors->isEmpty()): ?>
              <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->passwordErrors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
              <?php endif; ?>

              <?php if(session()->has('passwordMessages')): ?>
                <div class="alert alert-success">
                  <?php echo e(session()->get('passwordMessages')); ?>

                </div>
              <?php endif; ?>

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
                <?php echo Form::open(array('url' => 'user/change_image','method' => 'POST','class' => 'form-horizontal','files' => true )); ?>


                 <?php if(!$errors->imageErrors->isEmpty()): ?>
                  <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->imageErrors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                  <?php endif; ?>


               <?php if(session()->has('imagesMessages')): ?>
                <div class="alert alert-success">
                  <?php echo e(session()->get('imagesMessages')); ?>

                </div>
              <?php endif; ?>

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
                <?php echo Form::open(array('url' => 'user/change_cover_image','method' => 'POST','class' => 'form-horizontal','files' => true )); ?>


                 <?php if(!$errors->cover_imageErrors->isEmpty()): ?>
                  <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->cover_imageErrors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                  <?php endif; ?>


               <?php if(session()->has('cover_imageMessages')): ?>
                <div class="alert alert-success">
                  <?php echo e(session()->get('cover_imageMessages')); ?>

                </div>
              <?php endif; ?>

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

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_script'); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>