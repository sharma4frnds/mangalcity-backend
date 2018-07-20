<?php
namespace App\Otp;

class SmsOtp 
{

    public $user;
    private $smsUrl = 'http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp?username=clamourtech&password=2050731103&sendername=srasti';

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
        //  $message=urlencode("Your varification code is $otp");
        // $ch =curl_init("$this->smsUrl&mobileno=$mobile&message=$message"); 
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $responsech = curl_exec($ch);
        // curl_close($ch);
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