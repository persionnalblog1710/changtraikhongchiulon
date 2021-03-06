<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', ['as' => 'home', 'uses' => 'HomepageController@index' ]);
Route::get('/contact', ['as' => 'contact', 'uses' => 'HomepageController@getContact' ]);
Route::get('about', ['as' => 'about', 'uses' => 'HomepageController@getAbout' ]);

Route::get('profile', ['middleware' => 'auth' ,'as' => 'profile', 'uses' => 'UserController@index']);
Route::post('profile/update/{user_id}', ['middleware' => 'auth' ,'as' => 'update_profile', 'uses' => 'UserController@update']);
Route::post('profile/change_password', ['middleware' => 'auth' ,'as' => 'change_password', 'uses' => 'UserController@changePassword']);

Route::group([
            'as'     => 'category.',
            'prefix' => 'category',
        ], function () {
            Route::get('{parent}/{sub}', ['uses' => 'CategoryController@getProductsByCategory', 'as' => 'product_by_category']);
});

Route::get('product/{id}', ['uses' => 'ProductController@show', 'as' => 'product_detail']);

Auth::routes();



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

