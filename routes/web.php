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
use App\Http\Controllers\RoundController;
use App\Http\Controllers\DanceSportController;
use App\Models\Round;

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

    Route::get('/events',[EventsController::class, 'event'])->name('events.event');
    Route::get('/events/create',[EventsController::class, 'create']);
    Route::post('/events', [EventsController::class, 'store']);

    Route::put('/events/{id}', [EventsController::class, 'update'])->name('events.update');
    Route::delete('/events/{id}', [EventsController::class, 'destroy'])->name('events.destroy');

    Route::get('/events/{eventId}/contests',[ContestController::class, 'index'])->name('contests.contest');

    Route::put('/contests/{id}', [ContestController::class, 'update'])->name('contests.update');
    Route::delete('/contests/{id}', [ContestController::class, 'destroy'])->name('contests.destroy');

    Route::get('/events/{eventId}/contests/create',[ContestController::class, 'create']);
    Route::get('/contests/{contest}',[ContestController::class, 'show'])->name('contests.show');

    Route::post('/events/{eventId}/contests', [ContestController::class, 'store']);
    Route::post("/rounds/{round}/{contest}/contestants", [ContestantController::class, 'store']);
    Route::post("/contests/{contest}/judges", [JudgeController::class, 'store']);
    Route::post("/rounds/{round}/{contest}/criterias", [CriteriaController::class, 'store']);
    Route::post("/contests/{contest}/rounds", [RoundController::class, 'store']);

    Route::get('/contestants/{contestant}',[ContestantController::class, 'show']);
    Route::put('/contestants/{contestant}',[ContestantController::class, 'update']);

    Route::get('/judges/{judge}', [JudgeController::class, 'show']);
    Route::put('/judges/{judge}', [JudgeController::class, 'update']);
    // Route::delete('/contests/{contest}', [JudgeController::class, 'destroy'])->name('judges.destroy');
    Route::delete('/judges/{judge}/contests/{contest}', [JudgeController::class, 'destroy'])->name('judges.destroy');

    Route::get('/criterias/{criteria}', [CriteriaController::class, 'show']);
    Route::put('/criterias/{criteria}', [CriteriaController::class, 'update']);

    Route::get('/dancesports',[DanceSportController::class, 'index'])->name('dancesports.dancesport');
    Route::get('/dancesports/create',[DanceSportController::class, 'create']);
    Route::post('/dancesports', [DanceSportController::class, 'store']);
    Route::get('/dancesports/{contest}',[DanceSportController::class, 'show']);

    Route::post("/dancesports/{contest}/judges", [JudgeController::class, 'store']);
    Route::post("/dancesports/{contest}/criterias", [CriteriaController::class, 'store']);
    Route::post("/dancesports/{contest}/contestants", [ContestantController::class, 'store']);

    Route::put('/dancesports/{id}', [DanceSportController::class, 'update'])->name('dancesports.update');
    Route::delete('/dancesports/{id}', [DanceSportController::class, 'destroy'])->name('dancesports.destroy');

    Route::get('/rounds/{round}/{contest}', [RoundController::class, 'show'])->name('rounds.preview');
    Route::get('/rounds/{round}/{contest}/select', [RoundController::class, 'select']);
    Route::post('/rounds/{round}/{contest}', [RoundController::class, 'startNextRound']);
    Route::get('/rounds/{round}', [RoundController::class, 'edit']);
    Route::put('/rounds/{round}', [RoundController::class, 'update'])->name('rounds.update');
    // Route::delete('/rounds/{round}/contests/{contest}', [RoundController::class, 'destroy'])->name('rounds.destroy');


    Route::get('/logout',[SiteController::class, 'logout']);
});
