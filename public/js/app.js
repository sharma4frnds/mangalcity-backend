var siteUrl=$('meta[name=base-url]').attr("content");
$(document).ready(function(){
var siteUrl=$('meta[name=base-url]').attr("content");

    /*
        post Text
        post Images & vedies
    */
try {
  
 
$('#feedForm').ajaxForm({ 
        // dataType identifies the expected content type of the server response 
        beforeSubmit: function() {
        $("#mloader").show();
        },
        dataType:  'json', 
        success: processJson,
    });
}
catch(err) {

}

    function processJson(data) 
    { 
       $("#mloader").hide();
        $("#error_div").html('');
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

        if(data.success==true){
            $('#feedForm').each(function(){
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

                hdiv +='<p class="post-txt">'+data.pdata.message+'</p>';
                if(data.pdata.type=='image'){
                    hdiv +='<div class="post-img"><a data-toggle="modal" href="'+siteUrl+'/image_popup/'+data.pdata.id+'" data-target="#myModal"> <img src="'+data.pdata.value+'" class="img-responsive"> </a></div>'
                }

                if(data.pdata.type=='video'){
                    hdiv +='<div class="post-video"><video width="100%" height="315" controls><source src="'+data.pdata.value+'" type="video/mp4"></video></div>';
                }
                if(data.pdata.type=='audio'){
                    hdiv +='<div class="post-audio"><audio controls > <source src="'+data.pdata.value+'"></audio></div>';
                }
                hdiv +='<div class="share-area">';
                    hdiv +='<ul>';
                     hdiv +='<li ><a onclick="doLike('+data.pdata.id+',0)" id="dolike'+data.pdata.id+'" ><i class="fa fa-thumbs-o-up"></i> 0</a> </li>';   
                     hdiv +='<li ><a onclick="dodislikes('+data.pdata.id+',1)" id="dodislikes'+data.pdata.id+'" ><i class="fa fa-thumbs-o-down"></i> 0</a>  </i></li>';   
                     hdiv +='<li><a onclick="focus_form('+data.pdata.id+')"><i class="fa fa-comment" aria-hidden="true"></i> Comment</i></a> </li>';  
                     hdiv +='<li><a onclick="share_post_popup('+data.pdata.id+')"><i class="fa fa-share-alt" aria-hidden="true"></i> Share</a> </li>';   
                    hdiv +='</ul>';
                hdiv +='</div>';
           

                  hdiv +='<div class="hr"></div>';
                  hdiv +='<div id="comment_section'+data.pdata.id+'"></div>';

                    hdiv +='<div class="col-md-12 col-sm-4 col-xs-12 top-pd-20 cmnt-pnl">';
                    hdiv +='<div class="col-md-12 cmnt-pnl-ped">';
                     hdiv +='<div class="pro1"><img src="'+data.pdata.image+'" class="img-responsive"></div>';  
                     hdiv +='<div class="cmnt-box">';
                        hdiv +='<textarea rows="2" cols="100" name="comment" id="comment-form'+data.pdata.id+'" placeholder="Leave a comment..."></textarea>';
                        hdiv +='<button class="post-bt" onclick="postComment('+data.pdata.id+',0)">Post</button>';
                    hdiv +='</div>';
                    hdiv +='</div>';
                hdiv +='</div>';
                hdiv +='</div>';

             hdiv +='</div>';


         $("#currentMessage").prepend(hdiv);
          toastr.success('successfully posted');
          $("#queued-files").html('').hide();
          $("#imagePreview").html('').hide();
   
        }

    
        
    }





});

//doLike
function doLike(post_id,like_type){

    $.ajax({
        url: siteUrl+'/dolike',
        type: 'POST',
        beforeSend: function(xhr){
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr("content"));},
        cache: false,
        async:false,
        data: {'post_id':post_id,'like_type':like_type},
        success:function(data){
            if(data.type==0){
            $("#dolike"+post_id).html('<i class="fa fa-thumbs-o-up" aria-hidden="true"> ' + data.lcount);
            toastr.success('Removed to Liked Post');
            }
            else
            {
              $("#dolike"+post_id).html('<i class="fa fa-thumbs-up"></i> ' + data.lcount);
              toastr.success('Added to Liked Post');
            }

            $("#dodislikes"+post_id).html('<i class="fa fa-thumbs-o-down" aria-hidden="true"> ' + data.dcount);
        },
        error: function(data) {
          //
            }
      
        })


}
//end like

//doLike
function dodislikes(post_id,like_type){

  $.ajax({
        url: siteUrl+'/dodislikes',
        type: 'POST',
        beforeSend: function(xhr){
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr("content"));},
        cache: false,
        async:false,
        data: {'post_id':post_id,'like_type':like_type},
        success:function(data)
        {
            if(data.type==0)
            {
                $("#dodislikes"+post_id).html('<i class="fa fa-thumbs-o-down" aria-hidden="true"> ' + data.dcount);
                toastr.success('Removed to Dislikes Post');
            }
            else
            {
              $("#dodislikes"+post_id).html('<i class="fa fa-thumbs-down"></i> ' + data.dcount);
              toastr.success('Added to Dislikes Post');
            }

            $("#dolike"+post_id).html('<i class="fa fa-thumbs-o-up" aria-hidden="true"> ' + data.lcount);
     

        },
        error: function(data) {
          //
            }
      
        })


}
//end like


//focus_form
function focus_form(id){
 $("#comment-form"+id).focus();   
}

//postComment
function postComment(post_id,comment_id)
{
    var prefix='';
     prefix_id=post_id;
    if(comment_id !=0){
        prefix='_reply';
         prefix_id=comment_id;
        var comment=$("#comment-form"+prefix+prefix_id).val();
    }else{
    var comment=$("#comment-form"+post_id).val();
    }


    $.ajax({
    url: siteUrl+'/postComment',
    type: 'POST',
    beforeSend: function(xhr){
    xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr("content"));},
    cache: false,
    async:false,
    data:{'post_id':post_id,'comment_id':comment_id,'comment':comment},
    success:function(data){

            var hdiv='';
            hdiv+='<div class="col-md-12 col-sm-4 col-xs-12 top-pd-20 cmnt-pnl" id="commentDiv'+data.comment_id+'">'
                hdiv+='<div class="col-md-11 cmnt-pnl-ped">';
                 
                hdiv+='<div class="pro1"><img src="'+data.user_image+'" class="img-responsive" alt="img"></div>'; 
                  hdiv+='<div class="cmnt-box">';
                 hdiv+='<span class="pro-name"><b>'+data.name+':</b> '+data.comment+'</span>';
                hdiv+='<span class="post-time"><i class="fa fa-clock-o" aria-hidden="true"></i>'+data.date+'</span>'; 
                 hdiv+='</div>';
                 hdiv+='</div>';
              
                hdiv+='<div class="dropdown">';
                 hdiv+='<i data-toggle="dropdown" class="fa dropdown-toggle fa-angle-down"></i>';
                 hdiv+='<ul class="dropdown-menu side-fix">';
                   hdiv+='<li><a onclick="deleteComment('+post_id+','+data.comment_id+')">Delete</a></li>';
                 hdiv+='</ul>';
               hdiv+='</div>';

             hdiv+='</div>';

             $("#comment_section"+prefix+prefix_id).append(hdiv);
             $("#comment-form"+prefix+prefix_id).val('');
              toastr.success('Successfully posted');
    },
    error: function(data) {
            var hdiv='';
             var obj = jQuery.parseJSON(data.responseText);
              num= Math.floor(Math.random() * 1000) + 1 ;
                hdiv +='<div class="message-notification" id="post_comment_'+num+'">';
                hdiv +='<div class="message-reported">'+obj.errors.comment;
                 hdiv +='<a onclick="deleteNotification('+num+')" title="Close"><div class="delete_btn"></div></a>';
                 hdiv +='</div>';
                 hdiv +='</div>';
                 
              $("#comment_section"+prefix+prefix_id).append(hdiv);
        }
  
    });
}


//deleteComment
function deleteComment(post_id,comment_id){
  
        $.ajax({
        url: siteUrl+'/deleteComment',
        type: 'POST',
        beforeSend: function(xhr){
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr("content"));},
        cache: false,
        async:false,
        data: {'post_id':post_id,'comment_id':comment_id},
        success: function(data) {
            $("#commentDiv"+comment_id).remove();
            
         },
        error: function(data) {
           
        }
    });

}

//deleteNotification

function deleteNotification(num)
{
 $("#post_comment_"+num).remove();
}


//spamReport
function reportFeedback()
{
    var spam_tags =$("input[name='spam_tags']:checked").val();
    var post_id=$("#post_id").val();
    $("#errer_div").hide();

    $.ajax({
    url: siteUrl+'/reportFeedback',
    type: 'POST',
    beforeSend: function(xhr){
    xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr("content"));},
    cache: false,
    async:false,
    data:{'post_id':post_id,'spam_tags':spam_tags},
    success:function(data){
         $('#myModal').modal('hide');
        toastr.success('Successfully submit feedback');
    },
    error: function(data) {
        $("#errer_div").show().html('Invalid parameter value');
        }
    });
}

//postDelete
function delete_post_popup(post_id)
{
   $.ajax({
    url: siteUrl+'/delete_post_popup',
    type: 'POST',
    beforeSend: function(xhr){
    xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr("content"));},
    cache: false,
    async:false,
    data:{'post_id':post_id},
    success:function(data){
        $(".modal-content").html(data);
        $('#myModal').modal('show');
    },
    error: function(data) {
           
        }
    });

}

//deletePost
function deletePost(post_id){
    $.ajax({
    url: siteUrl+'/delete_post',
    type: 'POST',
    beforeSend: function(xhr){
    xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr("content"));},
    cache: false,
    async:false,
    data:{'post_id':post_id},
    success:function(data){
        $('#myModal').modal('hide');
         $("#postdiv"+post_id).remove();
        toastr.error('Successfully deleted');
    },
    error: function(data) {
           
        }
  
    });
}


//share post
function share_post_popup(post_id){
    $.ajax({
    url: siteUrl+'/share_post_popup',
    type: 'POST',
    beforeSend: function(xhr){
    xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr("content"));},
    cache: false,
    async:false,
    data:{'post_id':post_id},
    success:function(data){
        $('#myModal').modal('show');
        $(".modal-content").html(data);
    },
    error: function(data) {
           
        }
  
    });
}

function sharePost(post_id){
  var share_message=$("#share_message").val();
    $.ajax({
    dataType : "json",
    url: siteUrl+'/share_post',
    type: 'POST',
    beforeSend: function(xhr){
    xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr("content"));},
    cache: false,
    async:false,
    data:{'post_id':post_id,'share_message':share_message},
    success:function(data){
        $('#myModal').modal('hide');
        toastr.success('successfully share your post');
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

                hdiv +='<p class="post-txt">'+data.pdata.message+'</p>';
                if(data.pdata.type=='image'){
                    hdiv +='<div class="post-img"><a data-toggle="modal" href="'+siteUrl+'/image_popup/'+data.pdata.id+'" data-target="#myModal"> <img src="'+data.pdata.value+'" class="img-responsive"> </a></div>'
                }

                if(data.pdata.type=='video'){
                    hdiv +='<div class="post-video"><video width="100%" height="315" controls><source src="'+data.pdata.value+'" type="video/mp4"></video></div>';
                }
                if(data.pdata.type=='audio'){
                    hdiv +='<div class="post-audio"><audio controls > <source src="'+data.pdata.value+'"></audio></div>';
                }
                hdiv +='<div class="share-area">';
                    hdiv +='<ul>';
                     hdiv +='<li ><a onclick="doLike('+data.pdata.id+',0)" id="dolike'+data.pdata.id+'" ><i class="fa fa-thumbs-o-up"></i> 0</a> </li>';   
                     hdiv +='<li ><a onclick="dodislikes('+data.pdata.id+',1)" id="dodislikes'+data.pdata.id+'" ><i class="fa fa-thumbs-o-down"></i> 0</a>  </i></li>';   
                     hdiv +='<li><a onclick="focus_form('+data.pdata.id+')"><i class="fa fa-comment" aria-hidden="true"></i> Comment</i></a> </li>';  
                     hdiv +='<li><a onclick="share_post_popup('+data.pdata.id+')"><i class="fa fa-share-alt" aria-hidden="true"></i> Share</a> </li>';   
                    hdiv +='</ul>';
                hdiv +='</div>';
           

                  hdiv +='<div class="hr"></div>';
                  hdiv +='<div id="comment_section'+data.pdata.id+'"></div>';

                    hdiv +='<div class="col-md-12 col-sm-4 col-xs-12 top-pd-20 cmnt-pnl">';
                    hdiv +='<div class="col-md-12 cmnt-pnl-ped">';
                     hdiv +='<div class="pro1"><img src="'+data.pdata.image+'" class="img-responsive"></div>';  
                     hdiv +='<div class="cmnt-box">';
                        hdiv +='<textarea rows="2" cols="100" name="comment" id="comment-form'+data.pdata.id+'" placeholder="Leave a comment..."></textarea>';
                        hdiv +='<button class="post-bt" onclick="postComment('+data.pdata.id+',0)">Post</button>';
                    hdiv +='</div>';
                    hdiv +='</div>';
                hdiv +='</div>';
                hdiv +='</div>';

             hdiv +='</div>';


         $("#currentMessage").prepend(hdiv);


    },
    error: function(data) {
        toastr.error('Please enter some text');
        }
  
    });
}

function displayImage(elem)
{
  var image = document.getElementById("npimage");
    //image= elem.name;
   $("#queued-files").html('1 image selected <i class="fa fa-times" aria-hidden="true" onclick="removedImage(\'image\')"></i>').show();
    $("#imagePreviewDiv").show();
   
    var reader = new FileReader();
    reader.onload = function()
    {
    var output = document.getElementById('imagePreview');
    output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
        
}

function removedImage()
{
  $("#npimage").val("");
  $("#npaudio").val("");
  $("#npvideo").val("");
  $("#queued-files").html("");
  $("#imagePreviewDiv").hide();
}


function displayVideo(elem)
{
      var image = document.getElementById("npvideo");
       // image= elem.name;
        $("#queued-files").html('1 video selected <i class="fa fa-times" aria-hidden="true" onclick="removedImage(\'video\')"></i>').show();
}

function displayAudio(elem)
{
      var image = document.getElementById("npvideo");
       // image= elem.name;
        $("#queued-files").html('1 Audio selected <i class="fa fa-times" aria-hidden="true" onclick="removedImage(\'audio\')"></i>').show();
}


$(document).on('submit', 'form#imageUpload', function (event) {
    event.preventDefault();
        $('.image_ajax_load').show();
      var form = $(this);
        var data = new FormData($(this)[0]);
        $.ajax({
        url: siteUrl+'/user/change_image',
        beforeSend: function(xhr){
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr("content"));
         $('.image_ajax_load').show();
        },
        type: 'POST',              
        data: data,
        processData: false,
        contentType: false, 
        async:false,
        success: function(result)
        {
            $('.image_ajax_load').hide();
            location.reload();
        },
        error: function(request)
        {
             if (request.status == 422) {
            // Parser the json response expected
            var $errors = $.parseJSON(request.responseText);
            // Bootstrap alert scafolding for error 
            var errorsHtml = '<div class="alert alert-danger alert-dismissible"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><h4><i class="icon fa fa-times"></i>Opps! Seems like you didn\'t fill the form properly...</h4><ul>';
            // The root nodes are field names, with an array of error messages
            $.each( $errors, function( key, value ) {
              // We loop through the error to see if there are multiple error associated with the field 
              $.each( value, function( key2, error ) {
                errorsHtml += '<li>' + error + '</li>';
              });
            });
            errorsHtml += '</ul></div>';
            $( '#form-errors' ).html( errorsHtml );
          }
        }
    });
 return false; 
});


$(document).on('submit', 'form#change_cover_Upload', function (event) {
       $("#progressbar").css("display", "");
    event.preventDefault();

      var form = $(this);
        var data = new FormData($(this)[0]);
        $.ajax({
        url: siteUrl+'/user/change_cover_image',
        beforeSend: function(xhr){
          showLoader();
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr("content"));},
        type: 'POST',              
        data: data,
        processData: false,
        contentType: false,
        async:false,
        success: function(result)
        {
            location.reload();
        },
        error: function(request)
        {
          $("#image_ajax_load").hide();
             if (request.status == 422) {
            // Parser the json response expected
            var $errors = $.parseJSON(request.responseText);
            // Bootstrap alert scafolding for error 
            var errorsHtml = '<div class="alert alert-danger alert-dismissible"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><h4><i class="icon fa fa-times"></i>Opps! Seems like you didn\'t fill the form properly...</h4><ul>';
            // The root nodes are field names, with an array of error messages
            $.each( $errors, function( key, value ) {
              // We loop through the error to see if there are multiple error associated with the field 
              $.each( value, function( key2, error ) {
                errorsHtml += '<li>' + error + '</li>';
              });
            });
            errorsHtml += '</ul></div>';
            $( '#form-errors' ).html( errorsHtml );
          }
        }
    });
 return false; 
});

function showLoader() {
    $("#image_ajax_load").css("display", "");
}

function showReplydiv(comment_id)
{
    $("#rply"+comment_id).show();
    $("#comment-form_reply"+comment_id).focus();
}

function hideReplydiv(comment_id)
{
    $("#rply"+comment_id).show();
}






   $(document).ready(function() {

    if ( $( "#search_text" ).length ) {

     $("#search_text").autocomplete({
        source: function(request, response) {
            $.ajax({
               url: siteUrl+'/search',
                beforeSend: function(xhr){
                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr("content"));},
                dataType: "json",
                type:"POST",
                data: {
                    q : request.term
                },
                success: function(data) {
                    response(data);
                   
                }

            });

        },
        minLength: 1,
       
    }).data("ui-autocomplete")._renderItem = function (ul, item) {
    
            var inner_html = 
                 '<a href="'+ item.url +'"><div class="list_item_container"><div class="image"><img src="' + 
                 item.image + '"></div><div class="">' + item.value + '</div><div class="description">' + 
                 item.city + '</div></div></a>';
                  return $("<li></li>")
                .data("item.autocomplete", item)
                .append(inner_html)
                .appendTo(ul);
        };
      }
});


/* Audio Autho Play */
$(function(){
   $("audio").on("play", function() {
    $("audio").not(this).each(function(index, audio) {
        audio.pause();
    });
  });

 });

/* End  Autho Play */