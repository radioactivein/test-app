<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('project', ProjectController::class);

// Route::post('project',[ProjectController::class,'store']);
// Route::get('project',[ProjectController::class,'index']);
// Route::delete('project',[ProjectController::class,'destroy']);
// Route::put('project',[ProjectController::class,'update']);
