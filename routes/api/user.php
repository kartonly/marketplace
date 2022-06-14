<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user'], function(){
    Route::get('/', 'UsersController@user')->middleware('cors');
    Route::get('addresses', 'UsersController@addresses')->middleware('cors');
    Route::get('address/{id}', 'UsersController@address')->middleware('cors');
    Route::match(['options', 'post'], 'createAddress', 'UsersController@createAddress')->middleware('cors');
    Route::match(['options', 'post', 'delete'], 'delAddress/{id}', 'UsersController@delAddress')->middleware('cors');
});

Route::group(['prefix' => 'cart'], function (){
    Route::get('/', 'UsersController@cart')->middleware('cors');
    Route::match(['options', 'post'], 'add', 'UsersController@addToCart')->middleware('cors');
    Route::match(['options', 'post', 'delete'], 'del', 'UsersController@delFromCart')->middleware('cors');
    Route::match(['options', 'post', 'put'], 'change', 'UsersController@changeCount')->middleware('cors');
});

Route::group(['prefix' => 'orders'], function (){
    Route::get('/', 'UsersController@orders')->middleware('cors');
    Route::get('order/{id}', 'UsersController@order')->middleware('cors');
    Route::match(['options', 'post'], 'create', 'UsersController@createOrder')->middleware('cors');
});

Route::group(['prefix' => 'liked'], function (){
    Route::get('/', 'UsersController@liked')->middleware('cors');
    Route::match(['options', 'post'], 'addLike/{id}', 'UsersController@addLike')->middleware('cors');
    Route::match(['options', 'post', 'delete'], 'delLike/{id}', 'UsersController@delLike')->middleware('cors');
});

Route::match(['options', 'post'], 'addReview', 'ReviewController@addReview')->middleware('cors');


Route::group(['prefix' => 'seller'], function (){
    Route::get('shopRequests', 'SellerController@allRequests')->middleware('cors');
    Route::get('shopRequest/{id}', 'SellerController@myRequest')->middleware('cors');
    Route::match(['options', 'post'], 'addShopRequest', 'SellerController@requestForShop')->middleware('cors');

    Route::match(['options', 'post'], 'addPhoto/{product}', 'ProductsController@addPhoto')->middleware('cors');
    Route::get('upload-image/{product}', 'ProductsController@index')->middleware('cors');

    Route::get('myShops', 'SellerController@myShops')->middleware('cors');
    Route::get('myShop/{id}', 'SellerController@myShop')->middleware('cors');

    ///add to insomnia
    Route::match(['options', 'post'], 'addProduct', 'ProductsController@addProduct')->middleware('cors');
    Route::match(['options', 'post'], 'addStorage/{product}', 'ProductsController@addStorage')->middleware('cors');
});


