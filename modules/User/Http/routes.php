<?php

Route::group(['middleware' => 'web', 'prefix' => 'user', 'namespace' => 'Modules\User\Http\Controllers'], function()
{
    Route::get('/', 'UserController@index');
});

/**
 * 
 * User api routes
 */

Route::group(['middleware'=>'api', 'prefix'=>'api/user', 'namespace'=>'Modules\User\Http\Controllers'], function(){

    // All users
    Route::get('all','UserController@getAll');

    // Route::get('show','UserController@show');

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

/**
 * 
 * Account api routes 
 */

Route::group(['middleware'=>'api', 'prefix'=>'api/user/account', 'namespace'=>'Modules\User\Http\Controllers'], function(){

    // All accountss
    Route::get('all','AccountsController@getAll');

    // Single accounts
    Route::get('find/{id}', 'AccountsController@getSingleAccount');

    // Register account
    Route::post('create','AccountsController@createSingleAccount');

    //update account
    Route::put('update/{id}','AccountsController@update');

    //delete account
    Route::delete('remove/{id}','AccountsController@destroy');
});