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

    	return view('profile',compact('states','districts','citys','home_location','hdistricts','hcitys'));
    }

    public function update_profile(Request $request)
    {
        
    	$this->validate($request, ['first_name' =>'required|max:20','last_name' =>'required|max:20','email' =>'email','country' =>'required|numeric','state' =>'required|numeric','district' =>'required|numeric','city' =>'required|numeric','city' =>'required|numeric','address' =>'max:50','gender' =>'required','marital_status' =>'required']);

    		User::where('id',Auth::user()->id)->update(['first_name'=>$request->first_name,'last_name'=>$request->last_name,'email'=>$request->email,'country'=>$request->country,'state'=>$request->state,'district'=>$request->district,'city'=>$request->city,'address'=>$request->address,'gender'=>$request->gender,'marital_status'=>$request->marital_status,'profile'=>1]);

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

    		return redirect()->back()->with('message', 'Profile Update  successfully');
    }


    public function change_password(Request $request)
    {
        $validator = Validator::make($request->all(), ['old_password'=>'required','password' => 'required|string|min:6|confirmed']);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'passwordErrors'); 
        }

        $pass = Hash::check($request->old_password, Auth::user()->password);

        if($pass==false){
          return redirect('user/profile')->with('passwordMessages','Old Password Not Match');
          
          exit();
        }
        $newpassword = bcrypt($request->password);
        $user=User::find(Auth::user()->id);
        $user->password=$newpassword;
    
        $user->save();

        return redirect('user/profile')->with('passwordMessages','Password update successfully');
    }


    public function uploadImagechanges(Request $request)
    {
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

        $validator = Validator::make($request->all(), ['cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1048']);
        
        if($validator->fails())
        {
             return response()->json(['success'=>true, 'errors'=>$validator->getMessageBag()->toArray()],422);
        }

       $imageName = time(). '.' .$request->file('cover_image')->getClientOriginalExtension();

        Image::make($request->file('cover_image')->getRealPath())->fit(300, 400)->save('public/images/user/cover/'.$imageName);
    
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

}
