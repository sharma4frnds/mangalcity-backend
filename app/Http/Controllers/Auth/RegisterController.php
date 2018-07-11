<?php
namespace App\Http\Controllers\Auth;
use Mail;
use App\User;
use App\Model\VerifyUser;
use Illuminate\Http\Request;
use App\Otp\SmsOtp;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\FrontController;
class RegisterController extends FrontController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|alpha|min:3|max:55',
            'last_name' => 'required|alpha|string|max:25',
            'email' => 'string|email|max:100',
            'mobile' => 'numeric|digits:10|unique:users',
            'password' => 'required|string|min:6|confirmed|max:25',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user= User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'password' => bcrypt($data['password']),
            'is_admin'=>0,
        ]);

        $otp=rand(10000,99999);
        
         $verifyUser=VerifyUser::create([
            'user_id' => $user->id,
            'mobile' => $data['mobile'],
            'otp' =>$otp
        ]);
 
        $sms=new SmsOtp();
        $sms->verifyOtp($data['mobile'],$otp);

        $user->url=str_slug("$user->id $user->first_name $user->last_name");
        $user->save();

        return $user;

    }

    protected function ragisterOtp(Request $request)
    {
    
        $this->validate($request, ['otp' => 'required|digits:5', 'mobile' => 'required|digits:10' ]);


        $verifyUser = VerifyUser::where('otp', $request->otp)->where('mobile', $request->mobile)->first();
        if(isset($verifyUser) ){

            User::where('mobile',$request->mobile)->update(['verified' => 1]);
            VerifyUser::where('otp', $request->otp)->where('mobile', $request->mobile)->delete();

          return response()->json([
                'message' => 'Your mobile number is verified. You can now login',
            ], 200);
             //Your e-mail is verified. You can now login.
        }else{
        return response()->json(['error' => 'Invalid otp', 'code' => 405 ], 405);
        }

    }

//resend_otp
   protected function resend_otp(Request $request)
    {
        $this->validate($request, ['mobile' => 'required|digits:10' ]);

            $otp=rand(10000,99999);
        
        
         $vuser=VerifyUser::where('mobile',$request->mobile)->first();
         if($vuser)
         {
            $sms=new SmsOtp();
            $sms->verifyOtp($request->mobile,$otp);
            VerifyUser::where('mobile',$request->mobile)->update(['otp'=>$otp]);
            return response()->json(['message' => 'successfully send',], 200);
         }else
         {
           return response()->json(['error' => 'Invalid mobile', 'code' => 405 ], 405); 
         }

    }




}
