<!-- Modal -->

  <div class="modal-header">

    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

    <h4 class="modal-title" id="myModalLabel">Delete Post</h4>

  </div>

  <div class="modal-body">

    <form class="form-horizontal">

       <?php echo e(csrf_field()); ?>


        <h4>This will be removed from your timeline. </h4>



    

       <input type="hidden" name="post_id" value="<?php echo e($id); ?>">

       

  </form>



  </div>

  <div class="modal-footer">

    <button type="button" class="btn btn-primary" onclick="deletePost(<?php echo e($id); ?>)" ()>Delete</button>

  </div>

