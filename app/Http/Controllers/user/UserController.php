<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use DB;
use Session;
use Auth;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        $user=DB::table('users')->where('id',$id)->first();
        $user_info=DB::table('usermeta')->where('user_id',$id)->get();
        return view('user.profile.edit',compact('user','user_info'));
        
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
        if($request->user_image==''){
         $image_name=$request->d_image;
        }else{
            $image_name = time() . '.' . $request->user_image->getClientOriginalExtension();
            $request->user_image->move(('assets/front/user/'), $image_name);
        }
        $user=DB::table('users')
        ->where('id',$id)
        ->update([
                'name'=>$request->first_name,
                'last_name'=>$request->last_name,
            ]
        );
       DB::table('usermeta')->where('user_id',$id)->where('meta_key','first_name')->update([
            'meta_value'=>$request->first_name,
       ]);
       DB::table('usermeta')->where('user_id',$id)->where('meta_key','last_name')->update([
            'meta_value'=>$request->last_name,
       ]);
       DB::table('usermeta')->where('user_id',$id)->where('meta_key','address_two')->update([
            'meta_value'=>$request->address_two,
       ]);
       DB::table('usermeta')->where('user_id',$id)->where('meta_key','phone')->update([
            'meta_value'=>$request->phone,
       ]);
       DB::table('usermeta')->where('user_id',$id)->where('meta_key','user_image')->update([
            'meta_value' =>$image_name,
       ]);
      session()->flash("success","Information Update Successfully");
      return redirect(url('profile'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function d_account(){
        $id=auth()->user()->id;
        User::where('id',$id)->update([
          'status' =>0
        ]);
        auth::logout();
       return redirect()->route('login');
    }
}
