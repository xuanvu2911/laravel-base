<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function validateLogin(Request $request)
    {
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
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'login_id' => 'Tên đăng nhập hoặc mật khẩu không hợp lệ',
        ]);
    }

    //add username for login field 
    protected function credentials(Request $request)
    {
        if (filter_var($request->login_id, FILTER_VALIDATE_EMAIL)) {
            $fieldDb = 'email';
        } else {
            $fieldDb = 'username';
        }

        $dataArr = [
            $fieldDb => $request->login_id,
            'password' => $request->password,
        ];
        return $dataArr;
    }


    //overide logout in AuthenticatesUsers to set login page when logout
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/login');
    }
}
