<?php

Route::group(['middleware' => 'web', 'prefix' => 'user', 'namespace' => 'Modules\User\Http\Controllers'], function()
{
    Route::get('/', 'UserController@index');
});

Route::group(['middleware'=>['api'], 'prefix'=>'api/user', 'namespace'=>'Modules\User\Http\Controllers'], function(){

    // All users
    Route::get('all','UserController@getAll');

    // Single user
    Route::get('find/{id}', 'UserController@getSingleUser');

    // Register user
    Route::post('register','UserController@registerUser');

    //Login user
    Route::post('login','UserController@loginUser');

    //update user
    Route::put('update/{id}','UserController@update');

    //delete user
    Route::delete('remove/{id}','UserController@destroy');
});