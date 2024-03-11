<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest', 'PreventBackHistory'])->group(function () {
        //Login
        Route::view('/login', 'admin.auth.login')->name('login');
        Route::post('/login_handler', [LoginController::class, 'loginHandler'])->name('login_handler');

        //Forgot Password
        Route::view('/forgot-password', 'admin.auth.forgot-password')->name('forgot_password');
        Route::post('/send-password-reset-link', [ForgotPasswordController::class, 'sendPasswordResetLink'])->name('send_password_reset_link');
        Route::get('/password/reset/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('reset_password');
        Route::post('/reset-password-handler', [ForgotPasswordController::class, 'resetPasswordHandler'])->name('reset_password_handler');

        //Register
        Route::view('/register', 'admin.auth.register')->name('register');
        Route::post('/register-handler', [RegisterController::class, 'registerHandler'])->name('register_handler');
    });

    Route::middleware(['auth', 'PreventBackHistory'])->group(function () {
        Route::view('/', 'admin.dashboard');
        Route::view('/home', 'admin.dashboard')->name('home');
        Route::post('/logout_handler', [LoginController::class, 'logoutHandler'])->name('logout_handler');
        Route::get('/profile', [AdminController::class, 'profileView'])->name('profile');
        Route::post('/update-user-details', [AdminController::class, 'updatePersonalDetails'])->name('update_user_details');
        Route::post('/change-password', [AdminController::class, 'changePassword'])->name('change_password');
        Route::post('/update-profile-picture', [AdminController::class, 'updateProfilePicture'])->name('update_profile_picture');
    });

    // Route::get('/register', [AdminController::class, 'register'])->name('register');
});

//notice to the new register or didn't verify.
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

//link sent to register
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

//resend email verify
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');
