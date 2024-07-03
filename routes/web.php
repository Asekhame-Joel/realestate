<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'store'])->name('admin.profile.store');
    Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');

});

Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::get('agent', [AgentController::class, 'index'])->name('agent.index');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('user', [UserController::class, 'index'])->name('user.index');
});

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');







