<?php

use App\Http\Controllers\Api\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
route::POST('login', [LoginController::class,'login']);

route::group(['middleware'=> 'auth:api'],function(){
    route::post('logout', 'Auth\LoginController@logout');
    route::get('product/search', 'ProductController@search')->name('product.search');
    route::get('category/search', 'CategoryController@search')->name('category.search');
    route::apiResource('category','CategoryController')->except('update');
    route::POST('category/{category}', 'CategoryController@update');
    route::apiResource('product', 'ProductController')->except('update');
    route::POST('product/{product}', 'ProductController@update')->name('product.update');

});
