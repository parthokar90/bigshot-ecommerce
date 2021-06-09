<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use Session;
use App\Model\front\Post;
use App\Model\front\Order_item;
use App\Model\front\Postmeta;
use App\Mail\systemMail;
use Mail;
use Carbon\Carbon;


class QuickReportController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
  }


  public function index(Request $request)
  {
   if($request->user()->can('quick-report')) {
    $extraInfo=array(
      'title'=>"Quick Report",
      'page'=>'quickReport'
    );
    $current_date=date('Y-m-d');
    $day_one_date=date('Y-m-d', strtotime('-1 day', strtotime($current_date)));
    $day_two_date=date('Y-m-d', strtotime('-2 day', strtotime($current_date)));
    $day_three_date=date('Y-m-d', strtotime('-3 day', strtotime($current_date)));
    $day_four_date=date('Y-m-d', strtotime('-4 day', strtotime($current_date)));
    $day_five_date=date('Y-m-d', strtotime('-5 day', strtotime($current_date)));

    // pending order condition start
    $today_pending_order=DB::table('posts')
    ->where(['posts.post_type'=>'shop_order','post_status'=>'on-hold','post_date'=>date('Y-m-d')])
    ->count(); 
    $day_one_pending_order=DB::table('posts')
    ->where(['posts.post_type'=>'shop_order','post_status'=>'on-hold','post_date'=>$day_one_date])
    ->count();  
    $day_two_pending_order=DB::table('posts')
    ->where(['posts.post_type'=>'shop_order','post_status'=>'on-hold','post_date'=>$day_two_date])
    ->count();
    $day_three_pending_order=DB::table('posts')
    ->where(['posts.post_type'=>'shop_order','post_status'=>'on-hold','post_date'=>$day_three_date])
    ->count();
    $day_four_pending_order=DB::table('posts')
    ->where(['posts.post_type'=>'shop_order','post_status'=>'on-hold','post_date'=>$day_four_date])
    ->count();
    $all_pending_order=DB::table('posts')
    ->where('posts.post_type','shop_order')
    ->where('post_status','on-hold')
    ->count();    
   // pending order condition end 


   // processing order condition start
    $today_processing_order=DB::table('posts')
    ->where('post_type','shop_order')
    ->where('post_status','processing')
    ->whereBetween('post_modified',[date('Y-m-d 00:00:00',strtotime($current_date)),date('Y-m-d 23:59:59',strtotime($current_date))])
    ->count();
    $day_one_processing_order=DB::table('posts')
    ->where('post_type','shop_order')
    ->where('post_status','processing')
    ->whereBetween('post_modified',[date('Y-m-d 00:00:00', strtotime($day_one_date)),date('Y-m-d 23:59:59',strtotime($day_one_date))])
    ->count();
    $day_two_processing_order=DB::table('posts')
    ->where('post_type','shop_order')
    ->where('post_status','processing')
    ->whereBetween('post_modified',[date('Y-m-d 00:00:00', strtotime($day_two_date)),date('Y-m-d 23:59:59',strtotime($day_two_date))])
    ->count();
    $day_three_processing_order=DB::table('posts')
    ->where('post_type','shop_order')
    ->where('post_status','processing')
    ->whereBetween('post_modified',[date('Y-m-d 00:00:00', strtotime($day_three_date)),date('Y-m-d 23:59:59',strtotime($day_three_date))])
    ->count();
    $day_four_processing_order=DB::table('posts')
    ->where('post_type','shop_order')
    ->where('post_status','processing')
    ->whereBetween('post_modified',[date('Y-m-d 00:00:00', strtotime($day_four_date)),date('Y-m-d 23:59:59',strtotime($day_four_date))])
    ->count();
    $all_processing_order=DB::table('posts')
    ->where('posts.post_type','shop_order')
    ->where('post_status','processing')
    ->count();
    // processing order condition end 


    // dispatch order condition start
    $today_dispatch_order=DB::table('posts')
    ->where('post_type','shop_order')
    ->where('post_status','dispatch')
    ->whereBetween('post_modified',[date('Y-m-d 00:00:00', strtotime($current_date)),date('Y-m-d 23:59:59',strtotime($current_date))])
    ->count();
    $day_one_dispatch_order=DB::table('posts')
    ->where('post_type','shop_order')
    ->where('post_status','dispatch')
    ->whereBetween('post_modified',[date('Y-m-d 00:00:00', strtotime($day_one_date)),date('Y-m-d 23:59:59',strtotime($day_one_date))])
    ->count();
    $day_two_dispatch_order=DB::table('posts')
    ->where('post_type','shop_order')
    ->where('post_status','dispatch')
    ->whereBetween('post_modified',[date('Y-m-d 00:00:00', strtotime($day_two_date)),date('Y-m-d 23:59:59',strtotime($day_two_date))])
    ->count();
    $day_three_dispatch_order=DB::table('posts')
    ->where('post_type','shop_order')
    ->where('post_status','dispatch')
    ->whereBetween('post_modified',[date('Y-m-d 00:00:00', strtotime($day_three_date)),date('Y-m-d 23:59:59',strtotime($day_three_date))])
    ->count();
    $day_four_dispatch_order=DB::table('posts')
    ->where('post_type','shop_order')
    ->where('post_status','dispatch')
    ->whereBetween('post_modified',[date('Y-m-d 00:00:00', strtotime($day_four_date)),date('Y-m-d 23:59:59',strtotime($day_four_date))])
    ->count();
    $all_dispatch_order=DB::table('posts')
    ->where('posts.post_type','shop_order')
    ->where('post_status','dispatch')
    ->count();
   // dispatch order condition start
     
    // * start product stock move *//
  


    // week one start
    $starDate=date('Y-m-d H:i:s');
    $endDate=date('Y-m-d H:i:s',strtotime('-1 week'));
   

    $week1_default=DB::table('posts')
    ->where('post_type','product')
    ->whereBetween('post_date', [$endDate,$starDate])  
    ->where('meta_key', 'default_qty')
    ->where('meta_value','>',0)
    ->join('postmeta', 'posts.ID', '=', 'postmeta.post_id')
    ->count();
   

     $week1_attribute=DB::table('posts')
    ->where('post_type','product_varient')
    ->whereBetween('post_date', [$endDate,$starDate])  
    ->where('meta_key', 'attribute_stock')
    ->where('meta_value','>',0)
    ->join('postmeta', 'posts.ID', '=', 'postmeta.post_id')
    ->count();
    $total_week1=$week1_default+$week1_attribute;
    // week one end 

    // week two start
    $starDate =date('Y-m-d H:i:s',strtotime('-1 week'));
    $endDate = date('Y-m-d  H:i:s',strtotime('-2 week'));   
    $week2_default=DB::table('posts')
    ->where('post_type','product')
    ->whereBetween('post_date', [$endDate,$starDate])  
    ->where('meta_key', 'default_qty')
    ->where('meta_value','>',0)
    ->join('postmeta', 'posts.ID', '=', 'postmeta.post_id')
    ->count();
     $week2_attribute=DB::table('posts')
    ->where('post_type','product_varient')
    ->whereBetween('post_date', [$endDate,$starDate])  
    ->where('meta_key', 'attribute_stock')
    ->where('meta_value','>',0)
    ->join('postmeta', 'posts.ID', '=', 'postmeta.post_id')
    ->count();
     $total_week2=$week2_default+$week2_attribute;
    // week two end 


    //month one start
    $starDate = date('Y-m-d H:i:s',strtotime('-2 week')); 
    $endDate = date('Y-m-d H:i:s',strtotime('-1 month'));   
    $month1_default=DB::table('posts')
    ->where('post_type','product')
    ->whereBetween('post_date', [$endDate,$starDate])  
    ->where('meta_key', 'default_qty')
    ->where('meta_value','>',0)
    ->join('postmeta', 'posts.ID', '=', 'postmeta.post_id')
    ->count();
     $month1_attribute=DB::table('posts')
    ->where('post_type','product_varient')
    ->whereBetween('post_date', [$endDate,$starDate])   
    ->where('meta_key', 'attribute_stock')
    ->where('meta_value','>',0)
    ->join('postmeta', 'posts.ID', '=', 'postmeta.post_id')
    ->count();
     $total_month1=$month1_default+$month1_attribute;
    //month one end 

     //month two start
    $starDate = date('Y-m-d H:i:s',strtotime('-1 month')); 
    $endDate = date('Y-m-d H:i:s',strtotime('-2 month'));   
    $month2_default=DB::table('posts')
    ->where('post_type','product')
    ->whereBetween('post_date', [$endDate,$starDate])  
    ->where('meta_key', 'default_qty')
    ->where('meta_value','>',0)
    ->join('postmeta', 'posts.ID', '=', 'postmeta.post_id')
    ->count();
     $month2_attribute=DB::table('posts')
    ->where('post_type','product_varient')
    ->whereBetween('post_date', [$endDate,$starDate])  
    ->where('meta_key', 'attribute_stock')
    ->where('meta_value','>',0)
    ->join('postmeta', 'posts.ID', '=', 'postmeta.post_id')
    ->count();
     $total_month2=$month2_default+$month2_attribute;
    //month two end 

      //month three start
    $starDate = date('Y-m-d H:i:s',strtotime('-2 month'));
    $endDate = date('Y-m-d H:i:s',strtotime('-3 month'));   
    $month3_default=DB::table('posts')
    ->where('post_type','product')
    ->whereBetween('post_date', [$endDate,$starDate])  
    ->where('meta_key', 'default_qty')
    ->where('meta_value','>',0)
    ->join('postmeta', 'posts.ID', '=', 'postmeta.post_id')
    ->count();
     $month3_attribute=DB::table('posts')
    ->where('post_type','product_varient')
    ->whereBetween('post_date', [$endDate,$starDate])  
    ->where('meta_key', 'attribute_stock')
    ->where('meta_value','>',0)
    ->join('postmeta', 'posts.ID', '=', 'postmeta.post_id')
    ->count();
     $total_month3=$month3_default+$month3_attribute;
    //month three end 

  
    $stcokMove=array(
      'week1'=>$total_week1,
      'week2'=>$total_week2,
      'month1'=>$total_month1,
      'month2'=>$total_month2,
      'month3'=>$total_month3
    );


    // stock condition start
      $products=DB::table('posts')
  ->where('post_type','product')
  ->where('post_status','!=','deleted')
  ->get();
     // stock condition end 

    $d_data=Post::
    where('post_type','product')
    ->where('post_status','!=','deleted')
    ->where('meta_key', 'default_qty')
    ->where('meta_value','>',0)
    ->join('postmeta', 'posts.ID', '=', 'postmeta.post_id')
    ->get();

     $a_data=Post::
     where('post_type','product_varient')
    ->where('postmeta.meta_key', 'attribute_stock')
    ->where('postmeta.meta_value','>',0)
    ->join('postmeta', 'posts.ID', '=', 'postmeta.post_id')
    ->groupBy('post_parent')
    ->get();
  

    $product=Post::where('post_type','product')->get();   
    $pro=Post::where('post_type','product')
    ->where('post_status', '!=', 'deleted')
    ->get();   

    // delivered order condition start
    $delivered_qty=DB::table('posts')
    ->where('post_type','shop_order')
    ->where('post_status','delivered')
    ->where('meta_key','_qty')
    ->whereBetween('post_modified',[date('Y-m-01 00:00:00'),date('Y-m-t 23:59:59')])
    ->join('order_itemmeta','order_itemmeta.order_id','=','posts.ID')
    ->sum('meta_value');

    $delivered_order=Post::where('post_type','shop_order')
    ->where('post_status','delivered')
    ->whereBetween('post_modified',[date('Y-m-01 00:00:00'),date('Y-m-t 23:59:59')])
    ->get();  
   // delivered order condition end 


    $s=date('Y-m-01');
    $e=date('Y-m-t');
    $year=date('Y');

    // gross profit yearly and monthly start
    $order_gross_profit_month=Post::where('post_type','shop_order')->whereBetween('post_date',[$s,$e])->get();
    $order_gross_profit_yearly=Post::where('post_type','shop_order')->whereYear('post_date',$year)->get();
    // gross profit yearly and monthly end 


    $stock_product=Post::where(['post_type'=>'product','meta_key'=>'qty'])
    ->where('meta_value','>',0)
    ->select('post_date','ID','meta_value as quantity')
    ->join('postmeta','posts.ID','=','postmeta.post_id')
    ->get();

     
    $d_sell=DB::table('posts')
  ->where('post_type','product')
  ->where('post_status','!=','deleted')
  ->get();
  
    
   
    //sold out condition start
         $default_product_sold=DB::table('postmeta')  
                    ->where('meta_key','default_qty') 
                    ->where('meta_value','<=',0)
                    ->get();

     $attribute_product_sold=DB::table('postmeta')  
                    ->where('meta_key','attribute_stock') 
                    ->where('meta_value','<=',0)
                    ->get(); 
    //sold out condition end 

    // best sell item condition start
      $m_start=date('Y-m-01');
      $m_end=date('Y-m-t');
      $monthly_best_sell_item=DB::SELECT("SELECT order_itemmeta.product_parent,order_itemmeta.product_id,order_items.order_id,order_item_name,SUM(meta_value) as total_qty 
      FROM order_itemmeta 
      JOIN order_items ON order_itemmeta.order_item_id=order_items.order_item_id 
      where meta_key='_qty' 
      and order_date Between '$m_start' and '$m_end' 
      GROUP by order_itemmeta.product_parent ORDER by total_qty DESC LIMIT 10");


      $yearly_best_sell_item=DB::SELECT("SELECT order_date,SUM(meta_value) as total_qty 
      FROM order_itemmeta 
      JOIN order_items ON order_itemmeta.order_item_id=order_items.order_item_id
      where meta_key='_qty' and YEAR(order_date)='$year' 
      GROUP by order_itemmeta.product_parent ORDER by total_qty DESC");

      // best sell item condition end 

      //lower stock start
				
					
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
      //lower stock end


      //gross profit monthly
      $starttt=date('Y-m-01');                                       
                         $enddd=date('Y-m-t');
                          $orderrr=Post::where('post_type','shop_order')
                          ->where('post_status','!=','cancelled')
                          ->whereBetween('post_date',[$starttt,$enddd])->get();

                          
 $yearrr=date('Y');
 $orderrrr=Post::where('post_type','shop_order')->where('post_status','!=','cancelled')->whereYear('post_date',$yearrr)->orderBy('ID','DESC')->get();
      //gross profit monthly


    return view('admin.quickReport.index',
      compact(
        'default_product_sold',
        'attribute_product_sold',
        'orderrrr',
        'orderrr',
        'd_pro',
        'a_pro',
        'today_pending_order',
        'day_one_pending_order',
        'day_two_pending_order',
        'day_three_pending_order',
        'day_four_pending_order',
        'all_pending_order',
        'today_processing_order',
        'day_one_processing_order',
        'day_two_processing_order',
        'day_three_processing_order',
        'day_four_processing_order',
        'all_processing_order',
        'today_dispatch_order',
        'day_one_dispatch_order',
        'day_two_dispatch_order',
        'day_three_dispatch_order',
        'day_four_dispatch_order',
        'all_dispatch_order',
        'stcokMove',
        'products',
        'product',
        'pro',
        'delivered_qty',
        'delivered_order',
        'order_gross_profit_month',
        'order_gross_profit_yearly',
        'd_data',
        'a_data',
        'stock_product',
        'monthly_best_sell_item',
        'yearly_best_sell_item',
        'd_sell',
      ))->with($extraInfo);
      }
  }


   public function lower_stock_weekly(){
      $products=Post::
      where('post_type','product')
      ->where('post_status', '!=', 'deleted')
      ->get(); 
      return view('admin.stock.lower_stock_weekly',compact('products'));
   }

   public function sold_out_stock_weekly(){
    $extraInfo = array(
    'title' => "Sold Stock List",
    'page' => 'oldstock'
     );
      $products = Post::where('post_type', 'product')
      ->where('meta_key', 'qty')
      ->where('meta_value', 0)
      ->join('postmeta', 'posts.ID', '=', 'postmeta.post_id')
      ->paginate(10);
      $pro = Post::where('post_type', 'product')
      ->where('meta_key', 'qty')
      ->where('meta_value', 0)
      ->join('postmeta', 'posts.ID', '=', 'postmeta.post_id')
      ->get();
      $total_stock = DB::table('posts')
      ->where('post_type', 'product')
      ->where('post_status', '!=', 'deleted')
      ->where('meta_key', 'qty')
      ->where('meta_value', '=', 0)
      ->join('postmeta', 'posts.ID', '=', 'postmeta.post_id')
      ->count();
      return view('admin.stock.sold_out_stock_weekly', compact('products', 'total_stock', 'pro'))->with($extraInfo);  
   }

   public function sold_out_stock_yearly(){
       $extraInfo = array(
    'title' => "Sold Stock List",
    'page' => 'oldstock'
     );
      $products = Post::where('post_type', 'product')
      ->where('meta_key', 'qty')
      ->where('meta_value', 0)
      ->whereYear('post_date',date('Y'))
      ->join('postmeta', 'posts.ID', '=', 'postmeta.post_id')
      ->paginate(10);
      $pro = Post::where('post_type', 'product')
      ->where('meta_key', 'qty')
      ->where('meta_value', 0)
      ->whereYear('post_date',date('Y'))
      ->join('postmeta', 'posts.ID', '=', 'postmeta.post_id')
      ->get();
      $total_stock = DB::table('posts')
      ->where('post_type', 'product')
      ->where('post_status', '!=', 'deleted')
      ->where('meta_key', 'qty')
      ->where('meta_value', '=', 0)
      ->whereYear('post_date',date('Y'))
      ->join('postmeta', 'posts.ID', '=', 'postmeta.post_id')
      ->count();
      return view('admin.stock.sold_out_stock_yearly', compact('products', 'total_stock', 'pro'))->with($extraInfo);  
   }

   public function best_sell_weekly(){
         $year=date('Y');
         $order=DB::SELECT("SELECT order_date,product_id,order_item_name,SUM(meta_value) as total_qty 
         FROM order_itemmeta JOIN order_items ON order_itemmeta.order_item_id=order_items.order_item_id
         where meta_key='_qty' and YEAR(order_date)='$year' 
         GROUP by product_id ORDER by total_qty DESC LIMIT 10");
        return view('admin.quickReport.best_selling_weekly',compact('order'));
   }

  public function manStock()
  {
    $data=DB::table('term_relationships')
    ->leftjoin('posts','term_relationships.object_id','=','posts.ID')
    ->where('term_taxonomy_id',1)
    ->where('posts.post_type','product')
    ->paginate(20);

    return view('admin.quickReport.man_stock');
  }
  public function womenStock(Request $request)
  {
   if($request->user()->can('manage-report')) {
   $extraInfo=array(
    'title'=>"Category Wise Stock",
    'page'=>'Report'
  );
   $categories=DB::table('term_taxonomy')
   ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
   ->where('term_taxonomy.taxonomy','product_cat')
   ->select('term_taxonomy.*','terms.name','terms.status','term_taxonomy.term_id as ac_id')
   ->orderBy('term_taxonomy.term_taxonomy_id','desc')
   ->get(); 
   if($request->cat_id==''){
    $cat_pro=[];
  }else{
   $cat_pro=DB::table('term_relationships')
   ->leftjoin('posts','term_relationships.object_id','=','posts.ID')
   ->where('term_taxonomy_id',$request->cat_id)
   ->where('posts.post_type','product')
   ->get();
 }
 return view('admin.quickReport.women_stock',compact('categories','cat_pro'))->with($extraInfo);
}
}
public function salesReport(Request $request)
{
    if($request->user()->can('manage-report')) {
  $extraInfo=array(
    'title'=>"Category Wise Stock",
    'page'=>'Report'
  );
  $start=$request->start;
  $end=$request->end;
   $orders=Post::where('posts.post_type','shop_order')
      ->whereBetween('post_date',[$start,$end])
      ->orderBy('ID','DESC')
      ->get(); 
        $or=Post::where('posts.post_type','shop_order')
     ->whereBetween('post_date',[$start,$end])
      ->orderBy('ID','DESC')
      ->get(); 
      $total_orders=Post::where('posts.post_type','shop_order')
      ->whereBetween('post_date',[$start,$end])
      ->count();  
       $total_item=DB::table('order_itemmeta')
       ->join('posts','posts.ID','=','order_itemmeta.order_id')
       ->where('posts.post_type','shop_order')
       ->where('meta_key','_qty')
       ->whereBetween('post_date',[$start,$end])
       ->sum('meta_value');
        $total_amount=DB::table('order_itemmeta')
       ->join('posts','posts.ID','=','order_itemmeta.order_id')
       ->where('posts.post_type','shop_order')
       ->where('meta_key','_line_subtotal')
       ->whereBetween('post_date',[$start,$end])
       ->sum('meta_value');
       return view('admin.quickReport.sales_report',compact('orders','total_orders','total_item','total_amount','or'))->with($extraInfo);
   }
}
public function deliveryReport(Request $request)
{
  
    if($request->user()->can('manage-report')) {
  $extraInfo=array(
    'title'=>"Category Wise Stock",
    'page'=>'Report'
  );
  $start=$request->start;
  $end=$request->end;
  $order_item=DB::table('posts')
  ->where('post_type','shop_order')
  ->where('post_status','delivered')
  ->whereBetween('post_modified', [date('Y-m-d 00:00:00', strtotime($start)), date('Y-m-d 23:59:59', strtotime($end))])
  ->get();
  return view('admin.quickReport.delivery_report',compact('order_item'));
}
}
public function rejectItem(Request $request)
{
  if($request->user()->can('manage-report')) {
    $year=date('Y');
  $extraInfo=array(
    'title'=>"Reject Item List",
    'page'=>'Report'
  );
  $data=Post::where(['post_type'=>'product','meta_key'=>'product_status'])
  ->join('postmeta','posts.ID','=','postmeta.post_id')
  ->get();
  
  $data_reject=DB::table('postmeta')
  ->where('meta_key','reject_date')
  ->whereYear('meta_value',$year)
  ->get();
 

  return view('admin.quickReport.reject_item',compact('data','data_reject'))->with($extraInfo);
}
}

public function rejectItemRemove($id,Request $request){
   if($request->user()->can('manage-report')) {
  $meta_info=Postmeta::where('meta_key','qty')
  ->where('post_id',$id)
  ->first();
  $reject_qty=Postmeta::where('meta_key','reject_qty')
  ->where('post_id',$id)
  ->first();
  $newQty=$meta_info->meta_value+$reject_qty->meta_value;
  $relationShips=DB::table('postmeta')->where('meta_key','qty')
  ->where('post_id',$id)
  ->update(['meta_value'=>$newQty]);
  DB::table('postmeta')->where('meta_key','product_status')
  ->where('post_id',$id)
  ->delete();
  DB::table('postmeta')->where('meta_key','reject_date')
  ->where('post_id',$id)
  ->delete();
  DB::table('postmeta')->where('meta_key','reject_qty')
  ->where('post_id',$id)
  ->delete();
  session()->flash("success","Quantity has been added Successfully");
  return back();
   }
}

public function reject_qty_add($date_id,$qty_id){

  //reject total qty
  $reject_qt=DB::table('postmeta')->where('meta_id',$qty_id)->where('meta_key','reject_qty')->first();
  
  //current_stock_default
  $total_stock_default=DB::table('postmeta')->where('post_id',$reject_qt->post_id)->where('meta_key','default_qty')->sum('meta_value');

  //current_stock_attribute
  $total_stock_attribute=DB::table('postmeta')->where('post_id',$reject_qt->post_id)->where('meta_key','attribute_stock')->sum('meta_value');


     $stock_update=$total_stock_default+$reject_qt->meta_value;
     DB::table('postmeta')->where('post_id',$reject_qt->post_id)->where('meta_key','default_qty')->update([
        'meta_value' => $stock_update
     ]);
  


      $stock_update=$total_stock_attribute+$reject_qt->meta_value;
      DB::table('postmeta')->where('post_id',$reject_qt->post_id)->where('meta_key','attribute_stock')->update([
         'meta_value' =>  $stock_update
      ]);       
  

  //delete data
  DB::table('postmeta')->where('meta_id',$date_id)->where('meta_key','reject_date')->delete();
  DB::table('postmeta')->where('meta_id',$qty_id)->where('meta_key','reject_qty')->delete();
  
  session()->flash("success","Quantity has been added Successfully");
  return back();
 
}

public function rejectItemSearch(Request $request){
   if($request->user()->can('manage-report')) {
    $start=$request->start;
    $end=$request->end;
    $extraInfo=array(
      'title'=>"Reject Item List",
      'page'=>'Report',
      'startDate'=>$start,
      'endDate'=>$end
    );
  $data=DB::table('postmeta')
  ->where('meta_key','reject_date')
  ->whereBetween('meta_value',[$start,$end])
  ->get();
  return view('admin.quickReport.reject_item_search',compact('data'))->with($extraInfo);
}
}



public function bestSelling(Request $request)
{
   if($request->user()->can('manage-report')) {
  $extraInfo=array(
    'title'=>"Best Sellings Items List",
    'page'=>'Report'
  );
  $start=date('Y-m-01');
  $end=date('Y-m-t');
  $order=DB::SELECT("SELECT order_itemmeta.product_parent,order_itemmeta.product_id,order_items.order_id,order_item_name,SUM(meta_value) as total_qty 
   FROM order_itemmeta 
   JOIN order_items ON order_itemmeta.order_item_id=order_items.order_item_id 
   where meta_key='_qty' 
   and order_date Between '$start' and '$end' 
   GROUP by order_itemmeta.product_parent ORDER by total_qty DESC LIMIT 10");
  return view('admin.quickReport.best_selling',compact('order'))->with($extraInfo);
}
}
public function bestSellingSearch(Request $request){
   if($request->user()->can('manage-report')) {
  $extraInfo=array(
    'title'=>"Best Sellings Items List",
    'page'=>'Report'
  );
  $start=$request->start;
  $end=$request->end;
  $order=DB::SELECT("SELECT order_itemmeta.product_parent,order_itemmeta.product_id,order_items.order_id,order_item_name,SUM(meta_value) as total_qty 
   FROM order_itemmeta JOIN order_items ON order_itemmeta.order_item_id=order_items.order_item_id 
   where meta_key='_qty' 
   and order_date Between '$start' and '$end' 
   GROUP by order_itemmeta.product_parent ORDER by total_qty DESC");
  return view('admin.quickReport.best_sell_search',compact('order','start','end'))->with($extraInfo);
}
}
public function cancellationItems()
{
 return view('admin.quickReport.cancellation_items');
}
public function soldoutStock(Request $request)
{
   if($request->user()->can('manage-report')) {
 $extraInfo=array(
  'title'=>"Sold Out Stock List",
  'page'=>'Report'
);
 $product=Post::where('post_type','product')->get();
 return view('admin.quickReport.soldout_stock',compact('product'))->with($extraInfo);
}
}
public function bestCustomer(Request $request)
{
   if($request->user()->can('manage-report')) {
  $extraInfo=array(
    'title'=>"Best Customer List",
    'page'=>'Report'
  );
  $start=date('Y-m-01'); 
  $end=date('Y-m-t'); 
  $data=DB::SELECT("SELECT order_id,customer_id,SUM(meta_value) as total_qty 
    FROM order_itemmeta 
    where meta_key='_qty' and order_date Between '$start' and '$end' AND customer_id!=0
    GROUP by customer_id ORDER by total_qty DESC LIMIT 10");
  return view('admin.quickReport.best_customer',compact('data'))->with($extraInfo);
}
}

public function bestCustomerSearch(Request $request){
   if($request->user()->can('manage-report')) {
  $extraInfo=array(
    'title'=>"Best Customer List",
    'page'=>'Report'
  );
  $start=$request->start; 
  $end=$request->end; 
  $data=DB::SELECT("SELECT order_id,customer_id,SUM(meta_value) as total_qty 
    FROM order_itemmeta 
    where meta_key='_qty' and order_date Between '$start' and '$end' 
    GROUP by customer_id ORDER by total_qty DESC LIMIT 10");
  return view('admin.quickReport.best_customer_search',compact('data'))->with($extraInfo);
}
}

public function bestCustomerSendEmail($email){
  return view('emails.best_customer_email')->with(['email'=>$email]);
}

public function bestCustomerSendEmailData(Request $request){
  $email=$request->email;
  $message=$request->message;
  $title=$request->title;
  $details = [
    'title' => $title,
    'body' => $message,
  ];
  Mail::to($email)->send(new systemMail($details));
  session()->flash("success", "Email has been sent successfully");
  return back();
}

public function grossProfit(Request $request)
{
if($request->user()->can('manage-report')){
  $extraInfo=array(
   'title'=>"Best Customer List",
   'page'=>'Report'
  );
  $start=date('Y-m-01');
  $end=date('Y-m-t');
  $order=Post::where('post_type','shop_order')
  ->where('post_status','!=','cancelled')
   ->whereBetween('post_date',[$start,$end])
   ->orderBy('ID','DESC')->get();
 return view('admin.quickReport.gross_profit',compact('order','start','end'))->with($extraInfo);
}
}
  //gross profit report show
public function grossProfitShow(Request $request)
{
   if($request->user()->can('manage-report')) {
  $extraInfo=array(
    'title'=>"Gross Profit List",
    'page'=>'Report'
  );
  $start=date('Y-m-d',strtotime($request->start));
  $end=date('Y-m-d',strtotime($request->end));
  $order=Post::where('post_type','shop_order')
   ->where('post_status','!=','cancelled')
  ->whereBetween('post_date',[$start,$end])->get();
  return view('admin.quickReport.gross_profit_show',compact('order','start','end'))->with($extraInfo);
}
}

public function gross_profit_monthly(Request $request){
   if($request->user()->can('manage-report')) {
 $extraInfo=array(
  'title'=>"Gross Profit List",
  'page'=>'Report'
);
 $start=date('Y-m-01');
 $end=date('Y-m-t');
 $order=Post::where('post_type','shop_order')
  ->where('post_status','!=','cancelled')
 ->whereBetween('post_date',[$start,$end])->get();
 return view('admin.quickReport.gross_profit_show_monthly',compact('order','start','end'))->with($extraInfo);
}
}

//profit yearly
public function profit_yearly(Request $request){
     if($request->user()->can('manage-report')) {
      $extraInfo=array(
        'title'=>"Gross Profit List",
        'page'=>'Report'
      );
      $start=date('Y');
      $order=Post::where('post_type','shop_order')
        ->where('post_status','!=','cancelled')
      ->whereYear('post_date',[$start])->get();
      return view('admin.quickReport.profit_yearly',compact('order','start'))->with($extraInfo);
    }
}

public function best_sell_yearly(Request $request){
   if($request->user()->can('manage-report')) {
 $year=date('Y');
 $order=DB::SELECT("SELECT order_itemmeta.product_parent,order_date,order_itemmeta.product_id,order_item_name,SUM(meta_value) as total_qty 
   FROM order_itemmeta JOIN order_items ON order_itemmeta.order_item_id=order_items.order_item_id
   where meta_key='_qty' and YEAR(order_date)='$year' 
   GROUP by order_itemmeta.product_parent ORDER by total_qty DESC LIMIT 120");
 return view('admin.quickReport.best_selling_yearly',compact('order'));
   }
}



public function grossProfitSummary(){
 $extraInfo=array(
  'title'=>"Best Customer List",
  'page'=>'Report'
);
 $year=date('Y');
 $order=Post::where('post_type','shop_order')
  ->where('post_status','!=','cancelled')
 ->whereYear('post_date',$year)->get();
 return view('admin.quickReport.gross_profit_summary',compact('order'))->with($extraInfo);
}
}
