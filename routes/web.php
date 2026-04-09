<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;

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
    return view('welcome');
});


Route::get('login', [LoginController::class, 'index'])->name('login');
Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('registerData', [RegisterController::class, 'register'])->name('registerData');
Route::get('changePassword', [PasswordController::class, 'index'])->name('changePassword');
Route::middleware(['auth.redirect'])->group(function(){
    Route::get('teacher/teacherExam', [TeacherController::class, 'showExam'])->name('showExam');
    Route::get('editProfile', [ProfileController::class, 'index'])->name('editProfile');
});
