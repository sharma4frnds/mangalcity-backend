<!-- Modal -->
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Give Feedback on This Post</h4>
  </div>
  <div class="modal-body">
    <form class="form-horizontal">

    <div class="alert alert-danger" role="alert" id="errer_div" style="display: none"></div>

       <?php echo e(csrf_field()); ?>

        <h4>We use your feedback to help us learn when something's not right.</h4>
       
        <?php $__currentLoopData = $spam_tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <div class="form-group col-sm-offset col-sm-10">
           <div class="radio">
              <label><input type="radio" name="spam_tags" id="spam_tags"  value="<?php echo e($tag->id); ?>" checked><?php echo e($tag->name); ?>

              </label>
           </div>
       </div>
       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       <input type="hidden" name="post_id" id="post_id" value="<?php echo e($id); ?>">


       <div class="form-group">
          <div class="col-sm-offset col-sm-10">
            <button type="button" class="btn btn-primary" onclick="reportFeedback()">Send</button>  
          </div>
      </div>


  </form>

  </div>
  <div class="modal-footer">
   
  </div>
