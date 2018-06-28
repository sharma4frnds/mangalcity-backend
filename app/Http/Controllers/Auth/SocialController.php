<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\Http\Controllers\Controller;
use Request;
use Redirect;
use Session;
use App\User;
use Auth;
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
    public function redirectToProvider()
    {

         $provider= Request::segment(2);
        if (!in_array($provider, $this->network)) {
            $provider = Request::segment(3);
        }
        if (!in_array($provider, $this->network)) {
            abort(404);
        }
       
       return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback()
    {


        //$user = Socialite::driver('facebook')->user();
        
         $provider = Request::segment(2);
        if (!in_array($provider, $this->network)) {
            $provider = Request::segment(3);
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
}
