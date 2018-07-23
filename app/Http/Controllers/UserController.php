<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Model\City ;
use App\Model\State;
use App\Model\District;
use App\Model\Home_location;
use Auth;
use Validator;
use Hash;
use Image;
use File;
use Session;
class UserController extends Controller
{
    public function index()
    {
    	return view('user_dashboard');
    }

    //Get Your Profile

    public function profile(){
    	$states=State::get();
    	$districts=District::where('state_id',Auth::user()->state)->get();
    	$citys=City::where('district_id',Auth::user()->district)->get();
        $home_location=Home_location::where('user_id',Auth::user()->id)->first();
        $hdistricts= (object) array();
        $hcitys=  (object) array();
        if($home_location)
        {
            $hdistricts=District::where('state_id',$home_location->home_state)->get();
            $hcitys=City::where('district_id',$home_location->home_district)->get();
        }

    	return view('user_profile',compact('states','districts','citys','home_location','hdistricts','hcitys'));
    }

    public function update_profile(Request $request)
    {
        
    	$this->validate($request, ['first_name' =>'required|max:20','last_name' =>'required|max:20','email' =>'nullable|email','country' =>'required|numeric','state' =>'required|numeric','district' =>'required|numeric','city' =>'required|numeric','city' =>'required|numeric','address' =>'max:50','gender' =>'required','marital_status' =>'required','dob'=>'required','profession'=>'max:50']);

           $url=str_slug(Auth::user()->id.' '.trim($request->first_name).' '.trim($request->last_name));

           $dob_hidden=isset($request->dob_hidden) ? $request->dob_hidden :'0';
           $mobile_hidden=isset($request->mobile_hidden) ? $request->mobile_hidden :'0';
           
    		User::where('id',Auth::user()->id)->update(['first_name'=>$request->first_name,'last_name'=>$request->last_name,'country'=>$request->country,'state'=>$request->state,'district'=>$request->district,'city'=>$request->city,'address'=>$request->address,'gender'=>$request->gender,'marital_status'=>$request->marital_status,'profile'=>1,'dob'=>$request->dob,'profession'=>$request->profession,'url'=>$url,
                'dob_hidden'=>$dob_hidden,'mobile_hidden'=>$mobile_hidden
        ]);

            if($request->email && empty(Auth::user()->provider))
            {
                User::where('id',Auth::user()->id)->update(['email'=>$request->email]);
            }

            if($request->current_location =='active')
            {
                
                Home_location::where('user_id',Auth::user()->id)->delete();

                // if(Home_location::where('user_id',Auth::user()->id)->count() =='0')
                // {
                //     Home_location::create(['user_id'=>Auth::user()->id,'home_country'=>$request->country,'home_state'=>$request->state,'home_district'=>$request->district,'home_city'=>$request->city]);
                // }
                // else{
                // Home_location::where('user_id',Auth::user()->id)->update(['home_country'=>$request->country,'home_state'=>$request->state,'home_district'=>$request->district,'home_city'=>$request->city]);
                // }

            }else{

                $this->validate($request, ['home_country'=>'required|numeric','home_state' =>'required|numeric','home_district' =>'required|numeric','home_city' =>'required|numeric']);

                 if(Home_location::where('user_id',Auth::user()->id)->count() =='0')
                    {
                        Home_location::create(['user_id'=>Auth::user()->id,'home_country'=>$request->home_country,'home_state'=>$request->home_state,'home_district'=>$request->home_district,'home_city'=>$request->home_city]);
                    }
                    else{
                    Home_location::where('user_id',Auth::user()->id)->update(['home_state'=>$request->home_state,'home_district'=>$request->home_district,'home_city'=>$request->home_city]);
                    }
            }

            //update loation
            $location=Home_location::where('user_id',Auth::user()->id)->first();

            $cCity_name=City::where('id',Auth::user()->city)->first();
          
            if($location)
            {

                $city_name=City::where('id',$location->home_city)->first();
                Session::put('clocation',array('home_city'=>$city_name->name,'current_city'=>$cCity_name->name,'current_location'=>'default','no_of_location'=>2));
                Session::save();
                
                  if(Session::has('home_location')){
                    Session::put('home_location',array('home_city'=>$location->home_city,'home_district'=>$location->home_district,'home_state'=>$location->home_state));
                    Session::save();
                }
            }else
            {
                Session::put('clocation',array('home_city'=>'','current_city'=>$cCity_name->name,'current_location'=>'default','no_of_location'=>1));
                Session::save();
            }

           //end 

    		return redirect('/home')->with('message', 'Profile Update  successfully');
    }



    public function get_change_password(){
        return view('change_password');
    }


    public function change_password(Request $request)
    {
        $validator = Validator::make($request->all(), ['old_password'=>'required','password' => 'required|string|min:6|confirmed']);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'passwordErrors'); 
        }

        $pass = Hash::check($request->old_password, Auth::user()->password);

        if($pass==false){
          return redirect('user/change_password')->with('passwordMessages','Old Password Not Match');
          
          exit();
        }
        $newpassword = bcrypt($request->password);
        $user=User::find(Auth::user()->id);
        $user->password=$newpassword;
    
        $user->save();

        return redirect('user/change_password')->with('passwordMessages','Password update successfully');
    }


    public function uploadImagechanges(Request $request)
    {

        $validator = Validator::make($request->all(), ['image' => 'required']);
        
        if($validator->fails()) 
        {
            return response()->json(['success'=>true, 'errors'=>$validator->getMessageBag()->toArray()],422);
        }

        $image = $request->image;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = str_random(10).'.'.'png';
         $file='public/images/user/'.$imageName;
        $vupload= \File::put($file, base64_decode($image));

        $user=User::find(Auth::user()->id);

        if($user->image !='default.default'){
            $file='public/images/user/'.$user->image;
            if(file_exists($file))
            {
                  
                   @unlink($file);
            }
         }
 
        $user->image=$imageName;
        $user->save();
                
             


           return response()->json(['success'=>false, 'message'=>'successfully change images'],200);

        /* file upload */

        $validator = Validator::make($request->all(), ['image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1048']);
        
        if($validator->fails()) 
        {
            return response()->json(['success'=>true, 'errors'=>$validator->getMessageBag()->toArray()],422);
        }



       $imageName = time(). '.' .$request->file('image')->getClientOriginalExtension();
        Image::make($request->file('image')->getRealPath())->fit(50, 50)->save('public/images/user/'.$imageName);

        $user=User::find(Auth::user()->id);
     
        if($user->image !='default.default'){
            $file='public/images/user/'.$user->image;
            if(file_exists($file))
            {
                   @unlink($file);
            }
         }

         $user->image=$imageName;
         $user->save();
     
        return response()->json(['success'=>false, 'message'=>'successfully change images'],200);

    }

    public function change_cover_image(Request $request)
    {

        $validator = Validator::make($request->all(), ['cover_image' => 'required']);
        
        if($validator->fails()) 
        {
            return response()->json(['success'=>true, 'errors'=>$validator->getMessageBag()->toArray()],422);
        }

        $image = $request->cover_image;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = str_random(10).'.'.'png';
        $file='public/images/user/cover/'.$imageName;
        $vupload= \File::put($file, base64_decode($image));

         $user=User::find(Auth::user()->id);

        $file='public/images/user/cover/'.$user->cover_image;
        if(file_exists($file))
        {
           @unlink($file);
        }

         $user->cover_image=$imageName;
         $user->save();
        return response()->json(['success'=>false, 'message'=>'successfully update'],200);


        $validator = Validator::make($request->all(), ['cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5096|dimensions:min_width=850,min_height=351']);
        
        if($validator->fails())
        {
             return response()->json(['success'=>false, 'errors'=>$validator->getMessageBag()->toArray()],422);
        }

       $imageName = time(). '.' .$request->file('cover_image')->getClientOriginalExtension();

        Image::make($request->file('cover_image')->getRealPath())->fit(850, 351)->save('public/images/user/cover/'.$imageName);
    
        $user=User::find(Auth::user()->id);

        $file='public/images/user/cover/'.$user->cover_image;
        if(file_exists($file))
        {
           @unlink($file);
        }

         $user->cover_image=$imageName;
         $user->save();

        return response()->json(['success'=>false, 'message'=>'successfully update'],200);
        
    }

    public function imagepopup()
    {
        return view('image_popup');
    }

    public function coverpopup()
    {
        return view('cover_popup');
    
    }

 public function imagepopup_demo()
    {
        return view('imagepopup_demo');
    }

    

}
