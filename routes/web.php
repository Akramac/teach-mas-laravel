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
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('registerData', [RegisterController::class, 'register'])->name('registerData');
Route::post('login/validation', [LoginController::class, 'validation'])->name('login/validation');
Route::middleware(['auth.redirect'])->group(function(){
    Route::get('teacher/teacherExam', [TeacherController::class, 'showExam'])->name('showExam');
    Route::get('teacher/teacherEditExam/{exam}/{teacher}', [TeacherController::class, 'editExamByTeacher'])->name('teacher.teacherEditExam');
    Route::get('teacher/list/exam-by-teacher/{teacher}', [TeacherController::class, 'studentListExamByTeacher'])->name('teacher.studentListExamByTeacher');
    Route::get('teacher/adminstrate/exam-by-teacher/{exam}', [TeacherController::class, 'administrateExamByTeacher'])->name('teacher.administrateExam');
    Route::post('teacher/addExamData', [TeacherController::class, 'addExamData'])->name('addExamData');
    Route::get('teacher/affect/exam-by-teacher/{exam}', [TeacherController::class, 'affectExamByTeacher'])->name('teacher.affectExamByTeacher');
    Route::post('teacher/affectation', [TeacherController::class, 'affectation'])->name('teacher.affectation');
    Route::get('student/studentExam', [StudentController::class, 'studentExam'])->name('studentExam');
    Route::get('student/pass/exam/{exam}', [StudentController::class, 'studentExam'])->name('student.studentPassExam');
    Route::get('changePassword', [PasswordController::class, 'changePassword'])->name('changePassword');
    Route::get('editProfile', [ProfileController::class, 'index'])->name('editProfile');
    Route::post('loggedin/change-password', [PasswordController::class, 'changePasswordData'])->name('loggedin/change-password');
    Route::post('loggedin/edit-profile', [ProfileController::class, 'editProfileData'])->name('loggedin/edit-profile');
    Route::get('student/activate-exam/{exam}/{teacher}/{hash}', [StudentController::class, 'activateExamUrl'])->name('student/activate-exam');
    Route::get('student/studentListExam', [StudentController::class, 'studentListExam'])->name('student.studentListExam');
});
