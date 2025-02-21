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

Route::get("members", function(Request $request) {
    $cnic = $request->cnic;
    $membership_no = request()->membership_no;
    $results = DB::connection("second_mysql")
                    ->table("members_2")
                    ->where("cnic_passport", $cnic)
                    ->where("membership_no", $membership_no)
                    ->first();
    return $results;
})->name("members");

Route::middleware(['auth'])->group(function () {
    Route::resource("/admin/complains", ComplainController::class)->names([
        'index'   => 'admin.complains.index',
        'create'  => 'admin.complains.create',
        'store'   => 'admin.complains.store',
        'show'    => 'admin.complains.show',
        'edit'    => 'admin.complains.edit',
        'update'  => 'admin.complains.update',
        'destroy' => 'admin.complains.destroy',
    ]);
    Route::resource("/admin/types", ComplainTypeController::class)->names([
        'index'   => 'admin.types.index',
        'create'  => 'admin.types.create',
        'store'   => 'admin.types.store',
        'show'    => 'admin.types.show',
        'edit'    => 'admin.types.edit',
        'update'  => 'admin.types.update',
        'destroy' => 'admin.types.destroy',
    ]);
    Route::resource("/admin/users", UserController::class)->names([
        'index'   => 'admin.users.index',
        'create'  => 'admin.users.create',
        'store'   => 'admin.users.store',
        'show'    => 'admin.users.show',
        'edit'    => 'admin.users.edit',
        'update'  => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);

    Route::get("/admin/{type}/questions", [QuestionController::class, "index"])->name("admin.questions");
    Route::put("/admin/question/{question}/edit", [QuestionController::class, "update"])->name('questions.update');
    Route::delete("/admin/question/{question}/delete", [QuestionController::class, "destroy"])->name('questions.destroy');
    Route::get("/admin/question/{type}/create", [QuestionController::class, "create"])->name('questions.create');
    Route::post("/admin/question/{type}/create", [QuestionController::class, "store"])->name("questions.store");

    Route::put("/admin/complain/{complain}/highlight", [ComplainController::class, "highlight"])->name("complain.highlight");
});

Route::get("/", [\App\Http\Controllers\User\ComplainController::class, "index"])->name("complain.index");
Route::post("/", [\App\Http\Controllers\User\ComplainController::class, "store"])->name("complain.submit");


// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
