<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use App\Rules\Blank;
use App\Rules\Vietnamese;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
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
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:5'],
            'username' => ['bail','required', 'string', 'min:5', new Vietnamese, new Blank],
        ], [
            'required' => ':attribute không được để trống',
            'string' => ':attribute phải là ký tự',
            'min' => ':attribute phải có ít nhất :min ký tự',
            'unique' => ':attribute đã được sử dụng trên hệ thống',
        ], [
            'name' => 'Họ và Tên',
            'username' => 'Username',
        ]);

        if ($validator->fails()) {
            return json_encode(['errors' => $validator->errors()->toArray()]);
        }

        $user_id = Auth::id();
        $user = User::find($user_id);
        $user->name = $request->name;
        $user->username = $request->username;
        $update = $user->save();
        if ($update) {
            $user_info = User::find($user_id);
            return json_encode(['status' => 1, 'user_info' => $user_info, 'msg' => 'Thông tin tài khoản đã được cập nhật']);
        } else {
            return json_encode(['status' => 0, 'msg' => 'Something went wrong.']);
        }
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['bail', 'required', 'current_password'],
            'new_password' => ['bail','required', 'string', 'min:6', new Vietnamese, new Blank],
            'confirm_new_password' => ['required', 'same:new_password', 'string'],
        ], [
            'required' => ':attribute không được để trống',
            'string' => ':attribute phải là ký tự',
            'min' => ':attribute phải có ít nhất :min ký tự',
            'same' => ':attribute không trùng khớp mật khẩu mới',
            'current_password' => 'Mật khẩu hiện tại không chính xác'
        ], [
            'current_password' => 'Mật khẩu hiện tại',
            'new_password' => 'Mật khẩu mới',
            'confirm_new_password' => 'Xác nhận mật khẩu',
        ]);

        if ($validator->fails()) {
            return json_encode(['errors' => $validator->errors()->toArray()]);
        }

        $user_id = Auth::id();
        $user = User::find($user_id);
        $user->password =  Hash::make($request->new_password);
        $user->save();

        //Send Email notification to user(admin) email address
        $data = array(
            'user' => $user,
            'password' => $request->new_password
        );

        $mail_body = view('email-templates.reset-password', $data)->render();

        $mailConfig = array(
            'mail_recipient_email' => $user->email,
            'mail_recipient_name' => $user->name,
            'mail_subject' => '[Laravel-Base] Password Changed',
            'mail_body' => $mail_body,
        );
        $result = sendEmail($mailConfig);
        if ($result) {
            return json_encode(['status' => 1, 'user_info' => $user, 'msg' => 'Mật khẩu hiện tại đã được thay đổi']);
        } else {
            return json_encode(['status' => 0, 'msg' => 'Đã có lỗi xảy ra, vui lòng thử lại sau.']);
        }
    }

    public function updateProfilePicture(Request $request)
    {
        $user_id = Auth::id();
        $user = User::find($user_id);

        $thumbnailPath = public_path('backend/assets/img/avatars/thumbnail');
        $image = $request->file('user_profile_file');
        $extension = $image->extension();

        $old_picture = $user->picture;
        $new_filename = 'UIMG_' . rand(2, 1000) . $user_id . time() . uniqid() . '.' . $extension;

        $realPath = $image->getRealPath();
        $imgFile = Image::make($realPath);

        //Save image to thumbnail folder
        //To resize image we must have to remove ";" in line ";extension = gd" within PHP.ini file.
        $imgFile->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save($thumbnailPath . '/' . $new_filename);

        //Save image to Destination folder
        $destinationPath = public_path('/backend/assets/img/avatars');
        $imgFile->resize(450, 450, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath . '/' . $new_filename);

        if ($old_picture != null && File::exists(public_path($destinationPath . $old_picture))) {
            File::delete(public_path($destinationPath . $old_picture));
            File::delete(public_path($thumbnailPath . $old_picture));
        }
        $user->picture = $new_filename;
        $user->save();
        return response()->json(['status' => 1, 'msg' => 'Hình ảnh đại diện của bạn đã được thay đổi thành công.']);
    }
}
