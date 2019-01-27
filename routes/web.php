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

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/login', 'UserController@getLoginAdmin');
Route::post('admin/login', 'UserController@postLoginAdmin');
Route::get('admin/logout', 'UserController@getLogoutAdmin');

Route::group(['prefix' => 'admin', 'middleware'=>'adminLogin'], function () {
    Route::group(['prefix' => 'theloai'], function () {
        Route::get('list', 'TheLoaiController@getList');
        Route::get('add', 'TheLoaiController@getAdd');
        Route::post('add', 'TheLoaiController@postAdd');
        Route::get('edit/{id}', 'TheLoaiController@getEdit');
        Route::post('edit/{id}', 'TheLoaiController@postEdit');
        Route::get('delete/{id}', 'TheLoaiController@getDelete');
    });
    Route::group(['prefix' => 'loaitin'], function () {
        Route::get('list', 'LoaiTinController@getList');
        Route::get('add', 'LoaiTinController@getAdd');
        Route::post('add', 'LoaiTinController@postAdd');
        Route::get('edit/{id}', 'LoaiTinController@getEdit');
        Route::post('edit/{id}', 'LoaiTinController@postEdit');
        Route::get('delete/{id}', 'LoaiTinController@getDelete');
    });
    Route::group(['prefix' => 'tintuc'], function () {
        Route::get('list', 'TinTucController@getList');
        Route::get('add', 'TinTucController@getAdd');
        Route::post('add', 'TinTucController@postAdd');
        Route::get('edit/{id}', 'TinTucController@getEdit');
        Route::post('edit/{id}', 'TinTucController@postEdit');
        Route::get('delete/{id}', 'TinTucController@getDelete');
    });
    Route::group(['prefix' => 'comment'], function () {
        Route::get('delete/{idComment}/{idTinTuc}', 'CommentController@getDelete');
    });
    Route::group(['prefix' => 'slide'], function () {
        Route::get('list', 'SlideController@getList');
        Route::get('add', 'SlideController@getAdd');
        Route::post('add', 'SlideController@postAdd');
        Route::get('edit/{id}', 'SlideController@getEdit');
        Route::post('edit/{id}', 'SlideController@postEdit');
        Route::get('delete/{id}', 'SlideController@getDelete');
    });
    Route::group(['prefix' => 'user'], function () {
        Route::get('list', 'UserController@getList');
        Route::get('add', 'UserController@getAdd');
        Route::post('add', 'UserController@postAdd');
        Route::get('edit/{id}', 'UserController@getEdit');
        Route::post('edit/{id}', 'UserController@postEdit');
        Route::get('delete/{id}', 'UserController@getDelete');
    });
    Route::group(['prefix' => 'ajax'], function () {
        Route::get('loaitin/{idTheLoai}', 'AjaxController@getLoaiTin');
    });
});

Route::get('home', 'PageController@home');
Route::get('contact', 'PageController@contact');
Route::get('category/{id}/{TenKhongDau}.html', 'PageController@category');
Route::get('tintuc/{id}/{TenKhongDau}.html', 'PageController@tintuc');
Route::get('login', 'PageController@getLogin');
Route::post('login', 'PageController@postLogin');
Route::get('logout', 'PageController@getLogout');
Route::get('account', 'PageController@getAccount');
Route::post('account', 'PageController@postAccount');
Route::get('register', 'PageController@getRegister');
Route::post('register', 'PageController@postRegister');
Route::get('search', 'PageController@getSearch');
Route::post('search', 'PageController@postSearch');
Route::post('comment/{id}', 'CommentController@postComment');
