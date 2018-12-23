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

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    
    Route::group(['prefix' => 'webapi', 'namespace' => 'Api'],function () {
        Route::get('/conversations', 'ConversationController@index');
        Route::get('/conversation/{conversation}', 'ConversationController@show');
    });

    Route::get('/conversations', 'ConversationController@index')->name('conversations.index');
});

