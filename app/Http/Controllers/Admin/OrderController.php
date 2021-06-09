<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\front\Post;
use App\Model\front\Postmeta;
use App\Model\front\Order_item;
use Carbon\Carbon;
use DB;
use Session;
use App;
use Auth;
use Mail;
use PDF;
use App\Exports\DispatchExcel;
use Excel;

class OrderController extends Controller
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
      if($request->user()->can('order-history')) {
        $extraInfo=array(
          'title'=>"Order List",
          'page'=>'order'
        );
        $pending_order=Post::where(['posts.post_type'=>'shop_order','post_status'=>'on-hold'])
        ->count();
        $processing_order = Post::where(['posts.post_type' => 'shop_order', 'post_status' => 'processing'])
        ->count();
        $dispatch_order = Post::where(['posts.post_type' => 'shop_order', 'post_status' => 'dispatch'])
        ->count();
        $delivered_order = Post::where(['posts.post_type' => 'shop_order', 'post_status' => 'delivered'])
        ->count();
        $cancelled_order = Post::where(['posts.post_type' => 'shop_order', 'post_status' => 'cancelled'])
        ->count();
        $reject_order = Post::where(['posts.post_type' => 'shop_order', 'post_status' => 'failed'])
        ->count();
        $total_order_status=$pending_order+$processing_order+$dispatch_order+$delivered_order+$cancelled_order+$reject_order;     
        return view('admin.order.list',compact('pending_order','processing_order','delivered_order','cancelled_order', 'dispatch_order','total_order_status'))->with($extraInfo);
      }
    }

    public function pendingOrder(){
      $extraInfo=array(
        'title'=>"Pending Order List",
        'page'=>'pendingOrder'
      );


      $orders=Post::where('posts.post_type','shop_order')
      ->where('post_status','on-hold')
      ->whereBetween('post_date',[date('Y-m-01'), date('Y-m-t')])
      ->orderBy('ID','DESC')
      ->simplePaginate(10); 
      $or=Post::where('posts.post_type','shop_order')
      ->where('post_status','on-hold')
      ->whereBetween('post_date',[date('Y-m-01'), date('Y-m-t')])
      ->orderBy('ID','DESC')
      ->get(); 
      $total_orders=Post::where('posts.post_type','shop_order')
      ->where('post_status','on-hold')
      ->whereBetween('post_date', [date('Y-m-01'), date('Y-m-t')])
      ->count();  

      $total_item=DB::table('order_itemmeta')
      ->join('posts','posts.ID','=','order_itemmeta.order_id')
      ->where('posts.post_type','shop_order')
      ->where('post_status','on-hold')
      ->where('meta_key','_qty')
      ->whereBetween('post_date', [date('Y-m-01'), date('Y-m-t')])
      ->sum('meta_value');

      $total_amount=DB::table('order_itemmeta')
      ->join('posts','posts.ID','=','order_itemmeta.order_id')
      ->where('posts.post_type','shop_order')
      ->where('post_status','on-hold')
      ->where('meta_key','_line_subtotal')
      ->whereBetween('post_date', [date('Y-m-01'), date('Y-m-t')])
      ->sum('meta_value');

      return view('admin.order.pendingOrder',compact('orders','total_orders','total_item','total_amount','or'))->with($extraInfo);
    }
    public function todayPendingOrder(){
     $extraInfo=array(
      'title'=>"Pending Order List",
      'page'=>'pendingOrder',
      'search_title'=>'Today Pending Order list'
    );


     $orders=Post::where('posts.post_type','shop_order')
     ->where('post_status','on-hold')
     ->whereBetween('post_date',[date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59')])
     ->orderBy('ID','DESC')
     ->simplePaginate(10); 
     $or=Post::where('posts.post_type','shop_order')
     ->where('post_status','on-hold')
     ->whereBetween('post_date',[date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59')])
     ->orderBy('ID','DESC')
     ->get(); 
     $total_orders=Post::where('posts.post_type','shop_order')
     ->where('post_status','on-hold')
     ->whereBetween('post_date',[date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59')])
     ->count();  

     $total_item=DB::table('order_itemmeta')
     ->join('posts','posts.ID','=','order_itemmeta.order_id')
     ->where('posts.post_type','shop_order')
     ->where('post_status','on-hold')
     ->where('meta_key','_qty')
     ->whereBetween('post_date',[date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59')])
     ->sum('meta_value');

     $total_amount=DB::table('order_itemmeta')
     ->join('posts','posts.ID','=','order_itemmeta.order_id')
     ->where('posts.post_type','shop_order')
     ->where('post_status','on-hold')
     ->where('meta_key','_line_subtotal')
     ->whereBetween('post_date',[date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59')])
     ->sum('meta_value');

     return view('admin.order.pendingOrder',compact('orders','total_orders','total_item','total_amount','or'))->with($extraInfo);
   }
   public function pendingOrderByDate($day){

     $starDate = date('Y-m-d 00:00:00',strtotime('-'.$day.'day'));
     $endDate =  date('Y-m-d 23:59:59',strtotime('-'.$day.'day'));  

     $extraInfo=array(
      'title'=>"Pending Order List",
      'page'=>'pendingOrder',
      'search_title'=>'Pending Order list from '.$starDate.' To '.$endDate
    );


     $orders=Post::where('posts.post_type','shop_order')
     ->where('post_status','on-hold')
     ->whereBetween('post_date',[$starDate,   $endDate])
     ->orderBy('ID','DESC')
     ->simplePaginate(10); 
     $or=Post::where('posts.post_type','shop_order')
     ->where('post_status','on-hold')
     ->whereBetween('post_date',[$starDate,   $endDate])
     ->orderBy('ID','DESC')
     ->get(); 
     $total_orders=Post::where('posts.post_type','shop_order')
     ->where('post_status','on-hold')
     ->whereBetween('post_date',[$starDate,   $endDate])
     ->count();  

     $total_item=DB::table('order_itemmeta')
     ->join('posts','posts.ID','=','order_itemmeta.order_id')
     ->where('posts.post_type','shop_order')
     ->where('post_status','on-hold')
     ->where('meta_key','_qty')
     ->whereBetween('post_date',[$starDate,   $endDate])
     ->sum('meta_value');

     $total_amount=DB::table('order_itemmeta')
     ->join('posts','posts.ID','=','order_itemmeta.order_id')
     ->where('posts.post_type','shop_order')
     ->where('post_status','on-hold')
     ->where('meta_key','_line_subtotal')
     ->whereBetween('post_date',[$starDate,   $endDate])
     ->sum('meta_value');

     return view('admin.order.pendingOrder',compact('orders','total_orders','total_item','total_amount','or'))->with($extraInfo);
   }


   public function pendingOrderAll(){
    $extraInfo=array(
      'title'=>"All Pending Order List",
      'page'=>'pendingOrder'
    );


    $orders=Post::where('posts.post_type','shop_order')
    ->where('post_status','on-hold')

    ->orderBy('ID','DESC')
    ->simplePaginate(10); 
    $or=Post::where('posts.post_type','shop_order')
    ->where('post_status','on-hold')

    ->orderBy('ID','DESC')
    ->get(); 
    $total_orders=Post::where('posts.post_type','shop_order')
    ->where('post_status','on-hold')

    ->count();  

    $total_item=DB::table('order_itemmeta')
    ->join('posts','posts.ID','=','order_itemmeta.order_id')
    ->where('posts.post_type','shop_order')
    ->where('post_status','on-hold')
    ->where('meta_key','_qty')

    ->sum('meta_value');

    $total_amount=DB::table('order_itemmeta')
    ->join('posts','posts.ID','=','order_itemmeta.order_id')
    ->where('posts.post_type','shop_order')
    ->where('post_status','on-hold')
    ->where('meta_key','_line_subtotal')

    ->sum('meta_value');

    return view('admin.order.pendingOrder',compact('orders','total_orders','total_item','total_amount','or'))->with($extraInfo);
  }

  public function search_pending_order(Request $request){
    $extraInfo = array(
      'title' => "Panding Order List",
      'page' => 'pendingOrder'
    );
    $start=Carbon::parse($request->start)
    ->toDateString();
    $end=Carbon::parse($request->end)
    ->toDateString();
    $orders=Post::where('posts.post_type','shop_order')
    ->where('post_status','on-hold')
    ->whereBetween('post_date',array([$start,$end]))
    ->orderBy('ID','DESC')
    ->simplePaginate(10); 
    $or=Post::where('posts.post_type','shop_order')
    ->where('post_status','on-hold')
    ->whereBetween('post_date',array([$start,$end]))
    ->orderBy('ID','DESC')
    ->get(); 
    $total_orders=Post::where('posts.post_type','shop_order')
    ->where('post_status','on-hold')
    ->whereBetween('post_date',array([$start,$end]))
    ->count();  

    $total_item=DB::table('order_itemmeta')
    ->join('posts','posts.ID','=','order_itemmeta.order_id')
    ->where('posts.post_type','shop_order')
    ->where('post_status','on-hold')
    ->where('meta_key','_qty')
    ->whereBetween('post_date',array([$start,$end]))
    ->sum('meta_value');

    $total_amount=DB::table('order_itemmeta')
    ->join('posts','posts.ID','=','order_itemmeta.order_id')
    ->where('posts.post_type','shop_order')
    ->where('post_status','on-hold')
    ->where('meta_key','_line_subtotal')
    ->whereBetween('post_date',array([$start,$end]))
    ->sum('meta_value');

    return view('admin.order.searchOrder',compact('orders','total_orders','total_item','total_amount','or','start','end'))->with($extraInfo);
  }

  public function processing()
  {
    $extraInfo = array(
      'title' => "Order List",
      'page' => 'order'
    );
    $order=Post::where('post_type','shop_order')
    ->where('post_status','processing')
    ->whereBetween('post_modified', [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')]) 
    ->orderBy('post_modified','DESC')
    ->simplePaginate(20);
    $total_order=Post::where('post_type', 'shop_order')
    ->where('post_status', 'processing')
    ->whereBetween('post_modified', [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')])
    ->count();
    return view('admin.order.processing',compact('order','total_order'))->with($extraInfo);
  }

  public function processingAll(){
   $extraInfo = array(
    'title' => "Order List",
    'page' => 'order',
    'search_title'=>'All Processing Order'
  );
   $order=Post::where('post_type','shop_order')
   ->where('post_status','processing')

   ->orderBy('post_modified','DESC')
   ->simplePaginate(20);
   $total_order=Post::where('post_type', 'shop_order')
   ->where('post_status', 'processing')
   ->count();
   return view('admin.order.processing',compact('order','total_order'))->with($extraInfo);
 }

 public function processingOrderByDate($day)
 {

  $starDate = date('Y-m-d 00:00:00',strtotime('-'.$day.'day'));
  $endDate =  date('Y-m-d 23:59:59',strtotime('-'.$day.'day'));  

  $extraInfo=array(
    'title'=>" Order List",
    'page' => 'order',
    'search_title'=>'Processing Order list from '.$starDate.' To '.$endDate
  );


  $order=Post::where('post_type','shop_order')
  ->where('post_status','processing')
  ->whereBetween('post_modified', [$starDate,$endDate]) 
  ->orderBy('post_modified','DESC')
  ->simplePaginate(20);
  $total_order=Post::where('post_type', 'shop_order')
  ->where('post_status', 'processing')
  ->whereBetween('post_modified', [$starDate,$endDate]) 
  ->count();
  return view('admin.order.processing',compact('order','total_order'))->with($extraInfo);

} 
public function print()
{   
  return view('admin.order.pendingOrder_print');
}

public function dispat()
{
  $extraInfo = array(
    'title' => "Order List",
    'page' => 'order'
  );
  $order = Post::where('post_type','shop_order')
  ->where('post_status', 'dispatch')
  ->whereBetween('post_modified', [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')])
  ->orderBY('post_modified','DESC')
  ->simplePaginate(20);
  $total_order = Post::where('post_type', 'shop_order')
  ->where('post_status', 'dispatch')
  ->whereBetween('post_modified', [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')])
  ->count();
  return view('admin.order.dispat', compact('order','total_order'))->with($extraInfo); 
}

public function allDispatchcomplete(){
  $extraInfo = array(
    'title' => "Order List",
    'page' => 'order'
  );
  $order = Post::where('post_type', 'shop_order')
  ->where('post_status', 'dispatch')
  ->where('ping_status','close')
  ->whereBetween('post_modified', [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')])
  ->simplePaginate(20);

  $total_complete=Post::where('post_type','shop_order')
  ->where('post_status','dispatch')
  ->where('ping_status','close')
  ->whereBetween('post_modified', [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')])
  ->count();
  $total_qty=Post::where('post_type','shop_order')
  ->where('post_status','dispatch')
  ->where('ping_status','close')
  ->where('meta_key','_qty')
  ->whereBetween('post_modified', [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')])
  ->join('order_itemmeta','posts.ID','=','order_itemmeta.order_id')
  ->sum('meta_value');
  return view('admin.order.all_complete_dispatch', compact('order','total_complete','total_qty'))->with($extraInfo); 
}

public function dispatchByDate($day)
{
  $starDate = date('Y-m-d 00:00:00',strtotime('-'.$day.'day'));
  $endDate =  date('Y-m-d 23:59:59',strtotime('-'.$day.'day'));  

  $extraInfo=array(
    'title'=>"Dispatch Order List",
    'page'=>'order',
    'search_title'=>'Dispatch Order list from '.$starDate.' To '.$endDate
  );
  $order = Post::where('post_type','shop_order')
  ->where('post_status', 'dispatch')
  ->whereBetween('post_modified', [$starDate, $endDate]) 
  ->orderBY('post_modified','DESC')
  ->simplePaginate(20);
  $total_order = Post::where('post_type', 'shop_order')
  ->where('post_status', 'dispatch')
  ->whereBetween('post_modified', [$starDate, $endDate])  
  ->count();
  return view('admin.order.dispat', compact('order','total_order'))->with($extraInfo); 
}

public function dispatAll()
{

  $extraInfo=array(
    'title'=>"Dispatch Order List",
    'page'=>'order',
    'search_title'=>'Dispatch All'
  );
  $order = Post::where('post_type','shop_order')
  ->where('post_status', 'dispatch')
  ->orderBY('post_modified','DESC')
  ->simplePaginate(20);
  $total_order = Post::where('post_type', 'shop_order')
  ->where('post_status', 'dispatch')
  ->count();
  return view('admin.order.dispat', compact('order','total_order'))->with($extraInfo); 
}

public function cancelled()
{   
 $extraInfo=array(
  'title'=>"Cancel List",
  'page'=>'cancelled'
); 

 $order = Post::where('post_type', 'shop_order')
 ->where('post_status', 'cancelled')
 ->whereBetween('post_modified', [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')])
 ->orderBy('post_modified','DESC')
 ->simplePaginate(20);

 $total_order = Post::where('post_type', 'shop_order')
 ->where('post_status', 'cancelled')
 ->whereBetween('post_modified', [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')])
 ->count();

 return view('admin.order.cancelled', compact('order','total_order'))->with($extraInfo);
}

public function allStatus()
{
 $extraInfo = array(
  'title' => "Order List",
  'page' => 'order'
);
 $order = Post::where('post_type','shop_order')
 ->whereBetween('post_date', [date('Y-m-01'), date('Y-m-t')])
 ->orderBy('ID', 'DESC')
 ->simplePaginate(20);
 return view('admin.order.allStatus',compact('order'))->with($extraInfo);
}



public function allStatusPrint($id)
{    
  $order = Post::where('ID', $id)->first();
  $name = DB::table('postmeta')->where('post_id', $id)->where('meta_key','first_name')->first();
  $lname = DB::table('postmeta')->where('post_id', $id)->where('meta_key','last_name')->first();
  $phone = DB::table('postmeta')->where('post_id', $id)->where('meta_key', 'phone')->first();
  $city = DB::table('postmeta')->where('post_id', $id)->where('meta_key', 'city')->first();
  $products = Order_item::where('order_id', $id)->whereNotNull('product_id')->get();
  $deliverycharge = DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','delivery_charge')->first();
  $coupon = DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','coupon_taka')->first();
  $order_info = DB::table('postmeta')->where('post_id', $order->ID)->get();
  $pdf = PDF::loadView('admin.order.allStatusPrint', array(
    'order' => $order, 'name' => $name, 'phone' => $phone,
    'city' => $city, 'products' => $products, 'order_info' => $order_info,'deliverycharge'=>$deliverycharge,'coupon'=>$coupon,'lname'=>$lname 
  ));
  return $pdf->download('allStatusPrint.pdf');
}

public function downloadShipAddress($id){

}


public function sendParcel(Request $request)
{   
 if($request->user()->can('send-parcel')) {
   $extraInfo=array(
    'title'=>"Brand List",
    'page'=>'sendParcel'
  ); 
   $orders=Post::where('posts.post_type','shop_order')
   ->where('post_status','processing')
   ->simplePaginate(10); 
   $total_orders=Post::where('posts.post_type','shop_order')
   ->where('post_status','processing')
   ->count();  
   return view('admin.order.sendParcel',compact('orders','total_orders'))->with($extraInfo);
 }
}

public function sendParcelSearch(Request $request){
 $extraInfo=array(
  'title'=>"Brand List",
  'page'=>'sendParcel',
); 
  $count_order=Post::
  where('ID',$request->order_id)
  ->where('posts.post_type','shop_order')
  ->where('post_status','processing')
  ->count();
 if($request->checkid){
  foreach($request->checkid as $value):
    $checkId[]=$value;
  endforeach;
  $checkId[]=$request->order_id;
}
else{
  $checkId[]=$request->order_id;
}
$orders=Post::
whereIn('ID',$checkId)
->where('posts.post_type','shop_order')
->where('post_status','processing')
->get();
$total_orders=Post::
whereIn('ID',$checkId)
->where('posts.post_type','shop_order')
->where('post_status','processing')
->count();
$total_order_processing=Post::where('posts.post_type','shop_order')
->where('post_status','processing')
->count(); 
return view('admin.order.send_parcel_search',compact('orders','total_orders','total_order_processing','checkId'))->with($extraInfo);
}

public function deliveryInvoice()
{    
  $extraInfo=array(
    'title'=>"Brand List",
    'page'=>'sendParcel'
  ); 
  return view('admin.order.deliveryInvoice')->with($extraInfo);
}

public function reject(Request $request)
{  
  if($request->user()->can('manage-reject')) { 
    $extraInfo=array(
      'title'=>"Reject item",
      'page'=>'reject'
    ); 
    $sku=$request->sku;
    if($sku==''){
     return view('admin.order.reject')->with($extraInfo);
   }else{
     $count=Postmeta::where('meta_key','_sku')->where('meta_value',$sku)->count();
     if($count==0){
      session()->flash("error", "No Sku Found");
      return back();
    }

    $meta_info=Postmeta::where('meta_key','_sku')->where('meta_value',$sku)->first();
    $img=Postmeta::where('meta_key','attached_file')->where('post_id',$meta_info->post_id)->first();
    $lists=DB::table('posts')
    ->where('post_parent',$meta_info->post_id)
    ->where('post_type','product_varient')
    ->where('meta_key','attribute')
    ->join('postmeta','postmeta.post_id','=','posts.ID')
    ->select('meta_value','post_id')
    ->get();
    if($meta_info==NULL){
      session()->flash("error", "No Sku Found");
      return back();
    }
    $post=Post::where('ID',$meta_info->post_id)->first();
    $relationShips=DB::table('term_relationships')
    ->join('terms','terms.term_id','=','term_relationships.term_taxonomy_id')
    ->where('object_id',$post->ID)
    ->first();  
    return view('admin.order.reject_qty',compact('meta_info','post','relationShips','img','lists'))->with($extraInfo);
  }
}

}

public function rejectProductSearh(Request $request)
{    
  $extraInfo=array(
    'title'=>"Reject item",
    'page'=>'reject'
  ); 
  $sku=$request->sku;
  $count=Postmeta::where('meta_key','_sku')->where('meta_value',$sku)->count();
  if($count==0){
    session()->flash("error", "No Sku Found");
    return back();
  }
  $meta_info=Postmeta::where('meta_key','_sku')->where('meta_value',$sku)->first();
  $qty_current=Postmeta::where('meta_key','qty')->where('post_id',$meta_info->post_id)->first();
  if($meta_info==NULL){
    session()->flash("error", "No Sku Found");
    return back();
  }
  $post=Post::where('ID',$meta_info->post_id)->first();
  $relationShips=DB::table('term_relationships')
  ->join('term_taxonomy','term_taxonomy.term_taxonomy_id','=','term_relationships.term_taxonomy_id')
  ->where('object_id',$post->ID)
  ->where('taxonomy','product_cat')
  ->first();
  return view('admin.order.reject_search',compact('meta_info','post','relationShips','qty_current'))->with($extraInfo);
}
public function rejectProductUpdate(Request $request)
{    
 $extraInfo=array(
  'title'=>"Reject item",
  'page'=>'reject'
);
 for($i=0;$i<count($request->post_id);$i++){
   if($request->stock[$i]!=null){
     $default_stock=DB::table('postmeta')
     ->where('post_id',$request->post_id[$i])
     ->where('meta_key','default_qty')
     ->first();

     if(isset($default_stock)){
       $update_qty=$default_stock->meta_value-$request->stock[$i];
       DB::table('postmeta')
       ->where('post_id',$request->post_id[$i])
       ->where('meta_key','default_qty')
       ->update([
         'meta_value' =>$update_qty
       ]);
     }

     $attribute_stock=DB::table('postmeta')
     ->where('post_id',$request->post_id[$i])
     ->where('meta_key','attribute_stock')
     ->first();

     if(isset($attribute_stock)){
       $update_qty=$attribute_stock->meta_value-$request->stock[$i];
       DB::table('postmeta')
       ->where('post_id',$request->post_id[$i])
       ->where('meta_key','attribute_stock')
       ->update([
         'meta_value' =>$update_qty
       ]);
     }

     DB::table('postmeta')->insert([
       'post_id'=>$request->post_id[$i],
       'meta_key'=>'product_status',
       'meta_value'=>'reject',
     ]);

     DB::table('postmeta')->insert([
       'post_id'=>$request->post_id[$i],
       'meta_key'=>'reject_date',
       'meta_value'=> date('Y-m-d')
     ]);

     DB::table('postmeta')->insert([
       'post_id'=>$request->post_id[$i],
       'meta_key'=>'reject_qty',
       'meta_value'=> $request->stock[$i]
     ]);
   }
 }

 session()->flash("success","Quantity has been reject Successfully");
 return redirect()->route('order.reject');
}
public function stock(Request $request)
{

  if($request->user()->can('manage-stock')) {     
    $extraInfo=array(
      'title'=>"Stock List",
      'page'=>'stock'
    ); 
    $products=DB::table('posts')
    ->where('post_type','product')
    ->where('post_status','!=','deleted')
    ->get();

    $data=Post::
    where('post_type','product')
    ->where('post_status','!=','deleted')
    ->get(); 

    return view('admin.order.stock',compact('products','data'))->with($extraInfo);
  }
}

public function stockMove($day)
{   

  if($day==7){    
   $starDate=date('Y-m-d H:i:s');
   $endDate=date('Y-m-d H:i:s',strtotime('-1 week'));
 }
 if($day==15){    
  $starDate =date('Y-m-d H:i:s',strtotime('-1 week'));
  $endDate = date('Y-m-d H:i:s',strtotime('-2 week'));   
}
if($day==30){    
  $starDate = date('Y-m-d H:i:s',strtotime('-2 week')); 
  $endDate = date('Y-m-d H:i:s',strtotime('-1 month')); 
} 
if($day==60){    
 $starDate = date('Y-m-d H:i:s',strtotime('-1 month')); 
 $endDate = date('Y-m-d H:i:s',strtotime('-2 month')); 
}
if($day==90){    
 $starDate = date('Y-m-d H:i:s',strtotime('-2 month'));
 $endDate = date('Y-m-d H:i:s',strtotime('-3 month'));  
}

$extraInfo=array(
  'title'=>" Order List",
  'page'=>'pendingOrder',
  'search_title'=>'Stock Item List'
);

if($day=='all'){    
 $default=Post::
 where('post_type','product')
 ->where('meta_key', 'default_qty')
 ->where('meta_value','>',0)
 ->join('postmeta', 'posts.ID', '=', 'postmeta.post_id')
 ->get();
 $attribute=DB::table('posts')
 ->where('post_type','product_varient') 
 ->where('meta_key', 'attribute_stock')
 ->where('meta_value','>',0)
 ->join('postmeta', 'posts.ID', '=', 'postmeta.post_id')
 ->get();
 return view('admin.order.stockMove',compact('default','attribute'))->with($extraInfo);
}else{
 $default=Post::
 where('post_type','product')
 ->whereBetween('post_date', [$endDate,$starDate])  
 ->where('meta_key', 'default_qty')
 ->where('meta_value','>',0)
 ->join('postmeta', 'posts.ID', '=', 'postmeta.post_id')
 ->get();
 $attribute=DB::table('posts')
 ->where('post_type','product_varient')
 ->whereBetween('post_date', [$endDate,$starDate])  
 ->where('meta_key', 'attribute_stock')
 ->where('meta_value','>',0)
 ->join('postmeta', 'posts.ID', '=', 'postmeta.post_id')
 ->get();
 return view('admin.order.stockMove',compact('default','attribute'))->with($extraInfo);
}





}

public function soldStock(Request $request)
{
 if($request->user()->can('manage-stock')) {  
  $extraInfo = array(
    'title' => "Sold Stock List",
    'page' => 'oldstock'
  );
  $default_product=DB::table('postmeta')  
  ->where('meta_key','default_qty') 
  ->where('meta_value','<=',0)
  ->get();

  $attribute_product=DB::table('postmeta')  
  ->where('meta_key','attribute_stock') 
  ->where('meta_value','<=',0)
  ->get();   

  return view('admin.order.stock_sold',compact('default_product','attribute_product'))->with($extraInfo);
}
}

public function lowerStock(Request $request){
 if($request->user()->can('manage-stock')) {  
  $extraInfo=array(
    'title'=>"Brand List",
    'page'=>'lowerstock'
  ); 
  $d_pro=Post::
  where('post_type','product')
  ->where('meta_key','default_qty')
  ->join('postmeta','posts.ID','=','postmeta.post_id')
  ->get();
  $a_pro=Post::
  where('post_type','product_varient')
  ->where('meta_key','attribute_stock')
  ->join('postmeta','posts.ID','=','postmeta.post_id')
  ->get();
  return view('admin.order.stock_lower',compact('d_pro','a_pro'))->with($extraInfo);
}
}



public function grossProfit()
{    
  $extraInfo=array(
    'title'=>"Brand List",
    'page'=>'grossProfit'
  ); 
  return view('admin.order.grossProfit')->with($extraInfo);
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
      $extraInfo=array(
        'title'=>"Order Edit",
        'page'=>'order'
      );
      $order=Post::find($id);
      $products=Order_item::where('order_id',$id)->whereNotNull('product_id')->get();
      $order_info=DB::table('postmeta')->where('post_id',$order->ID)->get();
      return view('admin.order.edit',compact('order','products','id','order_info'))->with($extraInfo);     
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
      $id=$request->id;
      $status=$request->status;
      $data=DB::table('posts')->where('post_type','shop_order')
      ->where('ID',$id)
      ->update([
        'post_status'=>$status
      ]);
      session()->flash("success","Status has been update");
      return redirect()->back();
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


    //pending order print
    public function pending_order_print($id){
      $total_qty=DB::table('order_itemmeta')->where(['order_id'=>$id,'meta_key'=>'_qty'])->sum('meta_value');
      $total_due=DB::table('order_itemmeta')->where(['order_id'=>$id,'meta_key'=>'_line_subtotal'])->sum('meta_value');
      
      $deliverycharge=DB::table('order_itemmeta')->where('order_id',$id)
      ->where('meta_key','delivery_charge')->first();
      $c=DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','coupon_taka')->first(); 
      if(isset($deliverycharge)){
       $charge=$deliverycharge->meta_value;
     }else{
      $charge=0;
    }

    if(isset($c)){
     $coupon=$c->meta_value;
   }else{
    $coupon=0;
  }

  $total_due=$total_due+$charge-$coupon;
  $customer_info=Postmeta::where('post_id',$id)->get();

  $pdf = PDF::loadView('admin.order.pendingOrder_print', array('total_qty' => $total_qty,'total_due'=>$total_due,'customer_info'=>$customer_info,'id'=>$id));
  return $pdf->download('shipping_address.pdf'); 


      // return view('admin.order.pendingOrder_print',compact('total_qty' ,'total_due','customer_info','id'));

}

public function pending_order_processing($id){
  DB::table('posts')->where('ID',$id)->update([
    'post_status' =>'processing',
    'post_modified' => date('Y-m-d H:i:s'),
  ]);
        //check if already have meta value
  $check=DB::table('postmeta')->where('post_id',$id)->where('meta_key','processing_date')->count();
  if($check>0){
    $check = DB::table('postmeta')->where('post_id', $id)->where('meta_key', 'processing_date')->delete();
    DB::table('postmeta')->insert([
      'post_id' => $id,
      'meta_key' => 'processing_date',
      'meta_value' => date('Y-m-d')
    ]);
  }else{
    DB::table('postmeta')->insert([
      'post_id' => $id,
      'meta_key' => 'processing_date',
      'meta_value' => date('Y-m-d')
    ]);
  }
  session()->flash("success","Status has been changed Successfully");
  return back();
}

public function pending_order_cancel($id){
  DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','coupon_taka')->update([
      'meta_value' =>0
  ]);
  $product=DB::table('order_items')->where('order_id',$id)->get();
  // default product start
  foreach($product as $item){
    $current_order_qty=DB::table('order_itemmeta')
    ->where('order_id',$item->order_id)
    ->where('product_parent',$item->product_parent)
    ->where('meta_key','_qty')
    ->first();
    $pro_stock=DB::table('postmeta')
    ->where('post_id',$item->product_parent)
    ->where('meta_key','default_qty')
    ->first();
    if(isset($current_order_qty) && isset($pro_stock)){
      DB::table('order_itemmeta')->insert([
       'order_id'=>$id,
       'meta_key'=>'cancel_quantity_default',
       'meta_value'=>$current_order_qty->meta_value,
       'product_parent'=>$item->product_parent,
     ]);
      DB::table('order_itemmeta')->insert([
       'order_id'=>$id,
       'meta_key'=>'cancel_default_product',
       'meta_value'=>$item->product_parent,
     ]);
      $update_stock=$current_order_qty->meta_value+$pro_stock->meta_value;

      DB::table('postmeta')
      ->where('post_id',$item->product_parent)
      ->where('meta_key','default_qty')
      ->update([
       'meta_value' =>$update_stock
     ]);

    }
  }
   // default product end

   // attribute product start
  foreach($product as $item){
   $current_order_qty=DB::table('order_itemmeta')
   ->where('order_id',$item->order_id)
   ->where('product_id',$item->product_id)
   ->where('meta_key','_qty')
   ->first();
   $pro_stock=DB::table('postmeta')
   ->where('post_id',$item->product_id)
   ->where('meta_key','attribute_stock')
   ->first();
   if(isset($current_order_qty) && isset($pro_stock)){
     DB::table('order_itemmeta')->insert([
       'order_id'=>$id,
       'meta_key'=>'cancel_quantity_attribute',
       'meta_value'=>$current_order_qty->meta_value,
     ]);
     DB::table('order_itemmeta')->insert([
       'order_id'=>$id,
       'meta_key'=>'cancel_attribute_product',
       'meta_value'=>$item->product_id,
     ]);
     $update_stock=$current_order_qty->meta_value+$pro_stock->meta_value;
     DB::table('postmeta')
     ->where('post_id',$item->product_id)
     ->where('meta_key','attribute_stock')
     ->update([
       'meta_value' =>$update_stock
     ]);

   }
 }
  // attribute product end 

  //order qty update to 0
 DB::table('order_itemmeta')
 ->where('order_id',$id)
 ->where('meta_key','_qty')
 ->update([
  'meta_value'=>0
]);

 DB::table('order_itemmeta')
 ->where('order_id',$id)
 ->where('meta_key','_line_subtotal')
 ->update([
  'meta_value'=>0
]);
 DB::table('posts')->where('ID',$id)->update([
  'post_status'=>'cancelled',
  'post_modified'=>date('Y-m-d h:i:s'),
]);
 session()->flash("success","Order has been cancelled Successfully");
 return back();

}


public function pending_order_edit($id){
  $extraInfo = array(
    'title' => "Order Edit",
    'page' => 'order'
  );
  $order = Post::find($id);
  $products = Order_item::where('order_id', $id)->whereNotNull('product_id')->get();
  $order_info = DB::table('postmeta')->where('post_id', $order->ID)->get();  
  $coupon=DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','coupon_taka')->first();
  $coupon_code=DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','coupon_code')->first();
  $total_qty=DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','_qty')->sum('meta_value');
  $delivery_option=DB::table('options')->first();
  if($delivery_option){
    $delivery_condition=$delivery_option->option_value;
  }else{
    $delivery_condition=0;
  }
  $sub_total=DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','_line_subtotal')->sum('meta_value');

  // delivery condition wise show start
  $delivery_charge=DB::table('order_itemmeta')
  ->where('order_id',$id)
  ->where('meta_key','delivery_charge')
  ->first();
  if(isset($delivery_charge)){
      $charge_delivery=$delivery_charge->meta_value;
  }else{
     $charge_delivery=0;
  }
  if($sub_total>$delivery_condition){
     $charge_delivery=0;
  }else{
     $charge_delivery=$delivery_charge->meta_value;
  }
 // delivery condition wise show end 

// coupon condition wise show start
 if(isset($coupon_code->meta_value)){
   $coupon_types=DB::table('coupons')->where('coupon_code',$coupon_code->meta_value)->select('coupon_amount','coupon_type')->first();
   if($coupon_types->coupon_type==2){
     $coupon_amount=$sub_total/100*$coupon_types->coupon_amount;
   }else{
      $coupon_amount=$coupon_types->coupon_amount;
   }
 }else{
   $coupon_amount=0;
 }
 if($total_qty==0){
    $coupon_amount=0;
 }
 // coupon condition wise show end 

// total order start
 $total_order_customer=$sub_total+$charge_delivery-$coupon_amount;
// total order end
  return view('admin.order.edit',compact('order','products','id','order_info','coupon','delivery_condition','sub_total','charge_delivery','coupon_amount','total_order_customer'))->with($extraInfo);     
}

public function cancel_order_return($id){
  $extraInfo = array(
    'title' => "Order Edit",
    'page' => 'order'
  );
  $order = Post::find($id);
  $products = Order_item::where('order_id', $id)->whereNotNull('product_id')->get();
  $order_info = DB::table('postmeta')->where('post_id', $order->ID)->get();
  $delivery_charge=DB::table('order_itemmeta')
  ->where('order_id',$order->ID)
  ->where('meta_key','delivery_charge')
  ->first();
  $coupon=DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','coupon_taka')->first();
  return view('admin.order.cancel_edit', compact('order', 'products', 'id', 'order_info','delivery_charge','coupon'))->with($extraInfo);     
}


//admin cancel item

public function adminupdateOrderQty(Request $request){
// get copon_code 
  $copon_code=DB::table('order_itemmeta')
  ->where('order_id',$request->order_id) 
  ->where('meta_key','coupon_code')
  ->first();

 // get copon info 
  $copon_info=DB::table('coupons')
  ->where('coupon_code',$copon_code->meta_value)  
  ->first();

  // update stock
  $orderDetails = DB::table('order_itemmeta')
  ->where('order_item_id',$request->order_item_id)
  ->first();
  $find_product_id=$request->product_id;
  $product_default_qty=DB::table('postmeta')
  ->where('post_id',$find_product_id)
  ->where('meta_key','default_qty')
  ->first();
  if(isset($product_default_qty)){
   $orderQty=DB::table('order_itemmeta')
   ->where('order_item_id',$request->order_item_id)
   ->where('meta_key','_qty')
   ->first();
   $update_qty=$product_default_qty->meta_value+$request->qty;
   $result=DB::table('postmeta')
   ->where(
    ['post_id' =>$find_product_id,'meta_key' => 'default_qty']
  )
   ->update([
    'meta_value'=>$update_qty
  ]);
 }
 $product_att_qty=DB::table('postmeta')
 ->where('post_id',$find_product_id)
 ->where('meta_key','attribute_stock')
 ->first();
 if(isset($product_att_qty)){
  $orderQty=DB::table('order_itemmeta')
  ->where('order_item_id',$request->order_item_id)
  ->where('meta_key','_qty')
  ->first();
  $update_qty=$product_att_qty->meta_value+$request->qty;
  $result=DB::table('postmeta')
  ->where(['post_id' =>$find_product_id,'meta_key' => 'attribute_stock'])
  ->update([
    'meta_value'=>$update_qty
  ]);
}
DB::table('order_itemmeta')->insert([
  'order_item_id'=>$request->order_item_id,
  'meta_key'=>'product_status',
  'meta_value'=>'cancel',
  'order_id' => $orderDetails->order_id,
  'order_date' => $orderDetails->order_date,
  'customer_id' => auth()->user()->id,
]);
$orderrQty=DB::table('order_itemmeta')
->where('order_item_id',$request->order_item_id)
->where('meta_key', '_qty')
->first();
$qt=$request->qty;
$order_update_qty=$orderrQty->meta_value-$qt;
DB::table('order_itemmeta')
->where('order_item_id',$request->order_item_id)
->where('meta_key','_qty')
->update([
  'meta_value' => $order_update_qty,
]);
$current_qty=DB::table('order_itemmeta')
->where('order_item_id',$request->order_item_id)
->where('meta_key','_qty')
->sum('meta_value');
$tot_price=$current_qty*$request->product_price;
DB::table('order_itemmeta')
->where('order_item_id',$request->order_item_id)
->where('meta_key','_line_subtotal')
->update([
  'meta_value' => $tot_price,
]);

DB::table('order_itemmeta')
->where('order_item_id',$request->order_item_id)
->where('meta_key','_line_subtotal')
->update([
  'meta_value' => $tot_price,
]);
/****** update copon taka *******/
$totalPrice=DB::table('order_itemmeta')
->where('order_id',$request->order_id)
->where('meta_key','_line_subtotal')
->sum('meta_value');

if($copon_info !=null && $copon_info->coupon_type==2):
  $coponAmount=($copon_info->coupon_amount*$totalPrice)/100;
  DB::table('order_itemmeta')
  ->where('order_id',$request->order_id)
  ->where('meta_key','coupon_taka')
  ->update(['meta_value'=>$coponAmount]);
endif;
$order_qty=DB::table('order_itemmeta')
->where('order_id',$request->order_id)  
->where('meta_key','_qty')
->sum('meta_value');
if((int) $order_qty==0):
  if($copon_info!=null && $copon_info->coupon_type==1):
   DB::table('order_itemmeta')
   ->where('order_id',$request->order_id)
   ->where('meta_key','coupon_taka')
   ->update(['meta_value'=>0]);
 endif;
endif;
// cost update start
 $oldCost=DB::table('order_itemmeta')
 ->where('order_id',$request->order_id)
 ->where('order_item_id',$request->order_item_id)
 ->where('meta_key','order_actual_cost')
 ->first();
 $cur_qty=DB::table('order_itemmeta')
 ->where('order_id',$request->order_id)
 ->where('order_item_id',$request->order_item_id)
 ->where('meta_key','_qty')
 ->first();
 DB::table('order_itemmeta')
  ->where('order_id',$request->order_id)
 ->where('order_item_id',$request->order_item_id)
 ->where('meta_key','order_product_cost')
 ->update([
   'meta_value'=>$oldCost->meta_value*$cur_qty->meta_value
 ]);
// cost update end
if($order_qty==0){
  DB::table('posts')->where('ID',$request->order_id)->where('post_type','shop_order')->update([
     'post_status' =>'cancelled',
     'post_modified' =>date('Y-m-d H:i:s'),
  ]);
}
/************ end of update copon taka ******************/
session()->flash("success", "Item has been Cancelled Successfully");
return back();
}


public function sendParcelPrint(Request $request){

  $current = date('Y-m-d H:i:s');
  $company_name=$request->delivery_company;
  $id=$request->order;
  $invoiceNumber=1;
  $oldInvoice=DB::table('posts')->where('post_type','invoice')->orderBy('ID', 'desc')->first();
  if($oldInvoice){
    $info=explode('-', $oldInvoice->post_name);
    $invoiceNumber=$info[1]+1;
  }
  $post_date=date('Y-m-d H:i:s');
  $post_date_gmt=date('Y-m-d H:i:s',strtotime($post_date.'+6 hour'));
  $import=implode(',', $id);
  $checkInfo=DB::table('posts')->where('post_type','invoice')->where('post_content',$import)->first();
  if($checkInfo==null){
    $invID=DB::table('posts')->insertGetId([
      'post_date'=>date('Y-m-d H:i:s'),    
      'post_type'=>'invoice',
      'post_content'=>$import,
      'post_name'=>'inv-'.$invoiceNumber,
      'post_title'=>'invoice',
      'post_author'=>Auth::user()->id,
      'post_modified'=>$current,
      'post_date_gmt'=>$post_date_gmt,
      'to_ping'=>'',
      'pinged'=>'',
      'post_content_filtered'=>'',
      'post_content_filtered'=>$request->delivery_company,
    ]);
    foreach ($id as $value) {
      DB::table('posts')->insert(
        [
          'post_date'=>date('Y-m-d H:i:s'),    
          'post_type'=>'invoice_order',
          'post_parent'=>$invID,
          'post_name'=>'invoice_order',
          'post_title'=>$value,
          'post_author'=>Auth::user()->id,
          'post_modified'=>$current,
          'post_date_gmt'=>$post_date_gmt,
          'to_ping'=>'',
          'pinged'=>'',
          'post_content_filtered'=>'',
          'post_content_filtered'=>$request->delivery_company,
        ]
      );

    }
  }
  $orders = Post::where(['posts.post_type'=>'shop_order','post_status'=>'processing'])->whereIn('ID',$id)->get();
  foreach ($id as $pid) {
    DB::table('posts')
    ->where('ID',$pid)
    ->update(
      [
        'post_status'=>'dispatch',
        'post_modified'=>$current,
        'post_content_filtered'=>$request->delivery_company,
      ]
    );
  }
  foreach($orders as $item){
   $delivery=DB::table('order_itemmeta')->where('order_id',$item->ID)
   ->where('meta_key','delivery_charge')->first();
   $coupon=DB::table('order_itemmeta')->where('order_id',$item->ID)
   ->where('meta_key','coupon_taka')->first();
 }
 if(isset($delivery)){ 
   $charge=$delivery->meta_value;
 } else{
   $charge=0;
 } 
 if(isset($coupon)){ 
   $c=$coupon->meta_value;
 } else{
   $c=0;
 }


// mail send start
// foreach($orders as $item){
//    $post_info=DB::table('posts')->where('ID',$item->ID)->first();
//    if($post_info->post_author!=0){

//     $user_info=DB::table('users')->where('id',$post_info->post_author)->first();
//     $name=$user_info->name;
//     $email=$user_info->email;
//   }
//   else{    
//     $name=DB::table('postmeta')->where('post_id',$item->ID)->where('meta_key','first_name')->first();
//     $email=DB::table('postmeta')->where('post_id',$item->ID)->where('meta_key','email')->first();
//   }
//         $subject='Dispatch Confirmation';
//         Mail::send('mail2', ['name' => $name], function($message) use ($email, $subject) {
//              $message->from('order@bigshotstyle.com', 'Bigshot');
//              $message->to($email)->subject($subject);
//         });
// }
// mail send end

 // $pdf = PDF::loadView('admin.order.parcel_print_new',array('company_name'=>$company_name,'orders'=>$orders,'charge'=>$charge,'invoiceNumber'=>$invoiceNumber,'c'=>$c));
 // return $pdf->download('delivery_invoice.pdf');

 // return view('admin.order.parcel_print_new',compact('company_name','orders','charge','c','invoiceNumber'));
 if(isset($invID)){
return redirect(route('order.invoice.print',$invID));
 }
 else{
  return redirect(route('order.sendParcel'));
 }
 

}

public function sendParcelRemove($id){
  // DB::table('posts')->where('ID',$id)->update([
  //   'post_status' => 'on-hold'
  // ]);
  return redirect()->route('order.sendParcel');
}

public function downloadShippingAddress($id){
  $order = Post::find($id);
  $products = Order_item::where('order_id', $id)
  ->whereNotNull('product_id')
  ->get();
  $name = DB::table('postmeta')->where('post_id', $order->ID)->where('meta_key','first_name')->first();
  $address = DB::table('postmeta')->where('post_id', $order->ID)->where('meta_key','address_one')->first();
  $phone = DB::table('postmeta')->where('post_id', $order->ID)->where('meta_key','phone')->first();
  $d=DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','delivery_charge')->first(); 
  $c=DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','coupon_taka')->first(); 
  if(isset($d)){
    $charge=$d->meta_value;
  }else{
    $charge=0;
  }
  if(isset($c)){
    $coupon=$c->meta_value;
  }else{
    $coupon=0;
  }
  $user_district=DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','user_district')->first();
  $user_city=DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','user_city')->first();
  $user_zip=DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','user_zip')->first();

  $total_qty=DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','_qty')->sum('meta_value');
  $total_due=DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','_line_subtotal')->sum('meta_value')+$charge-$coupon;
  $pdf = PDF::loadView('admin.pdf.order.shipping_address',array('order'=>$order,'name'=>$name,'address'=>$address,'phone'=>$phone,'total_qty'=>$total_qty,'total_due'=>$total_due,'user_district'=>$user_district,'user_city'=>$user_city,'user_zip'=>$user_zip));
  return $pdf->download('shipping.pdf');
}

    //excel dispatch
public function excelDispatch(){
  $extraInfo = array(
    'title' => "Dispatch Order List",
    'page' => 'order'
  ); 
  $order = Post::where('post_type','shop_order')
  ->where('post_status','dispatch')
  ->where('ping_status','open')
  ->whereBetween('post_modified', [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')])
  ->simplePaginate(500);
  $total_complete=Post::where('post_type','shop_order')
  ->where('post_status','dispatch')
  ->where('ping_status','close')
  ->whereBetween('post_modified', [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')])
  ->count();
  $total_qty=Post::where('post_type','shop_order')
  ->where('post_status','dispatch')
  ->where('ping_status','close')
  ->where('meta_key','_qty')
  ->whereBetween('post_modified', [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')])
  ->join('order_itemmeta','posts.ID','=','order_itemmeta.order_id')
  ->sum('meta_value');
  return view('admin.order.excelDispatch', compact('order','total_complete','total_qty'))->with($extraInfo); 
}

public function excelDispatchDownload(Request $request){
  DB::table('posts')->whereIn('ID',$request->check_id)->update([    
    'ping_status'=>'close'
  ]);
  $data=Post::whereIn('ID',$request->check_id)->get();
  return Excel::download(new DispatchExcel($data),'dispatch_excel.xlsx');
}

public function deliveryInvoiceOrder(){
  $extraInfo = array(
    'title' => "Order List",
    'page' => 'order'
  );
  $order=Post::where(['post_type'=>'invoice'])
  ->whereBetween('post_modified', [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')])
  ->orderBy('post_modified','DESC')
  ->simplePaginate(20);
  return view('admin.order.deliveryInvoiceOrder',compact('order'))->with($extraInfo); 
}

public function deliveredOrder(){
  $extraInfo = array(
    'title' => "Order List",
    'page' => 'order'
  ); 
  $order = Post::where('post_type', 'shop_order')
  ->where('post_status','=','delivered')
  ->whereBetween('post_modified', [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')])
  ->orderBy('post_modified','DESC')
  ->simplePaginate(20);
  $total_order = Post::where('post_type', 'shop_order')
  ->where('post_status','=','delivered')
  ->whereBetween('post_modified', [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')])
  ->count();
  return view('admin.order.delivery', compact('order','total_order'))->with($extraInfo); 
}

public function deliveredSearch(Request $request){
  $start=$request->start;
  $end=$request->end;
  $extraInfo = array(
    'title' => "Delivery List",
    'page' => 'processing'
  );
  $order = Post::where('post_type', 'shop_order')
  ->where('post_status','=','delivered')
  ->whereBetween('post_modified',[date('Y-m-d 00:00:00', strtotime($start)), date('Y-m-d 23:59:59', strtotime($end))])
  ->simplePaginate(2);
  $total_order = Post::where('post_type', 'shop_order')
  ->where('post_status','=','delivered')
  ->whereBetween('post_modified', [date('Y-m-d 00:00:00', strtotime($start)), date('Y-m-d 23:59:59', strtotime($end))])
  ->count();
  return view('admin.order.delivery_search', compact('order','total_order','start','end'))->with($extraInfo); 
}



public function cancelledOrder()
{
  $extraInfo = array(
    'title' => "Order List",
    'page' => 'order'
  );
  $order = Post::where('post_type', 'shop_order')
  ->where('post_status', 'cancelled')
  ->whereBetween('post_modified', [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')]) 
  ->orderBy('post_modified','DESC')
  ->simplePaginate(20);   
  $total_order = Post::where('post_type', 'shop_order')
  ->where('post_status', 'cancelled')
  ->whereBetween('post_modified', [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')]) 
  ->count();
  return view('admin.order.cancelled', compact('order','total_order'))->with($extraInfo);
} 

public function cancelledOrderSearch(Request $request){
  $start = $request->start;
  $end = $request->end;
  $extraInfo = array(
    'title' => "Delivery List",
    'page' => 'processing'
  );
  $order = Post::where('post_type', 'shop_order')
  ->where('post_status', 'cancelled')
  ->whereBetween('post_modified', [date('Y-m-d 00:00:00', strtotime($start)), date('Y-m-d 23:59:59', strtotime($end))])
  ->simplePaginate(20);
  $total_order = Post::where('post_type', 'shop_order')
  ->where('post_status', 'cancelled')
  ->whereBetween('post_modified', [date('Y-m-d 00:00:00', strtotime($start)), date('Y-m-d 23:59:59', strtotime($end))])
  ->count();
  return view('admin.order.cancelled_search', compact('order', 'total_order'))->with($extraInfo);
}

public function cancelledOrderPrint($id)
{
  $order = Post::where('ID', $id)->first();
  $name =  DB::table('postmeta')->where('post_id', $id)->where('meta_key', 'first_name')->first();
  $phone = DB::table('postmeta')->where('post_id', $id)->where('meta_key', 'phone')->first();
  $city =  DB::table('postmeta')->where('post_id', $id)->where('meta_key', 'city')->first();
  $products = Order_item::where('order_id', $id)->whereNotNull('product_id')->get();
  $order_info = DB::table('postmeta')->where('post_id', $order->ID)->get();
  $pdf = PDF::loadView('admin.order.concelled_order_pdf', array(
    'order' => $order, 'name' => $name, 'phone' => $phone,
    'city' => $city, 'products' => $products, 'order_info' => $order_info
  ));
  return $pdf->download('cancelledorder.pdf');
}

public function updateOrderQty(Request $request){
  if($request->qtyy==''){
   session()->flash("error","Enter no of quantity to update order");
   return back();
 }
// get copon_code 
 $copon_code=DB::table('order_itemmeta')
 ->where('order_id',$request->order_id) 
 ->where('meta_key','coupon_code')
 ->first();
 // get copon info 
 $copon_info=DB::table('coupons')
 ->where('coupon_code',$copon_code->meta_value)  
 ->first();
 $oldQty=DB::table('order_itemmeta')
 ->where('order_id',$request->order_id)
 ->where('order_item_id',$request->order_item_id)
 ->where('meta_key','_qty')
 ->first();
 $stuTotal=DB::table('order_itemmeta')
 ->where('order_id',$request->order_id)
 ->where('order_item_id',$request->order_item_id)
 ->where('meta_key','_line_subtotal')
 ->first();
 $unitPricee=$stuTotal->meta_value/$oldQty->meta_value;
 $term=DB::table('order_itemmeta')
 ->where('order_id',$request->order_id)
 ->where('order_item_id',$request->order_item_id)
 ->where('meta_key','_qty')
 ->update(['meta_value'=>$request->qtyy]);
 $term=DB::table('order_itemmeta')
 ->where('order_id',$request->order_id)
 ->where('order_item_id',$request->order_item_id)
 ->where('meta_key','_line_subtotal')
 ->update(['meta_value'=>$request->qtyy*$unitPricee]);
 $term=DB::table('order_itemmeta')
 ->where('order_id',$request->order_id)
 ->where('order_item_id',$request->order_item_id)
 ->where('meta_key','_line_total')
 ->update(['meta_value'=>$request->qtyy*$unitPricee]);
  //decrement stock from attribute
 $attribute_stock=DB::table('postmeta')
 ->where('post_id',$request->product_id)
 ->where('meta_key','attribute_stock')
 ->first();
 if(isset($attribute_stock)){
   $tot_stock=$attribute_stock->meta_value+($oldQty->meta_value-$request->qtyy);
   DB::table('postmeta')
   ->where('post_id',$request->product_id)
   ->where('meta_key','attribute_stock')
   ->update([
     'meta_value' => $tot_stock
   ]);
 }
//decrement stock from default
 $default_stock=DB::table('postmeta')
 ->where('post_id',$request->product_id)
 ->where('meta_key','default_qty')
 ->first();
 if(isset($default_stock)){
   $tot_stock=$default_stock->meta_value+($oldQty->meta_value-$request->qtyy);
   DB::table('postmeta')
   ->where('post_id',$request->product_id)
   ->where('meta_key','default_qty')
   ->update([
     'meta_value' => $tot_stock
   ]);
 }
 //count order total quantity
 $total_order=DB::table('order_itemmeta')->where('order_id',$request->order_id)->where('meta_key','_qty')->sum('meta_value');
 //check all quantity cancel
 if($total_order==0){
  DB::table('posts')->where('post_type','shop_order')
  ->where('ID',$request->order_id)
  ->update([
    'post_status'=>'cancelled',
    'post_modified'=>date('Y-m-d h:i:s'),
  ]);
  DB::table('order_itemmeta')->where('order_id',$request->order_id)->where('meta_key','coupon_taka')->update([
    'meta_value' =>0
  ]);
}

// delivery condition wise delivery charge add or minus
$total_order_user=DB::table('order_itemmeta')->where('order_id',$request->order_id)->where('meta_key','_line_subtotal')->sum('meta_value');
$delivery_condition=DB::table('options')->first();
$order_district=DB::table('order_itemmeta')->where('order_id',$request->order_id)->where('meta_key','user_district')->first();
$deli=DB::table('terms')->where('name',$order_district->meta_value)
->join('term_taxonomy','term_taxonomy.term_id','=','terms.term_id')
->where('term_taxonomy.taxonomy','district')
->select('description')
->first();
if($total_order_user>=$delivery_condition->option_value){
  DB::table('order_itemmeta')->where('order_id',$request->order_id)
  ->where('meta_key','delivery_charge')
  ->update([
    'meta_value' =>0
  ]);
}

if($total_order_user<$delivery_condition->option_value){
  DB::table('order_itemmeta')->where('order_id',$request->order_id)
  ->where('meta_key','delivery_charge')
  ->update([
    'meta_value' =>$deli->description
  ]);
}
// delivery condition wise delivery charge add or minus

// cost update start
 $oldCost=DB::table('order_itemmeta')
 ->where('order_id',$request->order_id)
 ->where('order_item_id',$request->order_item_id)
 ->where('meta_key','order_actual_cost')
 ->first();
 DB::table('order_itemmeta')
  ->where('order_id',$request->order_id)
 ->where('order_item_id',$request->order_item_id)
 ->where('meta_key','order_product_cost')
 ->update([
   'meta_value'=>$oldCost->meta_value*$request->qtyy
 ]);
// cost update end

/****** update copon taka *******/
$totalPrice=DB::table('order_itemmeta')
->where('order_id',$request->order_id)
->where('meta_key','_line_subtotal')
->sum('meta_value');
if($copon_info!=null && $copon_info->coupon_type==2):
  $coponAmount=($copon_info->coupon_amount*$totalPrice)/100;
  DB::table('order_itemmeta')
  ->where('order_id',$request->order_id)
  ->where('meta_key','coupon_taka')
  ->update(['meta_value'=>$coponAmount]);
endif;
$order_qty=DB::table('order_itemmeta')
->where('order_id',$request->order_id)  
->where('meta_key','_qty')
->sum('meta_value');
if((int) $order_qty==0):
  if($copon_info !=null && $copon_info->coupon_type==1):
   DB::table('order_itemmeta')
   ->where('order_id',$request->order_id)
   ->where('meta_key','coupon_taka')
   ->update(['meta_value'=>0]);
 endif;
endif;
/************ end of update copon taka ******************/
session()->flash("success","Order quantity and stock has been update successfully");
return back();
}

public function processingOrderPrint($id){
  $order = Post::where('post_type','shop_order')
  ->where('ID',$id) 
  ->get();
  $pdf = PDF::loadView('admin.order.processing_order_pdf', array('order' => $order));
  return $pdf->download('processingorder.pdf');
}

public function processingOrderEdit($id)
{
  $order = Post::where('post_type', 'shop_order')
  ->where('ID', $id)
  ->get();
  return view('admin.order.processing_order_edit',compact('order'));
}

public function processingOrderCancel($id)
{


  $product=DB::table('order_items')->where('order_id',$id)->get();
  // default product start
  foreach($product as $item){
    $current_order_qty=DB::table('order_itemmeta')
    ->where('order_id',$item->order_id)
    ->where('product_parent',$item->product_parent)
    ->where('meta_key','_qty')
    ->first();
    $pro_stock=DB::table('postmeta')
    ->where('post_id',$item->product_parent)
    ->where('meta_key','default_qty')
    ->first();
    if(isset($current_order_qty) && isset($pro_stock)){
      DB::table('order_itemmeta')->insert([
       'order_id'=>$id,
       'meta_key'=>'cancel_quantity_default',
       'meta_value'=>$current_order_qty->meta_value,
       'product_parent'=>$item->product_parent,
     ]);
      DB::table('order_itemmeta')->insert([
       'order_id'=>$id,
       'meta_key'=>'cancel_default_product',
       'meta_value'=>$item->product_parent,
     ]);
      $update_stock=$current_order_qty->meta_value+$pro_stock->meta_value;

      DB::table('postmeta')
      ->where('post_id',$item->product_parent)
      ->where('meta_key','default_qty')
      ->update([
       'meta_value' =>$update_stock
     ]);

    }
  }
   // default product end

   // attribute product start
  foreach($product as $item){
   $current_order_qty=DB::table('order_itemmeta')
   ->where('order_id',$item->order_id)
   ->where('product_id',$item->product_id)
   ->where('meta_key','_qty')
   ->first();
   $pro_stock=DB::table('postmeta')
   ->where('post_id',$item->product_id)
   ->where('meta_key','attribute_stock')
   ->first();
   if(isset($current_order_qty) && isset($pro_stock)){
     DB::table('order_itemmeta')->insert([
       'order_id'=>$id,
       'meta_key'=>'cancel_quantity_attribute',
       'meta_value'=>$current_order_qty->meta_value,
     ]);
     DB::table('order_itemmeta')->insert([
       'order_id'=>$id,
       'meta_key'=>'cancel_attribute_product',
       'meta_value'=>$item->product_id,
     ]);
     $update_stock=$current_order_qty->meta_value+$pro_stock->meta_value;
     DB::table('postmeta')
     ->where('post_id',$item->product_id)
     ->where('meta_key','attribute_stock')
     ->update([
       'meta_value' =>$update_stock
     ]);

   }
 }
  // attribute product end 

  //order qty update to 0
 DB::table('order_itemmeta')
 ->where('order_id',$id)
 ->where('meta_key','_qty')
 ->update([
  'meta_value'=>0
]);

 DB::table('order_itemmeta')
 ->where('order_id',$id)
 ->where('meta_key','_line_subtotal')
 ->update([
  'meta_value'=>0
]);
 DB::table('posts')->where('ID',$id)->update([
  'post_status'=>'cancelled',
  'post_modified'=>date('Y-m-d h:i:s'),
]);
 session()->flash("success","Order has been cancelled Successfully");
 return back();

}

public function processingOrderDispatch($id)
{
  DB::table('posts')->where('ID',$id)->update([
    'post_status' => 'dispatch',
    'post_modified' => date('Y-m-d H:i:s'),
  ]);
  session()->flash("success", "Order has been dispatch");
  return back();
}

public function processingOrderUpdate(Request $request){

  DB::table('postmeta')->where('post_id',$request->order_id)->where('meta_key','first_name')->update([
    'meta_value'=>$request->first_name
  ]);
  DB::table('postmeta')->where('post_id', $request->order_id)->where('meta_key', 'last_name')->update([
    'meta_value' => $request->last_name
  ]);
  DB::table('postmeta')->where('post_id', $request->order_id)->where('meta_key', 'address_one')->update([
    'meta_value' => $request->address
  ]);
  session()->flash("success", "Information update successfully");
  return back();

}

public function processingOrderdatewise(Request $request){
 $start=$request->start;
 $end=$request->end;
 $extraInfo = array(
  'title' => "Brand List",
  'page' => 'processing'
);
 $order=Post::where('post_type','shop_order')
 ->where('post_status','processing')
 ->whereBetween('post_modified', [date('Y-m-d 00:00:00',strtotime($start)), date('Y-m-d 23:59:59',strtotime($end))]) 
 ->simplePaginate(20);
 $total_order=Post::where('post_type', 'shop_order')
 ->where('post_status', 'processing')
 ->whereBetween('post_modified', [date('Y-m-d 00:00:00',strtotime($start)), date('Y-m-d 23:59:59',strtotime($end))]) 
 ->count();
 return view('admin.order.processing_date_wise',compact('order','total_order','start','end'))->with($extraInfo);
}

public function dispatchOrderDelivered($id){

  DB::table('posts')->where('ID',$id)->update([
    'post_status' =>'delivered',
    'post_modified' => date('Y-m-d H:i:s'),
  ]);

  $post_info=DB::table('posts')->where('ID',$id)->first();
  if($post_info->post_author!=0){

    $user_info=DB::table('users')->where('id',$post_info->post_author)->first();
    $name=$user_info->name;
    $email=$user_info->email;
    
    $subject='Delivery Confirmation';
    Mail::send('mail3', ['name' => $name], function($message) use ($email, $subject) {
     $message->from('order@bigshotstyle.com', 'Bigshot');
     $message->to($email)->subject($subject);
   });
  }

  session()->flash("success", "Order has been delivered");
  return redirect()->route('order.dispat');
}

// public function dispatchOrderEdit($id){
//     $order=Post::where('ID',$id)->first();
//     $order_item = Post::where('ID', $id)->get();
//     return view('admin.order.dispatch_order_edit',compact('order','order_item'));
// }


public function dispatchOrderdatewise(Request $request)
{
  $extraInfo = array(
    'title' => "Brand List",
    'page' => 'processing'
  );
  
  $order = Post::where('post_type','shop_order')
  ->where('post_status','dispatch')
  ->where('ID',$request->order_id)
  ->whereBetween('post_modified', [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')])
  ->simplePaginate(20);
  $total_order = Post::where('post_type', 'shop_order')
  ->where('post_status', 'dispatch')
  ->where('ID',$request->order_id)
  ->whereBetween('post_modified', [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')])
  ->count();
  $search_title='Order Id'.':'.$request->order_id;
  return view('admin.order.dispatch_date_wise', compact('order','total_order','search_title'))->with($extraInfo); 
}


public function dispatchOrderEdit($id)
{
  $order = Post::where('ID', $id)->first();
  $orders_data = Post::where('ID', $id)->get();
  $order_item = Post::where('ID', $id)->get();
  return view('admin.order.dispatch_order_edit', compact('order', 'order_item', 'orders_data'));
}


public function dispatchOrdercancel(Request $request)
{


  if ($request->full_order == 'full') {
    $status_change = DB::table('posts')->where('ID', $request->order_id)->update([
      'post_status' => 'cancelled',
      'post_modified' => date('Y-m-d'),
    ]);
    $order_items= DB::table('order_items')->where('order_id', $request->order_id)->get();

    foreach ($order_items as $items) {

      $itemQty=DB::table('order_itemmeta')
      ->where('order_id', $items->order_id)
      ->where('order_item_id', $items->order_item_id)
      ->where('meta_key', '_qty')
      ->first();


     // old stock
      $oldQty=DB::table('postmeta')->where('post_id', $items->product_id)->where('meta_key','qty')->first();

      $newQty=$oldQty->meta_value+$itemQty->meta_value;
      DB::table('postmeta')->where('post_id', $items->product_id)->where('meta_key','qty')->update([
        'meta_value'=>$newQty]);

    }

  } else {
    dd($request->partial_cancel);
  }
  return redirect(route('order.dispat'));
}
public function testpdf($id=1){    

  if($id==1){
    $data=[];
    $pdf = PDF::loadView('admin.pdf.order.test',array('order' => $data));
    return $pdf->download('testpdf.pdf');
  }
  else{
   return view('admin.pdf.order.test');
 }

}

public function exceldispatchOrderdate(Request $request){
  $start=$request->start;
  $end=$request->end;
  $extraInfo = array(
    'title' => "Brand List",
    'page' => 'processing'
  );
  $order = Post::where('post_type','shop_order')
  ->where('post_status','dispatch')
  ->whereBetween('post_modified', [date('Y-m-d 00:00:00',strtotime($start)), date('Y-m-d 23:59:59',strtotime($end))])
  ->simplePaginate(500);
  $total_complete=Post::where('post_type','shop_order')
  ->where('post_status','dispatch_complete')
  ->whereBetween('post_modified', [date('Y-m-d 00:00:00',strtotime($start)), date('Y-m-d 23:59:59',strtotime($end))])
  ->count();
  $total_qty=Post::where('post_type','shop_order')
  ->where('post_status','dispatch_complete')
  ->where('meta_key','_qty')
  ->whereBetween('post_modified', [date('Y-m-d 00:00:00',strtotime($start)), date('Y-m-d 23:59:59',strtotime($end))])
  ->join('order_itemmeta','posts.ID','=','order_itemmeta.order_id')
  ->sum('meta_value');
  return view('admin.order.excelDispatchdate', compact('order','total_complete','total_qty','start','end'))->with($extraInfo);
}


public function deliveryInvoiceData(Request $request){
  $order_id=$request->order_id;
  $date = $request->order_date;
  $company=$request->delivery_company;

  if($order_id=='' && $date=='' && $request->delivery_company==''){
    session()->flash("error", "Enter Invoice No Or Date Or Company");
    return redirect()->route('order.delivery.invoice');
  }
  if($order_id!=NULL){
    $ct=Post::where('post_type', 'invoice')    
    ->where('post_name',$order_id)
    ->count();
    if($ct==0){
      session()->flash("error", "Order id not found");
         return redirect()->route('order.delivery.invoice');
    }
    $order = Post::where('post_type', 'invoice')    
    ->where('post_name',$order_id)
        ->simplePaginate(20);
    $search_title='Invoice id '.' : '. $order_id;
  }
  if($date!=NULL){
    $ct=Post::where('post_type', 'invoice')    
    ->whereBetween('post_modified', [date('Y-m-d 00:00:00', strtotime($date)), date('Y-m-d 23:59:59', strtotime($date))])
    ->count();
    if($ct==0){
      session()->flash("error", "No order found");
         return redirect()->route('order.delivery.invoice');
    }
    $order = Post::where('post_type', 'invoice')  
    ->whereBetween('post_modified', [date('Y-m-d 00:00:00', strtotime($date)), date('Y-m-d 23:59:59', strtotime($date))])
    ->simplePaginate(20);
    $search_title='Search Date'.':'.$date;
  }

  if($request->delivery_company!=NULL){
    $ct=Post::where('post_type', 'invoice')    
    ->where('post_content_filtered',$request->delivery_company)
    ->count();
    if($ct==0){
      session()->flash("error", "No data found");
         return redirect()->route('order.delivery.invoice');
    }
    $order = Post::where('post_type', 'invoice')    
    ->where('post_content_filtered',$request->delivery_company)
    ->simplePaginate(20);
    $search_title='Delivery Company'.':'.$request->delivery_company;
  }
  
  return view('admin.order.deliveryInvoiceOrder',compact('order','search_title'));

}

public function deliveredOrderEdit($id){        
 $extraInfo = array(
  'title' => "Order Edit",
  'page' => 'order'
);
 $order = Post::find($id);
 $products = Order_item::where('order_id', $id)->whereNotNull('product_id')->get();
 $order_info = DB::table('postmeta')->where('post_id', $order->ID)->get();
 return view('admin.order.deliveryEdit', compact('order', 'products', 'id', 'order_info'))->with($extraInfo);   

}

public function updateDeliveryOrder(Request $request){
  $count=count($request->qty);

  for($i=0;$i<$count;$i++){

    $oldQty=DB::table('order_itemmeta')
    ->where('order_id',$request->order_id)
    ->where('order_item_id',$request->order_item_id[$i])
    ->where('meta_key','_qty')
    ->first();

    $stuTotal=DB::table('order_itemmeta')
    ->where('order_id',$request->order_id)
    ->where('order_item_id',$request->order_item_id[$i])
    ->where('meta_key','_line_subtotal')
    ->first();
    if($oldQty && $stuTotal){    
      $unitPrice=$stuTotal->meta_value/$oldQty->meta_value;
    }
    else{
      $startPrice=DB::table('postmeta')
      ->where('post_id',$request->product_id[$i])
      ->where('meta_key','sale_price')
      ->first();
      $unitPrice=$startPrice->meta_value;
    }
    $term=DB::table('order_itemmeta')
    ->where('order_id',$request->order_id)
    ->where('order_item_id',$request->order_item_id[$i])
    ->where('meta_key','_qty')
    ->update(['meta_value'=>$request->qty[$i]]);

    $term=DB::table('order_itemmeta')
    ->where('order_id',$request->order_id)
    ->where('order_item_id',$request->order_item_id[$i])
    ->where('meta_key','_line_subtotal')
    ->update(['meta_value'=>$request->qty[$i]*$unitPrice]);

    $term=DB::table('order_itemmeta')
    ->where('order_id',$request->order_id)
    ->where('order_item_id',$request->order_item_id[$i])
    ->where('meta_key','_line_total')
    ->update(['meta_value'=>$request->qty[$i]*$unitPrice]);
  }
  return redirect(route('order.deliver'));
}

public function deliveredOrderPrint($id){
  $order=Post::where('ID',$id)->first();
  $order_total_item=DB::table('order_items')->where('order_id',$id)->count();
  $deliverycharge = DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','delivery_charge')->first();
  $deliverycompany = DB::table('posts')->where('ID',$id)->select('post_content_filtered')->first();
  $c=DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','coupon_taka')->first(); 
  $total_parcel=Order_item::where('order_id', $id)->count();
  $name =DB::table('postmeta')->where('post_id',$id)->where('meta_key','first_name')->first();
  $lname =DB::table('postmeta')->where('post_id',$id)->where('meta_key','last_name')->first();
  $address =DB::table('postmeta')->where('post_id',$id)->where('meta_key','address_one')->first();
  $phone = DB::table('postmeta')->where('post_id', $id)->where('meta_key', 'phone')->first();
  $city = DB::table('postmeta')->where('post_id', $id)->where('meta_key', 'city')->first();
  $products = Order_item::where('order_id', $id)->whereNotNull('product_id')->get();
  $order_info = DB::table('postmeta')->where('post_id',$order->ID)->get();

  $pdf = PDF::loadView('admin.order.deliveryInvoice',array('order' => $order, 'name' => $name,'lname'=>$lname,'phone'=>$phone,
    'city'=>$city,'products'=>$products,'order_info'=> $order_info,'address'=>$address,'total_parcel'=>$total_parcel,
    'deliverycharge'=>$deliverycharge,'c'=>$c,'order_total_item'=>$order_total_item,'deliverycompany'=>$deliverycompany));
  return $pdf->download('delivery_invoice.pdf');

   // return view('admin.order.deliveryInvoice',compact('order','name','lname','phone',
   //  'city','products','order_info','address','total_parcel','deliverycharge','c','order_total_item','deliverycompany'));  
  
}



public function deliveredInvoicePrint($id){
  $total_item_order=0;
  $invoice=Post::where(['posts.post_type'=>'invoice','ID'=>$id])->first();
  $company_name=$invoice->post_content_filtered;
  $invoiceNumber=$invoice->post_name;

  $child = DB::table('posts')
  ->select('post_title')
  ->where(['posts.post_type'=>'invoice_order','post_parent'=>$id])
  ->get();

  $id=array();

  foreach ($child as $value) {
    $id[]=$value->post_title;
  }

  $orders = Post::where(['posts.post_type'=>'shop_order','post_status'=>'dispatch'])->whereIn('ID',$id)->get();



//   foreach($orders as $item){
//    $delivery=DB::table('order_itemmeta')->where('order_id',$item->ID)
//    ->where('meta_key','delivery_charge')->first();
//    $coupon=DB::table('order_itemmeta')->where('order_id',$item->ID)
//    ->where('meta_key','coupon_taka')->first();   
//  }

//  if(isset($delivery)){ 
//    $charge=$delivery->meta_value;
//  } else{
//    $charge=0;
//  } 

//  if(isset($coupon)){ 
//    $c=$coupon->meta_value;
//  } else{
//    $c=0;
//  }


 $pdf = PDF::loadView('admin.order.delivery_invoice_print',array('company_name'=>$company_name,'orders'=>$orders,'invoiceNumber'=>$invoiceNumber,'total_item_order'=>$total_item_order));
 return $pdf->download('delivery_invoice.pdf');

 // return view('admin.order.delivery_invoice_print',compact('company_name','orders','charge','c','invoiceNumber'));

}


public function deliveredInvoicePrintDelivery($id){
  $total_item_order=0;
  $invoice=Post::where(['posts.post_type'=>'invoice','ID'=>$id])->first();
  $company_name=$invoice->post_content_filtered;
  $invoiceNumber=$invoice->post_name;

  $child = DB::table('posts')
  ->select('post_title')
  ->where(['posts.post_type'=>'invoice_order','post_parent'=>$id])
  ->get();

  $id=array();

  foreach ($child as $value) {
    $id[]=$value->post_title;
  }

  $orders = Post::where(['posts.post_type'=>'shop_order','post_status'=>'delivered'])->whereIn('ID',$id)->get();



//   foreach($orders as $item){
//    $delivery=DB::table('order_itemmeta')->where('order_id',$item->ID)
//    ->where('meta_key','delivery_charge')->first();
//    $coupon=DB::table('order_itemmeta')->where('order_id',$item->ID)
//    ->where('meta_key','coupon_taka')->first();   
//  }

//  if(isset($delivery)){ 
//    $charge=$delivery->meta_value;
//  } else{
//    $charge=0;
//  } 

//  if(isset($coupon)){ 
//    $c=$coupon->meta_value;
//  } else{
//    $c=0;
//  }


 $pdf = PDF::loadView('admin.order.delivery_invoice_print',array('company_name'=>$company_name,'orders'=>$orders,'invoiceNumber'=>$invoiceNumber,'total_item_order'=>$total_item_order));
 return $pdf->download('delivery_invoice.pdf');

 // return view('admin.order.delivery_invoice_print',compact('company_name','orders','charge','c','invoiceNumber'));

}



public function deliveredOrderCancel($id){

  $product=DB::table('order_items')->where('order_id',$id)->get();
  // default product start
  foreach($product as $item){
    $current_order_qty=DB::table('order_itemmeta')
    ->where('order_id',$item->order_id)
    ->where('product_parent',$item->product_parent)
    ->where('meta_key','_qty')
    ->first();
    $pro_stock=DB::table('postmeta')
    ->where('post_id',$item->product_parent)
    ->where('meta_key','default_qty')
    ->first();
    if(isset($current_order_qty) && isset($pro_stock)){
      DB::table('order_itemmeta')->insert([
       'order_id'=>$id,
       'meta_key'=>'cancel_quantity_default',
       'meta_value'=>$current_order_qty->meta_value,
       'product_parent'=>$item->product_parent,
     ]);
      DB::table('order_itemmeta')->insert([
       'order_id'=>$id,
       'meta_key'=>'cancel_default_product',
       'meta_value'=>$item->product_parent,
     ]);
      $update_stock=$current_order_qty->meta_value+$pro_stock->meta_value;

      DB::table('postmeta')
      ->where('post_id',$item->product_parent)
      ->where('meta_key','default_qty')
      ->update([
       'meta_value' =>$update_stock
     ]);

    }
  }
   // default product end

   // attribute product start
  foreach($product as $item){
   $current_order_qty=DB::table('order_itemmeta')
   ->where('order_id',$item->order_id)
   ->where('product_id',$item->product_id)
   ->where('meta_key','_qty')
   ->first();
   $pro_stock=DB::table('postmeta')
   ->where('post_id',$item->product_id)
   ->where('meta_key','attribute_stock')
   ->first();
   if(isset($current_order_qty) && isset($pro_stock)){
     DB::table('order_itemmeta')->insert([
       'order_id'=>$id,
       'meta_key'=>'cancel_quantity_attribute',
       'meta_value'=>$current_order_qty->meta_value,
     ]);
     DB::table('order_itemmeta')->insert([
       'order_id'=>$id,
       'meta_key'=>'cancel_attribute_product',
       'meta_value'=>$item->product_id,
     ]);
     $update_stock=$current_order_qty->meta_value+$pro_stock->meta_value;
     DB::table('postmeta')
     ->where('post_id',$item->product_id)
     ->where('meta_key','attribute_stock')
     ->update([
       'meta_value' =>$update_stock
     ]);

   }
 }
  // attribute product end 

  //order qty update to 0
 DB::table('order_itemmeta')
 ->where('order_id',$id)
 ->where('meta_key','_qty')
 ->update([
  'meta_value'=>0
]);

 DB::table('order_itemmeta')
 ->where('order_id',$id)
 ->where('meta_key','_line_subtotal')
 ->update([
  'meta_value'=>0
]);
 DB::table('posts')->where('ID',$id)->update([
  'post_status'=>'cancelled',
  'post_modified'=>date('Y-m-d h:i:s'),
]);
 session()->flash("success","Order has been cancelled Successfully");
 return back();


}

public function deliveryInvoiceDataDetails($id){
  $order = Post::find($id);
  $products = Order_item::where('order_id', $id)->whereNotNull('product_id')->get();
  $order_info = DB::table('postmeta')->where('post_id', $order->ID)->get();
  return view('admin.order.deliveryInvoiceDataDetails', compact('order', 'products', 'id', 'order_info'));   
}

public function allStatusSearch(Request $request){
  $extraInfo = array(
    'title' => "Order List",
    'page' => 'order'
  );

  if($request->search_item==''){
    session()->flash("error", "Please enter some keyword to search");
    return redirect()->route('order.allStatus');
  }

  // order id search
  $order_order_id = Post::where('posts.post_type', 'shop_order')
  ->where('ID', '=', $request->search_item)
  ->orderBy('ID', 'DESC')
  ->simplePaginate(20);
  $count_search_order=Post::where('posts.post_type', 'shop_order')
  ->where('ID', '=',$request->search_item)
  ->count();

  if($count_search_order>0){
    $order=$order_order_id;
    $count_order=$count_search_order;
    $search_title='Search Order Id'.':'.$request->search_item;
    return view('admin.order.search_order_id', compact('order','count_order','search_title'))->with($extraInfo);
  }

    // order email search
  $order_email = Post::where(['meta_key' => 'email', 'meta_value' => $request->search_item, 'post_type' => 'shop_order'])
  ->join('postmeta', 'posts.ID', '=', 'postmeta.post_id')
  ->orderBy('ID', 'DESC')
  ->simplePaginate(20);
  $count_order_email=Post::where(['meta_key' => 'email', 'meta_value' => $request->search_item, 'post_type' => 'shop_order'])
  ->join('postmeta', 'posts.ID', '=', 'postmeta.post_id')
  ->orderBy('ID', 'DESC')
  ->count();

  if($count_order_email>0){
    $order=$order_email;
    $count_order=$count_order_email;
    $search_title='Search Email'.':'.$request->search_item;
    return view('admin.order.search_order_id', compact('order','count_order','search_title'))->with($extraInfo);
  }

   // order mobile search
  $order_mobile = Post::where(['meta_key'=>'phone','meta_value'=>$request->search_item,'post_type'=>'shop_order'])
  ->join('postmeta','posts.ID','=', 'postmeta.post_id')
  ->orderBy('ID', 'DESC')
  ->simplePaginate(20);
  $count_order_mobile=Post::where(['meta_key'=>'phone','meta_value'=>$request->search_item,'post_type'=>'shop_order'])
  ->join('postmeta','posts.ID','=', 'postmeta.post_id')
  ->orderBy('ID', 'DESC')
  ->count();

  if($count_order_mobile>0){
    $order=$order_mobile;
    $count_order=$count_order_mobile;
    $search_title='Search Mobile'.':'.$request->search_item;
    return view('admin.order.search_order_id', compact('order','count_order','search_title'))->with($extraInfo);
  }
  else{
    session()->flash("error", "Sorry No Data Found");
    return redirect()->route('order.allStatus');
  }
}

public function grossSummary(){
  return view('admin.order.gross_summary');
}

public function grossSummaryShow(Request $request){
 if($request->user()->can('manage-report')){
  $extraInfo=array(
   'title'=>"Best Customer List",
   'page'=>'Report'
  );
  $start=$request->start;
  $end=$request->end;
  $order=Post::where('post_type','shop_order')
  ->where('post_status','!=','cancelled')
   ->whereBetween('post_date',[$start,$end])
   ->orderBy('ID','DESC')->get();
 //gross profit summary default
    $order_summary=Post::where('post_type','shop_order')
   ->where('post_status','!=','cancelled')
   ->join('order_items','order_items.order_id','=','posts.ID')
   ->join('term_relationships','term_relationships.object_id','=','order_items.product_parent')
   ->join('terms','terms.term_id','=','term_relationships.term_taxonomy_id')
   ->select('terms.name as category_name','term_relationships.term_taxonomy_id as cat_id')
   ->whereBetween('post_date',[$start,$end])
   ->groupBy('term_relationships.term_taxonomy_id')
   ->orderBy('ID','DESC')
   ->get();
   $order_two=Post::where('post_type','shop_order')
   ->where('post_status','!=','cancelled')
   ->whereBetween('post_date',[$start,$end])
   ->orderBy('ID','DESC')
   ->get();
  //gross profit summary default
 return view('admin.quickReport.gross_profit',compact('order','order_summary','order_two','start','end'))->with($extraInfo);
}



}

}
