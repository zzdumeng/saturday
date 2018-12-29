<?php

use App\Models\Product;
use App\Models\Province;
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

Route::get('/flight', function (Request $req, Response $res) {
    $flights = App\Flight::findOrFail(1);
    return $flights;
});

Route::get('/product', function (Request $req) {
    // $pro = App\Product::findOrFail(1);
    // $pro = App\Product::all();
    $pro = App\Product::where('title', '苹果')->first();
    return $pro;
});

Route::post('/product/add', function (Request $req) {
    $name = $req->input('name');
    $price = $req->input('price');

    $p = new Product;
    $p->name = $name;
    $p->original_price = $price;
    $p->current_price = $price;
    $p->digest = 'some digest';
    $p->seller_id = 1;
    $p->save();
    return $p;

});

Route::get('/province', function (Request $req) {
    $pid = $req->input('id');
    $p = Province::with('regions')->find($pid);
    return $p;
});
Route::get('/product/{id}', 'ProductController@show');
Route::get('/category/{id}', 'ProductController@show');

Route::post('user/register', 'APIRegisterController@register');
Route::post('user/login', 'APILoginController@login');
Route::middleware('jwt.auth')->get('users', function(Request $request) {
    return auth()->user();
});