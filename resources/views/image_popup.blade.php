<!-- Modal -->
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Update Profile Picture</h4>
  </div>
  <div class="modal-body">
  {!! Form::open(array('url' => 'user/change_image','name'=>'imageUpload','id'=>'imageUpload','method' => 'POST','class' => 'form-horizontal','files' => true )) !!}
    <div id="form-errors"></div>

       {{ csrf_field() }}
        <div class="form-group">
     <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <span class="image-preview-input-title">Browse</span>
                        <input type="file"  name="image"/> <!-- rename it -->
          </div>
       </div>
       <div class="form-group">
          <div class="col-sm-offset col-sm-10">
         
            <button type="submit" class="btn btn-primary">Upload</button>
           <div class="image_ajax_load text-center" style="display:none">
           <p>{{Html::image('public/img/loader.gif')}} Loadinging</p>
          </div>
          </div>
      </div>

  </form>

  </div>
  <div class="modal-footer">
   
  </div>
