<?php

use App\Http\Controllers\ThreadController;
use App\Http\Controllers\TodoController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// route CRUD Threads
Route::get('/threadlist', [ThreadController::class, 'index']);
Route::post('/thread/add', [ThreadController::class, 'store']);
Route::get('/thread/{id}', [ThreadController::class, 'show']);
Route::put('/thread/edit/{id}', [ThreadController::class, 'update']);
Route::delete('/thread/delete/{id}', [ThreadController::class, 'destroy']);

Route::post('/todo/add', [TodoController::class, 'store']);
