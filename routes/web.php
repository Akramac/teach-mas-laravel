<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
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
Route::post('login/validation', [LoginController::class, 'validation'])->name('login/validation');
Route::get('changePassword', [PasswordController::class, 'index'])->name('changePassword');
Route::middleware(['auth.redirect'])->group(function(){
    Route::get('teacher/teacherExam', [TeacherController::class, 'showExam'])->name('showExam');
    Route::get('student/studentExam', [StudentController::class, 'studentExam'])->name('studentExam');
    Route::get('changePassword', [PasswordController::class, 'changePassword'])->name('changePassword');
    Route::get('editProfile', [ProfileController::class, 'index'])->name('editProfile');
    Route::post('loggedin/change-password', [PasswordController::class, 'changePasswordData'])->name('loggedin/change-password');
    Route::post('loggedin/edit-profile', [ProfileController::class, 'editProfileData'])->name('loggedin/edit-profile');
    Route::get('editProfile', [ProfileController::class, 'index'])->name('editProfile');
});
