<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Session;

class QuiryController extends Controller {

    //
    public function generalQuiry(Request $request) {
        $info = array(
            'post_type' => 'genarel_quiry',
            'post_author' => auth()->user()->id,
            'post_title' => $request->subject,
            'post_content' => $request->message
        );
        $insert = DB::table('posts')->insert($info);     
        session()->flash("success","Query has been sent successfully"); 
        return back();
    }

    //full order cancel
    public function support_all_cancel_order(Request $request) {
        if ($request->cancel_option == 'full') {
            $id = $request->customer_order_id;
            if ($id == '') {
                session()->flash("error", "Please Select Order Id");
                return back();
            }
            $copon_code=DB::table('order_itemmeta')
            ->where('order_id',$request->customer_order_id) 
            ->where('meta_key','coupon_code')
            ->first();
            if($copon_code!=null):
                DB::table('order_itemmeta')
                ->where('order_id',$id)
                ->where('meta_key','coupon_taka')
                ->update(['meta_value'=>0]);
            endif;
            $product = DB::table('order_items')->where('order_id', $id)->get();
            // default product start
            foreach ($product as $item) {
                $current_order_qty = DB::table('order_itemmeta')
                ->where('order_id', $item->order_id)
                ->where('product_parent', $item->product_parent)
                ->where('meta_key', '_qty')
                ->first();
                $pro_stock = DB::table('postmeta')
                ->where('post_id', $item->product_parent)
                ->where('meta_key', 'default_qty')
                ->first();
                if (isset($current_order_qty) && isset($pro_stock)) {
                  $cancel_quantity_default=array(
                    'order_item_id'=>$item->order_item_id,
                    'order_id' => $id,
                    'meta_key' => 'cancel_quantity_default',
                    'meta_value' => $current_order_qty->meta_value,
                    'product_parent' => $item->product_parent
                );                 
                  DB::table('order_itemmeta')->insert($cancel_quantity_default);
                  DB::table('order_itemmeta')->insert([
                    'order_id' => $id,
                    'order_item_id'=>$item->order_item_id,
                    'meta_key' => 'cancel_default_product',
                    'meta_value' => $item->product_parent,
                ]);
                  $update_stock = $current_order_qty->meta_value + $pro_stock->meta_value;
                  DB::table('postmeta')
                  ->where('post_id', $item->product_parent)
                  ->where('meta_key', 'default_qty')
                  ->update([
                    'meta_value' => $update_stock
                ]);
              }
          }
            // default product end
            // attribute product start
          foreach ($product as $item) {
            $current_order_qty = DB::table('order_itemmeta')
            ->where('order_id', $item->order_id)
            ->where('product_id', $item->product_id)
            ->where('meta_key', '_qty')
            ->first();
            $pro_stock = DB::table('postmeta')
            ->where('post_id', $item->product_id)
            ->where('meta_key', 'attribute_stock')
            ->first();
            if (isset($current_order_qty) && isset($pro_stock)) {
                DB::table('order_itemmeta')->insert([
                    'order_item_id'=>$item->order_item_id,
                    'order_id' => $id,
                    'meta_key' => 'cancel_quantity_attribute',
                    'meta_value' => $current_order_qty->meta_value,
                ]);
                DB::table('order_itemmeta')->insert([
                    'order_item_id'=>$item->order_item_id,
                    'order_id' => $id,
                    'meta_key' => 'cancel_attribute_product',
                    'meta_value' => $item->product_id,
                ]);
                $update_stock = $current_order_qty->meta_value + $pro_stock->meta_value;
                DB::table('postmeta')
                ->where('post_id', $item->product_id)
                ->where('meta_key', 'attribute_stock')
                ->update([
                    'meta_value' => $update_stock
                ]);
            }
        }
            // attribute product end 
            //order qty update to 0
        DB::table('order_itemmeta')
        ->where('order_id', $id)
        ->where('meta_key', '_qty')
        ->update([
            'meta_value' => 0
        ]);

        DB::table('order_itemmeta')
        ->where('order_id', $id)
        ->where('meta_key', '_line_subtotal')
        ->update([
            'meta_value' => 0
        ]);
        DB::table('posts')->where('ID', $id)->update([
            'post_status' => 'cancelled',
            'post_modified' => date('Y-m-d h:i:s'),
            'post_content' => $request->c_reason,
        ]);
        session()->flash("success", "Order has been cancelled Successfully");
        return back();
      }
      // full order cancel end
       if ($request->cancel_option == 'partials') {
            $id = $request->customer_order_id;
            if ($id == '') {
                session()->flash("error", "Please Select Order Id");
                return back();
            }  
            return redirect()->route('customer_ordere_cancel',$id); 
        }




      }

}
