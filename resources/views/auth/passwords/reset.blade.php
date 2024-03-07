@extends('auth.auth')

@section('css')
    <link rel="stylesheet" href="/backend/assets/vendor/libs/spinkit/spinkit.css" />
@endsection

@section('content')
    <!-- Reset Password -->
    <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-4 p-sm-5">
        <div class="w-px-400 mx-auto">
            <!-- Logo -->
            <div class="app-brand mb-5">
                <a href="{{ route('login') }}" class="app-brand-link gap-2">
                    <span class="app-brand-logo demo">
                        <img src="/backend/assets/img/logos/default-logo.png" class="img-fluid" alt="Logo image" />
                    </span>
                    <span class="app-brand-text demo text-body fw-bold">Laravel Base</span>
                </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Thiết Lập Lại Mật Khẩu 🔒</h4>
            <p class="mb-4">cho tài khoản:
                <span class="fw-medium"> {{ $email }}</span>
            </p>

            @if (session('status'))
                <div class="alert alert-danger" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form id="resetPassword" class="mb-3" method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password">Mật khẩu mới</label>
                    <div class="input-group input-group-merge">
                        <input type="password" id="password" class="form-control" name="password"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="password" />
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        @error('password')
                            <span class="show-error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password_confirmation">Xác nhận mật khẩu</label>
                    <div class="input-group input-group-merge">
                        <input type="password" id="password_confirmation" class="form-control" name="password_confirmation"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="password_confirmation" />
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        @error('password_confirmation')
                            <span class="show-error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" id="submitBtn" class="btn btn-primary d-grid w-100 mb-3">Đặt lại mật khẩu</button>
                <div class="mb-3" id="spinner" style="margin: auto; width: 10%;">
                </div>
                <div class="text-center">
                    <a href="{{ route('admin.') }}" class="d-flex align-items-center justify-content-center">
                        <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                        <span>Quay lại trang đăng nhập</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
    <!-- /Reset Password -->
@endsection

@section('js')
    <script>
        //SHOW SPINNER WHEN SUBMIT FORM
        $(document).ready(() => {
            $('#resetPassword').on('submit', function(e) {
                var spinner =
                    '<div class="sk-wave sk-primary"> <div class = "sk-wave-rect"> </div> <div class = "sk-wave-rect"> </div> <div class = "sk-wave-rect"> </div> <div class = "sk-wave-rect"> </div> <div class = "sk-wave-rect"> </div> </div>'
                $("#submitBtn").remove();
                $("#spinner").append(spinner);
            });
        });
    </script>
@endsection
