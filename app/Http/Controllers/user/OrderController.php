<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\front\Post;
use App\Model\front\Postmeta;
use App\Model\front\Order_item;
use Auth;
use DB;
use PDF;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $shop_order=Post::
        where('post_type','shop_order')
       ->where('post_author',auth()->user()->id)
       ->select('ID','post_date','post_status','post_modified')
       ->orderBy('ID','DESC')
       ->paginate(5);
       return view('front.order.list',compact('shop_order'));
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
        $order=Post::find($id);
        $products=Order_item::where('order_id',$id)   
        ->whereNotNull('product_id')
        ->get();
        $extraInfo=array(
            'title'=>"Order Edit",
            'page'=>'order'
        );
        $order_info=DB::table('postmeta')
        ->where('post_id',$id)
        ->get();
        $status=DB::table('posts')->where('ID',$id)->select('post_status')->first();
        $dist=DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','user_district')->first();
        $city=DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','user_city')->first();
        $zip=DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','user_zip')->first();

        $total_price=DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','_line_subtotal')->sum('meta_value');
        $delivery_charge=DB::table('order_itemmeta')->where('order_id',$order->ID) ->where('meta_key','delivery_charge')->first();
        $coupon_taka=DB::table('order_itemmeta')->where('order_id',$order->ID) ->where('meta_key','coupon_taka')->first();



        if(isset($delivery_charge)){
          $charge=$delivery_charge->meta_value;
        }else{
           $charge=0;
        }

       if(isset($coupon_taka)){
          $c=$coupon_taka->meta_value;
        }else{
           $c=0;
        }

        $orderr_total=$total_price+$charge-$c;
        return view('front.order.edit',compact('order','products','order_info','status','dist','city','zip','orderr_total','c'))->with($extraInfo);
    }

 

    //cancel order
    public function cancelOrder($id){
      $check=DB::table('posts')
            ->where('post_type', 'shop_order')
            ->where('ID', $id)
            ->where('post_status', 'on-hold')  
            ->count();
     if($check>0){
      $status=DB::table('posts')
      ->where('post_type','shop_order')
      ->where('ID',$id)->update([
       'post_status'=> 'Cancelled'
      ]);
      session()->flash("success", "Your Order Has Been Cancelled");
      return back();
     }else{
     session()->flash("error", "Your Can't Change the order Status because the order has already been Processing");
     return back();
     }
    }

    public function cancel_order_details($id){
        $order = Post::find($id);
        $order_item=Order_item::where('order_id',$id)->get();
        return view('front.order.cancel_data',compact('order','order_item'));
    }

    public function single_item_cancel($id){

        $orderQty=DB::table('order_itemmeta')
            ->where('order_item_id',$id)
            ->where('meta_key', '_qty')
            ->first();
        $orderDetails = DB::table('order_itemmeta')
        ->where('order_item_id', $id)
        ->first();
        $find_product_id=DB::table('order_items')->where('order_item_id',$id)->first();
        $product_qty=DB::table('postmeta')
        ->where(['post_id'=>$find_product_id->product_id,'meta_key'=>'qty'])
        ->first();
        $update_qty=$orderQty->meta_value+$product_qty->meta_value;
        DB::table('postmeta')
        ->where(['post_id' => $find_product_id->product_id, 'meta_key' => 'qty'])
        ->update([
            'meta_value'=>$update_qty
        ]);
        DB::table('order_itemmeta')->insert([
            'order_item_id'=>$id,
            'meta_key'=>'product_status',
            'meta_value'=>'cancel',
            'order_id' => $orderDetails->order_id,
            'order_date' => $orderDetails->order_date,
            'customer_id' => $orderDetails->customer_id,
        ]);
       session()->flash("success", "Item has been Cancelled Successfully");
       return back();
    }

    public function cancel_order_item(Request $request){
      // get copon_code 
      $copon_code=DB::table('order_itemmeta')
    ->where('order_id',$request->cancel_order_id) 
    ->where('meta_key','coupon_code')
    ->first();
    // get copon info 
      $copon_info=DB::table('coupons')
    ->where('coupon_code',$copon_code->meta_value)  
    ->first();
     $product_current_price=DB::table('order_items')
     ->where('order_item_id',$request->cancel_item_id)
     ->where('meta_key','sale_price')
      ->join('postmeta','postmeta.post_id','=','order_items.product_parent')
     ->first();
      $cancel_qty=$request->request_qty; 
      //stock increase from default quantity
      $product_current_qty=DB::table('postmeta')
      ->where('post_id',$request->cancel_product_id)
      ->where('meta_key','default_qty')
      ->first();
      if(isset($product_current_qty)){
      $product_update_stock=$product_current_qty->meta_value+$cancel_qty;
      DB::table('postmeta')
      ->where('post_id',$request->cancel_product_id)
      ->where('meta_key','default_qty')
      ->update([
         'meta_value' => $product_update_stock
       ]);
      }
     //stock increase from default quantity

      //stock increase from attribute quantity
       $product_current_qty_attribute=DB::table('postmeta')
      ->where('post_id',$request->cancel_product_id)
      ->where('meta_key','attribute_stock')
      ->first();
      if(isset($product_current_qty_attribute)){
      $product_update_stock_attribute=$product_current_qty_attribute->meta_value+$cancel_qty;
      DB::table('postmeta')
      ->where('post_id',$request->cancel_product_id)
      ->where('meta_key','attribute_stock')
      ->update([
         'meta_value' => $product_update_stock_attribute
       ]);
      }
     //stock increase from attribute quantity

      $order_date=DB::table('order_itemmeta')
      ->where('order_id',$request->cancel_order_id)
      ->first();
        DB::table('order_itemmeta')->insert([
            'order_item_id' =>$request->cancel_item_id,
            'order_id' =>$request->cancel_order_id,
            'meta_key' =>'cancel_quantity',
            'meta_value' =>$request->request_qty,
            'customer_id' =>auth()->user()->id,
            'order_date' =>$order_date->order_date
        ]);
      $current=DB::table('order_itemmeta')
      ->where('order_item_id',$request->cancel_item_id)
      ->where('meta_key','_qty')
      ->sum('meta_value')-$cancel_qty;
      //order qty update
      DB::table('order_itemmeta')
      ->where('order_item_id',$request->cancel_item_id)
      ->where('meta_key','_qty')
      ->update([
        'meta_value'=>$current
      ]);
      //price update
      $acc_qty=DB::table('order_itemmeta')->where('order_item_id',$request->cancel_item_id)->where('meta_key','_qty')->first();
      $order_update_price=$product_current_price->meta_value*$acc_qty->meta_value;
     //price_update
      DB::table('order_itemmeta')
      ->where('order_item_id',$request->cancel_item_id)
      ->where('meta_key','_line_subtotal')
      ->update([
        'meta_value' =>$order_update_price
      ]);
     //price_update 
     //price_update
      DB::table('order_itemmeta')
      ->where('order_item_id',$request->cancel_item_id)
      ->where('meta_key','_line_total')
      ->update([
        'meta_value' =>$order_update_price
      ]);
     //price_update
     //check customer cancel all quantity then update order status to cancelled
      $ac_current=DB::table('order_itemmeta')
      ->where('order_id',$request->cancel_order_id)
      ->where('meta_key','_qty')
      ->sum('meta_value');     
       if($ac_current==0){
         DB::table('posts')
         ->where('post_type','shop_order')
         ->where('ID',$request->cancel_order_id)
         ->update([
            'post_status' =>'cancelled',
            'post_modified' =>date('Y-m-d H:i:00'),
         ]);
          DB::table('order_itemmeta')
        ->where('order_id',$request->cancel_order_id)
        ->where('meta_key','coupon_taka')
        ->update(['meta_value'=>0]);
       }
      //check customer cancel all quantity then update order status to cancelled
      /****** update copon taka *******/

        
        $totalPrice=DB::table('order_itemmeta')
        ->where('order_id',$request->cancel_order_id)
        ->where('meta_key','_line_subtotal')
        ->sum('meta_value');


        // delivery condition wise delivery charge add or minus
        $total_order_user=DB::table('order_itemmeta')->where('order_id',$request->cancel_order_id)->where('meta_key','_line_subtotal')->sum('meta_value');
        $delivery_condition=DB::table('options')->first();
        $order_district=DB::table('order_itemmeta')->where('order_id',$request->cancel_order_id)->where('meta_key','user_district')->first();
        $deli=DB::table('terms')->where('name',$order_district->meta_value)
        ->join('term_taxonomy','term_taxonomy.term_id','=','terms.term_id')
        ->where('term_taxonomy.taxonomy','district')
        ->select('description')
        ->first();
        if($total_order_user>=$delivery_condition->option_value){
          DB::table('order_itemmeta')->where('order_id',$request->cancel_order_id)
          ->where('meta_key','delivery_charge')
          ->update([
            'meta_value' =>0
          ]);
        }
        if($total_order_user<$delivery_condition->option_value){
          DB::table('order_itemmeta')->where('order_id',$request->cancel_order_id)
          ->where('meta_key','delivery_charge')
          ->update([
            'meta_value' =>$deli->description
          ]);
        }
        // delivery condition wise delivery charge add or minus

        if($copon_info !=null && $copon_info->coupon_type==2):
          $coponAmount=($copon_info->coupon_amount*$totalPrice)/100;
          DB::table('order_itemmeta')
        ->where('order_id',$request->cancel_order_id)
        ->where('order_item_id',$request->cancel_item_id)
        ->where('meta_key','coupon_taka')
        ->update(['meta_value'=>$coponAmount]);
        endif;
 /************ end of update copon taka ******************/

        // cost update start
        $oldCost=DB::table('order_itemmeta')
        ->where('order_id',$request->cancel_order_id)
        ->where('order_item_id',$request->cancel_item_id)
        ->where('meta_key','order_actual_cost')
        ->first();
        $cur_qty=DB::table('order_itemmeta')
        ->where('order_id',$request->cancel_order_id)
        ->where('order_item_id',$request->cancel_item_id)
        ->where('meta_key','_qty')
        ->first();
        DB::table('order_itemmeta')
          ->where('order_id',$request->cancel_order_id)
        ->where('order_item_id',$request->cancel_item_id)
        ->where('meta_key','order_product_cost')
        ->update([
          'meta_value'=>$oldCost->meta_value*$cur_qty->meta_value
        ]);
        // cost update end

       session()->flash("error", "Order has been cancelled");
       return back();
    }


    public function cancel_order_item_full(Request $request){
       $id=$request->o_id;
      // select order product
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
    DB::table('order_itemmeta')
      ->where('order_id',$id)
      ->where('meta_key','coupon_taka')
      ->update([
        'meta_value'=>0
    ]);
    DB::table('posts')->where('ID',$id)->update([
      'post_status' =>'cancelled',
      'post_content' =>$request->reason,
      'post_modified' =>date('Y-m-d H:i:s'),
    ]);
    session()->flash("success","Order has been cancelled Successfully");
    return back();
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
        //
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

    public function order_invoice_download($id){
      $order=Post::find($id);
        $products=Order_item::where('order_id',$id)   
        ->whereNotNull('product_id')
        ->get();
        $extraInfo=array(
            'title'=>"Order Edit",
            'page'=>'order'
        );
        $order_info=DB::table('postmeta')
        ->where('post_id',$id)
        ->get();
        $status=DB::table('posts')->where('ID',$id)->select('post_status')->first();
        $dist=DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','user_district')->first();
        $city=DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','user_city')->first();
        $zip=DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','user_zip')->first();

        $total_price=DB::table('order_itemmeta')->where('order_id',$id)->where('meta_key','_line_subtotal')->sum('meta_value');
        $delivery_charge=DB::table('order_itemmeta')->where('order_id',$order->ID) ->where('meta_key','delivery_charge')->first();
        $coupon_taka=DB::table('order_itemmeta')->where('order_id',$order->ID) ->where('meta_key','coupon_taka')->first();



        if(isset($delivery_charge)){
          $charge=$delivery_charge->meta_value;
        }else{
           $charge=0;
        }

       if(isset($coupon_taka)){
          $c=$coupon_taka->meta_value;
        }else{
           $c=0;
        }

         $orderr_total=$total_price+$charge-$c;
         //return view('front.order.invoice_download',compact('order','products','order_info','status','dist','city','zip','orderr_total','c'))->with($extraInfo);
         $pdf = PDF::loadView('front.order.invoice_download',compact('order','products','order_info','status','dist','city','zip','orderr_total','c'));
         return $pdf->download('customer_invoice.pdf');
    }
}
