<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use Auth;
use Input;
use URL;
class SearchController extends Controller
{
	public function index(Request $request)
	{
		$query=e($request->q);
		if(!$query && $query == '') return response()->json(array(), 400);
	
  		$products=User::with('citydata')->where('first_name','LIKE','%'.$query.'%')->get();
    	$data=array();
   
    	if($products){
		 foreach ($products as $product) {
		 	 $image=URL::to('public/images/user/'.$product->image);
		 	 $url=URL::to('profile/'.$product->url);
		 	 $city=isset($product->citydata->name) ? $product->citydata->name : '';
             $data[]=array('value'=>$product->first_name.' '.$product->last_name,'id'=>$product->id,'url'=>$url,'image'=>$image,'city'=>$city);
    	}
        }


     return $data;
   

		
	}

}
