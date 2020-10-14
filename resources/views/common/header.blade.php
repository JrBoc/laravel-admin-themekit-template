<header class="header-top" header-theme="dark">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <div class="top-menu d-flex align-items-center">
                <button type="button" class="btn-icon mobile-nav-toggle d-lg-none ik ik-menu"></button>
            </div>
            <div class="top-menu d-flex align-items-center">
                <span class="text-nowrap text-white mt-2">
                    {{ auth()->user()->name ?? '' }}
                </span>
                <div class="dropdown ml-5">
                    <button class="nav-link" href="#" id="userDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ik ik-user"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('admin.profile.index') }}"><i class="ik ik-user dropdown-icon"></i> Profile</a>
                        <a class="dropdown-item" href="{{ route('admin.logout') }}"><i class="ik ik-power dropdown-icon"></i> Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
