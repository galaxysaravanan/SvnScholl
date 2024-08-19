<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('welcome');
});
Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/profile', [App\Http\Controllers\UsersController::class, 'profile'])->name('profile');


Route::get('/timetable', [App\Http\Controllers\TimetableController::class, 'index'])->name('timetable');
Route::post('/savetimetable', [App\Http\Controllers\TimetableController::class, 'savetimetable'])->name('savetimetable');
ROUTE::post('/savetimetable2', [App\Http\Controllers\TimetableController::class, 'savetimetable2'])->name('savetimetable2');
ROUTE::post('/savetimetable3', [App\Http\Controllers\TimetableController::class, 'savetimetable3'])->name('savetimetable3');
Route::get('/deletetimetable/{id}', [App\Http\Controllers\TimetableController::class, 'deletetimetable'])->name('deletetimetable');
ROUTE::get('/viewtimetable', [App\Http\Controllers\TimetableController::class, 'viewtimetable'])->name('viewtimetable');
ROUTE::get('/stafftimetable', [App\Http\Controllers\TimetableController::class, 'stafftimetable'])->name('stafftimetable');
ROUTE::get('/showtimetable/{class_id}/{division_id}', [App\Http\Controllers\TimetableController::class, 'showtimetable'])->name('showtimetable');
ROUTE::post('/updatesub', [App\Http\Controllers\TimetableController::class, 'updatesub'])->name('updatesub');
Route::post('/updateperiod', [App\Http\Controllers\TimetableController::class, 'updateperiod'])->name('updateperiod');

Route::post('/saveregister', [App\Http\Controllers\RegisterController::class, 'saveregister'])->name('saveregister');
Route::get('/checkphone/{phone}', [App\Http\Controllers\RegisterController::class, 'checkphone'])->name('checkphone');
Route::get('/checkemail/{email}', [App\Http\Controllers\RegisterController::class, 'checkemail'])->name('checkemail');

Route::get('/changepassword', [App\Http\Controllers\UsersController::class, 'changepassword'])->name('changepassword');
Route::post('/updatepassword', [App\Http\Controllers\UsersController::class, 'updatepassword'])->name('updatepassword');
Route::get('/usertypes', [App\Http\Controllers\UsersController::class, 'usertypes'])->name('usertypes');
Route::post('/saveusertype', [App\Http\Controllers\UsersController::class, 'saveusertype'])->name('saveusertype');
Route::post('/updateusertype', [App\Http\Controllers\UsersController::class, 'updateusertype'])->name('updateusertype');


ROUTE::get('/subject', [App\Http\Controllers\SubjectController::class, 'index'])->name('subject');
ROUTE::post('/addsubject', [App\Http\Controllers\SubjectController::class, 'AddSubject'])->name('addsubject');
ROUTE::post('/editsubject', [App\Http\Controllers\SubjectController::class, 'EditSubject'])->name('editsubject');

Route::get('/deletesubject/{id}', [App\Http\Controllers\SubjectController::class, 'DeleteSubject'])->name('deletesubject');


Route::get('/logout', [App\Http\Controllers\UsersController::class, 'logout'])->name('logout');

