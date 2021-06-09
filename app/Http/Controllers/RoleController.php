<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use Session;
use Illuminate\Support\Facades\Hash;
use DB;

class RoleController extends Controller
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
  
        $user=Role::orderBy('id','DESC')->paginate(10);
        $permission=Permission::all();
        return view('role_management.role.index',compact('user','permission'));
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
        if($request->page_id==null){
           session()->flash("error","Select page Permission");
           return redirect(route('role.index'));
           exit();
        }
        $create= new Role();
        $create->name=$request->name;
        $create->slug=strtolower($request->name);
        $create->save();
        for($i=0;$i<count($request->page_id);$i++){
          DB::table('roles_permissions')->insert([
              'role_id' =>$create->id,
              'permission_id' =>$request->page_id[$i],
          ]);
        }
        session()->flash("success","Role has been created successfully");
        return redirect(route('role.index'));
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
        $role=Role::find($id);
        $all_role=Role::orderBy('id','DESC')->paginate(10);
        $permission=Permission::all();
        return view('role_management.role.edit',compact('role','all_role','permission'));
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
        if($request->page_id==null){
           session()->flash("error","Select page Permission");
           return back();
           exit();
        }

        Role::where('id',$id)->update([
        'name'=>$request->name,
        ]);
        DB::table('roles_permissions')->where('role_id',$id)->delete();
         for($i=0;$i<count($request->page_id);$i++){
          DB::table('roles_permissions')->insert([
              'role_id' =>$id,
              'permission_id' =>$request->page_id[$i],
          ]);
        }
        session()->flash("success","Role & permission has been update successfully");
        return redirect(route('role.index'));
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
