<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users'], function(){
    Route::get('/', 'UserController@all')->middleware('cors');
});

Route::group(['prefix' => 'sellers'], function(){
    Route::get('all', 'SellersController@all')->middleware('cors');
    Route::get('requests', 'SellersController@allRequests')->middleware('cors');
    Route::get('requests/true', 'SellersController@trueRequests')->middleware('cors');
    Route::get('requests/false', 'SellersController@falseRequests')->middleware('cors');
    Route::get('requests/inReview', 'SellersController@inReviewRequests')->middleware('cors');
    Route::get('requests/request/{id}', 'SellersController@allRequests')->middleware('cors');
    Route::match(['get', 'options', 'post'],'rejectRequest/{id}', 'SellersController@rejectRequest')->middleware('cors');
    Route::match(['get', 'options', 'post'],'createShop/{id}', 'SellersController@createShopFromRequest')->middleware('cors');
});

