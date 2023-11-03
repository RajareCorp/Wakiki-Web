<?php

use App\Http\Controllers\PlayerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PlayerController::class, 'init']);

Route::post('/setLog', [PlayerController::class, 'setLog']);
Route::post('/resetLog', [PlayerController::class, 'resetLog']);
Route::post('/addPlayers', [PlayerController::class, 'addPlayers']);
Route::post('/delPlayers', [PlayerController::class, 'delPlayers']);

Route::post('/Wakiki', [PlayerController::class, 'calcul']);
Route::post('/realtime', [PlayerController::class, 'realtime']);
Route::get('/realtime', [PlayerController::class, 'realtime']);

Route::get('/log', [PlayerController::class, 'log']);