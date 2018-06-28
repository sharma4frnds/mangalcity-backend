<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Page;
use App\Model\City;
use Validator;
use Mail;
use Session;
use App\Model\Home_location;
use Auth;

class HomeController extends FrontController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    //if user not login redirect to login pages 
   /* public function __construct()
    {
        $this->middleware('auth');
    }
    */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home',compact('data'));
    }

    public function post(){
        return view('post');
    }

    /** Page **/
    public function pages($url){
       $page=Page::where('url',$url)->first();
        return view('page',compact('page'));
    }


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

    //change_location
    function change_location(Request $request)
    {
        $home_location=Session::get('home_location');
        $location=Home_location::where('user_id',Auth::user()->id)->first();
        if($home_location)
        {
        Session::forget('home_location');
        return redirect('/home');
        }

        if($location)
        {
            Session::put('home_location',array('home_city'=>$location->home_city,'home_district'=>$location->home_district,'home_state'=>$location->home_state));
            Session::save();
        }

      return redirect('/home');
    }


function image_popup($image)
{
    return view('show_image_popup',compact('image'));
}



}
