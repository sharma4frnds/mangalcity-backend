<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Http\Controllers\FrontController;
use Illuminate\Http\Request;
use App\Otp\SmsOtp;
use Session;
use App\User;
use Validator;
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
        $validator = Validator::make($request->all(), ['otp'=>'required','password' => 'required|string|min:6|confirmed' ]);
        
        if($validator->fails())
        {
            return response()->json(['success'=>false, 'errors'=>$validator->getMessageBag()->toArray()],422);
        }

        $data=Session::get('mobile_otp');
        if(empty($data)){
             $validator->errors()->add('message', 'Invalid otp and mobile number.');
             return response()->json(['success'=>false, 'errors'=>$validator->getMessageBag()->toArray()],422);
        }
        
        return response()->json(['message' =>'successfully update password,please login',], 200);

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
                $validator->errors()->add('otp', 'invalid mobile number.');
                return response()->json(['success'=>false, 'errors'=>$validator->getMessageBag()->toArray()],422);
             }
        }else{
             $validator->errors()->add('otp', 'Invalid otp.');
             return response()->json(['success'=>false, 'errors'=>$validator->getMessageBag()->toArray()],422);
        }


     }

}
