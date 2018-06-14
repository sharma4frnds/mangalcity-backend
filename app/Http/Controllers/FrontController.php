<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Page;

class FrontController extends Controller
{
    public $request;
    public $category;
    public $pages;
     public function __construct()
     {
	  //   $this->category=collect([]);
	  //   $this->middleware(function ($request, $next)
	  //   {
			// $this->setFrontSettings();
			// return $next($request);
	  //   });
     }


     public function setFrontSettings()
     {
     	$this->category=category::where('status', 'active')->orderBy('id', 'asc')->get();

     	view()->share('category', $this->category);

     	$pages=page::where('status', 'active')->orderBy('sort', 'ASC')->get();

     	view()->share('pages',$pages);

     }
}
