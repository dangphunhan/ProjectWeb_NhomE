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
Route::get('/','HomeController@index');
Route::get('/{slug?}', ['as' => 'home','uses' =>'HomeController@index']);


// Workspace
Route::post('/workspace',['as' => 'add_workspace','uses' =>'WorkspaceController@store']);
Route::delete('/workspace/{id}',['as' => 'delete_workspace','uses' =>'WorkspaceController@destroy']);
Route::delete('/workspace/leave/{id}',['as' => 'leave_workspace','uses' =>'WorkspaceController@leave']);
Route::get('/workspace/{id}',['as' => 'change_workspace','uses' =>'WorkspaceController@changeCurrantWorkspace']);

