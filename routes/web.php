<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('students', [StudentController::class, 'index'])->name('students.index');
    Route::get('students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('students', [StudentController::class, 'store'])->name('students.store');
    Route::put('students', [StudentController::class, 'update'])->name('students.update');
    Route::get('students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::delete('students/{id}', [StudentController::class, 'archive'])->name('students.archive');
    Route::delete('students/{id}/delete', [StudentController::class, 'destroy'])->name('students.destroy');
    Route::get('students/trashed', [StudentController::class, 'trashed'])->name('students.trashed');
    Route::post('students/{id}/restore', [StudentController::class, 'restore'])->name('students.restore');
    Route::get('students/mail', [StudentController::class, 'mail'])->name('students.mail');
    Route::get('students/settings', [StudentController::class, 'settings'])->name('students.settings');
});
