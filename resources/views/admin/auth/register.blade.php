@extends('auth.auth')

@section('content')
    <!-- Register -->
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
            <h4 class="mb-2">Đăng ký tài khoản</h4>
            <p class="mb-4">Vui lòng kiểm tra thông tin trước khi nhấn nút đăng ký!</p>
            @if (session('msg'))
                <div class="alert alert-success text-center">
                    {{ session('msg') }}
                </div>
            @endif

            <form id="registerForm" method="POST" class="mb-3" action="{{ route('admin.register-handler') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Họ và Tên</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                        placeholder="Nhập họ và tên..." autocomplete="name" autofocus>
                    @error('name')
                        <span class="show-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">username</label>
                    <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}"
                        placeholder="Nhập username..." autocomplete="nausernameme" autofocus>
                    @error('username')
                        <span class="show-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">email</label>
                    <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}"
                        placeholder="Nhập email..." autocomplete="email" autofocus>
                    @error('email')
                        <span class="show-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="password">Mật khẩu</label>
                    </div>
                    <div class="input-group input-group-merge has-validation">
                        <input id="password" type="password" class="form-control" value="{{ old('password') }}"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            name="password" autocomplete="current-password" aria-describedby="password" />
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>

                        @error('password')
                            <span class="show-error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="password_confirmation">Mật khẩu</label>
                    </div>
                    <div class="input-group input-group-merge has-validation">
                        <input id="password_confirmation" type="password" class="form-control"
                            value="{{ old('password_confirmation') }}"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            name="password_confirmation" autocomplete="current-password"
                            aria-describedby="password_confirmation" />
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>

                        @error('password_confirmation')
                            <span class="show-error">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                        <label class="form-check-label" for="terms-conditions">
                            I agree to
                            <a href="javascript:void(0);">privacy policy & terms</a>
                        </label>
                    </div>
                </div> --}}

                <input class="btn btn-primary d-grid w-100 mb-3" type="submit" id="submitBtn" value="Đăng Ký">
                <!-- vunx - load spinner when submit form -->
                {{-- <div class="mb-3" id="spinner" style="margin: auto; width: 10%;">
                </div> --}}

                {{-- <button class="btn btn-primary d-grid w-100" type="submit" id="submitBtn" value="Đăng Ký">Sign up</button> --}}
            </form>

            <p class="text-center">
                <span>Nếu đã có tài khoản?</span>
                <a href="{{ route('admin.login') }}">
                    <span>Vào trang đăng nhập</span>
                </a>
            </p>

            <div class="divider my-4">
                <div class="divider-text">or</div>
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
    <!-- /Register -->
@endsection

@section('js')
    <script>
        //VUNX - LOAD SPINNER WHEN SUBMIT FORM
        // $(document).ready(() => {
        //     $('#registerForm').on('submit', function(e) {
        //         var spinner =
        //             '<div class="sk-wave sk-primary"> <div class = "sk-wave-rect"> </div> <div class = "sk-wave-rect"> </div> <div class = "sk-wave-rect"> </div> <div class = "sk-wave-rect"> </div> <div class = "sk-wave-rect"> </div> </div>'
        //         $("#submitBtn").remove();
        //         $("#spinner").append(spinner);
        //     });
        // });
    </script>
@endsection
