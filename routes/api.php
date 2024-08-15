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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/createaccount', [App\Http\Controllers\api\MFIApiController::class, 'createaccount'])->name('createaccount');
Route::post('/createkyc', [App\Http\Controllers\api\MFIApiController::class, 'createkyc'])->name('createkyc');
Route::get('/get_branch/{key}', [App\Http\Controllers\api\MFIApiController::class, 'get_branch'])->name('get_branch');
Route::get('/get_district/{key}', [App\Http\Controllers\api\MFIApiController::class, 'get_district'])->name('get_district');
Route::get('/get_taluk/{key}/{distid}', [App\Http\Controllers\api\MFIApiController::class, 'get_taluk'])->name('get_taluk');
Route::get('/get_panchayath/{key}/{talukid}', [App\Http\Controllers\api\MFIApiController::class, 'get_panchayath'])->name('get_panchayath');
Route::get('/get_customer_branch/{key}/{distid}/{talukid}/{panchayathid}', [App\Http\Controllers\api\MFIApiController::class, 'get_customer_branch'])->name('get_customer_branch');
Route::get('/get_account_number/{key}/{username}', [App\Http\Controllers\api\MFIApiController::class, 'get_account_number'])->name('get_account_number');
Route::get('/get_transaction_report/{key}/{username}', [App\Http\Controllers\api\MFIApiController::class, 'get_transaction_report'])->name('get_transaction_report');
