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
    Route::resource('users', UserController::class);

    Route::match(['get', 'post'], '/testsessions/datatables', 'TestSessionController@index_datatables')->name('testsessions.datatables');
    Route::resource('testsessions', TestSessionController::class);
});

// Route::get('/', 'HomeController@index')->name('home');
// Route::get('/blank', 'BlankController@index')->name('blank');
