<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;

Route::get('/login', [Admin\Auth\LoginController::class, 'login'])->name('login')->middleware('guest');

Route::middleware('auth')->group(function() {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [Admin\ProfileController::class, 'index'])->name('profile.index');
    Route::get('/logout', [Admin\Auth\LoginController::class, 'logout'])->name('logout');

    Route::prefix('/system')->name('system.')->group(function() {
        Route::get('/user', [Admin\System\UserController::class, 'index'])->name('user.index');
        Route::post('/user/table', [Admin\System\UserController::class, 'table'])->name('user.table');

        Route::get('/permissions', [Admin\System\PermissionController::class, 'index'])->name('permission.index');
        Route::post('/permissions/table', [Admin\System\PermissionController::class, 'table'])->name('permission.table');

        Route::get('/roles', [Admin\System\RoleController::class, 'index'])->name('role.index');
        Route::post('/roles/table', [Admin\System\RoleController::class, 'table'])->name('role.table');
    });
});

