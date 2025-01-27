<?php

use App\Http\Controllers\ComplainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ComplainTypeController;

Route::get("/members", function(Request $request) {
    $cnic = $request->cnic;
    $membership_no = request()->membership_no;
    $results = DB::connection("second_mysql")
                    ->table("members_2")
                    ->where("cnic_passport", $cnic)
                    ->where("membership_no", $membership_no)
                    ->first();
    return $results;
});

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

Route::get("/complain", [\App\Http\Controllers\User\ComplainController::class, "index"])->name("complain.index");
Route::post("/complain", [\App\Http\Controllers\User\ComplainController::class, "store"]);


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
