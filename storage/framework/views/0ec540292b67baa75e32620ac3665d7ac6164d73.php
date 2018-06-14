


<?php $__env->startSection('content'); ?>
 <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Property List</h3>
              </div>

              <div class="title_right">
                <div class="col-md-2 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                     <a href=<?php echo e(url('admin/property/create')); ?>> <button class="btn btn-primary" type="submit">Add Property</button></a>
                    
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

        
        <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th>Category</th>
                <th>Name</th>
                <td>Property id </td>
                <th>Price</th>
                <th>City</th>
                <th>Status</th>
                <th>Action</th>
                <th></th>
      
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $property; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($row->id); ?></td>
                <td><?php echo e($row->category->name); ?>  </td>
                <td><?php echo e($row->name); ?> </td>
                <td><?php echo e($row->property_id); ?> </td>
                <td><?php echo e($row->price); ?> </td>
                <td><?php echo e($row->city); ?> </td>
                <td><?php echo e($row->status); ?></td>
                <td>  
                  <a class="btn btn-warning btn-xs" href="<?php echo e(url("admin/property/$row->id")); ?>">View</a>
                  <a class="btn btn-primary btn-xs" href="<?php echo e(url("admin/property/$row->id/edit")); ?>">Edit</a>
                 </td>
               <td> <?php echo Form::open(array('url' => "admin/property/".$row->id,'method' => 'delete')); ?>

                      <?php echo Form::submit('delete!' , array(' class'  => 'btn btn-danger btn-xs','name'=>'delete' ));; ?>  
                    <?php echo Form::close(); ?> </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
              <?php $__env->startSection('footerscript'); ?>
                                <!-- js -->
              <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
              <script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
              <!-- js -->
              <!-- css -->
                  <link href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css" rel="stylesheet">
              <!-- css -->
                
              <script type="text/javascript" class="init"> 
              $(document).ready(function() {
                $('#example').DataTable( {
                  
                  initComplete: function () {
                    this.api().columns().every( function () {
                      var column = this;
                      var select = $('<select><option value=""></option></select>')
                        .appendTo( $(column.footer()).empty() )
                        .on( 'change', function () {
                          var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                          );
               
                          column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                        } );
               
                      column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                      } );
                    } );
                  }
                } );
                
              } );
               
              </script>
                <script>
                $(document).ready(function() {
                oTable=$('#example').DataTable();

                var oTable = $('#example').dataTable();

                // Sort immediately with columns 0 and 1
                oTable.fnSort( [ [0,'desc'] ] );

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