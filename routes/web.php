<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('welcome');
});
Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/profile', [App\Http\Controllers\UsersController::class, 'profile'])->name('profile');


ROUTE::post('/getsubject', [App\Http\Controllers\TimetableController::class, 'getsubject'])->name('getsubject');
ROUTE::post('/getstaff', [App\Http\Controllers\TimetableController::class, 'getstaff'])->name('getstaff');
Route::get('/timetable', [App\Http\Controllers\TimetableController::class, 'index'])->name('timetable');
Route::post('/savetimetable', [App\Http\Controllers\TimetableController::class, 'savetimetable'])->name('savetimetable');
ROUTE::post('/savetimetable2', [App\Http\Controllers\TimetableController::class, 'savetimetable2'])->name('savetimetable2');
ROUTE::post('/savetimetable3', [App\Http\Controllers\TimetableController::class, 'savetimetable3'])->name('savetimetable3');
Route::get('/deletetimetable/{id}', [App\Http\Controllers\TimetableController::class, 'deletetimetable'])->name('deletetimetable');
ROUTE::get('/viewtimetable', [App\Http\Controllers\TimetableController::class, 'viewtimetable'])->name('viewtimetable');
ROUTE::get('/stafftimetable', [App\Http\Controllers\TimetableController::class, 'stafftimetable'])->name('stafftimetable');
ROUTE::get('/showtimetable/{class_id}/{division_id}', [App\Http\Controllers\TimetableController::class, 'showtimetable'])->name('showtimetable');

Route::post('/saveregister', [App\Http\Controllers\RegisterController::class, 'saveregister'])->name('saveregister');
Route::get('/checkphone/{phone}', [App\Http\Controllers\RegisterController::class, 'checkphone'])->name('checkphone');
Route::get('/checkemail/{email}', [App\Http\Controllers\RegisterController::class, 'checkemail'])->name('checkemail');

Route::get('/changepassword', [App\Http\Controllers\UsersController::class, 'changepassword'])->name('changepassword');
Route::post('/updatepassword', [App\Http\Controllers\UsersController::class, 'updatepassword'])->name('updatepassword');
Route::get('/usertypes', [App\Http\Controllers\UsersController::class, 'usertypes'])->name('usertypes');
Route::post('/saveusertype', [App\Http\Controllers\UsersController::class, 'saveusertype'])->name('saveusertype');
Route::post('/updateusertype', [App\Http\Controllers\UsersController::class, 'updateusertype'])->name('updateusertype');



ROUTE::get('backups', [App\Http\Controllers\BackupController::class, 'index'])->name('index');
ROUTE::get('/backup/create', [App\Http\Controllers\BackupController::class, 'create'])->name('create');
ROUTE::get('/backup/download/{file_name}', [App\Http\Controllers\BackupController::class, 'download'])->name('download');
ROUTE::get('/backup/delete/{file_name}', [App\Http\Controllers\BackupController::class, 'delete'])->name('delete');

ROUTE::get('profile', [App\Http\Controllers\UsersController::class, 'profile'])->name('profile');


Route::get('/logout', [App\Http\Controllers\UsersController::class, 'logout'])->name('logout');

