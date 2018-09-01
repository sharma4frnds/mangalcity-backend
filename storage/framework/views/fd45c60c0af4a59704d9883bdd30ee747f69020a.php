<!-- Modal -->
  <div class="modal-header ">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Profile Picture</h4>
  </div>
  <div class="modal-body" >
   <div class="text-center">    
    <?php echo e(Html::image('/public/images/user/'.Auth::user()->image,'img',array('class'=>'img-responsive','width'=>300,'height'=>200))); ?>

  </div>

  </div>


  <div class="modal-footer">
   
  </div>



