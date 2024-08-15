<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('welcome');
});
Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/profile', [App\Http\Controllers\UsersController::class, 'profile'])->name('profile');

Route::get('/students', [App\Http\Controllers\StudentsController::class, 'students'])->name('students');
Route::post('/savestudents', [App\Http\Controllers\StudentsController::class, 'savestudents'])->name('savestudents');
Route::post('/updatestudents', [App\Http\Controllers\StudentsController::class, 'updatestudents'])->name('updatestudents');
Route::get('/deletestudent/{id}', [App\Http\Controllers\UsersController::class, 'deletestudent'])->name('deletestudent');
Route::get('/useraccount/{id}', [App\Http\Controllers\StudentsController::class, 'useraccount'])->name('useraccount');
Route::get('/statement', [App\Http\Controllers\StudentsController::class, 'statement'])->name('statement');


Route::get('/staf', [App\Http\Controllers\UsersController::class, 'users'])->name('users');
Route::get('/edituser/{id}', [App\Http\Controllers\UsersController::class, 'edituser'])->name('edituser');
Route::post('/saveuser', [App\Http\Controllers\UsersController::class, 'saveuser'])->name('saveuser');
Route::post('/updateusers', [App\Http\Controllers\UsersController::class, 'updateusers'])->name('updateusers');
Route::get('/deleteuser/{id}', [App\Http\Controllers\UsersController::class, 'deleteuser'])->name('deleteuser');

Route::get('/changepassword', [App\Http\Controllers\UsersController::class, 'changepassword'])->name('changepassword');
Route::post('/updatepassword', [App\Http\Controllers\UsersController::class, 'updatepassword'])->name('updatepassword');

Route::get('/usertypes', [App\Http\Controllers\UsersController::class, 'usertypes'])->name('usertypes');
Route::post('/saveusertype', [App\Http\Controllers\UsersController::class, 'saveusertype'])->name('saveusertype');
Route::post('/updateusertype', [App\Http\Controllers\UsersController::class, 'updateusertype'])->name('updateusertype');

Route::POST('/checkphone', [App\Http\Controllers\UsersController::class, 'checkphone'])->name('checkphone');
Route::POST('/checkemail', [App\Http\Controllers\UsersController::class, 'checkemail'])->name('checkemail');

Route::get('/getname/{account_no}', [App\Http\Controllers\UsersController::class, 'getname'])->name('getname');

ROUTE::get('backups', [App\Http\Controllers\BackupController::class, 'index'])->name('index');
ROUTE::get('/backup/create', [App\Http\Controllers\BackupController::class, 'create'])->name('create');
ROUTE::get('/backup/download/{file_name}', [App\Http\Controllers\BackupController::class, 'download'])->name('download');
ROUTE::get('/backup/delete/{file_name}', [App\Http\Controllers\BackupController::class, 'delete'])->name('delete');

ROUTE::get('profile', [App\Http\Controllers\UsersController::class, 'profile'])->name('profile');


Route::get('/logout', [App\Http\Controllers\UsersController::class, 'logout'])->name('logout');

