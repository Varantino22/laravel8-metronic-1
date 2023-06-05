<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiController;

use App\Http\Controllers\Api\GetNewsController;
use App\Http\Controllers\Api\PostNewsController;
use App\Http\Controllers\Api\UpdateNewsController;
use App\Http\Controllers\Api\DeleteNewsController;

use App\Http\Controllers\Api\Setting_menu\GetSetting_menuController;
use App\Http\Controllers\Api\Setting_menu\PostSetting_menuController;
use App\Http\Controllers\Api\Setting_menu\UpdateSetting_menuController;
use App\Http\Controllers\Api\Setting_menu\DeleteSetting_menuController;

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

Route::post('login', [ApiController::class, 'authenticate']);

Route::get('getnews', [GetNewsController::class, 'Index']);
Route::post('postnews', [PostNewsController::class, 'Index']);
Route::post('updatenews', [UpdateNewsController::class, 'Index']);
Route::post('deletenews', [DeleteNewsController::class, 'Index']);

Route::get("getSetting_menu", [GetSetting_menuController::class, "Index"]);
Route::post("postSetting_menu", [PostSetting_menuController::class, "Index"]);
Route::post("updateSetting_menu", [UpdateSetting_menuController::class, "Index"]);
Route::post("deleteSetting_menu", [DeleteSetting_menuController::class, "Index"]);