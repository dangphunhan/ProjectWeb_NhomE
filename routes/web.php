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
Route::get('/usersJson',['as' => 'user.email.json','uses' =>'UserController@getUserJson'])->middleware(['auth','XSS']);
Route::get('/userProjectJson/{id}',['as' => 'user.project.json','uses' =>'UserController@getProjectUserJson'])->middleware(['auth','XSS']);
Route::get('/{slug}/users',['as' => 'users.index','uses' =>'UserController@index'])->middleware(['auth','XSS']);
Route::get('/{slug}/users/invite',['as' => 'users.invite','uses' =>'UserController@invite'])->middleware(['auth','XSS']);
Route::put('/{slug}/users/invite',['as' => 'users.invite.update','uses' =>'UserController@inviteUser'])->middleware(['auth','XSS']);
Route::get('/{slug}/users/edit/{id}',['as' => 'users.edit','uses' =>'UserController@edit'])->middleware(['auth','XSS']);
Route::put('/{slug}/users/update/{id}',['as' => 'users.update','uses' =>'UserController@update'])->middleware(['auth','XSS']);
Route::delete('/{slug}/users/{id}',['as' => 'users.remove','uses' =>'UserController@removeUser'])->middleware(['auth','XSS']);

Route::get('/my-account',['as' => 'users.my.account','uses' =>'UserController@account'])->middleware(['auth','XSS']);
Route::post('/my-account',['as' => 'update.account','uses' =>'UserController@update'])->middleware(['auth','XSS']);
Route::post('/my-account/password',['as' => 'update.password','uses' =>'UserController@updatePassword'])->middleware(['auth','XSS']);
Route::delete('/my-account',['as' => 'delete.avatar','uses' =>'UserController@deleteAvatar'])->middleware(['auth','XSS']);

//Home
Route::get('/','HomeController@index')->middleware(['auth','XSS']);
Route::get('/{slug?}', ['as' => 'home','uses' =>'HomeController@index'])->middleware(['auth','XSS']);


// Workspace
Route::post('/workspace',['as' => 'add_workspace','uses' =>'WorkspaceController@store'])->middleware(['auth','XSS']);
Route::delete('/workspace/{id}',['as' => 'delete_workspace','uses' =>'WorkspaceController@destroy'])->middleware(['auth','XSS']);
Route::delete('/workspace/leave/{id}',['as' => 'leave_workspace','uses' =>'WorkspaceController@leave'])->middleware(['auth','XSS']);
Route::get('/workspace/{id}',['as' => 'change_workspace','uses' =>'WorkspaceController@changeCurrantWorkspace'])->middleware(['auth','XSS']);

// project
Route::get('/{slug}/projects',['as' => 'projects.index','uses' =>'ProjectController@index'])->middleware(['auth','XSS']);
Route::get('/{slug}/projects/create',['as' => 'projects.create','uses' =>'ProjectController@create'])->middleware(['auth','XSS']);
Route::get('/{slug}/projects/{id}',['as' => 'projects.show','uses' =>'ProjectController@show'])->middleware(['auth','XSS']);
Route::post('/{slug}/projects',['as' => 'projects.store','uses' =>'ProjectController@store'])->middleware(['auth','XSS']);
Route::get('/{slug}/projects/edit/{id}',['as' => 'projects.edit','uses' =>'ProjectController@edit'])->middleware(['auth','XSS']);
Route::put('/{slug}/projects/{id}',['as' => 'projects.update','uses' =>'ProjectController@update'])->middleware(['auth','XSS']);
Route::delete('/{slug}/projects/{id}',['as' => 'projects.destroy','uses' =>'ProjectController@destroy'])->middleware(['auth','XSS']);
Route::delete('/{slug}/projects/leave/{id}',['as' => 'projects.leave','uses' =>'ProjectController@leave'])->middleware(['auth','XSS']);
Route::get('/{slug}/projects/invite/{id}',['as' => 'projects.invite.popup','uses' =>'ProjectController@popup'])->middleware(['auth','XSS']);
Route::put('/{slug}/projects/invite/{id}',['as' => 'projects.invite.update','uses' =>'ProjectController@invite'])->middleware(['auth','XSS']);

