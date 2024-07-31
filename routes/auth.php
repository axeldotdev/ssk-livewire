<?php

use App\Http\Controllers\Auth\AccountOnboardingController;
use App\Http\Controllers\Auth\AssignmentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\CollaboratorsOnboardingController;
use App\Http\Controllers\Auth\CompanyInvitationController;
use App\Http\Controllers\Auth\CompanyOnboardingController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\ConnectedAccountController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\OnboardingController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\PhoneVerificationNotificationController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\SkipOnboardingController;
use App\Http\Controllers\Auth\VerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\VerifyPhoneController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get(
        'forgot-password',
        [PasswordResetLinkController::class, 'create'],
    )->name('password.request');

    Route::post(
        'forgot-password',
        [PasswordResetLinkController::class, 'store'],
    )->name('password.email');

    Route::get(
        'reset-password/{token}',
        [NewPasswordController::class, 'create'],
    )->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');

    Route::get('companies/{company}/invitations/{invitation}', [
        CompanyInvitationController::class,
        'show',
    ])->name('companies.invitations.show');

    Route::put('companies/{company}/invitations/{invitation}', [
        CompanyInvitationController::class,
        'update',
    ])->name('companies.invitations.update');
});

Route::post(
    'phone/verification-notification',
    [PhoneVerificationNotificationController::class, 'store'],
)->middleware(['throttle:6,1'])->name('phone-verification.send');

Route::middleware(['auth'])->group(function () {
    Route::get('verify-user', VerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        // ->middleware(['signed', 'throttle:6,1'])
        ->middleware(['throttle:6,1'])
        ->name('verification.verify');

    Route::post('verify-phone', VerifyPhoneController::class)
        // ->middleware(['signed', 'throttle:6,1'])
        ->middleware(['throttle:6,1'])
        ->name('phone-verification.verify');

    Route::post(
        'email/verification-notification',
        [EmailVerificationNotificationController::class, 'store'],
    )->middleware('throttle:6,1')->name('verification.send');

    Route::post('onboarding/account', [
        AccountOnboardingController::class,
        'store',
    ])->name('onboarding.account');

    Route::post('onboarding/company', [
        CompanyOnboardingController::class,
        'store',
    ])->name('onboarding.company');

    Route::post('onboarding/collaborators', [
        CollaboratorsOnboardingController::class,
        'store',
    ])->name('onboarding.collaborators');

    Route::get('onboarding/skip', [SkipOnboardingController::class, 'show'])
        ->name('onboarding.skip');

    Route::get('onboarding/{onboardingStep}', [
        OnboardingController::class,
        'show',
    ])->name('onboarding');

    Route::get('assignment', [AssignmentController::class, 'show'])
        ->name('assignment.show')
        ->middleware(['onboarded']);

    Route::post('assignment', [AssignmentController::class, 'store'])
        ->name('assignment.store')
        ->middleware(['onboarded']);

    Route::put('assignment', [AssignmentController::class, 'update'])
        ->name('assignment.update')
        ->middleware(['onboarded']);

    Route::get(
        'confirm-password',
        [ConfirmablePasswordController::class, 'show'],
    )->name('password.confirm');

    Route::post(
        'confirm-password',
        [ConfirmablePasswordController::class, 'store'],
    );

    Route::put('password', [PasswordController::class, 'update'])
        ->name('password.update');

    Route::post('logout', [
        AuthenticatedSessionController::class,
        'destroy',
    ])->name('logout');

    Route::delete(
        '/user/connected-account/{id}',
        [ConnectedAccountController::class, 'destroy'],
    )->name('connected-accounts.destroy');

    Route::post('password', [PasswordController::class, 'store'])
        ->name('password.set');
});
