<?php

use Illuminate\Http\Request;

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

Route::post('convert/from/json/to/csv', 'JsonConverterController@tocsv')->name('jsonToCsv');
Route::post('convert/from/json/to/google-sheets', 'JsonConverterController@saveToGoogleSheets')->name('jsonToGoogleSheets');
