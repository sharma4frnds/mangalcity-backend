<!-- Modal -->
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Update Cover Picture</h4>
  </div>
  <div class="modal-body">
  <?php echo Form::open(array('url' => 'user/change_cover_image','name'=>'change_cover_Upload','id'=>'change_cover_Upload','method' => 'POST','class' => 'form-horizontal','files' => true )); ?>

    <div id="form-errors"></div>

       <?php echo e(csrf_field()); ?>

        <div class="form-group">
          <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <span class="image-preview-input-title">Browse</span>
                          <input type="file" class="file form-control" placeholder="" name="cover_image" required="">
          </div>
       </div>

       <div class="form-group">
          <div class="col-sm-offset col-sm-10">
             <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Upload</button>
       
          </div>
      </div>

  </form>

  </div>
  <div class="modal-footer">
   
  </div>
