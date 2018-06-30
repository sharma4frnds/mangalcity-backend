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
use App\Model\Home_location;
use App\Otp\SmsOtp;
use Hash;
use Socialite;
use Helper;
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
        
        $rules=['mobile'=>'required|numeric|digits:10','password' => 'required|min:6'];

        $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()]);
        }
        
        $credentials['verified'] = 1;
        
        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['success' => false, 'error' => 'We cant find an account with this credentials. Please make sure you entered the right information and you have verified your mobile Number.']);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Failed to login, please try again.']);
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
            return response()->json(['success'=> false, 'error'=> $validator->messages()]);
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
    

//social login 
  public function social_login(Request $request)
  {

  // $googleAuthCode = $request->social_token;
    // $accessTokenResponse= Socialite::driver('google')->getAccessTokenResponse($googleAuthCode);
   
    // $accessToken=$accessTokenResponse["access_token"];
    // $expiresIn=$accessTokenResponse["expires_in"];
    // $idToken=$accessTokenResponse["id_token"];
    // $refreshToken=isset($accessTokenResponse["refresh_token"])?$accessTokenResponse["refresh_token"]:"";
    // $tokenType=$accessTokenResponse["token_type"];
    // $user = Socialite::driver('google')->userFromToken($accessToken);
    // dd($user);

    $credentials = $request->only('first_name', 'last_name','email','provider', 'provider_id');
        $rules =[
            'first_name' =>'required|string|min:3|max:255',
            'last_name' =>'required|string|max:255',
            'email' =>'required|string|email|max:255',
            'provider' =>'required|string|min:6|max:8',
            'provider_id' =>'required|string|min:6|max:20',
        ];
    
       $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            return response()->json(['success'=>false, 'error'=> $validator->messages()]);
        }

            // GET LOCAL USER
            $user = User::where('provider', $request->provider)->where('provider_id', $request->provider_id)->first();

            // CREATE LOCAL USER IF DON'T EXISTS
            if (empty($user)) {
                // Before... Check if user has not signup with an email
                $user = User::where('email', $request->email)->first();
            
                if (empty($user)) {
                   try{
                        $user_info = [
                        'first_name'   =>$request->first_name,
                        'last_name'=>$request->last_name,
                        'mobile'=>$request->provider_id,
                        'password'=>'',
                        'email'=>$request->email,
                        'provider'=>$request->provider,
                        'provider_id'=>$request->provider_id, 
                        'created_at'=>date('Y-m-d H:i:s'),
                         ];
                        $user = new User($user_info);
                        $user->save();
                    }
                    catch(\Exception $e){
                           // do task when error
                          // echo $e->getMessage(); exit;  // insert query
                        }
                                 
                } else {
                 
                    // Update 'created_at' if empty (for time ago module)
                    if (empty($user->created_at)) {
                        $user->created_at = date('Y-m-d H:i:s');
                        $user->save();
                    }
                }
            }

         //find the user using his details.
      
          try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = $token=JWTAuth::fromUser($user)) {
                return response()->json(['success' => false, 'error' => 'We cant find an account with this credentials. Please make sure you entered the right information and you have verified your mobile Number.']);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Failed to login, please try again.']);
        }
    
        return response()->json(['success' => true, 'data'=>['token' => $token,'user'=>$user]]);


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
       return response()->json(['success'=> false, 'message'=> 'Invalid otp']);
      }

}


//Login
 public function logout(Request $request) {
        try {
            JWTAuth::invalidate($request->input('token'));
            return response()->json(['success' => true, 'message'=> "You have successfully logged out."]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Failed to logout, please try again.']);
        }
  }



public function userprofile(Request $request)
{

  if(!$user = JWTAuth::toUser($request->token)) {
             return  json_encode(array('success'=>false,'errors'=>array('error'=>'User Not Found')));
        }

    $validator = Validator::make($request->all(), ['first_name' =>'required|max:20','last_name' =>'required|max:20','email' =>'email','country' =>'required|numeric','state' =>'required|numeric','district' =>'required|numeric','city' =>'required|numeric','city' =>'required|numeric','address' =>'max:50','gender' =>'required','marital_status' =>'required']);


     if($validator->fails())
      {
          return response()->json(['success'=>false, 'errors'=>$validator->getMessageBag()->toArray()]);
          // 400 being the HTTP code for an invalid request.
      }


      User::where('id',$user->id)->update(['first_name'=>$request->first_name,'last_name'=>$request->last_name,'email'=>$request->email,'country'=>$request->country,'state'=>$request->state,'district'=>$request->district,'city'=>$request->city,'address'=>$request->address,'gender'=>$request->gender,'marital_status'=>$request->marital_status,'profile'=>1]);

          if($request->current_location =='active')
          {
              Home_location::where('user_id',$user->id)->delete();
          }else{

            $validator = Validator::make($request->all(), ['home_country'=>'required|numeric','home_state' =>'required|numeric','home_district' =>'required|numeric','home_city' =>'required|numeric']);

             if($validator->fails())
              {
                  return response()->json(['success'=>false, 'errors'=>$validator->getMessageBag()->toArray()]);
              }

               if(Home_location::where('user_id',$user->id)->count() =='0')
                  {
                      Home_location::create(['user_id'=>$user->id,'home_country'=>$request->home_country,'home_state'=>$request->home_state,'home_district'=>$request->home_district,'home_city'=>$request->home_city]);
                  }
                  else{
                  Home_location::where('user_id',$user->id)->update(['home_state'=>$request->home_state,'home_district'=>$request->home_district,'home_city'=>$request->home_city]);
                  }
          }

       echo json_encode(array('success'=>true,'message'=>'Profile Update  successfully'));

}

//get profile
public function getprofile(Request $request)
{
  $user = JWTAuth::toUser($request->token);

  $userdata=user::where('id',$user->id)->first();
  $home_location=Home_location::where('user_id',$user->id)->first();
  if($home_location){
     echo json_encode(array('success'=>true,'user'=>$user,'current_location'=>'active',
      'home_location'=>array('home_country'=>$home_location->home_country,'home_state'=>$home_location->home_state,'home_district'=>$home_location->home_district,'home_city'=>$home_location->home_city) ));
  }else{
     echo json_encode(array('success'=>true,'user'=>$user,'current_location'=>'inactive','home_location'=>array() ));
  }
 
}

//user forgot

public function forgot_password_otp(Request $request)
{
    $validator = Validator::make($request->all(), ['mobile' => 'required|digits:10']);

     if($validator->fails())
      {
          return response()->json(['success'=>false, 'errors'=>$validator->getMessageBag()->toArray()]);
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

          echo json_encode(array('success'=>true,'mobile'=>$request->mobile,'message'=>'successfully send otp'),200);
       }else{
          echo json_encode(array('success'=>false,'message'=>'Invalid mobile'));
     }
}

//change_password
  public function forgot_change_password(Request $request)
  {
         $validator = Validator::make($request->all(), ['otp'=>'required','password' => 'required|string|min:6|confirmed']);

       if($validator->fails())
        {
            return response()->json(['success'=>false, 'errors'=>$validator->getMessageBag()->toArray()]);
        }

         $vuser=User::where('mobile',$request->mobile)->first();
        if($vuser)
        {
        $verifyUser = VerifyUser::where('otp', $request->otp)->where('mobile', $request->mobile)->first();
        if(isset($verifyUser) ){

            VerifyUser::where('otp', $request->otp)->where('mobile', $request->mobile)->delete();
              $newpassword = bcrypt($request->password);
                  User::where('id', $vuser->id)->update(['password' => $newpassword]);

          return response()->json(['success'=>true, 'message'=>'successfully update password,please login'], 200);
        }else{
         return response()->json(['success'=>false, 'message'=> 'Invalid otp']);
        }
      }else{
        return response()->json(['success'=>false, 'message'=> 'Invalid Mobile Number']);
      }

       
  }

  //change_password
  function change_password(Request $request)
  {
      $validator = Validator::make($request->all(), ['old_password'=>'required','password' => 'required|string|min:6|confirmed']);

        if ($validator->fails()) {
      
           return response()->json(['success' => false, 'error' => $validator->getMessageBag()->toArray()]);
        }

        $userdata = JWTAuth::toUser($request->token);
        $pass = Hash::check($request->old_password, $userdata->password);

        if($pass==false){
          return response()->json(['success'=>false, 'errors'=>['password'=>'Old Password Not Match']]);
        }

        $newpassword = bcrypt($request->password);
        $user=User::find($userdata->id);
        $user->password=$newpassword;
        $user->save();

        return response()->json(['success'=>true, 'message'=>'Password update successfully']);

  }

  public function resend_otp(Request $request)
  {
 
      $validator = Validator::make($request->all(), ['mobile' => 'required|digits:10']);
     if($validator->fails())
      {
          return response()->json(['success'=>false, 'errors'=>$validator->getMessageBag()->toArray()]);
      }

        $otp=rand(10000,99999);

         $vuser=VerifyUser::where('mobile',$request->mobile)->first();
         if($vuser)
         {
            $sms=new SmsOtp();
            $sms->verifyOtp($request->mobile,$otp);
            VerifyUser::where('mobile',$request->mobile)->update(['otp'=>$otp]);
            return response()->json(['success'=>true, 'message'=>'successfully send'], 200);
         }else
         {
            return response()->json(['success'=>false, 'message'=> 'Invalid mobile'], 405);
         }
  }




    public function upload_image_changes(Request $request)
    {
        $validator = Validator::make($request->all(), ['image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1048']);
        
        if($validator->fails()) 
        {
            return response()->json(['success'=>false, 'errors'=>$validator->getMessageBag()->toArray()]);
        }

      $user = JWTAuth::toUser($request->token);

       $imageName = time(). '.' .$request->file('image')->getClientOriginalExtension();
        Image::make($request->file('image')->getRealPath())->fit(50, 50)->save('public/images/user/'.$imageName);

        $user=User::find($user->id);
     
        if($user->image !='default.default'){
            $file='public/images/user/'.$user->image;
            if(file_exists($file))
            {
                   @unlink($file);
            }
         }

         $user->image=$imageName;
         $user->save();
     
        return response()->json(['success'=>true, 'message'=>'successfully change images'],200);

    }

    public function change_cover_image(Request $request)
    {
        $validator = Validator::make($request->all(), ['cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1048']);
        
        if($validator->fails())
        {
             return response()->json(['success'=>false, 'errors'=>$validator->getMessageBag()->toArray()]);
        }

       $imageName = time(). '.' .$request->file('cover_image')->getClientOriginalExtension();

        Image::make($request->file('cover_image')->getRealPath())->fit(300, 400)->save('public/images/user/cover/'.$imageName);
        $user1 = JWTAuth::toUser($request->token);
        $user=User::find($user1->id);

        $file='public/images/user/cover/'.$user->cover_image;
        if(file_exists($file))
        {
           @unlink($file);
        }

         $user->cover_image=$imageName;
         $user->save();

        return response()->json(['success'=>false, 'message'=>'successfully update'],200);
        
    }



}  