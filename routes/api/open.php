<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'products'], function(){
    Route::get('/', 'ProductController@getAll')->middleware('cors');
    Route::get('product/{id}', 'ProductController@storageByProduct')->middleware('cors');
    Route::get('category/{category}/{gender}', 'ProductController@getByCategory')->middleware('cors');

    Route::get('category/{category}', 'ProductController@byCatWithoutGender')->middleware('cors');
    Route::get('/{gender}', 'ProductController@getByGender')->middleware('cors');

    Route::get('subcategory/{subcategory}/{gender}', 'ProductController@getBySubcategory')->middleware('cors');
    Route::get('find/{product}', 'ProductController@find')->middleware('cors');
});

Route::group(['prefix' => 'shops'], function(){
    Route::get('/', 'ShopsController@getAll')->middleware('cors');
    Route::match(['options', 'get'], 'products/{shop}', 'ShopsController@products')->middleware('cors');
    Route::get('find/{shop}', 'ShopsController@find')->middleware('cors');
});

Route::get('categories', 'CategoriesController@getAll')->middleware('cors');
Route::get('subcategories', 'SubcategoriesController@getAll')->middleware('cors');
Route::get('colors', 'ColorsController@all')->middleware('cors');
Route::get('sizes', 'SizeController@all')->middleware('cors');

Route::get('getPhoto', 'ProductController@getPhoto')->middleware('cors');

Route::get('top', 'ProductController@topSales')->middleware('cors');
