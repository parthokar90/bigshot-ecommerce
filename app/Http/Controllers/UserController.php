<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\admin\admin;
use App\Permission;
use App\Role;
use Session;
use Illuminate\Support\Facades\Hash;
use DB;

class UserController extends Controller
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
    public function index()
    {
  
        $user=admin::orderBy('id','DESC')->paginate(10);
        $permission=Permission::all();
        $role=Role::all();
        return view('role_management.user.index',compact('user','permission','role'));
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
        $data=DB::table('roles_permissions')->where('role_id',$request->role_id)->select('permission_id')->get();
        $create= new admin();
        $create->name=$request->name;
        $create->email=$request->email;
        $create->password=Hash::make($request->password);
        $create->role_id=$request->role_id;
        $create->status=1;
        $create->save();
        foreach($data as $per){
         DB::table('users_permissions')->insert([
            'user_id'=>$create->id,
            'permission_id'=> $per->permission_id,
         ]);
        }
        session()->flash("success","User has been created successfully");
        return redirect(route('user.index'));
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
        $user=admin::find($id);
        $data=admin::orderBy('id','DESC')->paginate(10);
        $role=Role::all();
        return view('role_management.user.edit',compact('user','role','data'));
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
        if($request->password==''){
          $pa=admin::where('id',$id)->select('password')->first();
          $pass=$pa->password;
        }else{
           $pass=Hash::make($request->password);
        }
         admin::where('id',$id)->update([
        'name'=>$request->name,
        'password'=>$pass,  
        'role_id'=>$request->role_id,
        ]);
        DB::table('users_permissions')->where('user_id',$id)->delete();
        $data=DB::table('roles_permissions')->where('role_id',$request->role_id)->select('permission_id')->get();
        foreach($data as $item){
          DB::table('users_permissions')->insert([
            'user_id'=>$id,
            'permission_id'=> $item->permission_id,
          ]);
        }
        session()->flash("success","User has been update successfully");
        return redirect(route('user.index'));
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
}
