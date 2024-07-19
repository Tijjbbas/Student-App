<?php

use App\Http\Controllers\ComputationController;
use App\Http\Controllers\ImportFormController;
use App\Http\Controllers\ResultSheetController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Models\Computation;
use App\Models\ResultSheet;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// List students
Route::get('students', [StudentController::class, 'index']);

// Create new student
Route::post('/student', [StudentController::class, 'store'])->name('student.store');

// Show student details
Route::get('student/{id}', [StudentController::class, 'show']);

// Update student
Route::put('/student/{id}', [StudentController::class, 'update'])->name('student.update');

// Delete student
Route::delete('student/{id}', [StudentController::class, 'destroy']);


// List subjects
Route::get('subjects', [SubjectController::class, 'index'])->name('subject.get');

// Show subject details
Route::get('subject/{id}', [SubjectController::class, 'show']);

// Create new subject
Route::post('subject', [SubjectController::class, 'store']);

// Update subject
Route::put('subject/{id}', [SubjectController::class, 'update'])->name('subject.update');

// Delete suject
Route::delete('suject/{id}', [SubjectController::class, 'destroy']);


// List result_sheets
Route::get('result_sheets', [ResultSheetController::class, 'index'])->name('result_sheet.get');

// Show result_sheet details
Route::get('result_sheet/{id}', [ResultSheetController::class, 'show']);

// Create new result_sheet
Route::post('result_sheet', [ResultSheetController::class, 'store']);

// Update result_sheet
Route::put('result_sheet/{id}', [ResultSheetController::class, 'update'])->name('result_sheet.update');

// Delete result_sheet
Route::delete('result_sheet/{id}', [ResultSheetController::class, 'destroy'])->name('result_sheet.destroy');

Route::get('/result/{id}/cgpa', [ResultSheetController::class, 'showcgpa']);

//show result
Route::get('/result/{studentId}', [ResultSheetController::class, 'showResult']);

Route::get('/import-students', [ResultSheetController::class, 'importStudents']);

//show Form

Route::get('/import-form', [StudentController::class, 'showImportForm']);
Route::post('/import-form', [StudentController::class, 'saveImportFile']);



Route::post('/save-import-file', [StudentController::class, 'saveImportFile'])->name('saveImportFile');

// generate pdf results 
// Route::get('/student/{id}/results-pdf', [ResultSheetController::class, 'generatePdf']);



// List computations
Route::get('computations', [ComputationController::class, 'index'])->name('computation.get');

// Show computation details
Route::get('computation/{id}', [ComputationController::class, 'show']);

// Create new computation
Route::post('computation', [ComputationController::class, 'store']);

// Update computation
Route::put('computation/{id}', [ComputationController::class, 'update'])->name('computation.update');

// Delete compuatation
Route::delete('computation/{id}', [ComputationController::class, 'destroy'])->name('computation.destroy');

