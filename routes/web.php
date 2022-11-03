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

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

Auth::routes();

// User
Route::get('/my-account',['as' => 'users.my.account','uses' =>'UserController@account'])->middleware(['auth','XSS']);
Route::post('/my-account',['as' => 'update.account','uses' =>'UserController@update'])->middleware(['auth','XSS']);
Route::post('/my-account/password',['as' => 'update.password','uses' =>'UserController@updatePassword'])->middleware(['auth','XSS']);

//Home
Route::get('/','HomeController@index')->middleware(['auth','XSS']);
Route::get('/{slug?}', ['as' => 'home','uses' => 'HomeController@index'])->middleware(['auth','XSS']);
