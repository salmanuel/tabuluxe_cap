<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\JudgeController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\JudgingController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\ContestantController;

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

Route::get('/', [SiteController::class, 'loginForm'])->name('login');
Route::post('/login', [SiteController::class, 'login']);

Route::get('/judging',[JudgingController::class, 'index']);
Route::put('/judging',[JudgingController::class, 'save']);
Route::post('/judging/login',[JudgingController::class, 'login']);
Route::get('/judging/logout',[JudgingController::class, 'logout']);
Route::get('/judging/scoresheet',[JudgingController::class, 'scoreSheet']);

Route::group(['middleware'=>'auth'], function() {
    Route::get('/home', [SiteController::class, 'home']);

    Route::get('/events',[EventsController::class, 'event']);
    Route::get('/events/create',[EventsController::class, 'create']);
    Route::post('/events', [EventsController::class, 'store']);

    Route::get('/events/{eventId}/contests',[ContestController::class, 'index']);
    Route::get('/events/{eventId}/contests/create',[ContestController::class, 'create']);
    Route::get('/contests/{contest}',[ContestController::class, 'show']);
    Route::post('/events/{eventId}/contests', [ContestController::class, 'store']);
    Route::post("/contests/{contest}/contestants", [ContestantController::class, 'store']);
    Route::post("/contests/{contest}/judges", [JudgeController::class, 'store']);
    Route::post("/contests/{contest}/criterias", [CriteriaController::class, 'store']);

    Route::get('/contestants/{contestant}',[ContestantController::class, 'show']);
    Route::put('/contestants/{contestant}',[ContestantController::class, 'update']);

    Route::get('/judges/{judge}', [JudgeController::class, 'show']);
    Route::put('/judges/{judge}', [JudgeController::class, 'update']);

    Route::get('/criterias/{criteria}', [CriteriaController::class, 'show']);
    Route::put('/criterias/{criteria}', [CriteriaController::class, 'update']);

    Route::get('/logout',[SiteController::class, 'logout']);
});
