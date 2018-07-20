<!-- Modal -->
  <div class="modal-header ">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Update Profile Picture</h4>
  </div>
  <div class="modal-body" >

    <input type="file" id="profile_image_cropp_upload" accept="image/*">
    <hr>
    <div id="image_selected_div">
      <div id="profile_image_cropp" style="width:350px"></div>
        <strong>Select Image:</strong>
        <button class="btn btn-success upload-image-result" style="display: none">Upload Image</button>
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
      url: "{{url('user/change_cover_image')}}",
      type: "POST",
        beforeSend: function(xhr){
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr("content"));},
        cache: false,
        async:false,
      data: {"cover_image":resp},
      success: function (data) {
         $('.image_ajax_load').hide();
           location.reload();
      }
    });
  });
});


</script>

