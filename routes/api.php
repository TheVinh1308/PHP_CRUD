<?php

use App\Http\Controllers\ApiLoginController;
use App\Http\Controllers\ApiProductController;
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

//Lưu ý: các route trong file này đều có prefix '/api' và các middleware trong group 'api'
Route::post('/login',[ApiLoginController::class,'login']);
Route::middleware('auth:sanctum')->group(function() {
    Route::get('/tokens',[ApiLoginController::class,'showTokens']);
    Route::post('/logout',[ApiLoginController::class,'logout']);
    Route::post('/logout/all',[ApiLoginController::class,'logoutAll']);
    Route::post('/logout/{tokenId}',[ApiLoginController::class,'logoutById']);
    Route::get('/user',function(Request $request) {
        return $request->user();
    });
    //Cách 1: tạo controller
    Route::apiResource('/products',ApiProductController::class);
    // Cách 2: sửa controller cũ, thêm phần json cho api

});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
