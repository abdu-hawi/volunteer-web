<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FCMController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InitiativeController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\VolunteerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
//    return view('welcome');
//    return redirect(url('login'));
});

Auth::routes();
Route::middleware(['auth:sanctum', 'verified'])->group(function (){

    Route::get('/', function () {
        return view('admin.mobadrah');
    });


    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

    Route::get('settings',[SettingController::class,'setting']);
    Route::post('settings',[SettingController::class,'setting_save']);
    Route::resource('programs',ProgramController::class);
    Route::resource('volunteers',VolunteerController::class);
    Route::resource('initiatives',InitiativeController::class);
    Route::get('initiatives/{id}/qrCode',[InitiativeController::class,"qrCode"]);
    Route::get('init/chart',[InitiativeController::class,"chart"]);
//    Route::get('initiatives/{id}/end',[InitiativeController::class,""]);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/save-token', [HomeController::class, 'saveToken'])->name('save-token');
    Route::post('/send-notification', [HomeController::class, 'sendNotification'])->name('send.notification');
    Route::post('/resend', [InitiativeController::class, 'resendNotification']);
});


Route::get('init/chart',[InitiativeController::class,"chart"]);

Route::get('pdf', [PDFController::class,'makePDF']);
Route::get('send',[FCMController::class,'send']);
Route::get('init/come/{uid}/{id}',[FCMController::class,'approveVolunteer']);

