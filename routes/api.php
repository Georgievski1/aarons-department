<?php

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

Route::post('upload', '\App\Http\Controllers\FileController@upload');
Route::get('workers', '\App\Http\Controllers\WorkersController@index');
Route::get('worker/{id}', '\App\Http\Controllers\WorkersController@singleWorker');
Route::get('shifts', '\App\Http\Controllers\ShiftController@index');
Route::get('shifts/{q}', '\App\Http\Controllers\ShiftController@queryShifts');
Route::post('shifts/create', '\App\Http\Controllers\ShiftController@create');
Route::put('shifts/edit/{id}', '\App\Http\Controllers\ShiftController@update');
Route::delete('shifts/delete/{id}', '\App\Http\Controllers\ShiftController@delete');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
