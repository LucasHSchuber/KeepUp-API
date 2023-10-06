<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;
use App\Http\Controllers\AuthController;

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


Route::resource('stocks', StockController::class);

// Route::get("stock", function() {
//     return response()->json("GET!");
// });

// Route::post("stock", function() {
//     return response()->json("POST!");
// });

// Route::delete("stock", function() {
//     return response()->json("DELETEE!");
// });

// Route::put("stock", function() {
//     return response()->json("PUT!");
// });



//protected routes that require authentication
Route::middleware(['auth:sanctum'])->group(function() {
    Route::delete('stocks/{id}', [StockController::class, 'destroy']);
    Route::put('stocks/{id}', [StockController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('stocks', [StockController::class, 'store']);
    Route::post('/register', [AuthController::class, 'register']);

});

// public routes
Route::get('stocks', [StockController::class, 'index']);
Route::get('stocks/{id}', [StockController::class, 'show']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->get('user', function (Request $request) {
    return $request->user();
});
