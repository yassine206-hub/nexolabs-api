<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Artisan;
// Public — soumettre une demande
Route::post('/contact', [ContactController::class, 'store']);

// Admin — connexion
Route::post('/admin/login', [AdminAuthController::class, 'login']);

// Admin — routes protégées
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin/contacts',        [DashboardController::class, 'index']);
    Route::patch('/admin/contacts/{id}', [DashboardController::class, 'markRead']);
    Route::post('/admin/logout',         [AdminAuthController::class, 'logout']);
    Route::get('/setup', function () {
    try {
        Artisan::call('migrate', ['--force' => true]);
        Artisan::call('db:seed', ['--force' => true]);
        return response()->json(['message' => 'Migration et seed réussis !']);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
    });
});