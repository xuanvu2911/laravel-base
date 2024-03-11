@extends('auth.auth')

@section('css')
<link rel="stylesheet" href="/backend/assets/vendor/libs/spinkit/spinkit.css" />
@endsection

@section('content')

<!-- Forgot Password -->
<div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-5 p-4">
    <div class="w-px-400 mx-auto">
        <!-- Logo -->
        <div class="app-brand mb-5">
            <a href="{{ route('admin.home') }}" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                    <img src="/backend/assets/img/logos/default-logo.png" class="img-fluid" alt="Logo image" />
                </span>
                <span class="app-brand-text demo text-body fw-bold">Laravel Base</span>
            </a>
        </div>
        <!-- /Logo -->
        <h4 class="mb-2">Bạn quên mật khẩu? 🔒</h4>
        <p class="mb-4">Hãy nhập email của bạn và nhấn vào nút bên dưới để nhận email tạo lại mật khẩu.</p>

        @if (session('fail'))
        <div class="alert alert-danger" role="alert">
            {{ session('fail') }}
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ route('admin.send_password_reset_link') }}" class="mb-3" id="forgotPassword">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}"
                    placeholder="Nhập email của bạn..." autofocus />
                @error('email')
                <span class="show-error">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary d-grid w-100" id="submitBtn">Nhận email tạo lại mật
                khẩu</button>
            <div class="mb-3" id="spinner" style="margin: auto; width: 10%;">
            </div>
        </form>
        <div class="text-center">
            <a href="{{ route('admin.login') }}" class="d-flex align-items-center justify-content-center">
                <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                <span>Quay lại trang đăng nhập</span>
            </a>
        </div>
    </div>
</div>
<!-- /Forgot Password -->
@endsection

@section('js')
<script>
    //SHOW SPINNER WHEN SUBMIT FORM
    $(document).ready(() => {
        $('#forgotPassword').on('submit', function(e) {
            var spinner = '<div class="sk-wave sk-primary"> <div class = "sk-wave-rect"> </div> <div class = "sk-wave-rect"> </div> <div class = "sk-wave-rect"> </div> <div class = "sk-wave-rect"> </div> <div class = "sk-wave-rect"> </div> </div>'
            $("#submitBtn").remove();
            $("#spinner").append(spinner);
        });
    });
</script>
@endsection