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

//Home
Route::get('/','HomeController@index');
Route::get('/{slug?}', ['as' => 'home','uses' =>'HomeController@index']);


// Workspace
Route::post('/workspace',['as' => 'add_workspace','uses' =>'WorkspaceController@store']);
Route::delete('/workspace/{id}',['as' => 'delete_workspace','uses' =>'WorkspaceController@destroy']);
Route::delete('/workspace/leave/{id}',['as' => 'leave_workspace','uses' =>'WorkspaceController@leave']);
Route::get('/workspace/{id}',['as' => 'change_workspace','uses' =>'WorkspaceController@changeCurrantWorkspace']);

// project
Route::get('/{slug}/projects',['as' => 'projects.index','uses' =>'ProjectController@index']);
Route::get('/{slug}/projects/create',['as' => 'projects.create','uses' =>'ProjectController@create']);
Route::get('/{slug}/projects/{id}',['as' => 'projects.show','uses' =>'ProjectController@show']);
Route::post('/{slug}/projects',['as' => 'projects.store','uses' =>'ProjectController@store']);
Route::get('/{slug}/projects/edit/{id}',['as' => 'projects.edit','uses' =>'ProjectController@edit']);
Route::put('/{slug}/projects/{id}',['as' => 'projects.update','uses' =>'ProjectController@update']);
Route::get('/{slug}/searchJson/{search?}',['as' => 'search.json','uses' =>'ProjectController@getSearchJson']);
Route::delete('/{slug}/projects/{id}',['as' => 'projects.destroy','uses' =>'ProjectController@destroy']);
Route::delete('/{slug}/projects/leave/{id}',['as' => 'projects.leave','uses' =>'ProjectController@leave']);
Route::get('/{slug}/projects/invite/{id}',['as' => 'projects.invite.popup','uses' =>'ProjectController@popup']);
Route::get('/{slug}/projects/share/{id}',['as' => 'projects.share.popup','uses' =>'ProjectController@sharePopup']);
Route::post('/{slug}/projects/share/{id}',['as' => 'projects.share','uses' =>'ProjectController@share']);
Route::put('/{slug}/projects/invite/{id}',['as' => 'projects.invite.update','uses' =>'ProjectController@invite']);
Route::get('/{slug}/projects/milestone/{id}',['as' => 'projects.milestone','uses' =>'ProjectController@milestone']);
Route::post('/{slug}/projects/milestone/{id}',['as' => 'projects.milestone.store','uses' =>'ProjectController@milestoneStore']);
Route::get('/{slug}/projects/milestone/{id}/show',['as' => 'projects.milestone.show','uses' =>'ProjectController@milestoneShow']);
Route::get('/{slug}/projects/milestone/{id}/edit',['as' => 'projects.milestone.edit','uses' =>'ProjectController@milestoneEdit']);
Route::put('/{slug}/projects/milestone/{id}',['as' => 'projects.milestone.update','uses' =>'ProjectController@milestoneUpdate']);
Route::delete('/{slug}/projects/milestone/{id}',['as' => 'projects.milestone.destroy','uses' =>'ProjectController@milestoneDestroy']);
Route::post('/{slug}/projects/{id}/file',['as' => 'projects.file.upload','uses' =>'ProjectController@fileUpload']);
Route::get('/{slug}/projects/{id}/file/{fid}',['as' => 'projects.file.download','uses' =>'ProjectController@fileDownload']);
Route::delete('/{slug}/projects/{id}/file/delete/{fid}',['as' => 'projects.file.delete','uses' =>'ProjectController@fileDelete']);

// Task Board
Route::get('/{slug}/projects/client/task-board/{code}',['as' => 'projects.client.task.board','uses' =>'ProjectController@taskBoard']);
Route::get('/{slug}/projects/{id}/task-board',['as' => 'projects.task.board','uses' =>'ProjectController@taskBoard']);
Route::get('/{slug}/projects/{id}/task-board/create',['as' => 'tasks.create','uses' =>'ProjectController@taskCreate']);
Route::post('/{slug}/projects/{id}/task-board',['as' => 'tasks.store','uses' =>'ProjectController@taskStore']);
Route::put('/{slug}/projects/{id}/task-board/order',['as' => 'tasks.update.order','uses' =>'ProjectController@taskOrderUpdate']);
Route::get('/{slug}/projects/{id}/task-board/edit/{tid}',['as' => 'tasks.edit','uses' =>'ProjectController@taskEdit']);
Route::put('/{slug}/projects/{id}/task-board/{tid}',['as' => 'tasks.update','uses' =>'ProjectController@taskUpdate']);
Route::delete('/{slug}/projects/{id}/task-board/{tid}',['as' => 'tasks.destroy','uses' =>'ProjectController@taskDestroy']);
Route::get('/{slug}/projects/{id}/task-board/{tid}/{cid?}',['as' => 'tasks.show','uses' =>'ProjectController@taskShow']);

Route::post('/{slug}/projects/{id}/comment/{tid}/file/{cid?}',['as' => 'comment.store.file','uses' =>'ProjectController@commentStoreFile']);
Route::post('/{slug}/projects/{id}/comment/{tid}/{cid?}',['as' => 'comment.store','uses' =>'ProjectController@commentStore']);
Route::delete('/{slug}/projects/{id}/comment/{tid}/{cid}',['as' => 'comment.destroy','uses' =>'ProjectController@commentDestroy']);
Route::post('/{slug}/projects/{id}/sub-task/{tid}/{cid?}',['as' => 'subtask.store','uses' =>'ProjectController@subTaskStore']);
Route::put('/{slug}/projects/{id}/sub-task/{stid}',['as' => 'subtask.update','uses' =>'ProjectController@subTaskUpdate']);
Route::delete('/{slug}/projects/{id}/sub-task/{stid}',['as' => 'subtask.destroy','uses' =>'ProjectController@subTaskDestroy']);
