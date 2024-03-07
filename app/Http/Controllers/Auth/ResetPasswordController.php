<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    protected function validationErrorMessages()
    {
        return [
            'password.required' => 'Mật khẩu mới không được để trống',
            'password.string' => 'Mật khẩu phải là ký tự',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự',
            'password_confirmation.required' => 'Mật khẩu xác nhận không được để trống',
            'password_confirmation.same' => 'Mật khẩu xác nhận không khớp',
        ];
    }

    protected function rules()
    {
        return [
            'password' => ['required', 'string', 'min:6'],
            'password_confirmation' => ['required', 'same:password'],
        ];
    }
}
