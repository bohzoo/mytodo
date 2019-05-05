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

Route::group(['middleware' => 'auth'], function() {
    Route::get('/folder/{folder}/tasks', 'TaskController@index')->name('tasks.index');
    Route::get('/folder/create', 'FolderController@showCreateForm')->name('folders.create');
    Route::post('/folder/create', 'FolderController@create');   // nameメソッドで命名できるのはURLなので、getとpostで同じURLならgetのみに命名すればいい。
    Route::get('/folder/{folder}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
    Route::post('/folder/{folder}/tasks/create', 'TaskController@create');
    Route::get('/folder/{folder}/tasks/{task}/edit', 'TaskController@showEditForm')->name('tasks.edit');
    Route::post('/folder/{folder}/tasks/{task}/edit', 'TaskController@edit');
    Route::get('/', 'HomeController@index')->name('home');
});
Auth::routes();
