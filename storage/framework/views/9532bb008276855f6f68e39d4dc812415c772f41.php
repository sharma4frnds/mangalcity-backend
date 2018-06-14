<?php $__env->startSection('content'); ?>
 <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Property Create</h3>
              </div>

             
            </div>

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                    <br />

                    <?php if(count($errors) > 0): ?>
                       <div class="alert alert-danger">
                              <ul class='text'>
                                  <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </ul>
                          </div>
                      <?php endif; ?>


                    <?php echo Form::open(array('url' => 'admin/property','method' => 'POST','class' => 'form-horizontal form-label-left','files' => true)); ?>


                      <div class="form-group">
                        <label for="first-name" class="control-label col-md-2 col-sm-2 col-xs-12">
                        Category <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <select id="category" name="category" required="required" class="form-control col-md-7 col-xs-12" >
                            <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <option value="<?php echo e($cat->id); ?>" <?php echo e(old('category') == $cat->id ? 'selected' : ''); ?>><?php echo e($cat->name); ?> </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                        </div>

                          <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Price <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="number" id="price" name="price" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo e(old('price')); ?>">
                        </div> 

                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo e(old('name')); ?>">
                        </div>

                        <label for="first-name" class="control-label col-md-2 col-sm-2 col-xs-12">
                        Type  <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <select id="type" name="type" required="required" class="form-control col-md-7 col-xs-12" >
                           <option value="buy" <?php echo e(old('type') == 'buy' ? 'selected' : ''); ?>>Buy </option>
                           <option value="sale" <?php echo e(old('type') == 'sale' ? 'selected' : ''); ?>>Sale </option>
                          </select>
                        </div> 
                         
                      </div>

                       <div class="form-group">

                       <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Bedroom 
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" id="bedroom" name="bedroom"  class="form-control col-md-7 col-xs-12" value="<?php echo e(old('bedroom')); ?>">
                        </div>

                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Bathroom 
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" id="name" name="bathroom"  class="form-control col-md-7 col-xs-12" value="<?php echo e(old('bathroom')); ?>">
                        </div>

                      </div>

                       <div class="form-group">

                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Garage 
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" id="garage" name="garage"  class="form-control col-md-7 col-xs-12" value="<?php echo e(old('garage')); ?>">
                        </div>
                          <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Garage Size 
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" id="garage_size" name="garage_size"  class="form-control col-md-7 col-xs-12" value="<?php echo e(old('garage_size')); ?>">
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Property Size 
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" id="property_size" name="property_size"  class="form-control col-md-7 col-xs-12" value="<?php echo e(old('property_size')); ?>">
                        </div>
                          <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Year built 
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" id="year_built" name="year_built"  class="form-control col-md-7 col-xs-12" value="<?php echo e(old('year_built')); ?>">
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Area
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" id="area" name="area"  class="form-control col-md-7 col-xs-12" value="<?php echo e(old('area')); ?>" required="">
                        </div>
                          <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">City
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" id="city" name="city" class="form-control col-md-7 col-xs-12" value="<?php echo e(old('city')); ?>" required="">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Zip
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" id="zip" name="zip"  class="form-control col-md-7 col-xs-12" value="<?php echo e(old('zip')); ?>" required="">
                        </div>
                          <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">State
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" id="state" name="state"  class="form-control col-md-7 col-xs-12" value="<?php echo e(old('state')); ?>" required="">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name"> County
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" id="county" name="county"  class="form-control col-md-7 col-xs-12" value="<?php echo e(old('county')); ?>" required="">
                        </div>

                          <label for="first-name" class="control-label col-md-2 col-sm-2 col-xs-12">
                        Status  <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <select id="status" name="status" required="required" class="form-control col-md-7 col-xs-12" >
                           <option value="active" <?php echo e(old('status') == 'active' ? 'selected' : ''); ?>>Active </option>
                           <option value="inactive" <?php echo e(old('status') == 'inactive' ? 'selected' : ''); ?>>Inactive </option>
                          </select>
                        </div> 
                      </div>
                      

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Style
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" id="style" name="style"  class="form-control col-md-7 col-xs-12" value="<?php echo e(old('style')); ?>" >
                        </div>
                          <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Condition
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" id="condition" name="condition"  class="form-control col-md-7 col-xs-12" value="<?php echo e(old('condition')); ?>" >
                        </div>
                      </div>



                      <div class="clearfix"></div>
                      <br/>
                     <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Description <span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                          <textarea name='description' id="description" rows="10" class="form-control"><?php echo e(old('description')); ?></textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Feature <span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                          <textarea name='feature' id="feature" rows="10" class="form-control"><?php echo e(old('feature')); ?></textarea>
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Advance Details <span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                          <textarea name='detail' id="detail" rows="10" class="form-control">
                           <?php echo e(old('detail')); ?>

                          </textarea>
                        </div>
                      </div>



                        <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Advance Details <span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                          <textarea name='detail' id="detail" rows="10" class="form-control">
                           <?php echo e(old('detail')); ?>

                          </textarea>
                        </div>
                      </div>

 

                      <div class="form-group">
                       <label for="first-name" class="control-label col-md-2 col-sm-2 col-xs-12">
                        Freatured property <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <select id="freatured" name="freatured" required="required" class="form-control col-md-7 col-xs-12" >
                           <option value="no" <?php echo e(old('freatured') == 'no' ? 'selected' : ''); ?>>no </option>
                           <option value="yes" <?php echo e(old('freatured') == 'yes' ? 'selected' : ''); ?>>yes </option>
                          </select>
                        </div> 
                          <label for="first-name" class="control-label col-md-2 col-sm-2 col-xs-12">
                        Recently Property<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <select id="recently" name="recently" required="required" class="form-control col-md-7 col-xs-12" >
                           <option value="no" <?php echo e(old('recently') == 'no' ? 'selected' : ''); ?>>no </option>
                           <option value="yes" <?php echo e(old('recently') == 'yes' ? 'selected' : ''); ?>>yes </option>
                          </select>
                        </div> 
                      </div>

                      <div class="input-group control-group increment col-md-offset-2">
                        <input type="file" name="image[]" class="form-control">
                        <div class="input-group-btn"> 
                          <button class="btn btn-success adddiv" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                        </div>
                      </div>

                       <div class="clone hide">
                          <div class="control-group input-group col-md-offset-2" style="margin-top:10px">
                            <input type="file" name="image[]" class="form-control">
                            <div class="input-group-btn"> 
                              <button class="btn btn-danger removediv" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                            </div>
                          </div>
                        </div>

                    <div class="ln_solid"></div>

                      <div class="form-group">
                      <div class="col-md-8 col-sm-6 col-xs-12 col-md-offset-2">
                        <button type="submit" class="btn btn-primary">submit</button>
                        
                      </div>
                    </div>

                    <?php echo Form::close(); ?>


                      <?php $__env->startSection('footerscript'); ?>
                      <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
                      <script>CKEDITOR.replace('feature');</script>
                      <script>CKEDITOR.replace('description');</script>
                      <script>CKEDITOR.replace('detail');</script>
                     
                      <script type="text/javascript">
                          $(document).ready(function() {
                            $(".adddiv").click(function(){ 
                                var html = $(".clone").html();
                                $(".increment").after(html);
                            });

                            $("body").on("click",".removediv",function(){ 
                                $(this).parents(".control-group").remove();
                            });

                          });
                      </script>
                       <?php $__env->stopSection(); ?>
                  </div>
                </div>
              </div>
            </div>

          </div>
         </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>