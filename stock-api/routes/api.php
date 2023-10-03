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


Route::resource('stock', StockController::class);

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
    Route::post('stock', [TodoController::class, 'store']);
    Route::delete('stock/{id}', [TodoController::class, 'destroy']);
    Route::put('stock/{id}', [TodoController::class, 'update']);

});

//public routes
Route::get('stock', [TodoController::class, 'index']);
Route::get('stock/{id}', [TodoController::class, 'show']);
Route::post('/register', [AuthController::class, 'register']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
