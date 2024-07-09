<?php

use App\Http\Controllers\AssertionController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\SubmitionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return view('d');
});
// Route::get('/', function () {
//     return view('welcome');
// });
Route::redirect('/', 'login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::middleware('role:2')->group(function(){
        Route::resource('exams', ExamController::class);
        Route::post('/exams/{exam}/another-chance', [ExamController::class, 'allowAnotherChance'])->name('exams.another-chance');

        // Create questions resource
        Route::resource('questions', QuestionController::class)->only(['edit','destroy', 'update']);
        Route::post('/questions/{exam}/create', [QuestionController::class, 'store'])->name('questions.store');
        Route::post('/questions/{exam}/createQCM', [QuestionController::class, 'storeQcm'])->name('questions.storeQcm');

        Route::post('/assertion/{assertion}/setAnswer', [AssertionController::class, 'IsAnswer'])->name('assertion.IsAnswer');
        Route::post('/submitions/{submition}/setPoints', [SubmitionController::class, 'setPoints'])->name('exams.submittions.set-points');
    });
    
    Route::post('/exams/show/with-code', [ExamController::class, 'showWithCode'])->name('exams.show-with-code');

    Route::post('/responses/{exam}/set', [ResponseController::class, 'set'])->name('exams.responses.set');
    Route::get('/submitions/{exam}/get', [SubmitionController::class, 'get'])->name('exams.submittions.get');
    Route::get('/submitions/{presentation}/show', [SubmitionController::class, 'show'])->name('exams.submittions.show');
    

    Route::resource('presentations', PresentationController::class)
            ->only('index')
            ->middleware('role:3');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', UserController::class)
            ->except(['show'])
            ->middleware('role:1');
});

require __DIR__.'/auth.php';
