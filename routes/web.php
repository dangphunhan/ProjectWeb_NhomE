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
//Home
Route::get('/','HomeController@index')->middleware(['auth','XSS']);
Route::get('/{slug?}', ['as' => 'home','uses' => 'HomeController@index'])->middleware(['auth','XSS']);

