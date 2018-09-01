<?php
namespace App\Otp;
use Session;
class SmsOtp 
{

    public $user;
    //private $smsUrl = 'http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp?username=clamourtech&password=2050731103&sendername=srasti';
    private $smsUrl ='https://www.smsgateway.center/SMSApi/rest/send?userId=camiel&password=hPl3kpca&senderId=SMSGAT&sendMethod=simpleMsg&msgType=TEXT&msg=';
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {

    }
    
    public function verifyOtp($mobile,$otp)
    {
        $motp=array('mobile'=>$mobile,'otp'=>12345);
        Session::put('mobile_otp', $motp);
       // file_get_contents("https://www.smsgateway.center/SMSApi/rest/send?userId=camiel&password=hPl3kpca&senderId=SMSGAT&sendMethod=simpleMsg&msgType=TEXT&msg=Your%20SMSGatewayCenter%20OTP%20code%20is%201234.%20Please%20use%20the%20code%20within%202%20minutes.%20-%20Demo%20Message.&mobile=$mobile&duplicateCheck=true&format=json");
        /* $message=urlencode("Your varification code is $otp"); */
        
        //https://www.smsgateway.center/SMSApi/rest/send?userId=camiel&password=hPl3kpca&senderId=SMSGAT&sendMethod=simpleMsg&msgType=TEXT&msg=hii&mobile=7011154227&duplicateCheck=true&format=json
        $message=urlencode("Your SMSGatewayCenter OTP code is 1234. Please use the code within 2 minutes. - Demo Message.");
        $ch =curl_init("https://www.smsgateway.center/SMSApi/rest/send?userId=camiel&password=hPl3kpca&senderId=SMSGAT&sendMethod=simpleMsg&msgType=TEXT&msg=$message&mobile=$mobile&duplicateCheck=true&format=json"); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responsech = curl_exec($ch);
        curl_close($ch);
        //echo $responsech;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.verifyUser');
    }
}