<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', 'AuthController@index')->name('login');
Route::post('/login', 'AuthController@login');
Route::match(['get', 'post'], '/logout', 'AuthController@logout')->name('logout');

Route::get('/test', function () {
    phpinfo();
});

Route::group([
    'middleware' => 'auth',
], function ($router) {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/blank', 'BlankController@index')->name('blank');

    Route::match(['get', 'post'], '/users/datatables', 'UserController@index_datatables')->name('users.datatables');
    Route::get('/users/{id}/promosi/form', 'UserController@pengajuanPromosiForm')->name('users.promosi.form');
    Route::match(['post', 'put'], '/users/promosi', 'UserController@pengajuanPromosiPost')->name('users.promosi.post');
    Route::get('/users/{id}/setschedule/form', 'UserController@setScheduleForm')->name('users.setschedule.form');
    Route::post('/users/setschedule', 'UserController@setSchedulePost')->name('users.setschedule.post');
    Route::resource('users', UserController::class);

    Route::match(['get', 'post'], '/test/datatables', 'TestController@index_datatables')->name('test.datatables');
    Route::get('/test/wpt', 'TestController@wpt')->name('test.wpt');
    Route::get('/test/ist', 'TestController@ist')->name('test.ist');
    Route::get('/test/ist1', 'TestController@ist1')->name('test.ist1');
    Route::get('/test/ist2', 'TestController@ist2')->name('test.ist2');
    Route::get('/test/ist3', 'TestController@ist3')->name('test.ist3');
    Route::get('/test/ist4', 'TestController@ist4')->name('test.ist4');
    Route::get('/test/ist5', 'TestController@ist5')->name('test.ist5');
    Route::get('/test/ist6', 'TestController@ist6')->name('test.ist6');
    Route::get('/test/cfit', 'TestController@cfit')->name('test.cfit');
    Route::get('/test/cfit1', 'TestController@cfit1')->name('test.cfit1');
    Route::get('/test/cfit2', 'TestController@cfit2')->name('test.cfit2');
    Route::get('/test/cfit3', 'TestController@cfit3')->name('test.cfit3');
    Route::get('/test/cfit4', 'TestController@cfit4')->name('test.cfit4');
    Route::get('/test/papikostik', 'TestController@papikostik')->name('test.papikostik');
    Route::get('/user/test', 'TestController@test')->name('test.user');
    Route::resource('test', TestController::class);
});

// Route::get('/', 'HomeController@index')->name('home');
// Route::get('/blank', 'BlankController@index')->name('blank');
