<?php
use App\Http\Middleware\checklogin;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('test','test@index');
Route::get('test2','test@index2');

Route::namespace('Admin')->group(function () {
    Route::get('/',                             'admin_controller@login');
    
    Route::get('/logout',                       'admin_controller@logout');
    Route::post('/login',                       'admin_controller@check_login');
    
});
Route::group(['prefix' => 'admin','namespace'=>'Admin','middleware'=>'checklogin'], function () {
 Route::get('/signup',                       'admin_controller@signup');
 Route::post('/dangky',                       'admin_controller@dangky');
 Route::get('/',				                  'admin_controller@index');
 Route::get('/history',                       'admin_controller@history');
 Route::get('/staff',                         'admin_controller@staff');
 Route::get('/staff-edit/{id}',               'admin_controller@edit');
 Route::get('/staff-profile/{id}',            'admin_controller@profile');
 Route::get('/staff-delete/{id}',             'admin_controller@delete');
 Route::post('/staff-update',                 'admin_controller@update');

 Route::get ('/category'    ,                 'category_controller@index');
 Route::get ('/category-add',                 'category_controller@add')->middleware('checklogin');
 Route::post('/category-insert',              'category_controller@insert');
 Route::get ('/category-edit/{id}',           'category_controller@edit');
 Route::post('/category-update',              'category_controller@update');
 Route::get ('/category-delete/{id}',         'category_controller@delete');
 Route::get ('/get-data-api',                 'category_controller@get_data_api');
   // CATEGORY----------------------------------------------------------------------------------------------------------------------------

 Route::get ('/order'    ,                    'order_controller@index');
 Route::get ('/order-add'    ,                'order_controller@add');
 Route::post('/order-search',                 'order_controller@fetch')->name('autocomplete.fetch');
 Route::post('/order-search-gia',             'order_controller@fetch_gia')->name('autocomplete.fetch2');
 Route::post('/order-api-quan',               'order_controller@get_api_quanhuyen');
 Route::post('/order-api-product',            'order_controller@get_api_product');
 Route::post('/order-insert',                 'order_controller@insert_order');
 Route::get ('/searchajax',                   ['as'=>'searchajax','uses'=>'order_controller@searchResponse']);
 Route::get ('/order-detail',                 'order_controller@order_detail')->name('order_detail');

   Route::get ('/api-order-all',                'order_controller@order_api_all');//return các đơn----------------------------------------
   Route::get ('/api-order-allv2',              'order_controller@order_api_allv2');//return sp trong 1 đơn-------------------------------
   Route::get ('/api-order-dhvc',               'order_controller@order_api_dhvc');//return các đơn status=shipping,received--------------
   Route::get ('/api-order-shipping',           'order_controller@order_api_shipping');//return các đơn status=shipping-------------------
   Route::get ('/api-order-dnh',                'order_controller@order_api_dnh');//return các đơn status=received------------------------
   Route::get ('/api-order-dhht',               'order_controller@order_api_dhht');//return các đơn status=Done,ReturnOK-------------------
   Route::get ('/api-order-dnt',                'order_controller@order_api_dnt');//return các đơn status=Done---------------------------
   Route::get ('/api-order-dnl',                'order_controller@order_api_dnl');//return các đơn status=ReturnOK---------------------------
   Route::get ('/api-order-dhsc',               'order_controller@order_api_dhsc');//return các đơn status=Returning, Complain---------------------------
   Route::get ('/api-order-ch',                 'order_controller@order_api_ch');//return các đơn status=Returning---------------------------
   Route::get ('/api-order-kn',                 'order_controller@order_api_kn');//return các đơn status=Complain---------------------------

   Route::post('/api-change-orderStatus',       'order_controller@order_api_changeStatus');//change status=Received-----------------------
   Route::post('/api-change-orderStatusv2',     'order_controller@order_api_changeStatusv2');//changen status=DONE,update report-----
   Route::post('/api-change-orderStatusv3',     'order_controller@order_api_changeStatusv3');//changen status=RETURNING-----
   Route::post('/api-change-orderStatusv4',     'order_controller@order_api_changeStatusv4');//changen status=COMPLAIN-----
   Route::post('/api-change-orderStatusv5',     'order_controller@order_api_changeStatusv5');//changen status=RETUNROK-----
   
   Route::post('/api-edit-order',               'order_controller@order_api_edit');//edit Order-----

   Route::get ('/count-order-all',              'order_controller@count_order_all');
   Route::get ('/count-order-ship-and-received','order_controller@count_order_ship_and_received');
   Route::get ('/count-order-shipping',         'order_controller@count_order_shipping');
   
   Route::get ('/count-order-done_and_returnok',             'order_controller@count_order_done_and_returnok');
   Route::get ('/count-order-done',             'order_controller@count_order_done');
   Route::get ('/count-order-returnok',         'order_controller@count_order_returnok');
   Route::get ('/count-order-returning-and-complain',         'order_controller@count_order_returning_and_complain');
   Route::get ('/count-order-returning',             'order_controller@count_order_returning');
   Route::get ('/count-order-complain',              'order_controller@count_order_complain');
   Route::post ('/api-selected-orderShip',      'order_controller@api_selected_orderShip');
   Route::post ('/api-selected-orderStatus',    'order_controller@api_selected_orderStatus');

   Route::post('/api-selected-channel' ,         'order_controller@api_selected_channel');
   Route::get('/search-order',                   'order_controller@searchOrderNumber');
   Route::get ('/count-order-completed',         'order_controller@count_order_completed');
   Route::get ('/count-order-received',          'order_controller@count_order_received');
   Route::get('/count-order-completed-received', 'order_controller@count_order_completed_received');
   Route::get('/count-order-cancle-return',      'order_controller@count_order_cancle_return');
   Route::get('/count-order-shipping-ready',     'order_controller@count_order_shipping_ready');



   //ORDER-------------------------------------------------------------------------------------------------------------------

   Route::get ('/product-type',  	            'product_type_controller@index');
   Route::get ('/product-type-add',             'product_type_controller@add');
   Route::post('/product-type-insert',          'product_type_controller@insert');
   Route::get ('/product-type-edit/{id}',       'product_type_controller@edit');
   Route::post('/product-type-update',          'product_type_controller@update');
   Route::get ('/product-type-delete/{id}',     'product_type_controller@delete');

   //PRODUCT TYPE-----------------------------------------------------------------------------------------------------------

   Route::get ('/product',			               'product_controller@index');
   Route::get ('/product-instock',              'product_controller@instock');
   Route::get ('/product-done',                 'product_controller@done');
   Route::get ('/product-add',			         'product_controller@add');
   Route::post('/product-insert',               'product_controller@insert');
   Route::get ('/product-edit/{id}',            'product_controller@edit');
   Route::post('/product-update',               'product_controller@update');
   Route::get ('/product-delete/{id}',          'product_controller@delete');
   Route::get ('/best-selling',                 'product_controller@best_selling');
   Route::post('/product-get-cost',             'product_controller@get_cost')->name('product.getcost');
   Route::get ('/product-searchajax',           ['as'=>'product-searchajax','uses'=>'product_controller@searchResponse']);//auto

   Route::get('/variation/{sku}',                   'product_controller@variation');

   //PRODUCT----------------------------------------------------------------------------------------------------------------

   Route::get ('/product-variation',                      'product_variation@index');


   Route::get ('/customer',                     'customer_controller@index');
   Route::get ('/customer-table',               'customer_controller@table');
   Route::get ('/customer-profile/{id}',        'customer_controller@profile');
   Route::get ('/customer-edit/{id}',           'customer_controller@edit');
   Route::post ('/customer-update',             'customer_controller@update');
   Route::get ('/customer-table',               'customer_controller@table');
   Route::get ('/customer-delete/{id}',               'customer_controller@delete');



   Route::get ('/statistic',                    'statistic_controller@index');
   Route::get ('/statistic_month',              'statistic_controller@month');
   Route::get ('/statistic-month-order/{month}',        'statistic_controller@month_order');
   Route::get ('/chart-month',                  ['as'=>'chart-month','uses'=>'statistic_controller@chart_month']);//auto

   Route::get ('/expense',                      'expense_controller@index');
   Route::post('/expense-insert',               'expense_controller@insert');
   Route::get ('/expense-edit/{id}',            'expense_controller@edit');
   Route::post('/expense-update',               'expense_controller@update');
   Route::get ('/expense-delete/{id}',          'expense_controller@delete');

   Route::get ('/import',			                  'import_controller@index');
   Route::get ('/import-add',			              'import_controller@add');

   Route::get('/phuong', 'test_controller@getToken');  
   Route::get('/test-getorderlist', 'test_controller@test_getorderlist');  
   Route::get('/test-adddb', 'test_controller@test_adddb');  
   Route::get('/testshopee', 'test_controller@test_shopee');

});






Route::group(['prefix' => 'sendo','namespace'=>'Sendo'], function () {
  // Route::get('/getSendoToken', 'OrderController@testSendo');  
  Route::get('/add-new-order',            'OrderController@addNewOrder'); 
  Route::get('/update-order-except-done', 'OrderController@updateOrderExceptDone'); //sẽ có 1 event gọi ra cái ni click nút update đơn hàng đã có gì đó
  Route::get('/add-product-order',        'OrderController@getProductFromOrder'); 
  Route::get('/get-region' ,              'OrderController@getRegionsSendo');
  
  Route::get('/get-product-list',         'ProductController@getProductList');
  Route::get('/get-product-detail',       'ProductController@getProductDetail');
  Route::get('/update-product' ,          'ProductController@updateAllProduct');

  Route::get('/123',                      'ProductController@updateProduct');

  Route::get('/confirm-order-sendo/{orderID}' , 'OrderController@confirmOrderSendo');

  Route::get('/update-report-thang', 'OrderController@update_report_thang');  
});





Route::get('/noti', function () {
    return view('welcome');
});




Route::get('/send', 'SendMessageController@index')->name('send');
Route::post('/postMessage', 'SendMessageController@sendMessage')->name('postMessage');

Route::group(['prefix' => 'shopee','namespace'=>'Shopee'], function () {
  // Route::get('/getSendoToken', 'OrderController@testSendo');  
  Route::get('test', 'ProductController@getProductList');
  Route::get('test2', 'ProductController@getProductDetail');
  Route::get('test3', 'OrderController@getOrderList');
  Route::get('test4', 'OrderController@getOrderDetail');
  Route::get('test5', 'OrderController@getEscrowDetails');


  Route::get('add', 'OrderController@addNewOrder');
  Route::get('/update-order-except-done' , 'OrderController@updateOrderExceptDone');
});