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

Route::get('/', function () {
    return view('homepage')->name('homepage');
});


Route::get('/keranjang','TokoController@cart')->name('cart');
Route::get('/pesan', 'TokoController@show')->name('show');

Route::get('/test', function(){
    return view('home');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/user/logout', 'Auth\LoginController@logoutUser')->name('user.logout');

Route::group(['prefix'=>'admin'], function(){
    Route::get('/login','AuthAdmin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login','AuthAdmin\LoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.home');
    Route::get('/logout', 'AuthAdmin\LoginController@logout')->name('admin.logout');
    Route::get('/password/reset','AuthAdmin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email','AuthAdmin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset/{token}','AuthAdmin\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/password/reset','AuthAdmin\ResetPasswordController@reset');
    Route::get('/toko','AdminController@toko')->name('admin.toko');
    Route::get('/toko/tambahmenu','AdminController@create')->name('menu.create');
    Route::post('/toko/tambahmenu','AdminController@store')->name('menu.store');
    Route::get('/toko/editmenu/{id}','AdminController@edit')->name('menu.edit');
    Route::patch('/toko/editmenu/{id}','AdminController@update')->name('menu.update');
    Route::delete('toko/delete/{id}','AdminController@destroy')->name('menu.destroy');
    Route::get('/order','AdminController@order')->name('order.ongoing');
    Route::patch('/order','AdminController@done')->name('order.done');
    Route::get('/riwayat','AdminController@orderdone')->name('order.history');

});

Route::get('/detail/{id}','TransaksiController@detail')->name('menu.detail');
Route::post('/detail/{id}','TransaksiController@store')->name('transaksi.store');
Route::get('/keranjang','TransaksiController@cart')->name('cart');

Route::post('/','AdminController@message')->name('message');