<?php
namespace App\Http\Controllers;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Helpers\CustomHelper;


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


// Route::get('/', function () {
//     return view('welcome');
// });

//Route::any('/', 'HomeController@index');







Route::match(['get', 'post'], '/user-logout', 'Auth\LoginController@logout');











$ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();

Route::match(['get', 'post'], 'admin/login', 'Admin\LoginController@index');



// Admin
Route::group(['namespace' => 'Admin', 'prefix' => $ADMIN_ROUTE_NAME, 'as' => $ADMIN_ROUTE_NAME.'.', 'middleware' => ['authadmin']], function() {

    Route::get('/logout', 'LoginController@logout')->name('logout');

    Route::match(['get','post'],'/profile', 'HomeController@profile')->name('profile');

    Route::match(['get','post'],'/change-password', 'HomeController@change_password')->name('change_password');

    Route::get('/', 'HomeController@index')->name('home');

    //Route::get('/profile', 'HomeController@profile')->name('profile');




    Route::group(['prefix' => 'settings', 'as' => 'settings', 'middleware' => ['allowedmodule:settings'] ], function() {

        Route::match(['get', 'post'], '/{setting_id?}', 'SettingsController@index')->name('.index');
        //Route::any('/{setting_id}', 'SettingsController@index')->name('.index');
    });


////BusinessCategoryController
    Route::group(['prefix' => 'businesscategory', 'as' => 'businesscategory' , 'middleware' => ['allowedmodule:businesscategory'] ], function() {

        Route::get('/', 'BusinessCategoryController@index')->name('.index');
        Route::match(['get', 'post'], 'add', 'BusinessCategoryController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'BusinessCategoryController@add')->name('.edit');
        Route::post('ajax_delete_image', 'BusinessCategoryController@ajax_delete_image')->name('.ajax_delete_image');
        Route::match(['get','post'],'delete/{id}', 'BusinessCategoryController@delete')->name('.delete');
    });


////BusinessCategoryController
    Route::group(['prefix' => 'category', 'as' => 'category' , 'middleware' => ['allowedmodule:category'] ], function() {

        Route::get('/', 'CategoryController@index')->name('.index');
        Route::match(['get', 'post'], 'add', 'CategoryController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'CategoryController@add')->name('.edit');
        Route::post('ajax_delete_image', 'CategoryController@ajax_delete_image')->name('.ajax_delete_image');
        Route::match(['get','post'],'delete/{id}', 'CategoryController@delete')->name('.delete');
    });
    

////Vendors
    Route::group(['prefix' => 'vendors', 'as' => 'vendors' , 'middleware' => ['allowedmodule:vendors'] ], function() {

        Route::get('/', 'VendorController@index')->name('.index');
        Route::match(['get', 'post'], 'add', 'VendorController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'VendorController@add')->name('.edit');
        Route::post('ajax_delete_image', 'VendorController@ajax_delete_image')->name('.ajax_delete_image');
        Route::match(['get','post'],'delete/{id}', 'VendorController@delete')->name('.delete');
        Route::match(['get','post'],'get_slug', 'VendorController@get_slug')->name('.get_slug');

        Route::match(['get','post'],'working-hour/{ven_id}', 'VendorController@working_hour')->name('.working-hour');




    });


////Users
    Route::group(['prefix' => 'users', 'as' => 'users' , 'middleware' => ['allowedmodule:users'] ], function() {

        Route::get('/', 'UsersController@index')->name('.index');
        Route::match(['get', 'post'], 'add', 'UsersController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'UsersController@add')->name('.edit');
        Route::post('ajax_delete_image', 'UsersController@ajax_delete_image')->name('.ajax_delete_image');
        Route::match(['get','post'],'delete/{id}', 'UsersController@delete')->name('.delete');
    });


////Collections
    Route::group(['prefix' => 'collections', 'as' => 'collections' , 'middleware' => ['allowedmodule:collections'] ], function() {

        Route::get('/', 'CollectionController@index')->name('.index');
        Route::match(['get', 'post'], 'add', 'CollectionController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'CollectionController@add')->name('.edit');
        Route::post('ajax_delete_image', 'CollectionController@ajax_delete_image')->name('.ajax_delete_image');
        Route::match(['get','post'],'delete/{id}', 'CollectionController@delete')->name('.delete');
    });



////coupon
    Route::group(['prefix' => 'coupon', 'as' => 'coupon' , 'middleware' => ['allowedmodule:coupons'] ], function() {

        Route::get('/', 'CouponController@index')->name('.index');
        Route::match(['get', 'post'], 'add', 'CouponController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'CouponController@add')->name('.edit');
        Route::post('ajax_delete_image', 'CouponController@ajax_delete_image')->name('.ajax_delete_image');
        Route::match(['get','post'],'delete/{id}', 'CouponController@delete')->name('.delete');
        Route::match(['get','post'],'get_category', 'CouponController@get_category')->name('.get_category');
        Route::match(['get','post'],'details/{coup_id}', 'CouponController@details')->name('.details');
        Route::match(['get','post'],'add_image/{coup_id}', 'CouponController@add_image')->name('.add_image');

        Route::match(['get','post'],'add_products/{coup_id}', 'CouponController@add_products')->name('.add_products');
        Route::match(['get','post'],'delete_img/{image_id}', 'CouponController@delete_img')->name('.delete_img');



    });




/////////////readymade Products

    Route::group(['prefix' => 'readymadeproducts', 'as' => 'readymadeproducts' , 'middleware' => ['allowedmodule:readymadeproducts'] ], function() {

        Route::get('/', 'ReadyMadeController@index')->name('.index');
        Route::match(['get', 'post'], 'add', 'ReadyMadeController@add')->name('.add');


        Route::match(['get', 'post'], 'edit/{id}', 'ReadyMadeController@add')->name('.edit');
        Route::match(['get', 'post'], 'image-gallery/{id}', 'ReadyMadeController@add_image')->name('.add_image');


        Route::post('ajax_delete_image', 'ReadyMadeController@ajax_delete_image')->name('.ajax_delete_image');


        Route::match(['get','post'],'delete/{id}', 'ReadyMadeController@delete')->name('.delete');
    });


 Route::group(['prefix' => 'orders', 'as' => 'orders' , 'middleware' => ['allowedmodule:orders'] ], function() {

        Route::get('/{type}/{id}', 'OrderController@index')->name('.index');
        Route::match(['get', 'post'], 'add', 'OrderController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'OrderController@add')->name('.edit');
        Route::post('ajax_delete_image', 'OrderController@ajax_delete_image')->name('.ajax_delete_image');
        Route::post('delete/{id}', 'OrderController@delete')->name('.delete');
    });




	 // CMS Pages
    Route::group(['prefix' => 'cms', 'as' => 'cms' , 'middleware' => ['allowedmodule:cms'] ], function() {

        Route::get('/', 'CmsController@index')->name('.index');
        Route::match(['get', 'post'], 'add', 'CmsController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'CmsController@add')->name('.edit');
        Route::post('ajax_delete_image', 'CmsController@ajax_delete_image')->name('.ajax_delete_image');
        Route::post('delete/{id}', 'CmsController@delete')->name('.delete');
    });

    
});


// if(isset($segments_arr[0])){
//     Route::get('/{slug}', 'HomeController@cmsPage');
// }



$segments_arr = request()->segments();

if(isset($segments_arr[0])){
    Route::get('/{slug}', 'HomeController@index');
}


Route::match(['get', 'post'], '/otp_login', 'Auth\LoginController@otp_login');

Route::get('/account/login', 'Auth\LoginController@index');
Route::get('/account/register', 'Auth\LoginController@register');

Route::post('/account/register', 'Auth\LoginController@register')->name('user.register');

Route::post('/account/login', 'Auth\LoginController@index')->name('user.login');

Route::match(['get','post'],'/add_to_cart/', 'HomeController@add_to_cart')->name('add_to_cart')->middleware('auth:appusers');
Route::match(['get','post'],'/cart_minus/', 'HomeController@cart_minus')->name('cart_minus')->middleware('auth:appusers');
Route::match(['get','post'],'/cart_plus/', 'HomeController@cart_plus')->name('cart_plus')->middleware('auth:appusers');
Route::match(['get','post'],'/delete_cart_item/', 'HomeController@delete_cart_item')->name('delete_cart_item')->middleware('auth:appusers');


Route::match(['get','post'],'/search-coupons/', 'HomeController@secrch_suggest')->name('secrch_suggest');



Route::group(['prefix' => '{slug}', 'as' => '{slug}' , 'middleware' => ['auth:appusers'] ], function() {
  Route::get('/cart', 'HomeController@get_cart')->name('home.cart');
  Route::match(['get','post'],'/edit-profile', 'HomeController@edit_profile')->name('user.profile_edit');

  Route::match(['get','post'],'/upload-image', 'HomeController@upload');
  Route::match(['get','post'],'/order-success/', 'HomeController@place_order')->name('order-success');
  Route::get('/profile', 'HomeController@profile')->name('home.profile');

  Route::get('/orders/{status}', 'HomeController@order_list')->name('home.order_list');

  Route::match(['get','post'],'/order-details/{id}', 'HomeController@order_details');

  Route::match(['get','post'],'/change-password/', 'HomeController@change_password');


});

  Route::post('/cancel-order/', 'HomeController@cancel_order');




Route::group(['prefix' => '{slug}', 'as' =>'{slug}'], function() {

    Route::get('/purchase', 'HomeController@purchase')->name('home.purchase');
    Route::get('/winer-list', 'HomeController@winer_list')->name('home.winer-list');
    Route::get('/offers', 'HomeController@offers')->name('home.offers');
    Route::get('/merchant', 'HomeController@merchant')->name('home.merchant');



    Route::get('/search', 'HomeController@search')->name('home.search');
    Route::get('/search', 'HomeController@search')->name('home.search');

    Route::get('/category', 'HomeController@category_list')->name('home.category');
    
    


    Route::match(['get','post'],'/coupons/{id}', 'HomeController@coupon_listing')->name('coupon_listing');



    Route::match(['get','post'],'/products/{id}', 'HomeController@product_listing')->name('product_listing');

    Route::match(['get','post'],'/all-category/', 'HomeController@all_coupon_cat')->name('all_coupon_cat');

    





});



    Route::get('/{slug}/{category_id}', 'HomeController@index');
