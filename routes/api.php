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

Route::get('/products', function (Request $req) {
    // $pro = App\Product::findOrFail(1);
    // $pro = App\Product::all();
    $pro = App\Product::where('title', '苹果')->first();
    return $pro;
});

Route::post('/product/create', function (Request $req) {
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
Route::get('/products/{id}', 'ProductController@show');
Route::get('/products/{id}/reviews', 'ProductController@getReviews');
Route::get('/search', 'ProductController@search');

Route::get('/home', 'HomeController');
// Route::get('/reviews/{id}', 'ReviewController@show');
// Route::get('/reviews/{id}', 'ReviewController@show');

// Route::get('/sellers/{id}', '')

Route::post('user/signup', 'APIRegisterController@register');
Route::post('user/login', 'APILoginController@login');
// Route::post('user/me', 'EntryController@me');
Route::middleware('jwt.auth')->get('users', function (Request $request) {
    return auth()->user();
});
Route::middleware('jwt.auth')->get('user/me', 'EntryController@me');
Route::middleware('jwt.auth')->post('user/me/update', 'EntryController@updateProfile');
// Route::middleware('jwt.auth')->post('user/me/pay', 'EntryController@updateProfile');
//  add auth middleware
Route::middleware(['jwt.auth', 'check.self'])->get('users/{id}/orders', 'UserController@getOrders');
Route::middleware(['jwt.auth', 'check.self'])->get('users/{id}/messages', 'UserController@getMessages');
Route::middleware(['jwt.auth', 'check.self'])->get('users/{id}/points', 'UserController@getPoints');
Route::middleware(['jwt.auth', 'check.self'])->get('users/{id}/addresses', 'UserController@getAddresses');
Route::middleware(['jwt.auth', 'check.self'])->get('users/{id}/footprints', 'UserController@getFootprints');
Route::middleware(['jwt.auth', 'check.self'])->get('users/{id}/bills', 'UserController@getBills');

// user center

Route::middleware(['jwt.auth', 'check.self'])->post('me/profile', 'MeController@updateProfile');
Route::middleware(['jwt.auth', 'check.self'])->post('me/modify-password', 'MeController@modifyPassword');
Route::middleware(['jwt.auth', 'check.self'])->post('me/', 'MeController@updateProfile');
Route::middleware(['jwt.auth', 'check.self'])->post('me/change-mobile', 'MeController@changeMobile');
# address
Route::middleware(['jwt.auth', 'check.self'])->post('me/address/create', 'MeController@addAddress');
Route::middleware(['jwt.auth', 'check.self'])->post('me/address/update', 'MeController@updateAddress');
Route::middleware(['jwt.auth', 'check.self'])->post('me/address/delete', 'MeController@deleteAddress');
Route::middleware(['jwt.auth', 'check.self'])->post('me/address/default', 'MeController@setDefaultAddress');

# footprint
Route::middleware(['jwt.auth', 'check.self'])->post('me/footprint/create', 'MeController@addFootprint');
Route::middleware(['jwt.auth', 'check.self'])->post('me/footprint/delete', 'MeController@deleteFootprint');
// 订单详情
Route::get('orders/{id}', 'OrderController@show');

// test
Route::get('categories/{id}', 'CategoryController@show');
// Route::get('test', 'ProductController@test');
