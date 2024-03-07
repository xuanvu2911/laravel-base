<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    protected function validateEmail(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|string|email',
            ],
            [
                'email.required' => 'Email không được để trống.',
                'email.string' => 'Email phải là ký tự.',
                'email.email' => 'Email không đúng định dạng.',
            ]
        );
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        if ($request->wantsJson()) {
            throw ValidationException::withMessages([
                'email' => 'Email bạn nhập chưa được đăng ký trên hệ thống.',
            ]);
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'Email bạn nhập chưa được đăng ký trên hệ thống.']);
    }

    protected function sendResetLinkResponse(Request $request, $response)
    {
        return $request->wantsJson()
            ? new JsonResponse(['message' => 'Email tạo lại mật khẩu đã được gửi tới bạn.'], 200)
            : back()->with('status', 'Email tạo lại mật khẩu đã được gửi tới bạn.');
    }
}
