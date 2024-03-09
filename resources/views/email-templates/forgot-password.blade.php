<p>Xin chào {{$user->name}}</p>

<p>
    Chúng tôi đã nhận được yêu cầu thiết lập lại mật khẩu cho tài khoản liên kết với email:
    <i>{{$user->email}}</i>.
    Bạn có thể thiết lập lại mật khẩu của bạn bằng cách nhấn vào nút màu xanh bên dưới:

    <br><br>
    <a href="{{$actionLink}}"
        style="color:#fff;border-color:#22bc66;border-style:solid;border-width:5px 10px;background-color:#22bc66;display:inline-block;text-decoration:none;border-radius:3px;box-shadow:0 2px 3px rgba(0,0,0,0.16);-webkit-text-size-adjust:none;box-sizing:border-box;"
        target="_blank">Thiết lập lại mật khẩu</a>
    <br><br>
    <b>Lưu ý:</b> Đường dẫn này chỉ có thời hạn hiệu lực trong<span style="color:red;"><b> 60 phút </b></span>, sau thời
    gian trên bạn không thể sử dụng để thiết lập lại mật khẩu, bạn cần phải thực hiện yêu cầu gửi đường dẫn mới để thực
    hiện thiết lập lại mật khẩu nhé.
    <br><br>
    Nếu bạn không yêu cầu thiết lập lại mật khẩu, xin vui lòng bỏ qua email này.
</p>