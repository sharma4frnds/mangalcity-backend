<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use Session;
use App\User;
use Auth;
use App\Otp\SmsOtp;
use Validator;
//use Request;
use Route;

class SocialController extends Controller
{
     use AuthenticatesUsers;

    protected $redirectTo = '/account';
    protected $redirectPath = '/account';
    private $network = ['facebook', 'google', 'twitter'];

   public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    /**
     * SocialController constructor.
     */
 
    
    /**
     * Redirect the user to the Provider authentication page.
     *
	 * @return mixed
	 */
    public function redirectToProvider(Request $request)
    {

        $uri_path=Route::getFacadeRoot()->current()->uri();
        $uri_parts = explode('/', $uri_path);
        $provider   = end($uri_parts);
   

         //$provider= Request::segment(2);
        if (!in_array($provider, $this->network)) {
            //$provider = Request::segment(3);
            $provider=$uri_parts[1];
        }
        if (!in_array($provider, $this->network)) {
            abort(404);
        }
       
       return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback()
    {


        //$user = Socialite::driver('facebook')->user();

            $uri_path=Route::getFacadeRoot()->current()->uri();
        $uri_parts = explode('/', $uri_path);
        $provider   = end($uri_parts);
        
        // $provider = Request::segment(2);
        if (!in_array($provider, $this->network)) {
            //$provider = Request::segment(3);
            $provider=$uri_parts[1];
        }
        if (!in_array($provider, $this->network)) {
            abort(404);
        }

        
         // API CALL - GET USER FROM PROVIDER
        try {
            $user_data = Socialite::driver($provider)->user();
           
            // Data not found
            if (!$user_data) {

                Session::flash('message', 'Unknown error. Please try again in a few minutes.'); 
                Session::flash('alert-class', 'alert-danger');
                return redirect('/error1');
            }

            // Email not found
            if (!$user_data OR !filter_var($user_data->getEmail(), FILTER_VALIDATE_EMAIL)) {
                
                Session::flash('message', "Email address not found. You can't use your :provider account on our website.", ['provider' => ucfirst($provider)]); 
                Session::flash('alert-class', 'alert-danger');
                return redirect('/error2');
            }
        } catch (\Exception $e) {
            $msg = $e->getMessage();

            if (is_string($msg) and !empty($msg)) {
                Session::flash('message', $msg); 
                Session::flash('alert-class', 'alert-danger');
            } else {
                return redirect('/error1');
            }
             return redirect('/error2');
        }

        // Debug
         //dd($user_data);
        
        // DATA MAPPING

        // DATA MAPPING

        //Get country location
      
        try {
            $map_user = [];
            if ($provider == 'facebook') {
                $map_user['first_name'] = (isset($user_data->user['name'])) ? $user_data->user['name'] : 'user';
                if ($map_user['first_name'] == '') {
                    if (isset($user_data->user['first_name']) and isset($user_data->user['last_name'])) {
                        $map_user['first_name'] = $user_data->user['first_name'] . ' ' . $user_data->user['last_name'];
                    }
                }
            } elseif($provider == 'google'){
                    $map_user = [
                        'first_name' => (isset($user_data->name)) ? $user_data->name : '',
                    ];
            }
            else{
                if ($provider == 'twitter') {
                    $map_user = [
                        'first_name' => (isset($user_data->name)) ? $user_data->name : '',
                    ];
                }
            }

            // GET LOCAL USER
            $user = User::where('provider', $provider)->where('provider_id', $user_data->getId())->first();

            // CREATE LOCAL USER IF DON'T EXISTS
            if (empty($user)) {
                // Before... Check if user has not signup with an email
                $user = User::where('email', $user_data->getEmail())->first();
            
                if (empty($user)) {

                //get user mobile number for 
             
                  Session::put('social_data',array('first_name'=>$map_user['first_name'],'email'=>$user_data->getEmail(),'provider'=>$provider,'provider_id'=>$user_data->getId()));
                 Session::save();

                Session::flash('message', "Mobile number not found. You can't use your :provider account on our website.", ['provider' => ucfirst($provider)]); 
                Session::flash('alert-class', 'alert-danger');

                return redirect('login/social_verify_mobile');
                //end mobile coding

                   try{
                        $user_info = [
                        'first_name'   =>$map_user['first_name'],
                        'last_name'=>'',
                        'mobile'=>$user_data->getId(),
                        'password'=>'',
                        'email'        =>$user_data->getEmail(),
                        'provider'     =>$provider,
                        'provider_id'  =>$user_data->getId(), 
                        'created_at'   =>date('Y-m-d H:i:s'),
                         ];
                        $user = new User($user_info);
                        $user->save();
                    }
                    catch(\Exception $e){
                           // do task when error
                           echo $e->getMessage(); exit;  // insert query
                        }
                                 

                } else {
                 
                    // Update 'created_at' if empty (for time ago module)
                    if (empty($user->created_at)) {
                        $user->created_at = date('Y-m-d H:i:s');
                        $user->save();
                    }
                }
            }

            // GET A SESSION FOR USER
            if (Auth::loginUsingId($user->id)) {
                return redirect()->intended('/');
            } else {
               
                 Session::flash('message', "The Email Address or Password don't match."); 
                Session::flash('alert-class', 'alert-danger');
                return redirect('/login');
          
            }
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            if (is_string($msg) and !empty($msg)) {

                Session::flash('message', $msg); 
                Session::flash('alert-class', 'alert-danger');
                return redirect('/login');
            } else {
              
                 Session::flash('message', "Unknown error. The service does not work."); 
                 Session::flash('alert-class', 'alert-danger');
                 return redirect('/login');
            }

            return redirect('/login');
        }


    }

    //social mobile screan
    public function social_mobile(Request $request)
    {
        $data=Session::get('social_data');
        
          if(empty($data))  return redirect('/');
        return view('auth/social_mobile');
    }

    public function social_send_mobile(Request $request)
    {

        $validator = Validator::make($request->all(), ['mobile'=>'required|digits:10' ]);
        
        if($validator->fails())
        {
            return response()->json(['success'=>false, 'errors'=>$validator->getMessageBag()->toArray()],422);
        }


          $data=Session::get('social_data');

          if(empty($data))  return redirect('/');

        

             $vuser=User::where('mobile',$request->mobile)->first();

             if(empty($vuser))
             {
                $otp=rand(10000,99999);
                $sms=new SmsOtp();
                $sms->verifyOtp($request->mobile,$otp);
                $motp=array('mobile'=>$request->mobile,'otp'=>$otp);
                 Session::put('mobile_otp', $motp);
              
                 return response()->json(["success"=>true,'success' =>['message'=>'successfully send otp']], 200);
             }else{
               return response()->json(["success"=>false,'errors' =>['mobile'=>'Mobile number already exists']], 405); 
             }
    }
    

   public function social_submit_otp(Request $request)
   {
       $data=Session::get('social_data');  $mobile_otp=Session::get('mobile_otp');
          if(empty($data) || empty($mobile_otp)){
             return response()->json(["success"=>false,'errors' =>['mobile'=>'Please enter mobile ']], 405);
          }

        if($mobile_otp['otp']==$request->otp)
        {
             $vuser=User::where('mobile',$mobile_otp['mobile'])->first();
            if(empty($vuser))
             {
                $newpassword = bcrypt($request->password);


                   try{
                        $user_info = [
                        'first_name'   =>$data['first_name'],
                        'last_name'=>'',
                        'mobile'=>$mobile_otp['mobile'],
                        'password'=>bcrypt($data['provider_id']),
                        'email'        =>$data['email'],
                        'provider'     =>$data['provider'],
                        'provider_id'  =>$data['provider_id'], 
                        'created_at'   =>date('Y-m-d H:i:s'),
                         ];
                        $user = new User($user_info);
                        $user->save();
                    }
                    catch(\Exception $e){
                           // do task when error
                           echo $e->getMessage(); exit;  // insert query
                        }

                 // GET A SESSION FOR USER
                if (Auth::loginUsingId($user->id)) {
                     Session::forget('mobile_otp');
                     Session::forget('social_data');
                     return response()->json(["success"=>true,'errors' =>['mobile'=>'successfully']], 200);
                } else {
                     return response()->json(["success"=>false,'errors' =>['mobile'=>'invalid mobile number']], 405);

                }
         
             }else{ 
                  return response()->json(["success"=>false,'errors' =>['mobile'=>'invalid mobile number']], 405);
             }
        }else{
               return response()->json(["success"=>false,'errors' =>['otp'=>'invalid otp']], 405);
        }

   }
         


}
