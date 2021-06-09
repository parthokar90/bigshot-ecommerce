<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Cart;
use auth;
use Mail;
use Redirect;
use Session;
use App\Http\Requests\CheckoutValidateRequest;

class CartController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cart() {

        if (Auth::check()) {
            $info = DB::table('user_cart')->where('user_id', auth()->user()->id)->orderBy('cart_id', 'DESC')->get();
            $user_info = DB::table('usermeta')
            ->where('user_id', auth()->user()->id)
            ->get();
           $add=DB::table('usermeta')->where('user_id',auth()->user()->id)->where('meta_key','address_one')->first();
           $mob=DB::table('usermeta')->where('user_id',auth()->user()->id)->where('meta_key','phone')->first();
        } else {
            $user_info = [];
            $info = Cart::getContent();
            $add='';
            $mob='';
        }
        $district = DB::table('term_taxonomy')->where('taxonomy', 'district')
        ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
        ->select('terms.term_id', 'terms.name as district')
        ->get();
        return view('front.cart', compact('info', 'user_info', 'district','add','mob'));

        // return view('front.cart1', compact('info', 'user_info', 'district'))->with(['title'=>'Bigshot | Bag']);
    }

    public function cart1() {
        if (Auth::check()) {
            $info = DB::table('user_cart')->where('user_id', auth()->user()->id)->orderBy('cart_id', 'DESC')->get();
            $user_info = DB::table('usermeta')
            ->where('user_id', auth()->user()->id)
            ->get();
        } else {
            $user_info = [];
            $info = Cart::getContent();
        }

        $district = DB::table('term_taxonomy')->where('taxonomy', 'district')
        ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
        ->select('terms.term_id', 'terms.name as district')
        ->get();
        return view('front.cart1', compact('info', 'user_info', 'district'))->with(['title' => 'Bigshot | Bag']);
    }

    public function shipping() {
        if (Auth::check()) {
            $info = DB::table('user_cart')->where('user_id', auth()->user()->id)->orderBy('cart_id', 'DESC')->get();
            $user_info = DB::table('usermeta')
            ->where('user_id', auth()->user()->id)
            ->get();
        } else {
            $user_info = [];
            $info = Cart::getContent();
        }
        $district = DB::table('term_taxonomy')->where('taxonomy', 'district')
        ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
        ->select('terms.term_id', 'terms.name as district')
        ->get();

        return view('front.shipping', compact('info', 'user_info', 'district'))->with(['title' => 'Bigshot | Shipping']);
        ;
    }

    public function shippingInfo(Request $request) {
        if (Auth::check()) {
            $id=auth()->user()->id;

            $address=DB::table('usermeta')->where(['user_id' => $id, 'meta_key' => 'address1'])->first();
            if($address==null){
               DB::table('usermeta')->insert(
                ['user_id' => $id, 'meta_key' => 'address1', 'meta_value' => $request->address_one]
            );
           }
           else{
            DB::table('usermeta')
            ->where('user_id', $id)
            ->where('meta_key', 'address1')
            ->update(['meta_value' => $request->address_one]);
        } 

        $phones=DB::table('usermeta')->where(['user_id' => $id, 'meta_key' => 'phone']);
            if($phones==null){
               DB::table('usermeta')->insert(
                ['user_id' => $id, 'meta_key' => 'phone', 'meta_value' => $request->phone]
            );
           }
           else{
            DB::table('usermeta')
            ->where('user_id', $id)
            ->where('meta_key', 'phone')
            ->update(['meta_value' => $request->phone]);
        } 
         $countrys=DB::table('usermeta')->where(['user_id' => $id, 'meta_key' => 'country'])->first();

            if($countrys==null){
               DB::table('usermeta')->insert(
                ['user_id' => $id, 'meta_key' => 'country', 'meta_value' => $request->country]
            );
           }
           else{
            DB::table('usermeta')
            ->where('user_id', $id)
            ->where('meta_key', 'country')
            ->update(['meta_value' => $request->country]);
        } 

        $districts=DB::table('usermeta')->where(['user_id' => $id, 'meta_key' => 'district'])->first();
            if($districts==null){
               DB::table('usermeta')->insert(
                ['user_id' => $id, 'meta_key' => 'district', 'meta_value' => $request->state]
            );
           }
           else{
            DB::table('usermeta')
            ->where('user_id', $id)
            ->where('meta_key', 'district')
            ->update(['meta_value' => $request->state]);
        }

         $citys=DB::table('usermeta')->where(['user_id' => $id, 'meta_key' => 'city'])->first();
            if($citys==null){
               DB::table('usermeta')->insert(
                ['user_id' => $id, 'meta_key' => 'city', 'meta_value' => $request->city]
            );
           }
           else{
            DB::table('usermeta')
            ->where('user_id', $id)
            ->where('meta_key', 'city')
            ->update(['meta_value' => $request->city]);
        } 

        $zips=DB::table('usermeta')->where(['user_id' => $id, 'meta_key' => 'zip'])->first();
            if($zips==null){
               DB::table('usermeta')->insert(
                ['user_id' => $id, 'meta_key' => 'zip', 'meta_value' => $request->zip]
            );
           }
           else{
            DB::table('usermeta')
            ->where('user_id', $id)
            ->where('meta_key', 'zip')
            ->update(['meta_value' => $request->zip]);
        }

    } else {
        $checkUser = DB::table('users')->where('email', $request->email)->first();
        if ($checkUser != null) {
            $id = $checkUser->id;
            $info = array(
                "name" => $request->first_name,
                "last_name" => $request->last_name,
            );
            DB::table('users')
            ->where('email', $request->email)
            ->update($info);


            DB::table('usermeta')
            ->where('user_id', $id)
            ->where('meta_key', 'address1')
            ->update(['meta_value' => $request->address_one]);

            DB::table('usermeta')
            ->where('user_id', $id)
            ->where('meta_key', 'country')
            ->update(['meta_value' => $request->country]);

            DB::table('usermeta')
            ->where('user_id', $id)
            ->where('meta_key', 'district')
            ->update(['meta_value' => $request->state]);

            DB::table('usermeta')
            ->where('user_id', $id)
            ->where('meta_key', 'city')
            ->update(['meta_value' => $request->city]);

            DB::table('usermeta')
            ->where('user_id', $id)
            ->where('meta_key', 'zip')
            ->update(['meta_value' => $request->zip]);


            DB::table('usermeta')
            ->where('user_id', $id)
            ->where('meta_key', 'phone')
            ->update(['meta_value' => $request->phone]);

            session::put('gust_user_id', $checkUser->id);
        } else {

            $user = array(
                "name" => $request->first_name,
                "last_name" => $request->last_name,
                "email" => $request->email
            );
            $id = DB::table('users')->insertGetId($user);

            DB::table('usermeta')->insert(
                ['user_id' => $id, 'meta_key' => 'address1', 'meta_value' => $request->address_one]
            );
            DB::table('usermeta')->insert(
                ['user_id' => $id, 'meta_key' => 'country', 'meta_value' => $request->country]
            );
            DB::table('usermeta')->insert(
                ['user_id' => $id, 'meta_key' => 'district', 'meta_value' => $request->state]
            );
            DB::table('usermeta')->insert(
                ['user_id' => $id, 'meta_key' => 'zip', 'meta_value' => $request->zip]
            );

            DB::table('usermeta')->insert(
                ['user_id' => $id, 'meta_key' => 'phone', 'meta_value' => $request->phone]
            );
            DB::table('usermeta')->insert(
                ['user_id' => $id, 'meta_key' => 'city', 'meta_value' => $request->city]
            );
            session::put('gust_user_id', $id);
        }
    }    
    return redirect(route('review'));
}

public function review() {

    if (Auth::check()) {
        $info = DB::table('user_cart')->where('user_id', auth()->user()->id)->orderBy('cart_id', 'DESC')->get();
        $user_info = DB::table('usermeta')
        ->where('user_id', auth()->user()->id)
        ->get();
        $gust_info = DB::table('usermeta')
        ->where('user_id', auth()->user()->id)
        ->where('meta_key', 'district')
        ->first();
        $city_id = $gust_info->meta_value;
    } else {
        $guid = session::get('gust_user_id');

        $gust_info = DB::table('usermeta')
        ->where('user_id', $guid)
        ->where('meta_key', 'district')
        ->first();
        $city_id = $gust_info->meta_value;
        $user_info = [];
        $info = Cart::getContent();
    }
    $delivery_charge = DB::table('term_taxonomy')->where('taxonomy', 'district')
    ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
    ->select('terms.term_id', 'terms.name as district', 'term_taxonomy.description')
    ->where('terms.term_id', $city_id)
    ->first();
    $dc = $delivery_charge->description;

    return view('front.review', compact('info', 'user_info', 'dc'))->with(['title' => 'Bigshot | Bag Review']);
}

public function applyCopon(Request $request) {
    $coponInfo = DB::table('coupons')
    ->where('coupon_code', $request->promo_code)
    ->where('status', 1)
    ->where('expire_date', '>=', date('Y-m-d'))
    ->first();
    $dicount_amount = 0;
    if ($coponInfo != null):

        $cartTotal = Cart::getTotal();

        if ($coponInfo->coupon_type == 2) {
            $dicount_amount = ($cartTotal * $coponInfo->coupon_amount) / 100;
        } else {
            $dicount_amount = $coponInfo->coupon_amount;
        }
    endif;
    if (Auth::check()) {
        $id = auth()->user()->id;
    } else {

        $id = session::get('gust_user_id');
    }
    $result = DB::table('usermeta')
    ->where('user_id', $id)
    ->where('meta_key', 'coupon_amount')
    ->first();

    if ($result != null) {
        DB::table('usermeta')
        ->where('user_id', $id)
        ->where('meta_key', 'coupon_amount')
        ->update(['meta_value' => $dicount_amount]);

        DB::table('usermeta')
        ->where('user_id', $id)
        ->where('meta_key', 'coupon_code')
        ->update(['meta_value' => $request->promo_code]);
    } else {
        $coponInfoInsert = array(
            'user_id' => $id,
            'meta_key' => 'coupon_amount',
            'meta_value' => $dicount_amount
        );
        DB::table('usermeta')
        ->insert($coponInfoInsert);

        $coponCodeInsert = array(
            'user_id' => $id,
            'meta_key' => 'coupon_code',
            'meta_value' => $request->promo_code
        );
        DB::table('usermeta')
        ->insert($coponCodeInsert);
    }

    session::put('dicount_amount', $dicount_amount);

    return redirect(route('review'));
}

public function payment() {
    if (Auth::check()) {
        $info = DB::table('user_cart')->where('user_id', auth()->user()->id)->orderBy('cart_id', 'DESC')->get();
        $user_info = DB::table('usermeta')
        ->where('user_id', auth()->user()->id)
        ->get();
         $gust_info = DB::table('usermeta')
        ->where('user_id', auth()->user()->id)
        ->where('meta_key', 'district')
        ->first();
        $city_id = $gust_info->meta_value;

    } else {
        $guid = session::get('gust_user_id');

        $gust_info = DB::table('usermeta')
        ->where('user_id', $guid)
        ->where('meta_key', 'district')
        ->first();
        $city_id = $gust_info->meta_value;
        $user_info = [];
        $info = Cart::getContent();
    }
    $delivery_charge = DB::table('term_taxonomy')->where('taxonomy', 'district')
    ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
    ->select('terms.term_id', 'terms.name as district', 'term_taxonomy.description')
    ->where('terms.term_id', $city_id)
    ->first();

    $dc = $delivery_charge->description;

    return view('front.payment', compact('info', 'user_info', 'dc'))->with(['title' => 'Bigshot | Payment']);
}

public function saveOrder(Request $request) {
    if (Auth::check()) {
        $info = DB::table('user_cart')->where('user_id', auth()->user()->id)->orderBy('cart_id', 'DESC')->get();
        $user_info = DB::table('users')
        ->where('id', auth()->user()->id)
        ->first();
        $id=auth()->user()->id;
    } else {
        $id = session::get('gust_user_id');

        $user_info = DB::table('users')
        ->where('id', $id)
        ->first();
    }

    $citys = DB::table('usermeta')
    ->where('user_id', $id)
    ->where('meta_key', 'city')
    ->first();

    $districts = DB::table('usermeta')
    ->where('user_id', $id)
    ->where('meta_key', 'district')
    ->first();

    $city_id = $citys->meta_value;

    $delivery_charge = DB::table('term_taxonomy')->where('taxonomy', 'district')
    ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
    ->select('terms.term_id', 'terms.name as district', 'term_taxonomy.description')
    ->where('terms.term_id', $districts->meta_value)
    ->first();
    $result = DB::table('usermeta')
    ->where('user_id', $id)
    ->where('meta_key', 'coupon_amount')
    ->first();

    $c_codes = DB::table('usermeta')
    ->where('user_id', $id)
    ->where('meta_key', 'coupon_code')
    ->first();

    $zip_codes = DB::table('usermeta')
    ->where('user_id', $id)
    ->where('meta_key', 'zip')
    ->first();


    $addresses = DB::table('usermeta')
    ->where('user_id', $id)
    ->where('meta_key', 'address1')
    ->first();

    $phones = DB::table('usermeta')
    ->where('user_id', $id)
    ->where('meta_key', 'phone')
    ->first();
    $zip_code = $zip_codes->meta_value;
    $copon = $result->meta_value;
    $copon_code = $c_codes->meta_value;
    $address1 = $addresses->meta_value;
    $phone = $phones->meta_value;

    $dc = $delivery_charge->description;


    $dist_name = DB::table('term_taxonomy')
    ->where('taxonomy', 'district')
    ->where('terms.term_id', $districts->meta_value)
    ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
    ->first();

    $city_name = DB::table('term_taxonomy')
    ->where('taxonomy', 'city')
    ->where('terms.term_id', $city_id)
    ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
    ->first();

    $post_date = date('Y-m-d 0:0:0)');
    $post_date_gmt = date('Y-m-d H:i:s', strtotime('+6 hour'));

    $totalOrder = DB::table('posts')->where('post_type', 'shop_order')->where('post_author', $id)->count();
    $postName = 'order-' . ($totalOrder + 1);

    $order = array(
        'post_title' => 'Order' . date('Y-m-d H:i:s'),
        'post_status' => 'on-hold',
        'post_name' => $postName,
        'post_password' => 'order_1247',
        'post_date' => $post_date,
        'post_date_gmt' => $post_date_gmt,
        'post_type' => 'shop_order',
        'post_author' => $id,
    );
    $order_id = DB::table('posts')->insertGetId($order);

    $order_post = array(
        'post_id' => $order_id,
        'meta_key' => 'first_name',
        'meta_value' => $user_info->name,
    );
    DB::table('postmeta')->insert($order_post);

    $order_post = array(
        'post_id' => $order_id,
        'meta_key' => 'last_name',
        'meta_value' => $user_info->last_name,
    );
    DB::table('postmeta')->insert($order_post);
    $order_post = array(
        'post_id' => $order_id,
        'meta_key' => 'address_one',
        'meta_value' => $address1,
    );
    DB::table('postmeta')->insert($order_post);

    $order_post = array(
        'post_id' => $order_id,
        'meta_key' => 'phone',
        'meta_value' => $phone,
    );
    DB::table('postmeta')->insert($order_post);
    $order_post = array(
        'post_id' => $order_id,
        'meta_key' => 'email',
        'meta_value' => $user_info->email,
    );
    DB::table('postmeta')->insert($order_post);
    $order_post = array(
        'post_id' => $order_id,
        'meta_key' => 'country',
        'meta_value' => 'Bangladesh',
    );
    DB::table('postmeta')->insert($order_post);

    $order_post = array(
     'post_id' => $order_id,
     'meta_key' => 'state',
     'meta_value' => $dist_name->name,
 );
    DB::table('postmeta')->insert($order_post);
    $order_post = array(
     'post_id' => $order_id,
     'meta_key' => 'city',
     'meta_value' => $city_name->name,
 );

    DB::table('postmeta')->insert($order_post);
    $order_post = array(
     'post_id' => $order_id,
     'meta_key' => 'zip',
     'meta_value' => $zip_code,
 );
    DB::table('postmeta')->insert($order_post);
    $order_post = array(
     'post_id' => $order_id,
     'meta_key' => '_customer_user',
     'meta_value' => $id,
 );
    DB::table('postmeta')->insert($order_post);
    $order_post = array(
     'post_id' => $order_id,
     'meta_key' => '_billing_postcode',
     'meta_value' => $zip_code,
 );
    DB::table('postmeta')->insert($order_post);


    DB::table('postmeta')->insert($order_post);
    $order_post = array(
     'post_id' => $order_id,
     'meta_key' => 'payment_method',
     'meta_value' => $request->paymentMethod,
 );
    DB::table('postmeta')->insert($order_post);

    if (Auth::check()) {
        $info = DB::table('user_cart')->where('user_id', auth()->user()->id)->get();
    } else {
        $info = Cart::getContent();
    }

    foreach ($info as $key => $item) {
        $pro = DB::table('postmeta')->where('post_id', $item->id)->where('meta_key', 'default_qty')->get();
        foreach ($pro as $pros) {
            $ac_qty = $pros->meta_value;
            $customer_qty = $item->quantity;
            $tot_qty = $ac_qty - $customer_qty;
            DB::table('postmeta')->where('post_id', $item->id)->where('meta_key', 'default_qty')->update([
                'meta_value' => $tot_qty,
            ]);
        }

        $pro_two = DB::table('postmeta')->where('post_id', $item->id)->where('meta_key', 'attribute_stock')->get();
        foreach ($pro_two as $pros) {
            $ac_qty = $pros->meta_value;
            $customer_qty = $item->quantity;
            $tot_qty = $ac_qty - $customer_qty;
            DB::table('postmeta')->where('post_id', $item->id)->where('meta_key', 'attribute_stock')->update([
                'meta_value' => $tot_qty,
            ]);
        }

        if (Auth::check()) {
            $tot_pri = $item->quantity * $item->actual_price;
        } else {
            $tot_pri = $item->quantity * $item->price;
        }
        $check_id = DB::table('posts')
        ->where('ID', $item->id)
        ->select('ID', 'post_parent')
        ->first();

        if ($check_id->post_parent == 0) {
            $p_id = $check_id->ID;
        } else {
            $p_id = $check_id->post_parent;
        }

        $order_item = array(
            'order_item_name' => $item->name,
            'order_item_type' => 'line-item',
            'order_id' => $order_id,
            'product_id' => $item->id,
            'product_parent' => $p_id
        );
        $order_item_id = DB::table('order_items')->insertGetId($order_item);

        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => '_tax_class',
            'meta_value' => '',
            'customer_id' => $id,
            'order_id' => $order_id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id
        );
        DB::table('order_itemmeta')->insert($order_item_details);


        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => '_qty',
            'meta_value' => $item->quantity,
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id
        );
        DB::table('order_itemmeta')->insert($order_item_details);

        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => '_product_id',
            'meta_value' => $item->id,
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id
        );
        DB::table('order_itemmeta')->insert($order_item_details);
        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => '_variation_id',
            'meta_value' => '',
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id
        );
        DB::table('order_itemmeta')->insert($order_item_details);
        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => '_line_subtotal',
            'meta_value' => $tot_pri,
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id
        );
        DB::table('order_itemmeta')->insert($order_item_details);
        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => '_line_total',
            'meta_value' => $tot_pri,
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id
        );
        DB::table('order_itemmeta')->insert($order_item_details);
        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => '_line_subtotal_tax',
            'meta_value' => '',
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id
        );
        DB::table('order_itemmeta')->insert($order_item_details);
        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => '_line_tax',
            'meta_value' => '',
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id
        );
        DB::table('order_itemmeta')->insert($order_item_details);

        $_line_tax_data_gmt = date('Y-m-d H:i:s', strtotime('+6 hour'));
        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => '_line_tax_data',
            'meta_value' => $_line_tax_data_gmt,
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id
        );
        DB::table('order_itemmeta')->insert($order_item_details);
        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => 'delivery_charge',
            'meta_value' => $dc,
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id
        );
        DB::table('order_itemmeta')->insert($order_item_details);

        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => 'coupon_code',
            'meta_value' => $copon_code,
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id
        );
        DB::table('order_itemmeta')->insert($order_item_details);

        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => 'coupon_taka',
            'meta_value' => $copon,
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id
        );
        DB::table('order_itemmeta')->insert($order_item_details);

        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => 'attribute_parent',
            'meta_value' => $item->id,
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id
        );
        DB::table('order_itemmeta')->insert($order_item_details);

        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => 'user_district',
            'meta_value' => $dist_name->name,
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id
        );
        DB::table('order_itemmeta')->insert($order_item_details);

        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => 'user_city',
            'meta_value' => $city_name->name,
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id
        );
        DB::table('order_itemmeta')->insert($order_item_details);

        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => 'user_zip',
            'meta_value' => $zip_code,
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id
        );
        DB::table('order_itemmeta')->insert($order_item_details);
    }
    if (Auth::check()) {
        DB::table('user_cart')->where('user_id', auth()->user()->id)->delete();
    } else {
        Cart::clear();
    }
    session::forget('dicount_amount');
    $name = $user_info->name;
    $email = $user_info->email;
    $subject = 'Order Confirmation';
    Mail::send('mail', ['name' => $name, 'order_id' => $order_id], function($message) use ($email, $subject) {
        $message->from('order@bigshotstyle.com', 'Bigshot');
        $message->to($email)->subject($subject);
    });
    return redirect()->route('order.success');
}

public function cart_new() {

    $info = Cart::getContent();

    if (Auth::check()) {
        $user_info = DB::table('usermeta')
        ->where('user_id', auth()->user()->id)
        ->get();
    } else {
        $user_info = [];
    }
    $district = DB::table('term_taxonomy')->where('taxonomy', 'district')
    ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
    ->select('terms.term_id', 'terms.name as district')
    ->get();
    return view('front.cart_new', compact('info', 'user_info', 'district'));
}

public function districtCityAjax($id) {
    $data = DB::table('term_taxonomy')->where(['taxonomy' => 'city', 'parent' => $id])
    ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
    ->select('terms.name as city_name', 'terms.term_id')
    ->get();
    $charge = DB::table('term_taxonomy')->where('term_id', $id)->where('taxonomy', 'district')->get();
    $option_amount = DB::table('options')->first();
    if (isset($option_amount)) {
        $amount = $option_amount->option_value;
    } else {
        $amount = 0;
    }
    return response()->json(['data' => $data, 'charge' => $charge, 'amount' => $amount]);
}

public function districtCityPostcode($id) {
    $data = DB::table('term_taxonomy')->where(['taxonomy' => 'postcode', 'parent' => $id])
    ->select('description as zip')
    ->get();
    return response()->json($data);
}

public function addCart(Request $request) {
    if ($request->quantity == 0) {
        return back()->with('error', 'Quantity must be greater than 0');
        exit();
    }
    if ($request->attribute_id!=0) {
        $stock = DB::table('postmeta')
        ->where('post_id', $request->attribute_id)
        ->where('meta_key', 'attribute_stock')
        ->select('meta_value')
        ->first();
        if (isset($stock)) {
            if ($request->quantity > $stock->meta_value) {
                 session()->flash("error","Out of stock"); 
                return back();
                exit();
            }
            if ($stock->meta_value == 0) {
                session()->flash("error","Out of stock"); 
                return back();
                exit();
            }
        }
    } else {
        $stock = DB::table('postmeta')
        ->where('post_id', $request->id)
        ->where('meta_key', 'default_qty')
        ->select('meta_value')
        ->first();
        if (isset($stock)) {
            if ($request->quantity > $stock->meta_value) {
                session()->flash("error","Out of stock"); 
                return back();
                exit();
            }
            if ($stock->meta_value == 0) {
                session()->flash("error","Out of stock"); 
                return back();
                exit();
            }
        }
    }
    if (isset($stock)) {
        if ($request->attribute_id!=0) {
            $parent = $request->attribute_id;
        } else {
            $parent = $request->id;
        }
    } else {
        session()->flash("error","Out of stock"); 
                return back();
                exit();
    }

    Cart::add(array(
        array(
            'id' => $parent,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'name' => $request->name,
        ),
    )
);

    if (Auth::check()) {
        $user_id = auth()->user()->id;
        $count = DB::table('user_cart')
        ->where('user_id', $user_id)
        ->where('id', $parent)
        ->count();
        if ($count > 0) {
            $old_qty = DB::table('user_cart')
            ->where('user_id', $user_id)
            ->where('id', $parent)
            ->select('quantity')
            ->first();

            $old_price = DB::table('user_cart')
            ->where('user_id', $user_id)
            ->where('id', $parent)
            ->select('price')
            ->first();

            $updateQty = $old_qty->quantity + $request->quantity;
            $updatePrice = $updateQty * $request->price;

            DB::table('user_cart')
            ->where('user_id', $user_id)
            ->where('id', $parent)
            ->update([
                'user_id' => $user_id,
                'id' => $parent,
                'price' => $updatePrice,
                'actual_price' => $request->price,
                'quantity' => $updateQty,
                'name' => $request->name,
            ]);
        } else {
            DB::table('user_cart')->insert([
                'user_id' => $user_id,
                'id' => $parent,
                'price' => $request->price * $request->quantity,
                'actual_price' => $request->price,
                'quantity' => $request->quantity,
                'name' => $request->name,
            ]);
        }
    }

    return redirect()->back()->with('success', 'Product added in Cart');
}

public function index() {
        //
}

public function checkout(CheckoutValidateRequest $request) {
    $dist_name = DB::table('term_taxonomy')
    ->where('taxonomy', 'district')
    ->where('terms.term_id', $request->state)
    ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
    ->first();
    $city_name = DB::table('term_taxonomy')
    ->where('taxonomy', 'city')
    ->where('terms.term_id', $request->city)
    ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
    ->first();
    $zip_code = $request->zip;
    $deliver_condition_amount = DB::table('options')->first();
    if (isset($deliver_condition_amount)) {
        $op_amount = $deliver_condition_amount->option_value;
    } else {
        $op_amount = 0;
    }
    if (Auth::check()) {
        $totak_price = DB::table('user_cart')->where('user_id', auth()->user()->id)->sum('price');
    } else {
        $totak_price = Cart::getTotal();
    }
    if ($totak_price >= $op_amount) {
        $dcharge = 0;
    } else {

        if ($request->paymentMethod == 'DeliveryChargeOnly') {
            $dcharge = 0;
        } else {
            $delivery_charge = DB::table('term_taxonomy')->where('term_id', $request->state)->where('taxonomy', 'district')->select('description')->first();
            $dcharge = $delivery_charge->description;
        }
    }

    if ($request->coupon_taka == '') {
        $coupon_taka = 0;
    } else {
        $coupon_taka = $request->coupon_taka;
    }

    if (\Auth::check()) {
        $id = auth()->user()->id;
    } else {
        $id = 0;
    }
    $user_address = DB::table('usermeta')->where('user_id', $id)->where('meta_key', 'address_one')->count();
    $user_district = DB::table('usermeta')->where('user_id', $id)->where('meta_key', 'district')->count();
    $user_city = DB::table('usermeta')->where('user_id', $id)->where('meta_key', 'city')->count();
    $user_postcode = DB::table('usermeta')->where('user_id', $id)->where('meta_key', 'zip')->count();
    if ($user_address == 0) {
        DB::table('usermeta')->insert([
            'user_id' => $id,
            'meta_key' => 'address_one',
            'meta_value' => $request->address_one,
        ]);
    } else {
        DB::table('usermeta')->where('user_id', $id)->where('meta_key', 'address_one')->delete();
        DB::table('usermeta')->insert([
            'user_id' => $id,
            'meta_key' => 'address_one',
            'meta_value' => $request->address_one,
        ]);
    }

    if ($user_district == 0) {
        DB::table('usermeta')->insert([
            'user_id' => $id,
            'meta_key' => 'district',
            'meta_value' => $request->state,
        ]);
    } else {
        DB::table('usermeta')->where('user_id', $id)->where('meta_key', 'district')->delete();
        DB::table('usermeta')->insert([
            'user_id' => $id,
            'meta_key' => 'district',
            'meta_value' => $request->state,
        ]);
    }
    if ($user_city == 0) {
        DB::table('usermeta')->insert([
            'user_id' => $id,
            'meta_key' => 'city',
            'meta_value' => $request->city,
        ]);
    } else {
        DB::table('usermeta')->where('user_id', $id)->where('meta_key', 'city')->delete();
        DB::table('usermeta')->insert([
            'user_id' => $id,
            'meta_key' => 'city',
            'meta_value' => $request->city,
        ]);
    }

    if ($user_postcode == 0) {
        DB::table('usermeta')->insert([
            'user_id' => $id,
            'meta_key' => 'zip',
            'meta_value' => $request->zip,
        ]);
    } else {
        DB::table('usermeta')->where('user_id', $id)->where('meta_key', 'zip')->delete();
        DB::table('usermeta')->insert([
            'user_id' => $id,
            'meta_key' => 'zip',
            'meta_value' => $request->zip,
        ]);
    }
    $state = DB::table('terms')->where('term_id',$request->state)->select('name')->first();
    $city = DB::table('terms')->where('term_id',$request->city)->select('name')->first();
    $info = Cart::getContent();
    $post_date = date('Y-m-d 0:0:0)');
    $post_date_gmt = date('Y-m-d H:i:s', strtotime('+6 hour'));

    $totalOrder = DB::table('posts')->where('post_type', 'shop_order')->where('post_author', $id)->count();
    $postName = 'order-' . ($totalOrder + 1);

    $order = array(
        'post_title' => 'Order' . date('Y-m-d H:i:s'),
        'post_status' => 'on-hold',
        'post_name' => $postName,
        'post_password' => 'order_1247',
        'post_date' => $post_date,
        'post_date_gmt' => $post_date_gmt,
        'post_type' => 'shop_order',
        'post_author' => $id,
    );
    $order_id = DB::table('posts')->insertGetId($order);
    $order_post = array(
        'post_id' => $order_id,
        'meta_key' => 'first_name',
        'meta_value' => $request->first_name,
    );
    DB::table('postmeta')->insert($order_post);
    $order_post = array(
        'post_id' => $order_id,
        'meta_key' => 'last_name',
        'meta_value' => $request->last_name,
    );
    DB::table('postmeta')->insert($order_post);
    $order_post = array(
        'post_id' => $order_id,
        'meta_key' => 'address_one',
        'meta_value' => $request->address_one,
    );
    DB::table('postmeta')->insert($order_post);
    $order_post = array(
        'post_id' => $order_id,
        'meta_key' => 'address_two',
        'meta_value' => $request->address_two,
    );
    DB::table('postmeta')->insert($order_post);
    $order_post = array(
        'post_id' => $order_id,
        'meta_key' => 'phone',
        'meta_value' => $request->phone,
    );
    DB::table('postmeta')->insert($order_post);
    $order_post = array(
        'post_id' => $order_id,
        'meta_key' => 'email',
        'meta_value' => $request->email,
    );
    DB::table('postmeta')->insert($order_post);
    $order_post = array(
        'post_id' => $order_id,
        'meta_key' => 'country',
        'meta_value' => $request->country,
    );
    DB::table('postmeta')->insert($order_post);
    $order_post = array(
        'post_id' => $order_id,
        'meta_key' => 'state',
        'meta_value' => $state->name,
    );
    DB::table('postmeta')->insert($order_post);
    $order_post = array(
        'post_id' => $order_id,
        'meta_key' => 'city',
        'meta_value' => $city->name,
    );
    DB::table('postmeta')->insert($order_post);
    $order_post = array(
        'post_id' => $order_id,
        'meta_key' => 'zip',
        'meta_value' => $request->zip,
    );
    DB::table('postmeta')->insert($order_post);
    $order_post = array(
        'post_id' => $order_id,
        'meta_key' => '_customer_user',
        'meta_value' => $id,
    );
    DB::table('postmeta')->insert($order_post);
    $order_post = array(
        'post_id' => $order_id,
        'meta_key' => '_billing_postcode',
        'meta_value' => $request->zip,
    );
    DB::table('postmeta')->insert($order_post);
    $order_post = array(
        'post_id' => $order_id,
        'meta_key' => '_billing_company',
        'meta_value' => $request->_billing_company,
    );
    DB::table('postmeta')->insert($order_post);
    $order_post = array(
        'post_id' => $order_id,
        'meta_key' => '_billing_last_name',
        'meta_value' => $request->lastName,
    );
    DB::table('postmeta')->insert($order_post);
    $order_post = array(
        'post_id' => $order_id,
        'meta_key' => '_billing_first_name',
        'meta_value' => $request->firstName,
    );
    DB::table('postmeta')->insert($order_post);
    $order_post = array(
        'post_id' => $order_id,
        'meta_key' => 'payment_method',
        'meta_value' => $request->paymentMethod,
    );
    DB::table('postmeta')->insert($order_post);

    if (Auth::check()) {
        $info = DB::table('user_cart')->where('user_id', auth()->user()->id)->get();
    } else {
        $info = Cart::getContent();
    }
    foreach ($info as $key => $item) {
            //if product attribute not found then stock minus from default stock quantity 
        $pro = DB::table('postmeta')->where('post_id', $item->id)->where('meta_key', 'default_qty')->get();
        foreach ($pro as $pros) {
            $ac_qty = $pros->meta_value;
            $customer_qty = $item->quantity;
            $tot_qty = $ac_qty - $customer_qty;
            DB::table('postmeta')->where('post_id', $item->id)->where('meta_key', 'default_qty')->update([
                'meta_value' => $tot_qty,
            ]);
        }

        $pro_two = DB::table('postmeta')->where('post_id', $item->id)->where('meta_key', 'attribute_stock')->get();
        foreach ($pro_two as $pros) {
            $ac_qty = $pros->meta_value;
            $customer_qty = $item->quantity;
            $tot_qty = $ac_qty - $customer_qty;
            DB::table('postmeta')->where('post_id', $item->id)->where('meta_key', 'attribute_stock')->update([
                'meta_value' => $tot_qty,
            ]);
        }
            //if user login then price calculate from db otherwise session
        if (Auth::check()) {
            $tot_pri = $item->quantity * $item->actual_price;
        } else {
            $tot_pri = $item->quantity * $item->price;
        }
        $check_id = DB::table('posts')
        ->where('ID', $item->id)
        ->select('ID', 'post_parent')
        ->first();

        if ($check_id->post_parent==0) {
            $p_id = $check_id->ID;
        } else {
            $p_id = $check_id->post_parent;
        }

        //product_cost
        $cost_product=DB::table('postmeta')->where('post_id',$p_id)->where('meta_key','product_stock')->first();

        $order_item = array(
            'order_item_name' => $item->name,
            'order_item_type' => 'line-item',
            'order_id' => $order_id,
            'product_id' => $item->id,
            'product_parent' => $p_id,
        );
        $order_item_id = DB::table('order_items')->insertGetId($order_item);



        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => '_tax_class',
            'meta_value' => '',
            'customer_id' => $id,
            'order_id' => $order_id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id,
        );
        DB::table('order_itemmeta')->insert($order_item_details);


        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => '_qty',
            'meta_value' => $item->quantity,
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id,
        );
        DB::table('order_itemmeta')->insert($order_item_details);
        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => '_product_id',
            'meta_value' => $item->id,
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id,
        );
        DB::table('order_itemmeta')->insert($order_item_details);
        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => '_variation_id',
            'meta_value' => '',
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id,
        );
        DB::table('order_itemmeta')->insert($order_item_details);

        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => 'order_actual_cost',
            'meta_value' => $cost_product->meta_value,
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id,
        );
        DB::table('order_itemmeta')->insert($order_item_details);

        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => 'order_product_cost',
            'meta_value' => $cost_product->meta_value*$item->quantity,
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id,
        );
        DB::table('order_itemmeta')->insert($order_item_details);


        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => '_line_subtotal',
            'meta_value' => $tot_pri,
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id,
        );
        DB::table('order_itemmeta')->insert($order_item_details);


        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => '_line_total',
            'meta_value' => $tot_pri,
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id,
        );
        DB::table('order_itemmeta')->insert($order_item_details);
        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => '_line_subtotal_tax',
            'meta_value' => '',
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id,
        );
        DB::table('order_itemmeta')->insert($order_item_details);
        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => '_line_tax',
            'meta_value' => '',
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id,
        );
        DB::table('order_itemmeta')->insert($order_item_details);
            // $_line_tax_data=date('Y-m-d H:i:s');
        $_line_tax_data_gmt = date('Y-m-d H:i:s', strtotime('+6 hour'));
        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => '_line_tax_data',
            'meta_value' => $_line_tax_data_gmt,
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id,
        );
        DB::table('order_itemmeta')->insert($order_item_details);
        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => 'delivery_charge',
            'meta_value' => $dcharge,
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id,
        );
        DB::table('order_itemmeta')->insert($order_item_details);

        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => 'coupon_code',
            'meta_value' => $request->promo_code,
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id,
        );
        DB::table('order_itemmeta')->insert($order_item_details);

        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => 'coupon_taka',
            'meta_value' => $coupon_taka,
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id,
        );
        DB::table('order_itemmeta')->insert($order_item_details);

        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => 'attribute_parent',
            'meta_value' => $item->id,
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id,
        );
        DB::table('order_itemmeta')->insert($order_item_details);
            // if($request->paymentMethod=='DeliveryChargeOnly'){
            //    $order_item_details=array(
            //     'order_item_id'=>$order_item_id,
            //     'meta_key'=>'customer_pay_delivery_charge',
            //     'meta_value'=>$dcharge,
            //     'order_id'=>$order_id,
            //     'customer_id'=>$id,
            //     'order_date'=>date('Y-m-d'),
            //   );
            //  DB::table('order_itemmeta')->insert($order_item_details);
            // }


        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => 'user_district',
            'meta_value' => $dist_name->name,
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id,
        );
        DB::table('order_itemmeta')->insert($order_item_details);

        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => 'user_city',
            'meta_value' => $city_name->name,
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id,
        );
        DB::table('order_itemmeta')->insert($order_item_details);

        $order_item_details = array(
            'order_item_id' => $order_item_id,
            'meta_key' => 'user_zip',
            'meta_value' => $zip_code,
            'order_id' => $order_id,
            'customer_id' => $id,
            'order_date' => date('Y-m-d'),
            'product_id' => $item->id,
            'product_parent' => $p_id,
        );
        DB::table('order_itemmeta')->insert($order_item_details);
    }
    if (Auth::check()) {
        DB::table('user_cart')->where('user_id', auth()->user()->id)->delete();
    } else {
        Cart::clear();
    }

    $name = $request->first_name;
    $email = $request->email;
    $subject = 'Order Confirmation';
    Mail::send('mail', ['name' => $name, 'order_id' => $order_id], function($message) use ($email, $subject) {
        $message->from('order@bigshotstyle.com', 'Bigshot');
        $message->to($email)->subject($subject);
    });
    return redirect()->route('order.success');
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {

        for ($i = 0; $i < count($request->product_id); $i++) {
            $product_id = $request->product_id[$i];
            $qty = $request->quantity[$i];


            $default_pro = DB::table('postmeta')
            ->where('post_id', $request->product_id[$i])
            ->where('meta_key', 'default_qty')
            ->first();

            if (isset($default_pro)) {
                $ac_qty_default = $default_pro->meta_value;
                if ($qty > $ac_qty_default) {
                    return back()->with('status_error_update', 'Quantity not exists');
                }
            }

            $attribute_pro = DB::table('postmeta')
            ->where('post_id', $request->product_id[$i])
            ->where('meta_key', 'attribute_stock')
            ->first();

            if (isset($attribute_pro)) {
                $ac_qty_att = $attribute_pro->meta_value;
                if ($qty > $ac_qty_att) {
                    return back()->with('status_error_update', 'Quantity not exists');
                }
            }
            Cart::update($product_id, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $qty
                ),
            ));
            if (Auth::check()) {
                $user_id = auth()->user()->id;
                $current_price = DB::table('user_cart')
                ->where('user_id', $user_id)
                ->where('id', $product_id)
                ->select('actual_price')
                ->first();
                DB::table('user_cart')
                ->where('user_id', $user_id)
                ->where('id', $product_id)
                ->update([
                    'quantity' => $qty,
                    'price' => $qty * $current_price->actual_price,
                    'actual_price' => $current_price->actual_price,
                ]);
            }
        }
          session()->flash("success","Item quantity has been update"); 
          return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function remove($id) {
        Cart::remove($id);
        if (Auth::check()) {
            $user_id = auth()->user()->id;
            DB::table('user_cart')
            ->where('user_id', $user_id)
            ->where('id', $id)
            ->delete();
        }
         session()->flash("error","Item deleted from cart"); 
         return back();
    }

    //promo code ajax
    public function applyPromocode($code) {


        $count = DB::table('coupons')
        ->where('coupon_code', $code)
        ->where('status', 1)
        ->where('expire_date', '>=', date('Y-m-d'))
        ->select('coupon_code', 'coupon_amount', 'coupon_type')
        ->count();
        if ($count > 0) {
            $data = DB::table('coupons')
            ->where('coupon_code', $code)
            ->where('status', 1)
            ->where('expire_date', '>=', date('Y-m-d'))
            ->select('coupon_code', 'coupon_amount', 'coupon_type')
            ->get();
        } else {
            $data = 0;
        }
        return response()->json($data);
    }

}
