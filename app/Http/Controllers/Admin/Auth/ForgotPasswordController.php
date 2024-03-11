<?php

namespace App\Http\Controllers\Admin\Auth;


use constDefaults;
use App\Models\User;
use App\Rules\Blank;
use App\Rules\Vietnamese;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
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
        $actionLink = route('admin.reset_password', ['token' => $token, 'email' => $request->email]);

        //Create mail content
        $mail_body = view('email-templates.forgot-password', ['actionLink' => $actionLink, 'user' => $user])->render();

        $mailConfig = array(
            'mail_recipient_email' => $user->email,
            'mail_recipient_name' => $user->name,
            'mail_subject' => '[Laravel-Base] Reset Password',
            'mail_body' => $mail_body,
        );

        if (sendEmail($mailConfig)) {
            session()->flash('success', "Email tạo lại mật khẩu đã được gửi tới bạn.");
            return redirect()->route('admin.forgot_password');
        } else {
            session()->flash('fail', 'Đã có lỗi xảy ra, xin thử lại sau.');
            return redirect()->route('admin.forgot_password');
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
                return redirect()->route('admin.forgot_password');
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
                'password' => ['bail','required', 'string', 'min:6', new Vietnamese, new Blank],
                'password_confirmation' => ['required', 'same:password'],
            ],
            [
                'password.required' => 'Mật khẩu mới không được để trống',
                'password.string' => 'Mật khẩu phải là ký tự',
                'password.min' => 'Mật khẩu phải có ít nhất :min ký tự',
                'password_confirmation.required' => 'Mật khẩu xác nhận không được để trống',
                'password_confirmation.same' => 'Mật khẩu xác nhận không trùng khớp',
            ],
            ['password'=>'Mật khẩu']
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
                return redirect()->route('admin.forgot_password');
            }
        } else {
            session()->flash('fail', "Mã xác thực không đúng, vui lòng yêu cầu lại đường dẫn tạo lại mật khẩu mới.");
        }
    }
}
