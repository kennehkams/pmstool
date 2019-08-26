<?php

use Illuminate\Http\Request;


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


Route::apiResources(['user' => 'API\UserController' ]);
Route::get('profile', 'API\UserController@profile');
Route::put('profile', 'API\UserController@updateProfile');


//products routes. 
Route::apiResources(['product' => 'API\ProductController' ]);

//order routes 
Route::apiResources(['order' => 'API\OrderController' ]);

//order routes 
Route::apiResources(['orderdetail' => 'API\OrderdetailController' ]);

//Supplier routes 
Route::apiResources(['supplier' => 'API\SupplierController' ]);

//Supplier Product routes 
Route::apiResources(['supplierproduct' => 'API\SupplierproductController' ]);