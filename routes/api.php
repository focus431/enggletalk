<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AiChatController;

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

// AI Chat Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/chat/send', [AiChatController::class, 'sendMessage']);
    Route::get('/chat/history', [AiChatController::class, 'getChatHistory']);
});



