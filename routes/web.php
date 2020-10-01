<?php

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


//Front Page
Route::get('/', 'HomeController@index');
Route::get('/product/{id}', 'HomeController@index');
Route::get('/product/details/{id}/{product_name}', 'HomeController@productDetails');
Route::get('/product/details/{id}', 'HomeController@productDetails2');
Route::get('/product/category/all', 'HomeController@category');
Route::get('/categories', 'HomeController@categoryAll');
Route::get('/product/category/{id}', 'HomeController@categiriseProducts');
Route::get('/404', 'HomeController@Error');

//Extra Pages
Route::get('/about', 'HomeController@about');
Route::get('/how-to', 'HomeController@howTo');
Route::get('/identify', 'HomeController@identify');
Route::get('/way', 'HomeController@way');
Route::get('/search', 'HomeController@search');

//Cart Code
Route::get('/cart/all', 'HomeController@cartAll');
Route::post('/cart/add', 'HomeController@addIntoCart');
Route::post('/cart/remove', 'HomeController@removeItem');


##--------------------------------Admin Part Start--------------------------------------##

//Customer  Login
Route::get('/product/quickview/{id}', 'HomeController@quickview');
Route::post('/product/cart/add', 'HomeController@addTocart');
Route::post('/product/cart/add-multiple', 'HomeController@addTocartMultiple');
Route::post('/product/cart/remove', 'HomeController@removeFromcart');
Route::get('/products/get-cart', 'HomeController@getCart');

//Add to Cart Laravel
Route::post('/product/cart-l/add', 'HomeController@addTocartMultiple');

//Customer
/*Route::get('/customer/checkout', 'CustomerController@checkout');*/
Route::get('/customer/checkout', 'CustomerController@cart');
Route::get('/customer/cart', 'CustomerController@cart');
Route::post('/customer/order/store', 'CustomerController@placeOrder');
Route::get('/customer/registration', 'CustomerController@register');
Route::post('/customer/register/store', 'CustomerController@customerStore');
Route::get('/customer/login', 'CustomerController@login');
Route::post('/customer/login-check', 'CustomerController@doLogin');
Route::get('/customer/logout', 'CustomerController@doLogout');
Route::post('/customer/profile', 'CustomerController@customerProfile');

//Delivery
Route::get('/admin/product/confirm/{invoice}', 'SellController@confirmed');
Route::get('/admin/product/delivery/{invoice}', 'SellController@delivery');
Route::get('/admin/product/received/{invoice}', 'SellController@received');
Route::get('/admin/product/cancel/{invoice}', 'SellController@cancel');
Route::get('/admin/product/details/{invoice}', 'SellController@details');

//Admin Start

Route::get('/admin/login', 'AdminLoginController@login');
Route::post('/admin/login-check', 'AdminLoginController@doLogin');
Route::get('/admin/logout', 'AdminLoginController@doLogout');


//Admin
Route::get('/admin/dashboard', 'AdminHomeController@index');
Route::post('/admin/address/save', 'AdminHomeController@addressSave');


//Products
Route::get('/admin/product/create', 'ProductController@create');
Route::post('/admin/product/store', 'ProductController@store');
Route::post('/admin/extra-product/store', 'ProductController@extrastore');
Route::get('/admin/product/show', 'ProductController@show');
Route::get('/admin/product/delete/{id}', 'ProductController@destroy');
Route::get('/admin/product/edit/{id}', 'ProductController@edit');
Route::post('/admin/product/update', 'ProductController@update');
Route::get('/admin/product/unpublish/{id}', 'ProductController@unPublish');
Route::get('/admin/product/publish/{id}', 'ProductController@publish');

Route::get('/admin/product/feature-remove/{id}', 'ProductController@featureRemove');
Route::get('/admin/product/feature/{id}', 'ProductController@feature');


//Product Categories

Route::get('/admin/product/category/new', 'CategoryController@create');
Route::post('/admin/product/category/store', 'CategoryController@store');
Route::get('/admin/product/category/show', 'CategoryController@show');
Route::get('/admin/product/category/delete/{id}', 'CategoryController@destroy');
Route::get('/admin/product/category/edit/{id}', 'CategoryController@edit');
Route::post('/admin/product/category/update', 'CategoryController@update');
//Parent Categories

Route::get('/admin/parent/category/create', 'ParentCategoryController@index');
Route::post('/admin/parent/category/store', 'ParentCategoryController@store');
Route::get('/admin/parent/category/show', 'ParentCategoryController@show');
Route::get('/admin/parent/category/delete/{id}', 'ParentCategoryController@destroy');
Route::get('/admin/parent/category/edit/{id}', 'ParentCategoryController@edit');
Route::post('/admin/parent/category/update', 'ParentCategoryController@update');

//Product Slider
Route::get('/admin/slider/create', 'SliderController@create');
Route::post('/admin/slider/store', 'SliderController@store');
Route::get('/admin/slider/show', 'SliderController@show');
Route::get('/admin/slider/delete/{id}', 'SliderController@destroy');
Route::get('/admin/slider/edit/{id}', 'SliderController@edit');
Route::post('/admin/slider/update', 'SliderController@update');
//DElivery Charge
Route::post('/admin/delivery-charge/store', 'DeliveryChargeController@store');
Route::get('/admin/delivery-charge/show', 'DeliveryChargeController@show');
Route::get('/admin/delivery-charge/delete/{id}', 'DeliveryChargeController@destroy');
Route::get('/admin/delivery-charge/edit/{id}', 'DeliveryChargeController@edit');
Route::post('/admin/delivery-charge/update', 'DeliveryChargeController@update');

//Client Quotes
Route::get('/admin/client/create', 'ClientController@create');
Route::post('/admin/client/store', 'ClientController@store');
Route::get('/admin/client/show', 'ClientController@show');
Route::get('/admin/client/delete/{id}', 'ClientController@destroy');

//Stock   Manage
Route::get('/admin/stock/show', 'ProductStockController@show');
Route::post('/admin/stock/store', 'ProductStockController@store');

//Sell
Route::any('/admin/sell/show', 'SellController@show');
Route::post('/admin/product/pay', 'SellController@pay');

//Promo
Route::get('/admin/promo/create', 'PromoController@create');
Route::post('/admin/promo/store', 'PromoController@store');
Route::get('/admin/promo/show', 'PromoController@show');
Route::get('/admin/promo/delete/{id}', 'PromoController@destroy');
Route::get('/admin/promo/inactive/{id}', 'PromoController@inactive');
Route::get('/admin/promo/active/{id}', 'PromoController@active');
Route::get('/admin/promo/edit/{id}', 'PromoController@edit');
Route::post('/admin/promo/update', 'PromoController@update');

//Setting

Route::get('/admin/setting', 'ShopController@index');
Route::post('/admin/shop/update', 'ShopController@update');


//Discount
Route::post('/admin/product/discount', 'SellController@discount');

//Promotional Slider
Route::get('/admin/promotion/show', 'PromotionSlideController@show');
Route::get('/admin/promotion/edit/{id}', 'PromotionSlideController@edit');
Route::post('/admin/promotion/update', 'PromotionSlideController@update');

//Customers
Route::get('/admin/customers', 'SellController@customerList');
Route::get('/admin/customer/edit/{id}', 'SellController@customerEdit');
Route::post('/customer/update', 'SellController@customerUpdate');

//Manage Admin
Route::get('/admin/create', 'AdminController@create');
Route::get('/admin/edit/{id}', 'AdminController@edit');
Route::post('/admin/store', 'AdminController@store');
Route::get('/admin/show', 'AdminController@show');
Route::get('/admin/delete/{id}', 'AdminController@destroy');

Route::get('/admin/profile', 'AdminController@profile');
Route::post('/admin/update', 'AdminController@update');


Route::get('/get-ip', function () {

    return Request::ip();

});
