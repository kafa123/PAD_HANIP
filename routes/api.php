<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CounselingController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\StudentController;
use App\Models\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::apiResource('/student',StudentController::class);
Route::apiResource('/lecturer',LecturerController::class);
Route::apiResource('/project',ProjectController::class);


Route::apiResource('/period',PeriodController::class);
Route::middleware(['auth:sanctum'])->group( function () {
    Route::apiResource('/skill',SkillController::class);
    Route::apiResource('/counseling',CounselingController::class);
    Route::apiResource('/experience',ExperienceController::class);
});
Route::get('/download/{filename}',[FileController::class,'download']);
