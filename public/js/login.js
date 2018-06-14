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
                console.log(data.responseText);
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
        error: function(data) {
            toastr.warning(' Resend Otp  fail');
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
        error: function(data) {
            toastr.warning('invalid otp & password');
        }
    });


});
