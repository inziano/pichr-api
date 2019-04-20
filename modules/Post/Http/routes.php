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

Route::group(['middleware'=>'api','prefix'=> 'api/post/categories','namespace'=>'Modules\Post\Http\Controllers'], function()
{

    // Get all the images
    Route::get('all','CategoryController@allCategories');

    Route::get('notify', function() {
        event(new App\Events\ImageUploaded('some',2));
    });

    // New post
    Route::post('create','CategoryController@storeCategory');

});


Route::group(['middleware'=>'api','prefix'=> 'api/post/downloads','namespace'=>'Modules\Post\Http\Controllers'], function()
{

    // Get all the images
    Route::get('all','DownloadController@allDownloads');

    // New post
    Route::post('create','DownloadController@storeDownload');

});