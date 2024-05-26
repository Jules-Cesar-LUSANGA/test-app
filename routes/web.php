<?php

use App\Http\Controllers\AssertionController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::resource('exams', ExamController::class);
    Route::post('/exams/show/with-code', [ExamController::class, 'showWithCode'])->name('exams.show-with-code');

    // Create questions resource
    Route::resource('questions', QuestionController::class)->only(['edit','destroy', 'update']);
    Route::post('/questions/{exam}/create', [QuestionController::class, 'store'])->name('questions.store');
    Route::post('/questions/{exam}/createQCM', [QuestionController::class, 'storeQcm'])->name('questions.storeQcm');

    Route::post('/assertion/{assertion}/setAnswer', [AssertionController::class, 'IsAnswer'])->name('assertion.IsAnswer');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
