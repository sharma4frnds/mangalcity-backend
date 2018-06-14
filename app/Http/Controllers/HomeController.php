<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Page;
use App\Model\City;
use Validator;
use Mail;
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

    /* Get area */
    function getareas(Request $request)
    {
        $quaryDatas=City::where('city', 'like', '%' .$request->city.'%')->get();
        $data=array();
        if(!empty($quaryDatas)){
            echo '<option value="all">All Area</option>';
            foreach($quaryDatas as $quaryData) 
            {
                echo '<option value="'.$quaryData->area.'">'.$quaryData->area.'</option>';
            }
        }

    }

    /* Send mail */
    public function schedule_tour(Request $request)
    { 
        $validator = Validator::make($request->all(), ['name'=>'required|max:100',
            'email' => 'required|email', 'message' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'scheduleErrors'); }

        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['message1']=$request->message;
        $data['property_name']=$request->property_name;
        $data['date']=$request->date;
        $data['time']=$request->time;
        $from=config('mail.from');
        $from['email_to']=$request->email;
        Mail::send('emails.schedule_tour_mail', $data, function ($message) use ($from) {
        $message->from($from['address'], $from['name']);
        $message->to($from['email_to']);
        $message->subject('World Opportuniti:Schedule Tour');
        });

        return redirect()->back()->with('scheduleMessage', 'Thank you for your enquiry');
    
    }

    public function inquiry(Request $request)
    {
        $validator = Validator::make($request->all(), ['name'=>'required|max:100',
            'email' => 'required|email', 'message' => 'required',
        ]);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator, 'inquiryErrors');
        }

        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['message1']=$request->message;
        $data['property_name']=$request->property_name;
        $data['date']='';
        $data['time']='';
        $from=config('mail.from');
        $from['email_to']=$request->email;
        Mail::send('emails.schedule_tour_mail', $data, function ($message) use ($from) {
        $message->from($from['address'], $from['name']);
        $message->to($from['email_to']);
        $message->subject('World Opportuniti:Inquiry');
        });

        return redirect()->back()->with('inquiryMessages', 'Thank you for your enquiry');
    }



    public function test(){
        $data=array();

            Mail::send('emails.welcome', $data, function($message)
            {
            $message
            ->to('yuvrajlodhi1234@gmail.com')
            ->from('yuvrajlodhi1234@gmail.com')
            ->subject('TEST');
            });


            if( count(Mail::failures()) > 0 ) {
            echo "There was one or more failures. They were: <br />";
            foreach(Mail::failures as $email_address) {
            echo " - $email_address <br />";
            }
            } else {
            echo "No errors, all sent successfully!";
            }
       // return view('emails.welcome');
    }

}
