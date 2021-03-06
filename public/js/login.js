var siteUrl=$('meta[name=base-url]').attr("content");
$(document).ready(function(){

var siteUrl=$('meta[name=base-url]').attr("content");

/* sendmail accom email,id,productName */
var registerForm = $("#registerForm");
    var register_url = registerForm.attr('action');
    registerForm.submit(function(e) {
        e.preventDefault();
        var registerData = registerForm.serialize();
        $(".ragister_loader").show();
  
        $('#register-errors-first_name').html("");
        $('#register-errors-last_name').html("");
        $('#register-errors-mobile').html("");
        $('#register-login-email').html("");
    	$('#register-login-password').html("");
    	$('#register-login-password_confirmation').html("");
    	
        $.ajax({
            url: register_url,
            type: 'POST',
            data: registerData,
            success: function(data) {
                console.log(data);
                //location.reload(true);
            },
            error: function(data) {
                $(".ragister_loader").hide();
               
                var obj = jQuery.parseJSON(data.responseText);
                if (obj.first_name) {
                    $('#register-errors-first_name').html(obj.first_name);
                }
                if (obj.last_name) {
                    $('#register-errors-last_name').html(obj.last_name);
                }
                if (obj.email) {
                    $('#register-errors-email').html(obj.email);
                }
                if (obj.mobile) {
                    $('#register-errors-mobile').html(obj.mobile);
                }
                if (obj.password) {
                    $("#register-password-div").addClass("has-error");
                    $('#register-errors-password').html(obj.password);
                }
                if (obj.otp) {
                    $("#registerForm").hide();
                    $("#otpForm").show();
                    $("#otp_mobile").val(obj.mobile);
                    
                    $('#form-otp-errors').html(obj.otp);

                }
                if (obj.error) {
                
                    $('#form-register-errors').html(obj.error);
                }
            }
        });
    });


//Send otp
var otpForm=$("#otpForm");
var otpForm_url = otpForm.attr('action');

    otpForm.submit(function(e) {
        e.preventDefault();
        var otpData = otpForm.serialize();
        $(".otp_loader").show();
        $('#otp-errors-otp').html("");

        $.ajax({
            url: otpForm_url,
            type: 'POST',
            data: otpData,
            success: function(data) {
                $('#otpForm').hide();
                 $('#form-login-success').html('Your mobile number is verified. You can now login')
                 $('#form-login-success').show();
                 $('.nav-tabs a[href="#Section1"]').tab('show');
                 $('#form-otp-errors').html('');
             },
            error: function(data) {
                $(".otp_loader").hide();
                var obj = jQuery.parseJSON(data.responseText);
                 if (obj.otp) {
                    $('#form-otp-errors').html(obj.otp);
                }
                if (obj.error) {
                    $('#form-otp-errors').html(obj.error);
                }
            }
        });
    });



    });



//resend_otp
function resend_otp()
{
    var mobile=$('#otp_mobile').val();
      if(mobile !='')
      {
            $.ajax({
                url:siteUrl+'/auth/resend_otp',
                type: 'POST',
                  beforeSend: function(xhr){
                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr("content"));},
                cache: false,
                async:false,
                data: {'mobile':mobile},
                success: function(data) {
                   toastr.success('Successfully send otp');
                   $('#resend_otp').hide();
                 },
                error: function(data) {
                    toastr.warning('Invalid mobile');
                }
            });
      }
      else{
         toastr.error('invalid mobile number');
      }
}

//change password send otp
$("#resendotp").click(function(){

  var mobile=$('#lg_mobile').val();
 
    $.ajax({
        url:siteUrl+'/changepass_otp',
        type: 'POST',
          beforeSend: function(xhr){
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr("content"));},
        cache: false,
        async:false,
        data: {'mobile':mobile},
        success: function(data) {
           toastr.success('successfully Resend Otp');
           window.location.replace(siteUrl+"/changepassword");
         },
        error: function(request) {
            toastr.warning('Resend Otp  fail');
    
        }
    });
  

});

//change_password_btn

$("#change_password_btn").click(function(){
    var otp=$('#otp').val();
    var password=$('#password').val();
    var password_confirmation=$('#password_confirmation').val();
        $.ajax({
        url:siteUrl+'/changepassword',
        type: 'POST',
          beforeSend: function(xhr){
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr("content"));},
        cache: false,
        async:false,
        data: {'otp':otp,'password':password,'password_confirmation':password_confirmation},
        success: function(data) {
           toastr.success('successfully change password');
           window.location.replace(siteUrl);
         },
        error: function(request) {
            //toastr.warning('invalid otp & password');
              if (request.status == 422) {
            // Parser the json response expected
            var $errors = $.parseJSON(request.responseText);
            // Bootstrap alert scafolding for error 
            var errorsHtml = '<div class="alert alert-danger alert-dismissible"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><h4><i class="icon fa fa-times"></i></h4><ul>';
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


});


//change password send otp
$("#social_resendotp").click(function(){

  var mobile=$('#sl_mobile').val();
 
    $.ajax({
        url:siteUrl+'/login/social_send_mobile',
        type: 'POST',
        beforeSend: function(xhr){
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr("content"));},
        cache: false,
        async:false,
        data: {'mobile':mobile},
        success: function(data) {
           toastr.success('Successfully send Otp please enter OTP');
            $('#lg_mobile_div').hide();
            $('#social_resendotp').hide();
            $('#lg_otp_div').show();
            $('#social_submit_otp').show();
           var obj = jQuery.parseJSON(data.responseText);
           if(obj.success.success){
             toastr.success(obj.success.success);
          }

         },
        error: function(data) {
          var obj = jQuery.parseJSON(data.responseText);
          if(obj.errors.mobile){
             toastr.warning(obj.errors.mobile);
            
          }
          if(obj.error){
            toastr.warning(obj.errors);
          }

           
    
        }
    });
});

//social_submit_otp

$("#social_submit_otp").click(function(){

  var mobile=$('#sl_mobile').val();
  var otp=$('#sl_otp').val();
    $.ajax({
        url:siteUrl+'/login/social_submit_otp',
        type: 'POST',
        dataType: "json",
        beforeSend: function(xhr){
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr("content"));},
        cache: false,
        async:false,
        data: {'mobile':mobile,'otp':otp},
        success: function(data) {
        
            $('#lg_mobile_div').hide();
            $('#social_resendotp').hide();
            $('#lg_otp_div').show();
            $('#social_submit_otp').show();
             location.reload();
         },
        error: function(data) {
            var obj = jQuery.parseJSON(data.responseText);
              if(obj.errors.mobile){
             toastr.warning(obj.errors.mobile);
          }
            if(obj.errors.otp){
             toastr.warning(obj.errors.otp);
          }
    
        }
    });
});
