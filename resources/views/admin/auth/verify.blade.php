@extends('auth.auth')

@section('content')
    <!--  Verify email -->
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
            <h3 class="mb-2">Xác nhận email của bạn ✉️</h3>

            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    Một email xác nhận mới đã được gửi tới email của bạn.
                </div>
            @endif

            <p class="text-start">
                Liên kết kích hoạt tài khoản được gửi đến địa chỉ email của bạn, Vui lòng theo liên kết
                bên trong để tiếp tục.
            </p>

            <p class="text-start">
                Nếu bạn chưa nhận được email?
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-primary w-100 my-3">Nhấn vào đây để nhận email mới</button>.
            </form>
            </p>

        </div>
    </div>
    <!-- / Verify email -->
@endsection
