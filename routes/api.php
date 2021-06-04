<?php

use App\Http\Controllers\iOSController;
use App\Http\Controllers\PDFController;
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

Route::post('login',[iOSController::class,'login']);
Route::post('register',[iOSController::class,'register']);
Route::get('init/{id}',[iOSController::class,'allInitiative']);
Route::get('init/open/{id}',[iOSController::class,'openInitiative']);
Route::get('init/finish/{id}',[iOSController::class,'finishInitiative']);
Route::get('prepare/{initID}/{volunteerID}',[iOSController::class,'prepare']);
Route::get('program',[iOSController::class,'program']);
Route::post('init/agree',[iOSController::class,'agree']);
Route::post('init/decline',[iOSController::class,'decline']);
Route::get('pdf/{mobile}/{id}', [PDFController::class,'postPDF']);

