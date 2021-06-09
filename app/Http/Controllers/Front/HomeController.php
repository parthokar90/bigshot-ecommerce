<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\front\Post;

class HomeController extends Controller
{
    public function index(Request $request){
        // product 
        $products=Post::where('post_type','product')
        ->where('post_status','publish')
        ->orderBy('ID','DESC')
        ->get();
    	return view('front.home',compact('products'));
    }
}
