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
});