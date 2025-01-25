<?php

use App\Http\Controllers\ComplainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ComplainTypeController;

Route::middleware(['auth'])->group(function () {
    Route::resource("/admin/complains", ComplainController::class);
    Route::resource("/admin/types", ComplainTypeController::class);
    Route::resource("/admin/users", UserController::class);

    Route::get("/admin/{type}/questions", [QuestionController::class, "index"])->name("admin.questions");
    Route::put("/admin/question/{question}/edit", [QuestionController::class, "update"]);
    Route::delete("/admin/question/{question}/delete", [QuestionController::class, "destroy"]);
    Route::get("/admin/question/{type}/create", [QuestionController::class, "create"]);
    Route::post("/admin/question/{type}/create", [QuestionController::class, "store"]);

    Route::put("/admin/complain/{complain}/highlight", [ComplainController::class, "highlight"]);
});


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
