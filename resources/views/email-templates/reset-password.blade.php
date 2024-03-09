<p>Xin chào <b>{{ $user->name }}</b></p>

<p>
    Mật khẩu của bạn trên hệ thống đã được thay đổi thành công, dưới đây là thông tin đăng nhập mới của bạn:
    <br><br>
    <b>Tài khoản: </b> {{ $user->username }} hoặc {{ $user->email }}
    <br>
    <b>Mật khẩu: </b> {{ $password }}
</p>
<br>
Nhấn vào nút màu xanh bên dưới để vào trang đăng nhập.
<br><br>
<a href="{{ route('admin.login') }}"
    style="color:#fff;border-color:#22bc66;border-style:solid;border-width:5px 10px;background-color:#22bc66;display:inline-block;text-decoration:none;border-radius:3px;box-shadow:0 2px 3px rgba(0,0,0,0.16);-webkit-text-size-adjust:none;box-sizing:border-box;"
    target="_blank">Đăng nhập hệ thống</a>
<br><br>
------------------------------------------------------
<p>
    Email này được gửi tự động bằng hệ thống, do đó không phản hồi lại email này.
</p>
