<?php

use App\Http\Controllers\QuestionsController;
use Illuminate\Support\Facades\Route;

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
    return view('app');
});
Route::group(['prefix' => '/question'], function () {
    Route::get('/list', [QuestionsController::class, 'List']);
    Route::get('/createQ', [QuestionsController::class, 'CreateQuestions']);
});
Route::resource('/question', QuestionsController::class);
