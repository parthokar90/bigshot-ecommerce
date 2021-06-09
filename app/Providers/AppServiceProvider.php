<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Model\front\Post;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Schema::defaultStringLength(191);
      $pending_order=Post::where(['posts.post_type'=>'shop_order','post_status'=>'on-hold'])
      ->whereBetween('post_date', [date('Y-m-01'), date('Y-m-t')])
      ->count();
     view()->share('pending_order',$pending_order);
      $processing_order = Post::where(['posts.post_type' => 'shop_order', 'post_status' => 'processing'])
       ->whereBetween('post_modified', [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')])
      ->count();
       view()->share('processing_order',$processing_order);
      $dispatch_order = Post::where(['posts.post_type' => 'shop_order', 'post_status' => 'dispatch'])
      ->whereBetween('post_modified', [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')])
      ->count();
       view()->share('dispatch_order',$dispatch_order);
      $delivered_order = Post::where(['posts.post_type' => 'shop_order', 'post_status' => 'delivered'])
      ->whereBetween('post_modified', [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')])
      ->count();
       view()->share('delivered_order',$delivered_order);
      $cancelled_order = Post::where(['posts.post_type' => 'shop_order', 'post_status' => 'cancelled'])
      ->whereBetween('post_modified', [date('Y-m-01 00:00:00'), date('Y-m-t 23:59:59')])
      ->count();
       view()->share('cancelled_order',$cancelled_order);
      $total_order_admin=Post::where(['posts.post_type'=>'shop_order'])
      ->whereBetween('post_date', [date('Y-m-01'), date('Y-m-t')])
      ->count();
      view()->share('total_order_admin',$total_order_admin);
    }
}
