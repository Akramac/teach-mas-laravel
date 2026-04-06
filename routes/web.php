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

Route::get('teacher/teacherExam', [TeacherController::class, 'showExam']);
Route::get('login', [LoginController::class, 'index']);
Route::get('register', [RegisterController::class, 'index']);
Route::get('editProfile', [ProfileController::class, 'index']);
Route::get('changePassword', [PasswordController::class, 'index']);
