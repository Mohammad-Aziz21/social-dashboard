<?php

use App\Models\User;
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

// Route::get('test', function(){
//     User::create([
//         'name' => 'Admin',
//         'email' => 'admin@admin.com',
//         'username' => 'admin',
//         'password' => '12345678',
//         'role_id' => 1,
//         'image' => 'default.jpg'
//     ]);
// });


Route::group(['namespace' => 'App\Http\Controllers'], function()
{

    Route::group(['middleware' => ['guest']], function() {

        Route::get('login', 'LoginController@show')->name('login');
        Route::post('login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {

        Route::get('/', 'OperatorController@index')->name('operator.index');
        Route::post('operator', 'OperatorController@store')->name('operator.store');

        Route::get('customer', 'CustomerController@index')->name('customer.index');
        Route::post('customer', 'CustomerController@store')->name('customer.store');

        Route::get('record', 'RecordController@index')->name('record.index');
        Route::post('record', 'RecordController@store')->name('record.store');

        Route::get('type', 'TypeController@index')->name('type.index');
        Route::post('type', 'TypeController@store')->name('type.store');

        Route::get('logout', 'LogoutController@perform')->name('logout.perform');
    });
});