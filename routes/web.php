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

Route::get('/','frontend\HomeController@index')->name('home');

Route::get('/products','frontend\ProductsController@index')->name('frontend.products.list');
Route::get('/product_filter','frontend\ProductsController@product_filter')->name('frontend.products.product_filter');
Route::get('/single/{id}','frontend\ProductsController@single')->name('frontend.products.single');
Route::get('/getRegister','frontend\AccountController@getRegister')->name('frontend.account.getRegister');
Route::post('/postRegister','frontend\AccountController@postRegister')->name('frontend.account.postRegister');
Route::get('/getlogin','frontend\AccountController@getlogin')->name('frontend.account.getlogin');
Route::post('/postlogin','frontend\AccountController@postlogin')->name('frontend.account.postlogin');
Route::group(['middleware'=>'profile'],function(){
	Route::get('/profile','frontend\AccountController@profile')->name('frontend.account.profile')->middleware('profile');
	Route::get('/update_profile','frontend\AccountController@update_profile')->name('frontend.account.update_profile');
	Route::post('/check_password','frontend\AccountController@check_password')->name('frontend.account.check_password');
	Route::get('/logout','frontend\AccountController@logout')->name('frontend.account.logout');
	Route::get('/history_order','frontend\AccountController@history_order')->name('frontend.account.history_order');
	Route::get('/history_detail/{id}','frontend\AccountController@history_detail')->name('frontend.account.history_detail');
});

Route::post('/add_comment','frontend\ProductsController@add_comment')->name('frontend.products.add_comment');
Route::post('/add_sub_comment','frontend\ProductsController@add_sub_comment')->name('frontend.products.add_sub_comment');
Route::post('/show_more','frontend\ProductsController@show_more')->name('frontend.products.show_more');
Route::post('/like','frontend\ProductsController@like')->name('frontend.products.like');
Route::post('/dislike','frontend\ProductsController@dislike')->name('frontend.products.dislike');
Route::post('/add_cart','frontend\CartsController@add_cart')->name('frontend.cart.add_cart');
Route::get('/checkout','frontend\CartsController@checkout')->name('frontend.cart.checkout');
Route::post('/update_cart','frontend\CartsController@update_cart')->name('frontend.cart.update_cart');
Route::get('/delete_cart','frontend\CartsController@delete_cart')->name('frontend.cart.delete_cart');
Route::get('/process_to_buy','frontend\CartsController@process_to_buy')->name('frontend.cart.process_to_buy')->middleware('order');
Route::post('/order','frontend\CartsController@order')->name('frontend.cart.order')->middleware('profile');




Route::group(['prefix'=>'admin'],function(){
	Route::get('/','admin\HomeController@index')->name('admin')->middleware('login');
	Route::post('/login','admin\UsersController@login')->name('admin.login');

	Route::group(['middleware'=>'admin'],function(){
		Route::group(['prefix'=>'categories'],function(){
		Route::get('/','admin\CategoriesController@index')->name('admin.categories.list');
		Route::get('/create','admin\CategoriesController@create')->name('admin.categories.insert');
		Route::post('/store','admin\Categoriescontroller@store')->name('admin.categories.store');
		Route::get('/edit/{id}','admin\Categoriescontroller@edit')->name('admin.categories.edit');
		Route::post('/update/{id}','admin\Categoriescontroller@update')->name('admin.categories.update');
		Route::get('/update/delete','admin\Categoriescontroller@delete')->name('admin.categories.delete');
		Route::get('/search','admin\CategoriesController@search')->name('admin.categories.search');
	});


	Route::group(['prefix'=>'products'],function(){
		Route::get('/','admin\ProductsController@index')->name('admin.products.list');
		Route::get('/create','admin\ProductsController@create')->name('admin.products.create');
		Route::post('/store','admin\ProductsController@store')->name('admin.products.store');
		Route::get('/edit/{id}','admin\ProductsController@edit')->name('admin.products.edit');
		Route::post('/update/{id}','admin\ProductsController@update')->name('admin.products.update');
		Route::get('/delete','admin\ProductsController@delete')->name('admin.products.delete');
		Route::get('/search','admin\ProductsController@search')->name('admin.products.search');
		Route::get('/edit_sub_image','admin\ProductsController@edit_sub_image')->name('admin.products.edit_sub_image');
		Route::post('update_sub_image','admin\ProductsController@update_sub_image')->name('admin.products.update_sub_image');
		Route::get('/edit_size','admin\ProductsController@edit_size')->name('admin.products.edit_size');
		Route::post('/update_size','admin\ProductsController@update_size')->name('admin.products.update_size');

	});

	Route::group(['prefix'=>'users'],function(){
		Route::get('/index','admin\UsersController@index')->name('admin.users.list');
		Route::get('/create','admin\UsersController@create')->name('admin.users.create');
		Route::post('/store','admin\UsersController@store')->name('admin.users.store');
		
		Route::get('/logout','admin\UsersController@logout')->name('admin.users.logout');
		Route::get('/profile/{id}','admin\UsersController@profile')->name('admin.users.profile');
		Route::post('/update_profile','admin\UsersController@update_profile')->name('admin.users.update_profile');
		Route::post('/change_password','admin\UsersController@change_password')->name('admin.users.change_password');
		Route::post('/check_password','admin\UsersController@check_password')->name('admin.users.check_password');
	});

	Route::group(['prefix'=>'permission'],function(){
		Route::get('/index','admin\PermissionController@index')->name('admin.permission.list');
		Route::post('/store','admin\PermissionController@store')->name('admin.permission.store');
	});

	Route::group(['prefix'=>'comments'],function(){
		Route::get('/index','admin\CommentsController@index')->name('admin.comments.list');
	});

	Route::group(['prefix'=>'orders'],function(){
		Route::get('/index','admin\OrdersController@index')->name('admin.orders.list');
		Route::post('/search','admin\OrdersController@search')->name('admin.orders.search');
		Route::get('/details/{id}','admin\OrdersController@details')->name('admin.orders.details');
		Route::post('/confirm/{id}','admin\OrdersController@confirm')->name('admin.orders.confirm');
	});	
	});
	

});
