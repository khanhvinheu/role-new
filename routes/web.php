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
Route::get('errors-403', function() {
    return view('errors.403');
});
Route::group(['namespace' => 'Admin'], function() {

    Route::group(['namespace' => 'Auth'], function() {
        Route::get('/', 'LoginController@login')->name('user.login');
        Route::post('/', 'LoginController@postLogin');
        Route::get('/register', 'RegisterController@getRegister')->name('user.register');
        Route::post('/register', 'RegisterController@postRegister');
        Route::get('/logout', 'LoginController@logout')->name('user.logout');
        Route::get('/forgot/password', 'ForgotPasswordController@forgotPassword')->name('admin.forgot.password');
    });

    Route::group(['middleware' =>['auth']], function() {
        Route::get('/home', 'HomeController@index')->name('home');

        Route::group(['prefix' => 'group-permission'], function(){
            Route::get('/','GroupPermissionController@index')->name('group.permission.index');
            Route::get('/create','GroupPermissionController@create')->name('group.permission.create');
            Route::post('/create','GroupPermissionController@store');

            Route::get('/update/{id}','GroupPermissionController@edit')->name('group.permission.update');
            Route::post('/update/{id}','GroupPermissionController@update');

            Route::get('/delete/{id}','GroupPermissionController@destroy')->name('group.permission.delete');
        });

        Route::group(['prefix' => 'permission'], function(){
            Route::get('/','PermissionController@index')->name('permission.index');
            // ->middleware('permission:danh-sach-quyen|quan-tri-all');
            Route::get('/create','PermissionController@create')->name('permission.create');
            // ->middleware('permission:them-quyen|quan-tri-all');
            Route::post('/create','PermissionController@store');

            Route::get('/update/{id}','PermissionController@edit')->name('permission.update');
            // ->middleware('permission:sua-quyen|quan-tri-all');
            Route::post('/update/{id}','PermissionController@update');

            Route::get('/delete/{id}','PermissionController@delete')->name('permission.delete');
            // ->middleware('permission:xoa-quyen|quan-tri-all');
        });

        Route::group(['prefix' => 'role'], function(){
            Route::get('/','RoleController@index')->name('role.index');
            // ->middleware('permission:xem-danh-sach-vai-tro|quan-tri-all');
            Route::get('/create','RoleController@create')->name('role.create');
            // ->middleware('permission:them-moi-vai-tro|quan-tri-all');
            Route::post('/create','RoleController@store');

            Route::get('/update/{id}','RoleController@edit')->name('role.update');
            Route::post('/update/{id}','RoleController@update');

            Route::get('/delete/{id}','RoleController@delete')->name('role.delete');
        });

        Route::group(['prefix' => 'user'], function(){
            Route::get('/','UserController@index')->name('user.index');
            Route::get('/create','UserController@create')->name('user.create');
            Route::post('/create','UserController@store');

            Route::get('/update/{id}','UserController@edit')->name('user.update');
            Route::post('/update/{id}','UserController@update');

            Route::get('/delete/{id}','UserController@delete')->name('user.delete');
        });
    });
});

