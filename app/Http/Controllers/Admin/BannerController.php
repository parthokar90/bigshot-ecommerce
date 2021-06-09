<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if($request->user()->can('manage-settings')) {
         $extraInfo=array(
        'title'=>"District List",
        'page'=>'settings'
      );
        //banner view
        $banner=DB::table('posts')
        ->where('post_type','banner')
        ->join('postmeta','posts.ID','=','postmeta.post_id')
        ->first();
        return view('admin.banner.index',compact('banner'))->with( $extraInfo);
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'banner_img'=>'required',
        ]);
        $count=DB::table('posts')->where('post_type','banner')->count();
        if($count>0){
            session()->flash("error","Banner image already exists");
            return redirect(route('banner.index'));
        }
        $post_date=date('Y-m-d H:i:00');
        $post_date_gmt=date('Y-m-d H:i:s',strtotime($post_date.'+6 hour'));
        $banner=array(
            'post_title'=>'Banner Image',
            'post_name'=>'Banner Image',
            'post_content'=>'Banner Image',
            'post_excerpt'=>'Banner Image',
            'post_status'=>'publish',
            'post_author'=>Auth::user()->id,
            'post_date'=>$post_date,
            'post_date_gmt'=>$post_date_gmt,
            'to_ping'=>'',
            'pinged'=>'',
            'post_content_filtered'=>'',
            'post_type'=>'banner',
        );
        $post_id=DB::table('posts')->insertGetId($banner);
        $image = time().'.'.$request->banner_img->extension();  
        $request->banner_img->move('backend/banner/',$image);
        $postMeta=DB::table('postmeta')->insert([
            'post_id' =>$post_id,
            'meta_key' =>'banner_image',
            'meta_value' =>$image,
        ]);
        session()->flash("success","Banner image has been upload successfully");
        return redirect(route('banner.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner=DB::table('postmeta')->where('meta_id',$id)->first();
        return view('admin.banner.edit',compact('banner'));
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
       if($request->banner_img==''){
        $image=$request->default_img;
       }else{
        $image = time().'.'.$request->banner_img->extension();  
        $request->banner_img->move('backend/banner/',$image);
       } 
       
       DB::table('postmeta')->where('meta_id',$id)->update([
           'meta_value' =>$image
       ]);
       session()->flash("success","Banner image has been update successfully");
       return redirect(route('banner.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $info=DB::table('post')->where('post_type','banner')
        ->join('postmeta','post.ID','=','postmeta.post_id')
        ->where('ID',$id)
        ->where('postmeta.post_id',$id)
        ->delete();
    }
}
