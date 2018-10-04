<?php

Route::group(['middleware' => 'web', 'prefix' => 'post', 'namespace' => 'Modules\Post\Http\Controllers'], function()
{
    Route::get('/', 'PostController@index');
});

Route::group(['middleware'=>'api','prefix'=> 'api/posts','namespace'=>'Modules\Post\Http\Controllers'], function()
{

    // Get all the images
    Route::get('all','PostController@allPosts');

    // New post
    Route::post('create','PostController@storePost');

});

Route::group(['middleware'=>'api','prefix'=> 'api/categories','namespace'=>'Modules\Post\Http\Controllers'], function()
{

    // Get all the images
    Route::get('all','PostController@allCategories');

    // New post
    Route::post('create','PostController@storeCategory');

});