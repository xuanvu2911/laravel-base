@extends('layouts.admin')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Hồ sơ cá nhân')

@section('content')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light"></span> <i class='bx bx-user'></i> Thông tin tài khoản</h4>
    <div class="row">
        <!-- User Sidebar -->
        <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">

            <!-- User Card -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="user-avatar-section">
                        <div class="d-flex align-items-center flex-column">
                            <img src="/backend/assets/img/avatars/{{ $user->picture ?? 'default-avatar.png' }}"
                                alt="user-avatar" class="img-fluid rounded my-4 show-avatar-photo" height="110"
                                width="110" />

                            <div class="user-info text-center">
                                <h4 class="mb-2 show-name">{{ $user->name }}</h4>
                                <span class="bg-label-secondary show-username">{{ $user->username }}</span>
                                <h5 class="pb-2 border-bottom mb-4"></h5>
                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block"
                                            onclick="event.preventDefault();document.getElementById('user_profile_file').click();">Chọn
                                            ảnh thay thế</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input type="file" name="user_profile_file" id="user_profile_file"
                                            class="account-file-input" hidden accept="image/png, image/jpeg" />
                                    </label>
                                    <p class="text-muted mb-0">Chỉ nhận các định dạng ảnh JPG, GIF or PNG.<br>Dung lượng
                                        tối đa 800kb</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /User Card -->

        </div>
        <!--/ User Sidebar -->

        <!-- User Content -->
        <div class="col-xl-8">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-home" aria-controls="navs-pills-justified-home"
                            aria-selected="true">
                            <i class="bx bx-user me-1"></i>Tài khoản
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-profile" aria-controls="navs-pills-justified-profile"
                            aria-selected="false">
                            <i class="bx bx-lock-alt me-1"></i> Thay đổi mật khẩu
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
                        <div class="card-body">
                            <form action="<?= route('admin.update_user_details') ?>" method="POST"
                                id="personal_details_from">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Họ và tên </label>
                                        <input class="form-control" type="text" id="name" name="name"
                                            value="{{ $user->name }}" autofocus="">
                                        <span class="show-error name_error"></span>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="username" class="form-label">Tài khoản đăng nhập</label>
                                        <input class="form-control" type="text" name="username" id="username"
                                            value="{{ $user->username }}">
                                        <span class="show-error username_error"></span>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button id="updateInfoBtn" type="submit" class="btn btn-primary me-2">Cập
                                        nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
                        <div class="card-body">
                            <form action="<?= route('admin.change_password') ?>" method="POST"
                                id="change_password_form">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-6 form-password-toggle">
                                        <label class="form-label" for="currentPassword">Mật khẩu hiện tại</label>
                                        <div class="input-group input-group-merge has-validation">
                                            <input class="form-control" type="password" name="current_password"
                                                id="current_password" placeholder="············">
                                            <span class="input-group-text cursor-pointer"><i
                                                    class="bx bx-hide"></i></span>
                                            <span class="show-error current_password_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6 form-password-toggle">
                                        <label class="form-label" for="newPassword">Mật khẩu mới</label>
                                        <div class="input-group input-group-merge has-validation">
                                            <input class="form-control" type="password" id="new_password"
                                                name="new_password" placeholder="············">
                                            <span class="input-group-text cursor-pointer"><i
                                                    class="bx bx-hide"></i></span>
                                            <span class="show-error new_password_error"></span>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6 form-password-toggle">
                                        <label class="form-label" for="confirmPassword">Xác nhận mật khẩu mới</label>
                                        <div class="input-group input-group-merge has-validation">
                                            <input class="form-control" type="password" name="confirm_new_password"
                                                id="confirm_new_password" placeholder="············">
                                            <span class="input-group-text cursor-pointer"><i
                                                    class="bx bx-hide"></i></span>
                                            <span class="show-error confirm_new_password_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-1" id="parentSubmit">
                                    <button id="submitBtn" class="btn btn-primary me-2">Lưu thay đổi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ User Content -->
    </div>
</div>
<!-- / Content -->
</div>
@endsection

@section('js')

<script>
    $('#personal_details_from').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            var formdata = new FormData(form);
            var url = $(form).attr('action');
            var method = $(form).attr('method');

            $.ajax({
                url: url,
                method: method,
                data: formdata,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    toastr.remove();
                    $(form).find('span.show-error').text('');
                },
                success: function(response) {
                    if ($.isEmptyObject(response.errors)) {
                        if (response.status == 1) {
                            $('.show-name').each(function() {
                                $(this).html(response.user_info.name);
                            });
                            $('.show-username').each(function() {
                                $(this).html(response.user_info.username);
                            });
                            toastr.success(response.msg);
                        } else {
                            toastr.error(response.msg);
                        }
                    } else {
                        $.each(response.errors, function(prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val);
                        });
                    }
                }
            });
        });

        $('#change_password_form').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            var formdata = new FormData(form);
            var url = $(form).attr('action');
            var method = $(form).attr('method');

            $.ajax({
                url: url,
                method: method,
                data: formdata,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    toastr.remove();
                    $(form).find('span.show-error').text('');
                    $.blockUI({
                        message: '<div class="sk-wave mx-auto"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div>',
                        timeout: 10000,
                        css: {
                            backgroundColor: 'transparent',
                            border: '0'
                        },
                        overlayCSS: {
                            opacity: 0.5
                        }
                    });
                },
                success: function(response) {
                    if ($.isEmptyObject(response.errors)) {
                        if (response.status == 1) {
                            toastr.success(response.msg);
                            $(form).find('input[type="password"]').val('');
                            $.unblockUI();
                        } else {
                            $.unblockUI();
                            toastr.error(response.msg);
                        }
                    } else {
                        $.each(response.errors, function(prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val);
                        });
                        $.unblockUI();
                    }
                }
            });
        });

        $('#user_profile_file').ijaboCropTool({
            preview: '.show-avatar-photo',
            setRatio: 1,
            allowedExtensions: ['jpg', 'jpeg', 'png'],
            buttonsText: ['CROP', 'QUIT'],
            buttonsColor: ['#30bf7d', '#ee5155', -15],
            processUrl: '{{ route('admin.update_profile_picture') }}',
            withCSRF: ['_token', '{{ csrf_token() }}'],
            onSuccess: function(message, element, status) {
                if (status == 1) {
                    toastr.success(message);
                } else {
                    toastr.error(message);
                }
            },
            onError: function(message, element, status) {
                alert(message);
            }
        });
</script>
@endSection