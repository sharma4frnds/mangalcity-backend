<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Http\Controllers\FrontController;
use Illuminate\Http\Request;
use App\Otp\SmsOtp;
use Session;
use App\User;
class ForgotPasswordController extends FrontController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest');
    }


 public function forgotMobPass()
 {
   return view('auth/passwords/forget');
 }

    //changepass_otp
     public function changepass_otp(Request $request)
     {
          $this->validate($request, ['mobile' => 'required|digits:10' ]);
         
          
             $vuser=User::where('mobile',$request->mobile)->first();
             if($vuser)
             {
                $otp=rand(10000,99999);
                $sms=new SmsOtp();
                $sms->verifyOtp($request->mobile,$otp);
                $motp=array('mobile'=>$request->mobile,'otp'=>$otp);
                 Session::put('mobile_otp', $motp);
                return response()->json(['message' =>'successfully send otp',], 200);
             }else{
               return response()->json(['error' =>'Invalid mobile', 'code' => 405 ], 405); 
             }
     }

     //getchangepassword
     public function getchangepassword()
     {
        return view('auth/passwords/new_password');
     }

    //change password
     public function changepassword(Request $request)
     {
        $this->validate($request, ['otp'=>'required','password' => 'required|string|min:6|confirmed' ]);

        $data=Session::get('mobile_otp');
        if($data['otp']==$request->otp)
        {
             $vuser=User::where('mobile',$data['mobile'])->first();
            if($vuser)
             {
                $newpassword = bcrypt($request->password);
                User::where('id', $vuser->id)->update(['password' => $newpassword]);
                Session::put('mobile_otp', '');
                return response()->json(['message' =>'successfully update password,please login',], 200);
             }else{
                 return response()->json(['error' =>'invalid mobile number', 'code' => 405 ], 405); 
             }
        }else{
              return response()->json(['error' =>'invalid otp', 'code' => 405 ], 405); 
        }


     }

}
