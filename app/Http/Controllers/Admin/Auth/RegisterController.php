<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\User;
use App\Rules\Blank;
use App\Rules\Vietnamese;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function registerHandler(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'min:5'],
                'username' => ['bail', 'required', 'string', 'min:5', 'unique:users', new Vietnamese, new Blank],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['bail', 'required', 'string', 'min:6', new Vietnamese, new Blank],
                'password_confirmation' => ['required', 'same:password'],
            ],
            [
                'required' => ':attribute không được để trống',
                'string' => ':attribute phải là ký tự',
                'min' => ':attribute phải có ít nhất :min ký tự',
                'unique' => ':attribute đã được sử dụng trên hệ thống',
                'email.email' => 'Email không đúng định dạng',
                'password_confirmation.same' => 'Mật khẩu xác nhận không khớp',
            ],
            [
                'name' => 'Họ và Tên',
                'username' => 'Username',
                'email' => 'Email',
                'password' => 'Mật khẩu',
                'password_confirmation' => 'Mật khẩu xác nhận',
            ]
        );

        $user = User::firstOrCreate([
            'name' => $request->name,
            'email' => $request->email,
            'username' =>  $request->username,
            'group_id' => 1,
            'password' => Hash::make($request->password),
        ]);
        if ($user) {
            //Send Email verify account.
            //Create mail content
            $mail_body = view('email-templates.register', ['user' => $user, 'password' => $request->password])->render();

            $mailConfig = array(
                'mail_recipient_email' => $user->email,
                'mail_recipient_name' => $user->name,
                'mail_subject' => '[Laravel-Base] Đăng ký tài khoản thành công',
                'mail_body' => $mail_body,
            );

            if (sendEmail($mailConfig)) {
                session()->flash('success', 'Bạn đã đăng ký tài khoản thành công');
                return redirect()->route('admin.login');
            } else {
                session()->flash('fail', 'Đã có lỗi xảy ra, xin thử lại sau.');
                return redirect()->route('admin.register');
            }
        } else {
            session()->flash('fail', 'Đã có lổi xãy ra, vui lòng thử lại sau.');
            return redirect()->route('admin.register');
        }
    }
}
