<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item navbar-search-wrapper mb-0">
                <a class="nav-item nav-link search-toggler px-0" href="javascript:void(0);">
                    <i class="bx bx-search bx-sm"></i>
                    <span class="d-none d-md-inline-block text-muted">Tìm kiếm (Ctrl+/)</span>
                </a>
            </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Language -->
            {{-- <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <i class="bx bx-globe bx-sm"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-language="en"
                            data-text-direction="ltr">
                            <span class="align-middle">English</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-language="fr"
                            data-text-direction="ltr">
                            <span class="align-middle">French</span>
                        </a>
                    </li>
                </ul>
            </li> --}}
            <!-- /Language -->

            <!-- Quick links  -->
            {{-- <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-2 me-xl-0">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" aria-expanded="false">
                    <i class="bx bx-grid-alt bx-sm"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end py-0">
                    <div class="dropdown-menu-header border-bottom">
                        <div class="dropdown-header d-flex align-items-center py-3">
                            <h5 class="text-body mb-0 me-auto">Shortcuts</h5>
                            <a href="javascript:void(0)" class="dropdown-shortcuts-add text-body"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Add shortcuts"><i
                                    class="bx bx-sm bx-plus-circle"></i></a>
                        </div>
                    </div>
                    <div class="dropdown-shortcuts-list scrollable-container">
                        <div class="row row-bordered overflow-visible g-0">
                            <div class="dropdown-shortcuts-item col">
                                <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                                    <i class="bx bx-calendar fs-4"></i>
                                </span>
                                <a href="app-calendar.html" class="stretched-link">Calendar</a>
                                <small class="text-muted mb-0">Appointments</small>
                            </div>
                            <div class="dropdown-shortcuts-item col">
                                <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                                    <i class="bx bx-food-menu fs-4"></i>
                                </span>
                                <a href="app-invoice-list.html" class="stretched-link">Invoice App</a>
                                <small class="text-muted mb-0">Manage Accounts</small>
                            </div>
                        </div>
                        <div class="row row-bordered overflow-visible g-0">
                            <div class="dropdown-shortcuts-item col">
                                <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                                    <i class="bx bx-user fs-4"></i>
                                </span>
                                <a href="app-user-list.html" class="stretched-link">User App</a>
                                <small class="text-muted mb-0">Manage Users</small>
                            </div>
                            <div class="dropdown-shortcuts-item col">
                                <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                                    <i class="bx bx-check-shield fs-4"></i>
                                </span>
                                <a href="app-access-roles.html" class="stretched-link">Role
                                    Management</a>
                                <small class="text-muted mb-0">Permission</small>
                            </div>
                        </div>
                        <div class="row row-bordered overflow-visible g-0">
                            <div class="dropdown-shortcuts-item col">
                                <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                                    <i class="bx bx-pie-chart-alt-2 fs-4"></i>
                                </span>
                                <a href="index.html" class="stretched-link">Dashboard</a>
                                <small class="text-muted mb-0">User Profile</small>
                            </div>
                            <div class="dropdown-shortcuts-item col">
                                <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                                    <i class="bx bx-cog fs-4"></i>
                                </span>
                                <a href="pages-account-settings-account.html" class="stretched-link">Setting</a>
                                <small class="text-muted mb-0">Account Settings</small>
                            </div>
                        </div>
                        <div class="row row-bordered overflow-visible g-0">
                            <div class="dropdown-shortcuts-item col">
                                <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                                    <i class="bx bx-help-circle fs-4"></i>
                                </span>
                                <a href="pages-faq.html" class="stretched-link">FAQs</a>
                                <small class="text-muted mb-0">FAQs & Articles</small>
                            </div>
                            <div class="dropdown-shortcuts-item col">
                                <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                                    <i class="bx bx-window-open fs-4"></i>
                                </span>
                                <a href="modal-examples.html" class="stretched-link">Modals</a>
                                <small class="text-muted mb-0">Useful Popups</small>
                            </div>
                        </div>
                    </div>
                </div>
            </li> --}}
            <!-- Quick links -->

            <!-- Style Switcher -->
            <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <i class="bx bx-sm"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                            <span class="align-middle"><i class="bx bx-sun me-2"></i>Light</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                            <span class="align-middle"><i class="bx bx-moon me-2"></i>Dark</span>
                        </a>
                    </li>
                    {{-- <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                            <span class="align-middle"><i class="bx bx-desktop me-2"></i>System</span>
                        </a>
                    </li> --}}
                </ul>
            </li>
            <!-- / Style Switcher-->

            <!-- Notification -->
            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" aria-expanded="false">
                    <i class="bx bx-bell bx-sm"></i>
                    <span class="badge bg-danger rounded-pill badge-notifications">0</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end py-0">
                    <li class="dropdown-menu-header border-bottom">
                        <div class="dropdown-header d-flex align-items-center py-3">
                            <h5 class="text-body mb-0 me-auto">Thông báo</h5>
                            <a href="javascript:void(0)" class="dropdown-notifications-all text-body"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read"><i
                                    class="bx fs-4 bx-envelope-open"></i></a>
                        </div>
                    </li>
                    <li class="dropdown-notifications-list scrollable-container">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar">
                                            <img src="/backend/assets/img/avatars/{{ Auth::user()->picture ?? 'default-avatar.png' }}"
                                                alt class="w-px-40 h-auto rounded-circle show-avatar-photo" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        Chưa có thông báo mới.
                                    </div>
                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                        <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                                                class="badge badge-dot"></span></a>
                                        <a href="javascript:void(0)" class="dropdown-notifications-archive"><span
                                                class="bx bx-x"></span></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown-menu-footer border-top p-3">
                        <button class="btn btn-primary text-uppercase w-100">Xem tất cả thông báo</button>
                    </li>
                </ul>
            </li>
            <!--/ Notification -->
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="/backend/assets/img/avatars/{{Auth::user()->picture ?? 'default-avatar.png'}}" alt
                            class="w-px-40 h-auto rounded-circle show-avatar-photo" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="pages-account-settings-account.html">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="/backend/assets/img/avatars/{{Auth::user()->picture ?? 'default-avatar.png'}}"
                                            alt class="w-px-40 h-auto rounded-circle show-avatar-photo" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-medium d-block show-name">{{ Auth::user()->name }}</span>
                                    <small class="text-muted show-username">{{ Auth::user()->username }} - </small>
                                    <small class="text-muted">{{ Auth::user()->email }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.profile') }}">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">Hồ sơ cá nhân</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="pages-account-settings-account.html">
                            <i class="bx bx-cog me-2"></i>
                            <span class="align-middle">Cài đặt</span>
                        </a>
                    </li>

                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.logout_handler') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" target="_blank">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Đăng xuất</span>
                            <form id="logout-form" action="{{ route('admin.logout_handler') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            </div>
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>

    <!-- Search Small Screens -->
    <div class="navbar-search-wrapper search-input-wrapper d-none">
        <input type="text" class="form-control search-input container-xxl border-0" placeholder="Tìm kiếm..."
            aria-label="Tìm kiếm..." />
        <i class="bx bx-x bx-sm search-toggler cursor-pointer"></i>
    </div>
</nav>