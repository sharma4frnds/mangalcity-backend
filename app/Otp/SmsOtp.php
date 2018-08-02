<?php
namespace App\Otp;

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
        /* $message=urlencode("Your varification code is $otp"); */
        $message=urlencode("Your SMSGatewayCenter OTP code is 1234. Please use the code within 2 minutes. - Demo Message.");
        $ch =curl_init("$this->smsUrl&$message&mobile=$mobile&duplicateCheck=true&format=json"); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responsech = curl_exec($ch);
        curl_close($ch);
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