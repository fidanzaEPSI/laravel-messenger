<?php

Route::group(['namespace' => 'Auth'], function () {
    # Authentication
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout');
    
    # Registration
    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'RegisterController@register');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/conversations', 'ConversationController@index')->name('conversations.index');
    Route::get('/conversations/{conversation}', 'ConversationController@show');
    
    # Api
    Route::group(['prefix' => 'webapi', 'namespace' => 'Api'], function () {
        Route::get('/conversations', 'ConversationController@index');
        Route::get('/conversations/{conversation}', 'ConversationController@show');
    });

});

