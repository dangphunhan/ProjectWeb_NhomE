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
Route::get('/usersJson',['as' => 'user.email.json','uses' =>'UserController@getUserJson']);
Route::get('/userProjectJson/{id}',['as' => 'user.project.json','uses' =>'UserController@getProjectUserJson']);
Route::get('/{slug}/users',['as' => 'users.index','uses' =>'UserController@index']);
Route::get('/{slug}/users/invite',['as' => 'users.invite','uses' =>'UserController@invite']);
Route::put('/{slug}/users/invite',['as' => 'users.invite.update','uses' =>'UserController@inviteUser']);
Route::get('/{slug}/users/edit/{id}',['as' => 'users.edit','uses' =>'UserController@edit']);
Route::put('/{slug}/users/update/{id}',['as' => 'users.update','uses' =>'UserController@update']);
Route::delete('/{slug}/users/{id}',['as' => 'users.remove','uses' =>'UserController@removeUser']);

Route::get('/my-account',['as' => 'users.my.account','uses' =>'UserController@account']);
Route::post('/my-account',['as' => 'update.account','uses' =>'UserController@update']);
Route::post('/my-account/password',['as' => 'update.password','uses' =>'UserController@updatePassword']);
Route::delete('/my-account',['as' => 'delete.avatar','uses' =>'UserController@deleteAvatar']);

//Home
Route::get('/','HomeController@index');
Route::get('/{slug?}', ['as' => 'home','uses' =>'HomeController@index']);

