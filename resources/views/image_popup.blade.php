<!-- Modal -->
  <div class="modal-header ">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Update Profile Picture</h4>
  </div>
  <div class="modal-body user-pro">




      <div class="row">
        <div class="col-md-6 text-center" id="image_cropp" style="display: none">
        <div id="profile_image_cropp" style="width:350px"></div>
        </div>
        <div class="col-md-6 flt" style="padding-top:30px;">
        @if(Auth::user()->image !='default.png')
           <div class="flt">

    <div class="file-select-button" id="fileName">Choose File</div>
    <div class="file-select-name" id="noFile">No file chosen...</div> 
        <input type="file" id="profile_image_cropp_upload" accept="image/*">
      </div>
        <div class="removed_profile pos"> 
          <button class="btn btn-primary" id="removed_profile_pic">Removed Cover Picture</button> 
            <div class="image_ajax_load1 text-center" style="display:none">
               <p>{{Html::image('public/img/loader.gif')}} Loading...</p>
            </div>
        </div>
        @endif

        <br/>


        <button class="btn btn-success upload-image-result" style="display:none">Upload Image</button>
         <div class="image_ajax_load text-center" style="display:none">
           <p>{{Html::image('public/img/loader.gif')}} Loading...</p>
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
  $("#image_cropp").show();
  var reader = new FileReader();
    reader.onload = function (e) {
      $uploadCrop.croppie('bind', {
        url: e.target.result
      }).then(function(){
        $(".upload-image-result").show();
        $(".cr-slider-wrap").append('<b>Image Zoom</b>');

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
      url: "{{url('user/change_image')}}",
      type: "POST",
        beforeSend: function(xhr){
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr("content"));},
        cache: false,
       // async:false,
      data: {"image":resp},
      success: function (data) {
         $('.image_ajax_load').hide();
            location.reload();
      }
    });
  });
});


$("#removed_profile_pic").click(function(){
  var con=confirm("Are you sure you want to remove your Cover Photo?")
  if(con){
     $('.image_ajax_load1').show();
    $.ajax({
      url: "{{url('user/removed_profile_image')}}",
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

