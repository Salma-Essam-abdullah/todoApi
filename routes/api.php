<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/todo',[ApiController::class,'getAllTodos']);

Route::get('/todo/{id}',[ApiController::class,'getTodo']);

Route::post('/todo/create/{user_id}',[ApiController::class,'createTodo']);

Route::put('/todo/{id}/update',[ApiController::class,'updateTodo']);

Route::delete('/todo/{id}',[ApiController::class,'deleteTodo']);
