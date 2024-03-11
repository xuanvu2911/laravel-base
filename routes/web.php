<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
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

// Route::get('/', function () {
//     return redirect(route('login'));
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/login', function () {
//     return view('auth.login');
// })->name('login');

Route::prefix('admin')->name('admin.')->group(function () {

    //Route::get('/', [DashboardController::class, 'index']);

    Route::middleware(['guest', 'PreventBackHistory'])->group(function () {
        Route::view('/login', 'admin.auth.login')->name('login');
        Route::post('/login_handler', [AdminController::class, 'loginHandler'])->name('login_handler');
        Route::view('/forgot-password', 'admin.auth.forgot-password')->name('forgot-password');
        Route::post('/send-password-reset-link', [AdminController::class, 'sendPasswordResetLink'])->name('send-password-reset-link');
        Route::get('/password/reset/{token}', [AdminController::class, 'resetPassword'])->name('reset-password');
        Route::post('/reset-password-handler', [AdminController::class, 'resetPasswordHandler'])->name('reset-password-handler');
        Route::view('/register', 'admin.auth.register')->name('register');
        Route::post('/register-handler', [AdminController::class, 'registerHandler'])->name('register-handler');
    });



    Route::middleware(['auth', 'PreventBackHistory'])->group(function () {
        Route::view('/', 'admin.dashboard');
        Route::view('/home', 'admin.dashboard')->name('home');
        Route::post('/logout_handler', [AdminController::class, 'logoutHandler'])->name('logout_handler');
        Route::get('/profile', [AdminController::class, 'profileView'])->name('profile');
        Route::post('/update-personal-details', [AdminController::class, 'updatePersonalDetails'])->name('update-personal-details');
        Route::post('/change-password', [AdminController::class, 'changePassword'])->name('change-password');
        Route::post('/update-profile-picture', [AdminController::class, 'updateProfilePicture'])->name('update-profile-picture');



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
