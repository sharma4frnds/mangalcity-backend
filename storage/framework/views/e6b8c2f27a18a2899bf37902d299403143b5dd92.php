<!-- Modal -->
  <div class="modal-header ">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Update Cover Picture</h4>
  </div>
  <div class="modal-body" >

    <input type="file" id="profile_image_cropp_upload" accept="image/*">

    <?php if(Auth::user()->cover_image !='default.png'): ?>
    <div class="removed_profile"> 
      <button class="btn btn-primary" id="removed_cover_pic">Removed Cover Picture</button> 
        <div class="image_ajax_load1 text-center" style="display:none">
           <p><?php echo e(Html::image('public/img/loader.gif')); ?> Loading...</p>
        </div>
    </div>
    <?php endif; ?>
    <hr>

    <div id="image_selected_div" style="display:none">
     
      
      <div id="profile_image_cropp" style="width:350px"></div>
        
        <button class="btn btn-success upload-image-result" style="display: none">Upload Image</button>
           <div class="image_ajax_load text-center" style="display:none">
           <p><?php echo e(Html::image('public/img/loader.gif')); ?> Loading...</p>
          </div>
        <br>
      </div>


  </div>


  <div class="modal-footer">
   
  </div>




<script type="text/javascript">
$uploadCrop = $('#profile_image_cropp').croppie({
    enableExif: true,
    viewport: {
        width: 850,
        height: 351,
      
    },
    boundary: {
        width: 850,
        height: 351
    }
});


$('#profile_image_cropp_upload').on('change', function () { 
  $("#image_selected_div").show();
  var reader = new FileReader();
    reader.onload = function (e) {
      $uploadCrop.croppie('bind', {
        url: e.target.result
      }).then(function(){

        $(".cr-slider-wrap").append('<b>Image Zoom</b>');
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
      url: "<?php echo e(url('user/change_cover_image')); ?>",
      type: "POST",
        beforeSend: function(xhr){
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr("content"));},
        cache: false,
       // async:false,
      data: {"cover_image":resp},
      success: function (data) {
         $('.image_ajax_load').hide();
           location.reload();
      }
    });
  });
});


$("#removed_cover_pic").click(function(){
  var con=confirm("Are you sure you want to remove your Cover Photo?")
  if(con){
     $('.image_ajax_load1').show();
    $.ajax({
      url: "<?php echo e(url('user/removed_cover_image')); ?>",
      type: "POST",
      beforeSend: function(xhr){
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr("content"));},
        cache: false,
      success:function(){
         toastr.success('Successfully removed cover photo.');
         location.reload();
      }
    });
  }
});




</script>

