<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Spam_tag;
use App\Model\Feedbacks;
use App\Model\Post;
class SpamtagController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags=Spam_tag::get();
        return view('admin.tag',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
           $this->validate($request, ['name' => 'required','status' => 'required']);
    
          Spam_tag::Create([
            'name'=>$request->name,
            'status'=>$request->status
            ]);

          return redirect('admin/tags')->with('success','successfully add');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	 $tags=Spam_tag::find($id);
         return view('admin.tag_create',compact('tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       	 $tags=Spam_tag::find($id);
         return view('admin.tag_create',compact('tags'));
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
        $tags=Spam_tag::find($id);
        $tags->name=$request->name;
        $tags->status=$request->status;
        $tags->save();

        return redirect('/admin/tags');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        Spam_tag::destroy($id);
        Feedbacks::where('spam_tag',$id)->delete();
        return;
    }

  
}
