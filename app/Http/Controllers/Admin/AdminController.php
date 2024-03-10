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
use constDefaults;

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

    public function resetPassword(Request $request, $token = null)
    {
        $check_token = DB::table('password_reset_tokens')->where('token', $token)->first();

        if ($check_token) {
            //Check if token is not expried
            $diffMins = Carbon::createFromFormat('Y-m-d H:i:s', $check_token->created_at)->diffInMinutes(Carbon::now());
            if ($diffMins > constDefaults::tokenExpiredMinutes) {
                session()->flash('fail', 'Mã xác thực đã hết hạn, vui lòng yêu cầu lại đường dẫn tạo lại mật khẩu mới.');
                return redirect()->route('admin.forgot-password');
            } else {
                return view('admin.auth.reset-password')->with(['token' => $token, 'email' => $request->email]);
            }
        } else {
            session()->flash('fail', "Mã xác thực không đúng, vui lòng yêu cầu lại đường dẫn tạo lại mật khẩu mới.");
        }
    }

    public function resetPasswordHandler(Request $request)
    {
        $request->validate(
            [
                'password' => ['required', 'string', 'min:6'],
                'password_confirmation' => ['required', 'same:password'],
            ],
            [
                'password.required' => 'Mật khẩu mới không được để trống',
                'password.string' => 'Mật khẩu phải là ký tự',
                'password.min' => 'Mật khẩu phải có ít nhất :min ký tự',
                'password_confirmation.required' => 'Mật khẩu xác nhận không được để trống',
                'password_confirmation.same' => 'Mật khẩu xác nhận không khớp',
            ]
        );


        $token = DB::table('password_reset_tokens')->where(['token' => $request->token])->first();

        if ($token) {
            //Get user details
            $user = User::where('email', $token->email)->first();

            //Update password
            User::where('email', $user->email)->update([
                'password' => Hash::make($request->password)
            ]);

            //Delete token record
            DB::table('password_reset_tokens')->where('email', $user->email)->delete();

            //Send email to notify
            $data = array(
                'user' => $user,
                'password' => $request->password
            );
            $mail_body = view('email-templates.reset-password', $data)->render();
            $mailConfig = array(
                'mail_from_email' => env('MAIL_FROM_ADDRESS'),
                'mail_from_name' => env('MAIL_FROM_NAME'),
                'mail_recipient_email' => $user->email,
                'mail_recipient_name' => $user->name,
                'mail_subject' => '[Laravel-Base] Password Changed',
                'mail_body' => $mail_body,
            );

            if (sendEmail($mailConfig)) {
                session()->flash('success', "Mật khẩu của bạn đã tạo lại. Hãy sử dụng mật khẩu mới để đăng nhập vào hệ thống");
                return redirect()->route('admin.login');
            } else {
                session()->flash('fail', 'Đã có lỗi xảy ra, xin thử lại sau.');
                return redirect()->route('admin.forgot-password');
            }
        } else {
            session()->flash('fail', "Mã xác thực không đúng, vui lòng yêu cầu lại đường dẫn tạo lại mật khẩu mới.");
        }
    }

    public function registerHandler(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'min:5'],
                'username' => ['required', 'string', 'min:5', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6'],
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

        $result = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' =>  $request->username,
            'group_id' => 1,
            'password' => Hash::make($request->password),
        ]);
        if ($result) {
            session()->flash('success', 'Bạn đã đăng ký tài khoản thành công');
            return redirect()->route('admin.login');
        } else {
            session()->flash('fail', 'Đã có lổi xãy ra, vui lòng thử lại sau.');
            return redirect()->route('admin.register');
        }
    }

    public function profileView(Request $request)
    {
        if (Auth::guard('web')->check()) {
            $user = User::findOrFail(auth()->id());
        }
        $pageTitle = "Hồ Sơ cá nhân";
        return view('admin.profile.profile', compact('user', 'pageTitle'));
    }

    public function updatePersonalDetails(Request $request)
    {

        $user_id = Auth::user()->id;
        dd($request->ajax());
        if ($request->ajax()) {
            dd('afd');
            // $this->validate([
            //     'name' => [
            //         'rules' => 'required',
            //         'errors' => [
            //             'required' => 'Tên không được để trống'
            //         ]
            //     ],
            //     'username' => [
            //         'rules' => 'required|min_length[4]|is_unique[users.username,id,' . $user_id . ']|check_vietnamese|check_blank',
            //         'errors' => [
            //             'required' => 'Tài khoản không được để trống',
            //             'min_length' => 'Tài khoản phải có ít nhất 4 ký tự',
            //             'is_unique' => 'Tài khoản đã có trên hệ thống!',
            //             'check_vietnamese' => 'Tài khoản không được có dấu tiếng việt',
            //             'check_blank' => 'Tài khoản không được có khoảng trắng',
            //         ]
            //     ]
            // ]);

            // if ($validation->run() == FALSE) {
            //     $errors = $validation->getErrors();
            //     return json_encode(['status' => 0, 'error' => $errors]);
            // } else {
            //     $user = new User();
            //     $update = $user->where('id', $user_id)
            //         ->set([
            //             'name' => $request->getVar('name'),
            //             'username' => $request->getVar('username'),
            //             'bio' => $request->getVar('bio'),
            //         ])->update();


            //     if ($update) {
            //         $user_info = $user->find($user_id);
            //         return json_encode(['status' => 1, 'user_info' => $user_info, 'msg' => 'Thông tin tài khoản đã được cập nhật']);
            //     } else {
            //         return json_encode(['status' => 0, 'msg' => 'Something went wrong.']);
            //     }
            // }
        }
    }
}
