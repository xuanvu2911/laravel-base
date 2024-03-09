<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\User;

class AdminController extends Controller
{
    public function loginHandler(Request $request)
    {
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        //dd($fieldType);
        $request->validate(
            [
                'login_id' => 'required|string|min:5',
                'password' => 'required|string|min:6',
            ],
            [
                'login_id.required' => 'Thông tin đăng nhập bắt buộc phải nhập',
                'login_id.string' => 'Kiểu dữ liệu tên đăng nhập không hợp lệ',
                'login_id.min' => 'Tên đăng nhập không được ít hơn :min ký tự',
                'password.required' => 'Mật khẩu bắt buộc phải nhập',
                'password.string' => 'Kiểu dữ liệu mật khẩu không hợp lệ',
                'password.min' => 'Mật khẩu không được ít hơn :min ký tự'
            ]
        );

        $creds = array(
            $fieldType => $request->login_id,
            'password' => $request->password
        );

        $pageTitle = "Trang tổng quan";

        if (Auth::guard('web')->attempt($creds)) {
            return redirect()->route('admin.home', ['pageTitle' => $pageTitle]);
        } else {
            session()->flash('fail', 'Tên đăng nhập hoặc mật khẩu không đúng');
            return redirect()->route('admin.login');
        }
    }

    public function logoutHandler(Request $request)
    {
        Auth::guard('web')->logout();
        session()->flash('success', 'Bạn đã đăng xuất khỏi hệ thống.');
        return redirect()->route('admin.login');
    }

    public function sendPasswordResetLink(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|string|email|exists:users,email',
            ],
            [
                'email.required' => 'Email không được để trống.',
                'email.string' => 'Email phải là ký tự.',
                'email.email' => 'Email không đúng định dạng.',
                'email.exists' => 'Email bạn nhập chưa được đăng ký trên hệ thống.'
            ]
        );

        //Get user details
        $user = User::where('email', $request->email)->first();

        //Generate token
        $token = base64_encode(Str::random(64));

        //Check if there is an existing reset password token
        $oldToken = DB::table('password_reset_tokens')
            ->where('email', $request->email)->first();

        if ($oldToken) {
            //Update token
            DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->update([
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]);
        } else {
            //Add new token
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
        }

        //Create action link
        $actionLink = route('admin.reset-password', ['token' => $token, 'email' => $request->email]);


        //Create mail content
        $mail_body = view('email-templates.forgot-password', ['actionLink' => $actionLink, 'user' => $user])->render();

        $mailConfig = array(
            'mail_from_email' => env('MAIL_FROM_ADDRESS'),
            'mail_from_name' => env('MAIL_FROM_NAME'),
            'mail_recipient_email' => $user->email,
            'mail_recipient_name' => $user->name,
            'mail_subject' => '[Laravel-Base] Reset Password',
            'mail_body' => $mail_body,
        );

        if (sendEmail($mailConfig)) {
            session()->flash('success', "Email tạo lại mật khẩu đã được gửi tới bạn.");
            return redirect()->route('admin.forgot-password');
        } else {
            session()->flash('fail', 'Đã có lỗi xảy ra, xin thử lại sau.');
            return redirect()->route('admin.forgot-password');
        }
    }
}
