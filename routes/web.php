<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\StudentController\StudentControllerList;

Route::get('/students', [StudentControllerList::class, 'index'])->name('students.index');
//Route::post('/attendance/update', [DashboardController::class, 'update']);
Route::post('/attendance/fetch', [DashboardController::class, 'fetch']);

use App\Http\Controllers\SubjectController;

Route::resource('subjects', SubjectController::class);

use App\Http\Controllers\GenderController;

Route::resource('genders', GenderController::class);

use App\Http\Controllers\CourseController;

Route::resource('courses', CourseController::class);

use App\Http\Controllers\StudentController;

Route::resource('students', StudentController::class);


use App\Http\Controllers\ModuleController;

Route::resource('modules', ModuleController::class);

use App\Http\Controllers\ExamTypeController;

Route::resource('exam_types', ExamTypeController::class);
use App\Http\Controllers\ScoreController;

Route::resource('scores', ScoreController::class);

use App\Http\Controllers\DomainController;

Route::resource('domains', DomainController::class);

use App\Http\Controllers\AssessmentTypeController;

Route::resource('assessment_types', AssessmentTypeController::class);

use App\Http\Controllers\EvaluationController;

Route::resource('evaluations', EvaluationController::class);

use App\Http\Controllers\TopicAssessmentController;
use App\Http\Controllers\ModuleAssessmentController;

Route::resource('topic_assessments', TopicAssessmentController::class);
Route::resource('module_assessments', ModuleAssessmentController::class);




require __DIR__.'/auth.php';
