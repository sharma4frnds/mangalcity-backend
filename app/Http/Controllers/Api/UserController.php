<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\User;
use JWTAuthException;
use Validator;
use App\Model\VerifyUser;
use App\Otp\SmsOtp;
use Hash;
class UserController extends Controller
{   
    private $user;
    public function __construct(User $user){
        $this->user = $user;
    }
   
    //user login
  public function login(Request $request)
  {
        $credentials = $request->only('mobile', 'password');
        
        $rules = [
            'email' => 'numeric|digits:10',
            'password' => 'required|min:6',
        ];

        $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()]);
        }
        
        $credentials['verified'] = 1;
        
        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['success' => false, 'error' => 'We cant find an account with this credentials. Please make sure you entered the right information and you have verified your mobile Number.'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Failed to login, please try again.'], 500);
        }
        // all good so return the token
           $user = JWTAuth::toUser($token);
        return response()->json(['success' => true, 'data'=> ['token' => $token,'user'=>$user]]);
    }




    //getAuthUser
    public function getAuthUser(Request $request){
        $user = JWTAuth::toUser($request->token);
         // $user = JWTAuth::parseToken()->toUser();
        return response()->json(['success' => true, 'data'=> ['token' => $token,'user'=>$user]]);
    }

    /* 
      Register new user 
     */

    public function register(Request $request)
    {
        $credentials = $request->only('first_name', 'last_name','email','mobile', 'password','password_confirmation');
        
        $rules = [
            'first_name' => 'required|string|min:3|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'mobile' => 'numeric|digits:10|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
    
       $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()],422);
        }

        $user = $this->user->create([
          'first_name' => $request->get('first_name'),
          'last_name' => $request->get('last_name'),
          'email' => $request->get('email'),
          'mobile' => $request->get('mobile'),
          'is_admin'=>0,
          'password' => bcrypt($request->get('password'))
        ]);

        $otp=rand(10000,99999);

         $verifyUser=VerifyUser::create([
            'user_id' => $user->id,
            'mobile' => $request->get('mobile'),
            'otp' =>$otp
        ]);
 
        $sms=new SmsOtp();
        $sms->verifyOtp($request->get('mobile'),$otp);


       // return response()->json(['status'=>true,'message'=>'User created successfully','data'=>$user]);

         return response()->json(['success'=> true, 'message'=> 'Please verify your mobile number'],200);
    }
    



//verify User 
public function verifyUser(Request $request)
{
        $this->validate($request, ['otp' => 'required|digits:5', 'mobile' => 'required|digits:10' ]);


      $verifyUser = VerifyUser::where('otp', $request->otp)->where('mobile', $request->mobile)->first();
      if(isset($verifyUser) ){

          User::where('mobile',$request->mobile)->update(['verified' => 1]);
          VerifyUser::where('otp', $request->otp)->where('mobile', $request->mobile)->delete();

        return response()->json(['success'=> true, 'message'=>'Your mobile number is verified. You can now login'], 200);
           //Your e-mail is verified. You can now login.
      }else{
       return response()->json(['success'=> false, 'message'=> 'Invalid otp'], 405);
      }

}


//Login
 public function logout(Request $request) {
        try {
            JWTAuth::invalidate($request->input('token'));
            return response()->json(['success' => true, 'message'=> "You have successfully logged out."]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Failed to logout, please try again.'], 500);
        }
  }



public function userprofile(Request $request)
{

  $validator = Validator::make($request->all(), ['first_name' =>'required|max:20','last_name' =>'required|max:20','email' =>'email','country' =>'required|numeric','state' =>'required|numeric','district' =>'required|numeric','city' =>'required|numeric']);


     if($validator->fails())
      {
          return response()->json(['success'=> false, 'errors'=>$validator->getMessageBag()->toArray()], 405);
          // 400 being the HTTP code for an invalid request.
      }
      
      if(!$user = JWTAuth::toUser($request->token)) {
             return  json_encode(array('success'=>false,'errors'=>array('error'=>'User Not Found')),404);
        }
      User::where('id',$user->id)->update(['first_name'=>$request->first_name,'last_name'=>$request->last_name,'email'=>$request->email,'country'=>$request->country,'state'=>$request->state,'district'=>$request->district,'city'=>$request->city,'profile'=>1]);

        echo json_encode(array('success'=>true,'message'=>'Profile Update  successfully'),200);
}

//user forgot

public function forgot_password_otp(Request $request)
{
    $validator = Validator::make($request->all(), ['mobile' => 'required|digits:10']);

     if($validator->fails())
      {
          return response()->json(['success'=> false, 'errors'=>$validator->getMessageBag()->toArray()], 405);
      }

       $user=User::where('mobile',$request->mobile)->first();
       if($user)
       {
          $otp=rand(10000,99999);
          $sms=new SmsOtp();
          $sms->verifyOtp($request->mobile,$otp);

          VerifyUser::where('id',$user->id)->delete();

          VerifyUser::create([
            'user_id' => $user->id,
            'mobile' => $request->mobile,
            'otp' =>$otp
          ]);

          echo json_encode(array('success'=>true,'message'=>'successfully send otp'),200);
       }else{
          echo json_encode(array('success'=>false,'message'=>'Invalid mobile'),405);
     }
}

//change_password
  public function forgot_change_password(Request $request)
  {
         $validator = Validator::make($request->all(), ['otp'=>'required','password' => 'required|string|min:6|confirmed']);

       if($validator->fails())
        {
            return response()->json(['success'=> false, 'errors'=>$validator->getMessageBag()->toArray()], 405);
        }

         $vuser=User::where('mobile',$request->mobile)->first();
        if($vuser)
        {
        $verifyUser = VerifyUser::where('otp', $request->otp)->where('mobile', $request->mobile)->first();
        if(isset($verifyUser) ){

            VerifyUser::where('otp', $request->otp)->where('mobile', $request->mobile)->delete();
              $newpassword = bcrypt($request->password);
                  User::where('id', $vuser->id)->update(['password' => $newpassword]);

          return response()->json(['success'=> true, 'message'=>'successfully update password,please login'], 200);
        }else{
         return response()->json(['success'=> false, 'message'=> 'Invalid otp'], 405);
        }
      }else{
        return response()->json(['success'=> false, 'message'=> 'Invalid Mobile Number'], 405);
      }

       
  }

  //change_password
  function change_password(Request $request)
  {
      $validator = Validator::make($request->all(), ['old_password'=>'required','password' => 'required|string|min:6|confirmed']);

        if ($validator->fails()) {
          return response()->json(['success'=> false, 'errors'=>$validator->getMessageBag()->toArray()], 405);
        }

        $userdata = JWTAuth::toUser($request->token);
        $pass = Hash::check($request->old_password, $userdata->password);

        if($pass==false){
          return response()->json(['success'=> false, 'errors'=>['password'=>'Old Password Not Match']], 405);
          exit();
        }

        $newpassword = bcrypt($request->password);
        $user=User::find($userdata->id);
        $user->password=$newpassword;
        $user->save();

        return response()->json(['success'=> true, 'message'=>'Password update successfully'], 200);

  }

  public function resend_otp(Request $request)
  {
 
      $validator = Validator::make($request->all(), ['mobile' => 'required|digits:10']);
     if($validator->fails())
      {
          return response()->json(['success'=> false, 'errors'=>$validator->getMessageBag()->toArray()], 405);
      }

        $otp=rand(10000,99999);
         $vuser=VerifyUser::where('mobile',$request->mobile)->first();
         if($vuser)
         {
            $sms=new SmsOtp();
            $sms->verifyOtp($request->mobile,$otp);
            VerifyUser::where('mobile',$request->mobile)->update(['otp'=>$otp]);
            return response()->json(['success'=> true, 'message'=>'successfully send'], 200);
         }else
         {
            return response()->json(['success'=> false, 'message'=> 'Invalid mobile'], 405);
         }
  }



}  