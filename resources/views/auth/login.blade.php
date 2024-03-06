@extends('auth.auth')

@section('content')
    <!-- Login -->
    <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-5 p-4">
        <div class="w-px-400 mx-auto">
            <!-- Logo -->
            <div class="app-brand mb-5">
                <a href="index.html" class="app-brand-link gap-2">
                    <span class="app-brand-logo demo">
                        <img src="backend/assets/img/logos/default-logo.png" class="img-fluid" alt="Logo image" />
                    </span>
                    <span class="app-brand-text demo text-body fw-bold">Laravel Base</span>
                </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Xin chào! 👋</h4>
            <p class="mb-4">Hãy đăng nhập để truy cập vào hệ thống</p>
            <form id="formAuthentication" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email hoặc Username</label>
                    <input id="username" class="form-control" class="form-control @error('username') is-invalid @enderror"
                        name="username" value="{{ old('username') }}" autocomplete="email"
                        placeholder="Nhập email hoặc username..." autofocus />

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="password">Mật khẩu</label>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                <small>Quên mật khẩu?</small>
                            </a>
                        @endif
                    </div>
                    <div class="input-group input-group-merge">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            name="password" autocomplete="current-password" aria-describedby="password" />
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember-me"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember-me"> Remember Me </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary d-grid w-100">Đăng nhập</button>
            </form>

            <p class="text-center">
                <span>Bạn chưa có tài khoản?</span>
                <a href="{{ route('register') }}"><span>Đăng ký tài khoản</span></a>
            </p>

            <div class="divider my-4">
                <div class="divider-text">hoặc</div>
            </div>

            <div class="d-flex justify-content-center">
                <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
                    <i class="tf-icons bx bxl-facebook"></i>
                </a>

                <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">
                    <i class="tf-icons bx bxl-google-plus"></i>
                </a>

                <a href="javascript:;" class="btn btn-icon btn-label-twitter">
                    <i class="tf-icons bx bxl-twitter"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- /Login -->
@endsection
