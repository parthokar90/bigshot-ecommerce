<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Clear Cache facade value:
Route::get('/cc', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Cashe</h1>';
});

  Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
  Route::get('/callback/{provider}', 'SocialController@callback');
  Auth::routes();

Route::group(['middleware' => 'role:admin'], function() {
    Route::resource('/user','UserController');
    Route::resource('/role','RoleController');
});
   
    Route::group(['namespace'=>'Front'],function(){
        Route::post('user-register','PageController@userRegister')->name('user_registration');
        Route::get('apply/promocode/ajax/{code}','CartController@applyPromocode');
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('posts', 'HomeController@index');
        Route::get('/product/{id}/{title}','PageController@productView')->name('product-page');
        Route::get('/att/{id}/{product_id}','PageController@att_value');
        Route::get('/atts/{id}/{product_id}','PageController@atts_value');
        Route::get('/only/{id}/{product_id}','PageController@only');
        Route::get('/pickup-tab','PageController@pickupTab')->name('pickup.tab');
        Route::get('/recent','PageController@recent')->name('recent');
        Route::get('/brands','PageController@brands')->name('brands');
        Route::get('/popular','PageController@popular')->name('popular');
        Route::get('/categories/product/{id}','PageController@categoryProduct')->name('category.product');
        Route::get('/tag/product/{id}', 'PageController@tagProduct')->name('tag.product.show');
        Route::get('/cart','CartController@cart')->name('cart');

        Route::get('/cart1','CartController@cart1')->name('cart1');

        Route::get('/shipping','CartController@shipping')->name('shipping');

        Route::post('/shippingInfo','CartController@shippingInfo')->name('shippingInfo');

        Route::get('/review','CartController@review')->name('review');
        Route::post('/applyCopon','CartController@applyCopon')->name('applyCopon');
        
        Route::get('/payment','CartController@payment')->name('payment');
        Route::post('/saveOrder','CartController@saveOrder')->name('saveOrder');
        
        Route::get('/cart_new','CartController@cart_new')->name('cart_new');

        Route::get('/district/city/{id}', 'CartController@districtCityAjax');
        Route::get('/district/city/postcode/{id}', 'CartController@districtCityPostcode');
        Route::get('/profile','PageController@profile')->middleware('auth')->name('profile');

        Route::get('/wishlist','PageController@wishlist')->middleware('auth')->name('user_wish');
        Route::get('/wishlist/product/{id}','PageController@wishlistProduct')->middleware('auth');
        Route::get('/wishlist/delete/{id}','PageController@wishlistDelete')->middleware('auth')->name('wishlist_delete');

        Route::get('/order-history','PageController@OrderHistory')->name('order.history');
        Route::get('/order-success','PageController@OrderSuccess')->name('order.success');
        Route::get('/daily-login-bonus','PageController@DailyLoginBonus')->name('daily.bonus');
        Route::get('/rewards','PageController@rewards')->name('rewards');
        Route::get('/cash','PageController@cash')->name('cash');
        Route::get('/faq','PageController@faq')->name('faq');
        Route::get('/privacy','PageController@privacy')->name('privacy');
        Route::get('/terms&conditions','PageController@termsconditions')->name('terms.conditions');
        Route::get('/about','PageController@about')->name('about');
        Route::get('/return-policy','PageController@returnPolicy')->name('return.policy');
        Route::get('/settings','PageController@settings')->name('settings');
        Route::get('/customer-support','PageController@customerSupport')->middleware('auth')->name('customer.support');
        Route::get('/p_cancel_order/{id}','PageController@p_cancel_ajax')->middleware('auth');
        Route::get('/f_cancel_order/{id}','PageController@f_cancel_ajax')->middleware('auth');


        Route::post('/addCart','CartController@addCart')->name('addCart');
        Route::post('/checkout','CartController@checkout')->name('checkout');
        Route::post('/cart_update','CartController@update')->name('cart.update');
        Route::get('/remove/{id}','CartController@remove')->name('remove');     
    });

    Route::group(['namespace'=>'user'],function(){
        Route::post('account_deactive','UserController@d_account')->name('deactive_acc');
        Route::resource('/order-list','OrderController')->middleware('auth');
        Route::resource('user/profile','UserController');
        Route::get('user/profile/chnage/{id}','PageController@passwordEdit')->name('password.edit');
        Route::post('user/profile/chnage/{id}','PageController@passwordUpdate')->name('password.update');
        Route::post('quiry','QuiryController@generalQuiry')->name('genarelQuiry');

        Route::post('support/all/aorder/cancel','QuiryController@support_all_cancel_order')->name('s_cancel');
        Route::get('/customer/order/details/{id}','OrderController@edit')->name('customer_ordere_edit')->middleware('auth');
        Route::get('/customer/order/invoice/download/{id}','OrderController@order_invoice_download')->name('customer_invoice_download')->middleware('auth');
        Route::get('/customer/order/cancel/{id}','OrderController@cancel_order_details')->name('customer_ordere_cancel')->middleware('auth');
        Route::post('/customer/order/cancel/item', 'OrderController@cancel_order_item')->name('customer_order_cancel_item')->middleware('auth');
        Route::post('/customer/order/cancel/item/full', 'OrderController@cancel_order_item_full')->name('customer_order_cancel_item_full')->middleware('auth');
    });
       
    Route::group(['namespace'=>'Search'],function(){
        Route::get('/search/item','SearchController@SearchItem');
    });

    Route::group(['namespace'=>'Admin'],function(){       
        
        Route::get('/option/','ProductController@optionList')->name('deliver_option');
        Route::post('/option/update/{id}','ProductController@optionUpdate')->name('deliver_option_update');
        Route::post('/option/store/','ProductController@optionStore')->name('deliver_option_store');

        Route::get('att/status/{id}/{status}/{product_id}','ProductController@att_status_update');
        Route::get('gallery/product/delete/{id}','ProductController@gallery_image_delete')->name('gallery_delete');
        Route::get('attribute/stock','ProductController@varient_stock')->name('attribute_stock');
        Route::post('attribute/stock/add','ProductController@attributeStockAdd')->name('attribute_stock_add');
        Route::post('attribute/stock/update','ProductController@attributeStockupdate')->name('attribute_stock_update');
        Route::get('database/backup','SettingsController@databaseBackup')->name('database_backup');
        Route::get('all/dispatch/complete/order','OrderController@allDispatchcomplete')->name('all_dispatch_complete');
        Route::resource('coupon','CouponController');
        Route::get('gross/profit/monthly','QuickReportController@gross_profit_monthly')->name('g_profit_monthly');
        Route::get('profit/year','QuickReportController@profit_yearly')->name('g_profit_y');
        Route::get('best/sell/yearly','QuickReportController@best_sell_yearly')->name('b_sell_yearly');
        Route::post('search/pending/order','OrderController@search_pending_order')->name('s_pending_order');
        Route::get('search/pending/order','OrderController@search_pending_order')->name('s_pending_order');
        Route::GET('admin-login','Auth\LoginController@showLoginForm')->name('admin.login');
        Route::POST('admin-login','Auth\LoginController@login');
        Route::get('admin/home','HomeController@index')->name('admin.home');
        Route::resource('admin/category','CategoryController');
        Route::resource('admin/tag','TagController');
        Route::resource('admin/brand','BrandController');
        Route::resource('admin/attribute','AttributeController');
        Route::resource('admin/product','ProductController');
        Route::resource('admin/order','OrderController');
        Route::get('admin/pendingOrder','OrderController@pendingOrder')->name('order.pendingOrder');
        Route::get('admin/pendingOrderAll','OrderController@pendingOrderAll')->name('order.pendingOrderAll');
        Route::get('admin/district/thana/postcode','SettingsController@index')->name('district.thana.postcode');
        Route::post('admin/district/store','SettingsController@districtStore')->name('district.store');
        Route::post('admin/thana/store','SettingsController@thanaStore')->name('thana.store');
        Route::get('admin/district/edit/{id}','SettingsController@districtEdit')->name('district.edit');
        Route::post('admin/district/update/{id}','SettingsController@districtUpdate')->name('district.update');
        Route::get('admin/thana/update/{dist_id}/{thana_id}','SettingsController@thanaEdit')->name('thana.update');
        Route::post('admin/district/thana/post_code/update/{thana_id}','SettingsController@districtThanaPostcodeUpdate')->name('district.thana.postcode.update');
        Route::get('admin/todayPendingOrder','OrderController@todayPendingOrder')->name('todayPendingOrder');
        Route::get('admin/pendingOrderByDate/{day}','OrderController@pendingOrderByDate')->name('pendingOrderByDate');

        Route::get('admin/processingOrderByDate/{day}','OrderController@processingOrderByDate')->name('processingOrderByDate');
        Route::get('admin/pendingOrder/processing','OrderController@processing')->name('order.processing');
        Route::get('admin/pendingOrder/processingAll','OrderController@processingAll')->name('all_processing');

        Route::get('admin/pendingOrder/dispat','OrderController@dispat')->name('order.dispat');
        Route::get('admin/pendingOrder/dispatall','OrderController@dispatAll')->name('order.dispatall');
        Route::get('admin/pendingOrder/dispatchByDate/{day}','OrderController@dispatchByDate')->name('dispatchByDate');

        Route::get('admin/pendingOrder/print','OrderController@print')->name('pendingOrder.print');
        Route::get('admin/pendingOrder/cancelled','OrderController@cancelled')->name('order.cancelled');
        Route::get('admin/sendparcel','OrderController@sendParcel')->name('order.sendParcel');
        Route::get('admin/allStatus','OrderController@allStatus')->name('order.allStatus');
        Route::get('allStatus/print/{id}', 'OrderController@allStatusPrint')->name('order.allStatus.print');
        Route::get('admin/deliveryInvoice/{id}','OrderController@deliveryInvoice')->name('order.deliveryInvoice');
        Route::get('admin/reject','OrderController@reject')->name('order.reject');
        Route::post('reject/product/update','OrderController@rejectProductUpdate')->name('reject.update');
        Route::get('admin/stock','OrderController@stock')->name('order.stock');
        Route::get('admin/stock/lower','OrderController@lowerStock')->name('order.stock.lower');

        Route::get('admin/stockMove/{day}','OrderController@stockMove')->name('stockMove');
        // gross profit summary
        Route::get('admin/gross/summary','OrderController@grossSummary')->name('grossSummary');
        Route::post('admin/gross/summary/show','OrderController@grossSummaryShow')->name('grossSummaryShow');
          // gross profit summary

        Route::get('admin/stock/list/sold','OrderController@soldStock')->name('order.stock.old');
        Route::get('admin/grossProfit','OrderController@grossProfit')->name('order.grossProfit');
        Route::post('admin/grossProfit/report','QuickReportController@grossProfitShow')->name('order.grossProfit.report');
        Route::resource('admin/customer','CustomerController');

        Route::get('admin/customerQuery','CustomerController@customerQuery')->name('customer.customerQuery');

        Route::get('admin/queryReplay/{id}','CustomerController@queryReplay')->name('customer.queryReplay');
        Route::post('admin/replay','CustomerController@queryAnswer')->name('query.replay');

        Route::get('admin/attributeValue/{id}','AttributeController@attributeValue')->name('attribute.attributeValue');
        Route::POST('admin/attributeValueSave','AttributeController@attributeValueSave')->name('attributeValue.store');
        Route::get('admin/attributeValueEdit/{id}','AttributeController@attributeValueEdit')->name('attributeValue.edit');
        Route::PATCH('admin/attributeValueUpdate/{id}','AttributeController@attributeValueUpdate')->name('attributeValue.update');
        Route::get('admin/product/arttibuteValue/{id}','ProductController@attributeValue')->name('product.arttibuteValue');

        Route::get('admin/category/getType/{id}','CategoryController@getGroup')->name('category.getGroup');

        Route::POST('admin/product/store','ProductController@store')->name('product.store');
        // Route::get('admin/dispat','PageController@dispat')->name('dispat');
        Route::get('admin/quickReport','QuickReportController@index')->name('quickReport');
        Route::post('admin/order/status/update','OrderController@update')->name('update.order.status');
        Route::post('admin/order/update/qty', 'OrderController@updateOrderQty')->name('update.order.quantity');
        Route::post('admin/order/cancel/qty', 'OrderController@adminupdateOrderQty')->name('update.order.quantity.admin');


        Route::get('admin/quickReport/man_stock','QuickReportController@manStock')->name('man.stock');
        Route::get('admin/quickReport/search/category/wise/stock','QuickReportController@womenStock')->name('women.stock');
        Route::get('admin/quickReport/sales_report','QuickReportController@salesReport')
        ->name('sales.report');
        Route::get('admin/quickReport/delivery_report','QuickReportController@deliveryReport')->name('delivery.report');
        Route::get('admin/quickReport/reject_item','QuickReportController@rejectItem')->name('reject.item');
        Route::get('admin/quickReport/reject_item/search/','QuickReportController@rejectItemSearch')->name('reject.item.search.data');
        Route::get('admin/quickReport/reject_item/remove/{id}','QuickReportController@rejectItemRemove')->name('reject.item.remove.data');
        Route::get('stock_reject/remove/{date_id}/{qty_id}','QuickReportController@reject_qty_add')->name('stock_itemsss_remove');
        Route::get('admin/quickReport/best_selling_items','QuickReportController@bestSelling')->name('best.selling');
        Route::post('admin/quickReport/best_selling_items/search','QuickReportController@bestSellingSearch')->name('best.selling.search');
        Route::get('admin/quickReport/cancellation_items','QuickReportController@cancellationItems')->name('cancellation.items');
        Route::get('admin/quickReport/soldout_stock','QuickReportController@soldoutStock')->name('sold.stock');
        Route::get('admin/quickReport/best_customer','QuickReportController@bestCustomer')->name('best.customer');
        Route::get('admin/quickReport/best_customer/email/{email}','QuickReportController@bestCustomerSendEmail')->name('best.customer.send.email');
        Route::post('admin/quickReport/best_customer/email/data','QuickReportController@bestCustomerSendEmailData')->name('best.customer.send.email.data');
        Route::post('admin/quickReport/best_customer/search','QuickReportController@bestCustomerSearch')->name('best.customer.search');
        Route::get('admin/quickReport/gross_profit','QuickReportController@grossProfit')->name('gross.profit');
        Route::get('admin/quickReport/gross_profit/summary','QuickReportController@grossProfitSummary')->name('gross.profit.summary');
        Route::get('customer/edit/{id}','CustomerController@edit');
        Route::post('user/update','CustomerController@update')->name('user_update');
        //banner image route for home page
        Route::resource('/banner','BannerController');
        //pending order route
        Route::get('pending/order/print/{id}','OrderController@pending_order_print')->name('pending_order_print');
        Route::get('pending/order/processing/{id}','OrderController@pending_order_processing')->name('pending_order_processing');
        Route::get('pending/order/cancel/{id}','OrderController@pending_order_cancel')->name('pending_order_cancel');
        Route::get('order/edit/{id}','OrderController@pending_order_edit')->name('pending_order_edit');
        Route::get('order/return/{id}','OrderController@cancel_order_return')->name('cancel_order_edit');
        //pending order route
        //send parcel print route
         Route::post('send/parcel/print','OrderController@sendParcelPrint')->name('parcel_print');
         Route::post('send/parcel/search','OrderController@sendParcelSearch')->name('send.parcel.search');
         Route::get('send/parcel/remove/{id}','OrderController@sendParcelRemove')->name('send.parcel.search.remove');
        //send parcel print route
        //download shipping address
        Route::get('download/shipping/address/{id}','OrderController@downloadShippingAddress')->name('download.shipping.address');
        //excel dispatch
        Route::get('excel/dispatch', 'OrderController@excelDispatch')->name('order.excel.dispatch');
        Route::post('excel/dispatch/excel/download', 'OrderController@excelDispatchDownload')->name('order.excel.dispatch.download');
        //delivery invoice
        Route::get('delivery/invoice', 'OrderController@deliveryInvoiceOrder')->name('order.delivery.invoice');
        Route::get('delivered/order', 'OrderController@deliveredOrder')->name('order.deliver');
        Route::get('delivered/edit/{id}', 'OrderController@deliveredOrderEdit')->name('order.deliver.edit');
        Route::get('delivered/print/{id}', 'OrderController@deliveredOrderPrint')->name('order.deliver.print');

        Route::get('delivery/invoice/print/{id}', 'OrderController@deliveredInvoicePrint')->name('order.invoice.print');

        Route::get('delivery/invoice/printDelivery/{id}', 'OrderController@deliveredInvoicePrintDelivery')->name('order.invoice.printDelivery');

        Route::get('delivered/cancel/{id}', 'OrderController@deliveredOrderCancel')->name('order.deliver.cancel');
        Route::post('delivered/order/update', 'OrderController@updateDeliveryOrder')->name('order.deliver.update');
        Route::get('cancelled/order', 'OrderController@cancelledOrder')->name('order.cancelled');
        Route::post('cancelled/order/search', 'OrderController@cancelledOrderSearch')->name('order.cancelled.search');
        Route::get('cancelled/order/search', 'OrderController@cancelledOrderSearch')->name('order.cancelled.search');
        Route::get('cancelled/order/print/{id}', 'OrderController@cancelledOrderPrint')->name('order.cancelled.print');
        Route::get('processing/order/print/{id}', 'OrderController@processingOrderPrint')->name('order.processing.print');
        Route::get('processing/order/edit/{id}', 'OrderController@processingOrderEdit')->name('order.processing.edit');
        Route::get('processing/order/cancel/{id}', 'OrderController@processingOrderCancel')->name('order.processing.cancel');
        Route::get('processing/order/dispatch/{id}', 'OrderController@processingOrderDispatch')->name('order.processing.dispatch');
        Route::post('processing/order/date/wise', 'OrderController@processingOrderdatewise')->name('process.order.date.wise');
        Route::get('processing/order/date/wise', 'OrderController@processingOrderdatewise')->name('process.order.date.wise');
        Route::post('processing/order/update', 'OrderController@processingOrderUpdate')->name('process.order.update');
        Route::get('dispatch/order/edit/{id}', 'OrderController@dispatchOrderEdit')->name('order.dispatch.edit');
        Route::get('dispatch/order/deliver/{id}', 'OrderController@dispatchOrderDelivered')->name('order_dispatch_d');
        Route::get('dispatch/order/edit/{id}', 'OrderController@dispatchOrderEdit')->name('order.dispatch.edit');
        Route::get('dispatch/order/date/wise', 'OrderController@dispatchOrderdatewise')->name('dispatch.order.date.wise');
        Route::post('dispatch/order/cancel', 'OrderController@dispatchOrdercancel')->name('dispatch.order.cancel.type');
        Route::post('excel/dispatch/order/date/wise', 'OrderController@exceldispatchOrderdate')->name('excel.dispatch.order.date');
        Route::post('order/delivery/invoice/data', 'OrderController@deliveryInvoiceData')->name('order.delivery.invoice.data');
        Route::get('order/delivery/invoice/data', 'OrderController@deliveryInvoiceData')->name('order.delivery.invoice.data');
       
        Route::get('order/delivery/invoice/details/{id}', 'OrderController@deliveryInvoiceDataDetails')->name('order.delivery.invoice.data.details');
        Route::post('order/delivery/search/date', 'OrderController@deliveredSearch')->name('order.delivered.search');
        Route::get('order/delivery/search/date',  'OrderController@deliveredSearch')->name('order.delivered.search');
        Route::post('all/status/order/search', 'OrderController@allStatusSearch')->name('order.all.status.search');
        Route::get('all/status/order/search', 'OrderController@allStatusSearch')->name('order.all.status.search');
        Route::get('sku/download/{id}', 'ProductController@generateSku')->name('generate.sku');
        Route::get('stock/print/sticker/{id}', 'ProductController@stockPrintSticker')->name('stock.print.sticker');
        Route::post('stock/sku/search/', 'ProductController@stockSkuSearch')->name('stock.sku.search');
        Route::post('stock/sku/search/lower', 'ProductController@stockSkuSearchLower')->name('stock.sku.search.lower');
        Route::post('stock/sku/search/sold', 'ProductController@stockSkuSearchSold')->name('stock.sku.search.sold');
        Route::get('lower/stock/weekly', 'QuickReportController@lower_stock_weekly')->name('lower.stock.weekly');
        Route::get('sold/out/stock/weekly', 'QuickReportController@sold_out_stock_weekly')->name('sold.out.stock.weekly');
        Route::get('sold/out/stock/yearly', 'QuickReportController@sold_out_stock_yearly')->name('sold.out.stock.yearly');
        Route::get('best/sell/weekly', 'QuickReportController@best_sell_weekly')->name('best.sell.weekly');
    });