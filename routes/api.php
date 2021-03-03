<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\studentController;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
});

Route::group(['prefix' => 'admin'], function () {

    //user_staff

    Route::post('staff/add', [StaffController::class, 'addStaff']);
    Route::post('staff/update', [StaffController::class, 'updateStaff']);
    Route::get('staff/all', [StaffController::class, 'allStaff']);
    Route::post('staff/delete', [StaffController::class, 'deleteStaff']);
    Route::get('staff/specific', [StaffController::class, 'specificStaff']);

    //user_teacher
    Route::post('teacher/add', [TeacherController::class, 'addTeacher']);
    Route::post('teacher/update', [TeacherController::class, 'updateTeacher']);
    Route::get('teacher/all', [TeacherController::class, 'allTeacher']);
    Route::post('teacher/delete', [TeacherController::class, 'deleteTeacher']);
    Route::get('teacher/specific', [TeacherController::class, 'specificTeacher']);


});
