<!-- Modal -->
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel"></h4>
  </div>
  <div class="modal-body">
  	<p class="post-txt"><?php echo e($post->message); ?></p>
  <?php echo e(Html::image('public/images/post/post_image/'.$post->value,'img',array('class'=>'img-responsive'))); ?>  
  </div>
  <div class="modal-footer">
   
  </div>
