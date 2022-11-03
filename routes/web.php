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


// Workspace
Route::post('/workspace',['as' => 'add_workspace','uses' =>'WorkspaceController@store'])->middleware(['auth','XSS']);
Route::delete('/workspace/{id}',['as' => 'delete_workspace','uses' =>'WorkspaceController@destroy'])->middleware(['auth','XSS']);
Route::delete('/workspace/leave/{id}',['as' => 'leave_workspace','uses' =>'WorkspaceController@leave'])->middleware(['auth','XSS']);
Route::get('/workspace/{id}',['as' => 'change_workspace','uses' =>'WorkspaceController@changeCurrantWorkspace'])->middleware(['auth','XSS']);
Route::get('/workspace/{slug}/change_lang/{lang}',['as' => 'change_lang_workspace','uses' =>'WorkspaceController@changeLangWorkspace'])->middleware(['auth','XSS']);
Route::get('/workspace/{slug}/lang/create',['as' => 'create_lang_workspace','uses' =>'WorkspaceController@createLangWorkspace'])->middleware(['auth','XSS']);
Route::get('/workspace/{slug}/lang/{lang}',['as' => 'lang_workspace','uses' =>'WorkspaceController@langWorkspace'])->middleware(['auth','XSS']);
Route::post('/workspace/{slug}/lang/{lang}',['as' => 'store_lang_data_workspace','uses' =>'WorkspaceController@storeLangDataWorkspace'])->middleware(['auth','XSS']);
Route::post('/workspace/{slug}/lang',['as' => 'store_lang_workspace','uses' =>'WorkspaceController@storeLangWorkspace'])->middleware(['auth','XSS']);
