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
        dataType:  'json', 
        success: processJson,
    });
}
catch(err) {

}

    function processJson(data) 
    { 
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
                  hdiv +='<i class="fa fa-ellipsis-v"></i>';  
                hdiv +='</div>';
                hdiv +='<p class="post-txt">'+data.pdata.message+'</p>';
                if(data.pdata.type=='image'){
                    hdiv +='<div class="post-img"> <img src="'+data.pdata.value+'" class="img-responsive"></div>'
                }

                if(data.pdata.type=='video'){
                    hdiv +='<div class="post-video"><video width="100%" height="315" controls><source src="'+data.pdata.value+'" type="video/mp4"></video></div>';
                }
                hdiv +='<div class="share-area">';
                    hdiv +='<ul>';
                     hdiv +='<li><a onclick="doLike('+data.pdata.id+',0)" id="dolike'+data.pdata.id+'" ><i class="fa fa-thumbs-up"></i></a> 0</li>';   
                     hdiv +='<li><a onclick="doLike('+data.pdata.id+',1)" id="dolike'+data.pdata.id+'" ><i class="fa fa-thumbs-down"></i></a>  0</i></li>';   
                     hdiv +='<li><a onclick="focus_form('+data.pdata.id+')"><i class="fa fa-comment" aria-hidden="true"></i> Comment</i></a> </li>';  
                     hdiv +='<li><a onclick="share_post_popup('+data.pdata.id+'}})"><i class="fa fa-share-alt" aria-hidden="true"></i> Share</a> </li>';   
                    hdiv +='</ul>';
                hdiv +='</div>';
            hdiv +='</div>';


         $("#currentMessage").prepend(hdiv);
          toastr.success('successfully posted');
          $("#queued-files").html('').hide();
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
function postComment(post_id)
{
    var comment=$("#comment-form"+post_id).val();
    $.ajax({
    url: siteUrl+'/postComment',
    type: 'POST',
    beforeSend: function(xhr){
    xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr("content"));},
    cache: false,
    async:false,
    data:{'post_id':post_id,'comment':comment},
    success:function(data){

            var hdiv='';
            hdiv+='<div class="col-md-12 col-sm-4 col-xs-12 top-pd-20 cmnt-pnl" id="commentDiv'+data.comment_id+'">'
                hdiv+='<div class="col-md-11 cmnt-pnl-ped">';
                 
                hdiv+='<div class="pro1"><img src="'+data.user_image+'" class="img-responsive" alt="img"></div>'; 
                  hdiv+='<div class="cmnt-box">';
                 hdiv+='<span class="pro-name"><b>'+data.name+':</b> '+data.comment+'</span><br>';
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

             $("#comment_section"+data.post_id).append(hdiv);
             $("#comment-form"+post_id).val('');
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
                 
              $("#comment_section"+post_id).append(hdiv);
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
    var spam_tags=$("#spam_tags").val();
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
    $.ajax({
    url: siteUrl+'/share_post',
    type: 'POST',
    beforeSend: function(xhr){
    xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr("content"));},
    cache: false,
    async:false,
    data:{'post_id':post_id},
    success:function(data){
        $('#myModal').modal('hide');
    },
    error: function(data) {
           
        }
  
    });
}

function displayImage(elem)
{
      var image = document.getElementById("npimage");
        //image= elem.name;
       $("#queued-files").html('1 image selected').show();
}

function displayVideo(elem)
{
      var image = document.getElementById("npvideo");
       // image= elem.name;
        $("#queued-files").html('1 video selected').show();
}

