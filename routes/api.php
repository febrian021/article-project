<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ProfileController;
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

Route::post('login', [LoginController::class, 'login']);

Route::get('article', [ArticleController::class, 'index']);
Route::post('article/store', [ArticleController::class, 'store']);
Route::post('article/{id}/update', [ArticleController::class, 'update']);
Route::delete('article/{id}/delete', [ArticleController::class, 'destroy']);
