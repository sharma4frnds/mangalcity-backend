<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\City;
use App\Model\State;
use App\Model\District;
class DashboardController extends Controller
{
	public function index() {
		return view('admin/index');
	}
    
    public function login()
    {
    	return view('admin/login');
    }

    public function city(Request $request)
    {
        $citys=City::with('district')->get();
        return view('admin.city',compact('citys'));
    }

    public function getcity()
    {
    	$states=State::get();
    	return view('admin/city_create',compact('states'));
    }

    //test
    public function addcity(Request $request)
    {
    	 $this->validate($request, ['name' => 'required','district' => 'required' ]);

    		City::insert(['name'=>$request->name,'district_id'=>$request->district]);

    	 return redirect('/admin/addcity');
    }

    public function daleteCity(Request $request)
    {
       City::where('id',$request->id)->delete();

         return ;
    }


}
