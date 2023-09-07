<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReimbursementController;
use Illuminate\Support\Facades\Route;

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
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('/', DashboardController::class);
    Route::resource('users', ManageUserController::class)->middleware('can:crudUser,App\Models\User');
    Route::resource('reimbursement', ReimbursementController::class);
    Route::get('reimbursement/download/{id}', [ReimbursementController::class, 'downloadFile']);
});

require __DIR__.'/auth.php';


