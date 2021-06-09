<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use DataTables;
use App\Model\front\Post;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
      if($request->user()->can('manage-customer')) {
        $extraInfo=array(
            'title'=>"Customer List",
            'page'=>'customer'
        );
        if ($request->ajax()) {
            $data=DB::table('users')
            ->leftjoin('usermeta','usermeta.user_id','=','users.id')
            ->where('meta_key','phone')
            ->orderBy('users.id','DESC')
            ->get(); 
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function($row){
              if($row->status==1){
                return "Active";
               }else{
                return "Inactive";
              }
        })
            ->addColumn('action', function($row){
                $btn = '<a class="btn btn-primary" title="" href="'.url('/customer/edit/'.$row->id).'"> <i class="fa fa-edit"></i> Edit</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);       
        }               
        return view('admin.customer.list')->with($extraInfo);
    }
}


public function customerQuery(){

    $customerQuerys=Post::where('post_type','genarel_quiry')->orderBy('ID','DESC')->paginate(50);
    return view('admin.customer.customerQuery',compact('customerQuerys'));
}

public function queryReplay($id){

    $query=Post::find($id);        
    return view('admin.customer.queryReplay',compact('query'));
}

public function queryAnswer(Request $request){
    $id=$request->id;
    $info=array(
     'post_excerpt'=>$request->post_excerpt,           
 );
    DB::table('posts')->where('ID',$id)->update($info);

    return redirect(route('customer.customerQuery'));
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
        return view('admin.customer.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data=DB::table('users')
        ->where('id',$request->id)
        ->update(['status'=>$request->status]);
        session()->flash("success","Status has been update");
        return redirect()->route('customer.index');
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
