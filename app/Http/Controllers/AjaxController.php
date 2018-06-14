<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\City ;
use App\Model\State;
use App\Model\District;

class AjaxController extends Controller
{
   public function getDistict(Request $request)
   {
        $result = [];
        if (strlen($request->id) > 0) {
            $districts=District::where('state_id',$request->id)->get();
            if (!is_null($districts)) {
                $result = $districts;
            }
        }
        return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE);
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
        
       return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE);
   }


}
