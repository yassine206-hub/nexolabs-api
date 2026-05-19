<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;

// Public
Route::post('/contact', [ContactController::class, 'store']);

// Admin auth
Route::post('/admin/login', [AdminAuthController::class, 'login']);

// Admin protégé
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin/contacts',        [DashboardController::class, 'index']);
    Route::patch('/admin/contacts/{id}', [DashboardController::class, 'markRead']);
    Route::post('/admin/logout',         [AdminAuthController::class, 'logout']);
});