<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Auth\VerifyEmailController;

use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [AuthenticatedSessionController::class, 'loginShow'])->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'login']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'aa'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'aa'])
                ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'aa'])
                ->middleware('throttle:6,1')
                ->name('verification.send');




});

Route::middleware('auth:managers')->group(function () {
    Route::get('managers/login', [AuthenticatedSessionController::class, 'showManagerlogin'])->name('managers.login');
    
    Route::post('managers/login', [AuthenticatedSessionController::class, 'Managerlogin']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'showManagerlogin'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'Managerlogin'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'showManagerlogin'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'Managerlogin'])
                ->name('password.update');
});
Route::middleware('auth:superadmin')->group(function () {
    Route::get('/superadmins/login', [AuthenticatedSessionController::class, 'SuperAdminloginShow'])->name('superadmins.login');
    Route::post('/superadmins/login', [AuthenticatedSessionController::class, 'SuperAdminlogin'])->name('SuperAdminlogin'); 

    Route::get('superadmins/register', [RegisteredUserController::class, 'SuperAdminregistershow'])->name('SuperAdminregister');
    Route::post('superadmins/register', [RegisteredUserController::class, 'SuperAdminregister']);
    Route::post('superadminsdestroy', [AuthenticatedSessionController::class, 'superadminsdestroy'])
    
    ->name('superadminsdestroy');
});




