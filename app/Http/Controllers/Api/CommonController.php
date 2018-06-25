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
use App\Model\Spam_tag;
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

 public function spam_tags(Request $request)
 {
      $spam_tags=Spam_tag::where('status','active')->get();
    return response()->json(['success' => true, 'data'=>$spam_tags]);
 }

//download_image
 function download_image($url)
  {
       $filepath='public/images/post/post_image/'.$url;
      //Process download
      if(file_exists($filepath)) {
          header('Content-Description: File Transfer');
          header('Content-Type: application/octet-stream');
          header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
          header('Expires: 0');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');
          header('Content-Length: ' . filesize($filepath));
          flush(); // Flush system output buffer
          readfile($filepath);
          exit;
          }
  }


}
