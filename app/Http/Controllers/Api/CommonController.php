<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use JWTAuthException;
use App\Model\City ;
use App\Model\State;
use App\Model\District;
use App\User;

class CommonController extends Controller
{
   public function getState(Request $request)
   {
        	$result = [];
            $districts=State::get();
            if (!is_null($districts)) {
                $result = $districts;
            }
         return response()->json(['success' => true, 'data'=>$result]);
    
   }

   public function getDistict(Request $request)
   {
        $result = [];
        if (strlen($request->id) > 0) {
            $districts=District::where('state_id',$request->id)->get();
            if (!is_null($districts)) {
                $result = $districts;
            }
        }

       return response()->json(['success' => true, 'data'=>$result]);
 
   }


   public function getCity(Request $request)
   {
        $result = [];
        if (strlen($request->id) > 0) {
            $citys=City::where('district_id',$request->id)->get();
            if (!is_null($citys)) {
                $result = $citys;
            }
        }  
        return response()->json(['success' => true, 'data'=>$result]);
   } 
}
