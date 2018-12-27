<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/flight', function(Request $req, Response $res) {
    $flights = App\Flight::findOrFail(1);
    return $flights;
});

Route::get('/product', function(Request $req) {
    // $pro = App\Product::findOrFail(1);
    // $pro = App\Product::all();
    $pro = App\Product::where('title', '苹果')->first();
    return $pro;
});

Route::get('/product/{id}', 'ProductController@show');