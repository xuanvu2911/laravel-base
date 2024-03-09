@extends('auth.auth')

@section('content')

<!-- Confirm Password -->
<div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-5 p-4">
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
        <h4 class="mb-2">Xác nhận mật khẩu 🔒</h4>
        <div class="alert alert-warning" role="alert">
            Vui lòng nhập mật khẩu để tiếp tục.
        </div>


        <form method="POST" action="{{ route('password.confirm') }}" class="mb-3" id="confirmPassword">
            @csrf
            <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password">Mật khẩu</label>
                <div class="input-group input-group-merge has-validation">
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

            <div class=" mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                    <div class=" form-check">
                        <button type="submit" class="btn btn-primary d-grid w-100" id="submitBtn">Xác nhận mật
                            khẩu</button>
                    </div>

                    @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        <small>Quên mật khẩu?</small>
                    </a>
                    @endif

                </div>
            </div>
        </form>
    </div>
</div>
<!-- /Confirm Password -->
@endsection