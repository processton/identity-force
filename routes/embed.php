<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->prefix('embed')->group(function (){

    Route::middleware('guest')->group(function () {
        Route::get('register', [RegisteredUserController::class, 'create'])
            ->name('embed.register');
        Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->name('embed.login');
        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
            ->name('embed.password.request');
        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
            ->name('embed.password.reset');
    });

    Route::middleware('auth')->group(function () {

        Route::get('verify-email', EmailVerificationPromptController::class)
            ->name('embed.verification.notice');

        Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
            ->middleware(['signed', 'throttle:6,1'])
            ->name('embed.verification.verify');

        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
            ->name('embed.password.confirm');

        Route::prefix('profile')->group(function (){
            Route::get('/basic', [ProfileController::class, 'basic'])->name('embed.profile.basic');
            Route::get('/login_and_security', [ProfileController::class, 'loginAndSecurity'])->name('embed.profile.login_security');
            Route::get('/notifications', [ProfileController::class, 'notifications'])->name('embed.profile.notifications');
            Route::get('/billing_and_payments', [ProfileController::class, 'billingAndPayments'])->name('embed.profile.billing_payments');

            Route::prefix('/edit')->group(function (){
                Route::get('/', [ProfileController::class, 'edit'])->name('embed.profile.edit');
            });

            Route::post('picture', [ProfileController::class, 'profilePicture'])->name('embed.profile.picture');

        });

    });

});
