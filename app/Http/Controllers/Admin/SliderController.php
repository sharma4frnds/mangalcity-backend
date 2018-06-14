<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Slider;
class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider=Slider::all();
        return view('admin/slider',compact('slider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $Request)
    {
       
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048' ]);
        $t=time();
        $imageName =  $t. '.' .$request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(base_path() . '/public/images/slider/', $imageName);
    
        Slider::create([
            'title1' => $request->title1,
            'title2' => $request->title2,
            'title3' => $request->title3,
            'image' => $imageName,
            'url' => $request->url
        ]);

        return redirect('/admin/slider');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       echo 'trsdt2';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       echo 'trsdt3';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $slider=Slider::find($id);
       $oldstatus=$slider->status;

       if($oldstatus=='active') $status='inactive';
       if($slider->status=='inactive') $status='active';
       
       $slider->status = $status;
        $slider->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Slider::destroy($id);

    }
}
