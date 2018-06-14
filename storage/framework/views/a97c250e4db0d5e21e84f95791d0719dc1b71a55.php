<?php $__env->startSection('content'); ?>
 <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3> Pages</h3>
              </div>

              <div class="title_right">
                <div class="col-md-2 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                     <a href=<?php echo e(url('admin/pages/create')); ?>> <button class="btn btn-primary" type="submit">Add Pages</button></a>
                    
                  </div>
                </div>
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
                      
              <?php if(session()->has('success')): ?>
                <div class="alert alert-success">
                    <?php echo e(session()->get('success')); ?>

                </div>
              <?php endif; ?>
        
        <table id="view_table" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
              <th></th>
                <th>Name</th>
                <th>Url</th>
                 <th>Sort</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($row->id); ?></td>
                <td><?php echo e($row->name); ?> </td>
                <td><?php echo e($row->url); ?></td>
                <td><?php echo e($row->sort); ?></td>
                <td><?php echo e($row->status); ?></td>

                <td>
                  <a class="btn btn-primary btn-xs" href="<?php echo e(url("admin/pages/$row->id")); ?>">View</a> 
                  <a class="btn btn-info btn-xs" href="<?php echo e(url("admin/pages/$row->id/edit")); ?>">Edit</a> 
                  <button class="btn btn-danger btn-xs" onclick="deleteItam(<?php echo e($row->id); ?>)">Delete</button>
              </td>

            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

<?php $__env->startSection('footerscript'); ?>

            <?php echo e(Html::script('public/admin/js/jquery.dataTables.min.js')); ?>

            <?php echo e(Html::style('public/admin/css/jquery.dataTables.min.css')); ?>


            
          <script type="text/javascript" class="init"> 
          $(document).ready(function() {
            $('#view_table').DataTable( {
                "pageLength": 50
            });
            
            });

            function deleteItam(id){
              if(confirm("Are you sure?"))
              {
                $.ajax({
                url:'pages/'+id,
                type:'delete',
                beforeSend: function(xhr){
                xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));},
                cache: false,
                async:false,
                data:{'id':id},
                success:function(data){
                 location.reload();
                }
                })
              }
            }
        
          
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