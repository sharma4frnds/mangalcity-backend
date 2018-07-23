<!-- Modal -->
  <div class="modal-header ">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Update Profile Picture</h4>
  </div>
  <div class="modal-body">




      <div class="row">
        <div class="col-md-4 text-center">
        <div id="profile_image_cropp" style="width:350px"></div>
        </div>
        <div class="col-md-4" style="padding-top:30px;">
        <strong>Select Image:</strong>
        <br/>
        <input type="file" id="profile_image_cropp_upload" accept="image/*">
        <br/>
        <button class="btn btn-success upload-image-result" style="display:none">Upload Image</button>
         <div class="image_ajax_load text-center" style="display:none">
           <p><?php echo e(Html::image('public/img/loader.gif')); ?> Loadinging</p>
          </div>
        <br>
      
        </div>
        
      </div>




  </div>
  <div class="modal-footer">
   
  </div>




<script type="text/javascript">
$uploadCrop = $('#profile_image_cropp').croppie({
    enableExif: true,
    viewport: {
        width: 120,
        height: 120,
        //type: 'circle'
    },
    boundary: {
        width: 200,
        height: 200
    }
});


$('#profile_image_cropp_upload').on('change', function () { 
  var reader = new FileReader();
    reader.onload = function (e) {
      $uploadCrop.croppie('bind', {
        url: e.target.result
      }).then(function(){
        $(".upload-image-result").show();
        console.log('bind complete');
      });
      
    }
    reader.readAsDataURL(this.files[0]);
});


$('.upload-image-result').on('click', function (ev) {
  $uploadCrop.croppie('result', {
    type: 'canvas',
    size: 'viewport'
  }).then(function (resp) {

 $('.image_ajax_load').show();
    $.ajax({
      url: "<?php echo e(url('user/change_image')); ?>",
      type: "POST",
        beforeSend: function(xhr){
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr("content"));},
        cache: false,
        async:false,
      data: {"image":resp},
      success: function (data) {
         $('.image_ajax_load').hide();
            location.reload();
      }
    });
  });
});


</script>

