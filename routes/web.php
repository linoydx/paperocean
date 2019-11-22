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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/admin', function () {
//     return view('');
// });

// Route::get('/home', 'HomeController@index')->name('home');
Route::namespace('Admin')->group(function () {
	Route::any('/admin/login', 'LoginController@login')->name('admin.login');
	Route::get('/admin/verify', 'LoginController@verify');
	Route::get('/pri/top','PrivilegeController@getTopPris');
	Route::get('/cate/top','CategoryController@getTopCates');
	Route::group(['middleware'=>'check.login'],function() {
		Route::get('/admin/home', 'IndexController@index');
		Route::get('/admin/logout','LoginController@logout');
		Route::resource('admin','AdminController');
		Route::resource('role','RoleController');
		Route::resource('pri','PrivilegeController');
		Route::resource('cate','CategoryController');
		Route::resource('book','BookController');
		Route::post('/book/pic', 'BookController@uploadPic');
		Route::get('/role/{role_id}/pris','RoleController@getRolePris');
		// 图书信息相关路由
		Route::get('/bookinfo/{book_id}/check','BookinfoController@checkBookInfo');
		Route::get('/bookinfo/{book_id}/create','BookinfoController@create');
		Route::post('/bookinfo','BookinfoController@store');
		Route::get('/bookinfo/{book_id}/show','BookinfoController@show')->name('bookinfo.show');
		Route::get('/bookinfo/{info_id}/edit','BookinfoController@edit');
		Route::put('/bookinfo/{info_id}','BookinfoController@update');
	});
});

Route::namespace('Index')->group(function () {
	Route::any('/login', 'LoginController@login');
	Route::get('/logout', 'LoginController@logout');
	Route::any('/regist', 'LoginController@regist');
	Route::get('/', 'HomeController@index');
	Route::get('/person/{user_id}','HomeController@person');
	Route::post('/search','HomeController@search');
	// 用户操作路由
	Route::match(['get', 'post'],'/user/{user_id}/edit','UserController@edit');
	Route::post('/user/checkuser','UserController@checkuser');
	Route::get('/user/{user_id}/index','UserController@index');
	Route::get('/book/{book_id}/show','BookController@show');
	// 用户收货地址路由
	Route::get('/user/shipinfo/index','UserShipinfoController@index');
	Route::match(['get', 'post'],'/user/shipinfo/create','UserShipinfoController@edit');
	// 订单路由
	Route::get('order','OrderController@index');
	Route::post('/order','OrderController@store');
	Route::get('/order/{order_id}/edit','OrderController@edit');
	Route::put('/order/{order_id}', 'OrderController@update');
	Route::post('/order/{order_id}/setBook', 'OrderController@setOrderBook');
	// Route::get('/order/{order_id}/calculate','OrderController@calculatePay');
	Route::get('/order/{order_id}/test','OrderController@test');
});