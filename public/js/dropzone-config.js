var photo_counter = 0;
Dropzone.options.realDropzone = {

    uploadMultiple: true,
    paramName: "image",
    parallelUploads: 15,
    maxFilesize: 5,
    autoProcessQueue: false,
     enqueueForUpload: false,
    previewsContainer: '#dropzonePreview',
    previewTemplate: document.querySelector('#preview-template').innerHTML,
    addRemoveLinks: true,
    dictRemoveFile: '✘',
    dictFileTooBig: 'Image is bigger than 8MB',
    //clickable: false,
    thumbnailWidth: 40,
    thumbnailHeight: 35,
    acceptedFiles: "image/*",
    clickable: "#npimage",
    capture : 'audio/*',


    /* accept: function(file, done) {
        var ext = (file.name).split('.')[1]; // get extension from file name
        if (ext == 'jpg' || ext == 'png') {
          done("Dont like those extension"); // error message for user
        }
        else { done(); } // accept file
        done();
      },

      */

    // The setting up of the dropzone
    init:function() {

      var myDropzone = this;

      $('#submitfiles').on("click", function (e) {

        e.preventDefault();
        e.stopPropagation();

        if(myDropzone.getQueuedFiles().length > 0){
          myDropzone.processQueue();

         /*   after submit removed image
               myDropzone.on("complete", function(file) {
                 myDropzone.removeFile(file);
              });
            end removed
          */

        }else{
            //$('#real-dropzone').submit();
     
          //alert('No Files to upload!');
            document.querySelector("#total-progress .progress-bar").style.width =  "100%";
            var npvideo= $("#npvideo").val();
            var npaudio= $("#npaudio").val();
            var npmessage= $("#npmessage").val();
           // alert(npvideo); alert(npaudio); alert(npmessage);
            if(npvideo =='' && npaudio =='' && npmessage =='')
             {
               $("#npmessage").focus();
            }else{
                myDropzone.uploadFiles([{name:'nofiles'} ]);
            }
         }

      });


    myDropzone.on("sending", function(file, xhr, formData) {
        document.querySelector("#total-progress").style.opacity = "0";
          $( "#submitfiles" ).prop( "disabled", true );

          var npaudio_data = $("#npaudio").prop("files")[0];   
          formData.append("audio", npaudio_data);

          var npvideo_data = $("#npvideo").prop("files")[0];   
          formData.append("video", npvideo_data);
          // alert('tete2');
    });

    myDropzone.on("totaluploadprogress", function(progress) {
        document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
        // alert('tete3');
        $("#mloader").show();
    });



    myDropzone.on("queuecomplete", function(progress) {
          document.querySelector("#total-progress").style.opacity = "1";
      $( "#submitfiles" ).prop( "disabled", false );
      $("#mloader").hide();
   
    });

    myDropzone.on("successmultiple", function(file, data) {
      console.log(file);
      data = $.parseJSON(data);
          $("#queued-files").html('');
          $("#dropzonePreview").html('');
           $("#mloader").hide();
          //toastr.success('successfully posted');
          $('#real-dropzone').each(function(){
                this.reset();
          });
  
       var hdiv='';
            hdiv +='<div class="col-md-12 col-sm-4 col-xs-12 box-shd top-pd-20" id="postdiv'+data.pdata.id+'">';
                hdiv +='<div class="col-md-6">';
                 hdiv +='<div class="pro1"><img src="'+data.pdata.image+'" class="img-responsive"></div>';  
                 hdiv +='<span class="pro-name">'+data.pdata.name+'</span></br>';
                hdiv +='<span class="post-time">just now</span>'; 
                hdiv +='</div>';
            
                hdiv +='<div class="col-md-6">';
                    hdiv +='<div class="dropdown">';
                     hdiv +='<i data-toggle="dropdown" class="fa dropdown-toggle fa fa-ellipsis-v"></i>';
                     hdiv +='<ul class="dropdown-menu side-fix">';
                        hdiv +='<li><a onclick="delete_post_popup('+data.pdata.id+')">Delete</a></li>';
              
                       hdiv +='<li><a data-toggle="modal" href="'+siteUrl+'/reportFeedback/'+data.pdata.id+'" data-target="#myModal"> Give Feedback on This Post</a></li>';
                     hdiv +='</ul>';
                   hdiv +='</div>';
                hdiv +='</div>';
                if(data.pdata.message !=''){
                hdiv +='<p class="post-txt">'+data.pdata.message+'</p>';
                }
                if(data.pdata.type=='image'){
                  var media=data.pdata.value;
                  var imgCount=media.length;
                  var imgDip=5;
                  if(imgCount<5) imgDip=imgCount;
                  var im=1; var imid=''; var spim='';

                   hdiv +='<div class="lightboxp image-layout-'+imgDip+'"  data-id='+data.pdata.id+'>';
                     $.each(media, function(key,value) {
                     
                      if(im==5 && imgCount > 5) { imid='moreImgDef'; rim=imgCount-5; spim="<span>"+rim+"+</span>"; }
                         hdiv +='<div class="post-img2" id="'+imid+'" style="background-image: url('+value+')">'+spim+'</div>';
                         if(im==5) return false; 
                         im=im+1;
                    });
                  hdiv +='</div>';
                }

                if(data.pdata.type=='video'){
                    hdiv +='<div class="post-video"><video width="100%" height="315" controls><source src="'+data.pdata.value+'" type="video/mp4"></video></div>';
                }
                if(data.pdata.type=='audio'){
                    hdiv +='<div class="post-audio"><audio controls > <source src="'+data.pdata.value+'"></audio></div>';
                }
                hdiv +='<div class="share-area">';
                    hdiv +='<ul>';
                     hdiv +='<li ><a onclick="doLike('+data.pdata.id+',0)" id="dolike'+data.pdata.id+'" ><i class="fa fa-thumbs-o-up"></i> 0</a> <div class="content_like"><span class="tooltiptext" data-toggle="tooltip" title="Please wait.." id="clike_'+data.pdata.id+'">Like </span></div></li>';   
                     hdiv +='<li ><a onclick="dodislikes('+data.pdata.id+',1)" id="dodislikes'+data.pdata.id+'" ><i class="fa fa-thumbs-o-down"></i> 0</a></i> <div class="content_dislike"><span title="Please wait.." id="cdislike_'+data.pdata.id+'">Dislike</span></div></li>';   
                     hdiv +='<li><a onclick="focus_form('+data.pdata.id+')"><i class="fa fa-comment" aria-hidden="true"></i> Comment</i></a> </li>';  
                     hdiv +='<li><a onclick="share_post_popup('+data.pdata.id+')"><i class="fa fa-share-alt" aria-hidden="true"></i> Share</a> </li>';
                      if(data.pdata.type=='image'){
                        hdiv +='<li><a href="'+siteUrl+'/download_image/'+data.pdata.id+'"><i class="fa fa-cloud-download" aria-hidden="true"></i>Download</a></li>';
                      }   
                    hdiv +='</ul>';
                hdiv +='</div>';
           

                  hdiv +='<div class="hr"></div>';
                  hdiv +='<div id="comment_section'+data.pdata.id+'"></div>';

                    hdiv +='<div class="col-md-12 col-sm-4 col-xs-12 top-pd-20 cmnt-pnl">';
                    hdiv +='<div class="col-md-12 cmnt-pnl-ped">';
                     hdiv +='<div class="pro1"><img src="'+data.pdata.image+'" class="img-responsive"></div>';  
                     hdiv +='<div class="cmnt-box">';
                       hdiv +='<textarea rows="1" cols="100" name="comment" form="usrform" id="comment-form'+data.pdata.id+'" placeholder="write a reply..."> </textarea>';
                       hdiv +='<input type="hidden" name="cmnt_post_id"  value="'+data.pdata.id+'">';
                        hdiv +='<input type="hidden" name="cmnt_comment_id" value="0">';

                    hdiv +='</div>';
                    hdiv +='</div>';
                hdiv +='</div>';
                hdiv +='</div>';

             hdiv +='</div>';


         $("#currentMessage").prepend(hdiv);
    });

      
       myDropzone.on("addedfile", function (file) {
          $("#npaudio").val("");
          $("#npvideo").val("");
          $("#queued-files").html("");
        });
      
      myDropzone.on('removedfile', function(file){
         $("#mloader").hide();
      });
      
      // myDropzone.on("reset", function (file) {
      //         //used for disabling the submit button if no file exist 
      //         $( "#submitfiles" ).prop( "disabled", true );
      //   });
      
    myDropzone.on('error', function(file, data) {
        $("#error_div").html('');
        $("#mloader").hide();
        if(data.success==false){
            //$("#error_div").show();
            if(data.errors.message){
               // $("#error_div").html(data.errors.message+'<button type="button" class="close" data-dismiss="alert">x</button>');
             toastr.error(data.errors.message);
            }
            if(data.errors.image){
                toastr.error(data.errors.image);
                //$("#error_div").html(data.errors.image+'<button type="button" class="close" data-dismiss="alert">x</button>');
            }
            if(data.errors.video){
                toastr.error(data.errors.video);
                //$("#error_div").html(data.errors.video+'<button type="button" class="close" data-dismiss="alert">x</button>');
            }
            if(data.errors.audio){
                toastr.error(data.errors.audio);
                //$("#error_div").html(data.errors.video+'<button type="button" class="close" data-dismiss="alert">x</button>');
            }
            if(data.errors.error){
                toastr.error(data.errors.error);
               // $("#error_div").html(data.errors.error+'<button type="button" class="close" data-dismiss="alert">x</button>');
            }
         
        }
    });
   

    }
}
