<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginHandler(Request $request)
    {
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $request->validate(
            [
                'login_id' => ['required', 'string', 'min:5'],
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
}
