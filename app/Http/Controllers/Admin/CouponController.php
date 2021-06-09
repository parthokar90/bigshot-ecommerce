<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\admin\coupon;
use DB;
use Session;
use Illuminate\Support\Str;

class CouponController extends Controller
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
        if($request->user()->can('manage-settings')) {
        $q=$request->coupon;
        $extraInfo=array(
            'title'=>"Coupon List",
            'page'=>'coupon'
        );
        if($request->coupon==''){
            $categories=coupon::
             orderBy('id','desc')
            ->paginate(50); 
        }else{
            $categories=coupon::
            where('coupon_code', 'like', '%' .$q. '%')
            ->orderBy('id','desc')
            ->paginate(50); 
        }         
        return view('settings.coupon_list',compact('categories'))->with($extraInfo);
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
     if($request->user()->can('manage-settings')) {   
       $count=DB::table('coupons')->where('coupon_code',$request->coupon_code)->count();
       if($count>0){
         session()->flash("error","Coupon code already exists");
         return redirect(route('coupon.index'));
       } 
       $termInfo=array(
           'coupon_code'=>$request->coupon_code,
           'coupon_amount'=>$request->coupon_amount,
           'coupon_type'=>$request->coupon_type,
           'expire_date'=>$request->expire_date,
       );
       DB::table('coupons')->insert($termInfo);
       session()->flash("success","Information saved Successfully");
       return redirect(route('coupon.index'));
     }
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
    public function edit($id,Request $request)
    {
         if($request->user()->can('manage-settings')) {
        $extraInfo=array(
            'title'=>"Coupon Edit",
            'page'=>'coupon'
        );
        $category=DB::table('coupons')
        ->where('id',$id)
        ->first();
        $categories=coupon::
             orderBy('id','desc')
            ->paginate(50); 
        return view('settings.coupon_list',compact('categories','category'))->with($extraInfo);
      }
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
         if($request->user()->can('manage-settings')) {        
           $termInfo=array(
               'coupon_code'=>$request->coupon_code,
               'coupon_amount'=>$request->coupon_amount,
               'coupon_type'=>$request->coupon_type,
               'expire_date'=>$request->expire_date,
               'status'     =>$request->status
           );
           $term=DB::table('coupons')
           ->where('id',$id)
           ->update($termInfo);
           session()->flash("success","Information Update Successfully");
           return redirect(route('coupon.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('coupons')
        ->where('id',$id)
        ->delete();
        session()->flash("success","Coupon has been deleted Successfully");
        return redirect(route('coupon.index'));
    }
}
