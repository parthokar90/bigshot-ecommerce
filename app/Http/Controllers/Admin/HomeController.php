<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\front\Post;
use App\Model\front\Postmeta;
use App\Model\front\Order_item;
use DB;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
 
    
    public function index(Request $request){
        $start=$request->start;
        $end = $request->end;
        $extraInfo=array(
            'title'=>"Home",
            'page'=>'home'
        );
        $total_sales=DB::table('posts')
        ->where('post_type','shop_order')
        // ->where('post_status','on-hold')
        ->whereBetween('post_date',[date('Y-m-01 00:00:00'),date('Y-m-t 23:59:59')])
        ->count();
        
        $total_delivered = DB::table('posts')
        ->where('post_type', 'shop_order')
        ->where('post_status', 'delivered')
        ->whereBetween('post_modified', [date('Y-m-01 00:00:00'),date('Y-m-t 23:59:59')])


        ->count();
        $total_cancelled = DB::table('posts')
        ->where('post_type', 'shop_order')
        ->where('post_status', 'cancelled')
        ->whereBetween('post_modified', [date('Y-m-01 00:00:00'),date('Y-m-t 23:59:59')])
        ->count();

        $total_sale_amount=Post::where('post_type','shop_order')
        // ->where('post_status','on-hold')
        ->where('meta_key','_line_subtotal')
          ->whereBetween('post_date',[date('Y-m-01 00:00:00'),date('Y-m-t 23:59:59')])
        ->join('order_itemmeta','posts.ID','=', 'order_itemmeta.order_id')
        ->sum('meta_value');  

        $delivery_charge=Post::where('post_type','shop_order')
        // ->where('post_status','on-hold')
        ->where('meta_key','delivery_charge')
          ->whereBetween('post_date',[date('Y-m-01 00:00:00'),date('Y-m-t 23:59:59')])
        ->join('order_itemmeta','posts.ID','=', 'order_itemmeta.order_id')
        ->select('meta_value as d_charge')
        ->groupBy('order_id')
        ->get();

         $coupon=Post::where('post_type','shop_order')
        // ->where('post_status','on-hold')
        ->where('meta_key','coupon_taka')
          ->whereBetween('post_date',[date('Y-m-01 00:00:00'),date('Y-m-t 23:59:59')])
        ->join('order_itemmeta','posts.ID','=', 'order_itemmeta.order_id')
        ->select('meta_value as d_coupon')
        ->groupBy('order_id')
        ->get();
        
        foreach($delivery_charge as $charge){
           $total_sale_amount=$total_sale_amount+$charge->d_charge;
        }
         foreach($coupon as $c){
             $total_sale_amount=$total_sale_amount-$c->d_coupon;
        }


        if($start=='' && $end==''){
            // delivery charge
            $sale_charge=Post::where('post_type','shop_order')
            ->where('meta_key','delivery_charge')
              ->whereBetween('post_date',[date('Y-m-01 00:00:00'),date('Y-m-t 23:59:59')])
            ->join('order_itemmeta','posts.ID','=', 'order_itemmeta.order_id')
            ->select('meta_value as sale_charge')
            ->groupBy('order_id')
            ->get();
             $deliver_charge=Post::where('post_type','shop_order')
            ->where('post_status','delivered')
            ->where('meta_key','delivery_charge')
            ->whereBetween('post_modified', [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')])
            ->join('order_itemmeta','posts.ID','=', 'order_itemmeta.order_id')
            ->select('meta_value as deli_charge')
            ->groupBy('order_id')
            ->get();
             $cancel_charge=Post::where('post_type','shop_order')
            ->where('post_status','cancelled')
            ->where('meta_key','delivery_charge')
            ->whereBetween('post_modified', [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')])
            ->join('order_itemmeta','posts.ID','=', 'order_itemmeta.order_id')
            ->select('meta_value as canc_charge')
            ->groupBy('order_id')
            ->get();

            //coupon start
             $sale_coupon=Post::where('post_type','shop_order')
            ->where('meta_key','coupon_taka')
             ->whereBetween('post_date',[date('Y-m-01 00:00:00'),date('Y-m-t 23:59:59')])
            ->join('order_itemmeta','posts.ID','=', 'order_itemmeta.order_id')
            ->select('meta_value as sale_coupon')
            ->groupBy('order_id')
            ->get();

             $delivery_coupon=Post::where('post_type','shop_order')
            ->where('post_status','delivered')
            ->where('meta_key','coupon_taka')
              ->whereBetween('post_modified',[date('Y-m-01 00:00:00'),date('Y-m-t 23:59:59')])
            ->join('order_itemmeta','posts.ID','=', 'order_itemmeta.order_id')
            ->select('meta_value as deli_coupon')
            ->groupBy('order_id')
            ->get();

            $cancel_coupon=Post::where('post_type','shop_order')
            ->where('post_status','cancelled')
            ->where('meta_key','coupon_taka')
            ->whereBetween('post_modified',[date('Y-m-01 00:00:00'),date('Y-m-t 23:59:59')])
            ->join('order_itemmeta','posts.ID','=', 'order_itemmeta.order_id')
            ->select('meta_value as canc_coupon')
            ->groupBy('order_id')
            ->get();
         

            $total_sale_amount_date_wise=Post::where('post_type', 'shop_order')
                ->where('meta_key', '_line_subtotal')
                ->whereBetween('post_date', [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')])
                ->join('order_itemmeta', 'posts.ID', '=', 'order_itemmeta.order_id')
                ->sum('meta_value');

             foreach($sale_charge as $charge){
                 $total_sale_amount_date_wise=$total_sale_amount_date_wise+$charge->sale_charge;
             
             }
             foreach($sale_coupon as $sc){
                  $total_sale_amount_date_wise=$total_sale_amount_date_wise-$sc->sale_coupon;
             }
              $total_delivery_amount_date_wise = Post::where('post_type', 'shop_order')
                ->where('post_status', 'delivered')
                ->where('meta_key', '_line_subtotal')
                 ->whereBetween('post_modified', [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')])
                ->join('order_itemmeta', 'posts.ID', '=', 'order_itemmeta.order_id')
                ->sum('meta_value');
                 foreach($deliver_charge as $charge){
                    $total_delivery_amount_date_wise=$total_delivery_amount_date_wise+$charge->deli_charge;
                 }

                foreach($delivery_coupon as $dc){
                  $total_delivery_amount_date_wise=$total_delivery_amount_date_wise-$dc->deli_coupon;
                }
            $total_cancel_amount_date_wise = Post::where('post_type', 'shop_order')
                ->where('post_status', 'cancelled')
                ->where('meta_key', '_line_subtotal')
                 ->whereBetween('post_modified', [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')])
                ->join('order_itemmeta', 'posts.ID', '=', 'order_itemmeta.order_id')
                ->sum('meta_value');
               foreach($cancel_charge as $charge){
                  $total_cancel_amount_date_wise=$total_cancel_amount_date_wise+$charge->canc_charge;
               }
                 foreach($cancel_coupon as $cc){
                  $total_cancel_amount_date_wise=$total_cancel_amount_date_wise-$cc->canc_coupon;
                }

            }else{
               $sale_charge=Post::where('post_type','shop_order')
            ->where('meta_key','delivery_charge')
            ->whereBetween('post_date', [date('Y-m-d 00:00:00',strtotime($start)),date('Y-m-d 23:59:59',strtotime($end))])
            ->join('order_itemmeta','posts.ID','=', 'order_itemmeta.order_id')
            ->select('meta_value as pending_charge')
            ->groupBy('order_id')
            ->get();
             $deliver_charge=Post::where('post_type','shop_order')
            ->where('post_status','delivered')
            ->where('meta_key','delivery_charge')
             ->whereBetween('post_modified', [date('Y-m-d 00:00:00',strtotime($start)),date('Y-m-d 23:59:59',strtotime($end))])
            ->join('order_itemmeta','posts.ID','=','order_itemmeta.order_id')
            ->select('meta_value as deli_charge')
            ->groupBy('order_id')
            ->get();
             $cancel_charge=Post::where('post_type','shop_order')
            ->where('post_status','cancelled')
            ->where('meta_key','delivery_charge')
             ->whereBetween('post_modified', [date('Y-m-d 00:00:00',strtotime($start)),date('Y-m-d 23:59:59',strtotime($end))])
            ->join('order_itemmeta','posts.ID','=','order_itemmeta.order_id')
            ->select('meta_value as canc_charge')
            ->groupBy('order_id')
            ->get();

            //coupon
             $sale_coupon=Post::where('post_type','shop_order')
            ->where('meta_key','coupon_taka')
            ->whereBetween('post_date', [date('Y-m-d 00:00:00',strtotime($start)),date('Y-m-d 23:59:59',strtotime($end))])
            ->join('order_itemmeta','posts.ID','=', 'order_itemmeta.order_id')
            ->select('meta_value as sale_coupon')
            ->groupBy('order_id')
            ->get();

             $delivery_coupon=Post::where('post_type','shop_order')
            ->where('post_status','delivered')
            ->where('meta_key','coupon_taka')
             ->whereBetween('post_modified',[date('Y-m-d 00:00:00',strtotime($start)),date('Y-m-d 23:59:59',strtotime($end))])
            ->join('order_itemmeta','posts.ID','=', 'order_itemmeta.order_id')
            ->select('meta_value as deli_coupon')
            ->groupBy('order_id')
            ->get();

            $cancel_coupon=Post::where('post_type','shop_order')
            ->where('post_status','cancelled')
            ->where('meta_key','coupon_taka')
            ->whereBetween('post_modified', [date('Y-m-d 00:00:00',strtotime($start)),date('Y-m-d 23:59:59',strtotime($end))])
            ->join('order_itemmeta','posts.ID','=', 'order_itemmeta.order_id')
            ->select('meta_value as canc_coupon')
            ->groupBy('order_id')
            ->get();


            $total_sale_amount_date_wise=Post::where('post_type','shop_order')
            ->where('meta_key','_line_subtotal')
            ->whereBetween('post_date', [date('Y-m-d 00:00:00',strtotime($start)), date('Y-m-d 23:59:59',strtotime($end))])
            ->join('order_itemmeta', 'posts.ID', '=', 'order_itemmeta.order_id')
            ->sum('meta_value');
 
            foreach($sale_charge as $charge){
                 $total_sale_amount_date_wise=$total_sale_amount_date_wise+$charge->pending_charge;
             }

             foreach($sale_coupon as $sc){
                  $total_sale_amount_date_wise=$total_sale_amount_date_wise-$sc->sale_coupon;
             }
            $total_delivery_amount_date_wise = Post::where('post_type', 'shop_order')
            ->where('post_status', 'delivered')
            ->where('meta_key', '_line_subtotal')
             ->whereBetween('post_modified', [date('Y-m-d 00:00:00',strtotime($start)), date('Y-m-d 23:59:59', strtotime($end))])
            ->join('order_itemmeta', 'posts.ID', '=', 'order_itemmeta.order_id')
            ->sum('meta_value');

               foreach($deliver_charge as $charge){
                    $total_delivery_amount_date_wise=$total_delivery_amount_date_wise+$charge->deli_charge;
                 }

                foreach($delivery_coupon as $dc){
                  $total_delivery_amount_date_wise=$total_delivery_amount_date_wise-$dc->deli_coupon;
                }

            $total_cancel_amount_date_wise = Post::where('post_type', 'shop_order')
            ->where('post_status', 'cancelled')
            ->where('meta_key', '_line_subtotal')
            ->whereBetween('post_modified', [date('Y-m-d 00:00:00', strtotime($start)), date('Y-m-d 23:59:59', strtotime($end))])
            ->join('order_itemmeta', 'posts.ID', '=', 'order_itemmeta.order_id')
            ->sum('meta_value');
              foreach($cancel_charge as $charge){
                  $total_cancel_amount_date_wise=$total_cancel_amount_date_wise+$charge->canc_charge;
               }
                 foreach($cancel_coupon as $cc){
                  $total_cancel_amount_date_wise=$total_cancel_amount_date_wise-$cc->canc_coupon;
                }
            }
           return view("admin.home",compact('total_sales','total_delivered','total_cancelled','total_sale_amount','total_sale_amount_date_wise','total_delivery_amount_date_wise','total_cancel_amount_date_wise','start','end'))->with($extraInfo);
        }
    }
 