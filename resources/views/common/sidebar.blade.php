<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="index.html">
            <div class="logo-img">
                <i class="header-brand-img ik ik-code pl-5"></i>
            </div>
            <span class="text">{{ config('app.name') }}</span>
        </a>
        <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>
    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main" x-data="{url: '{{ url()->current() }}'}">
                <div class="nav-item" :class="{'active' : '{{ route('admin.dashboard') }}' == url }">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="ik ik-bar-chart-2"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
                <div class="nav-lavel">System</div>
                <div class="nav-item has-sub"
                    :class="{
                        'active open' : [
                            '{{ route('admin.system.user.index') }}',
                            '{{ route('admin.system.role.index') }}',
                            '{{ route('admin.system.permission.index') }}'
                        ].includes(url)
                    }">
                <a class="cursor-hand">
                    <i class="ik ik-sliders"></i>
                    <span>System</span>
                </a>
                <div class="submenu-content">
                    <a href="{{ route('admin.system.user.index') }}" :class="{'active' : '{{ route('admin.system.user.index') }}' == url }" class="menu-item">
                        <i class="ik ik-users"></i>
                        <span>Users</span>
                    </a>
                    <a href="{{ route('admin.system.role.index') }}" :class="{'active' : '{{ route('admin.system.role.index') }}' == url }" class="menu-item">
                        <i class="ik ik-user-check"></i>
                        <span>Roles</span>
                    </a>
                    <a href="{{ route('admin.system.permission.index') }}" :class="{'active' : '{{ route('admin.system.permission.index') }}' == url }" class="menu-item">
                        <i class="ik ik-shield"></i>
                        <span>Permissions</span>
                    </a>
                </div>
            </div>

                {{-- <div class="nav-lavel">Forms</div>
                <div class="nav-item">
                    <a href="form-picker.html"><i class="ik ik-terminal"></i><span>Form Picker</span> <span class="badge badge-success">New</span></a>
                </div>
                <div class="nav-lavel">Tables</div>
                <div class="nav-item">
                    <a href="table-bootstrap.html"><i class="ik ik-credit-card"></i><span>Bootstrap Table</span></a>
                </div>
                <div class="nav-item">
                    <a href="table-datatable.html"><i class="ik ik-inbox"></i><span>Data Table</span></a>
                </div>

                <div class="nav-lavel">Charts</div>
                <div class="nav-item has-sub">
                    <a href="#"><i class="ik ik-pie-chart"></i><span>Charts</span> <span class="badge badge-success">New</span></a>
                    <div class="submenu-content">
                        <a href="charts-chartist.html" class="menu-item">Chartist</a>
                        <a href="charts-flot.html" class="menu-item">Flot</a>
                        <a href="charts-knob.html" class="menu-item">Knob</a>
                        <a href="charts-amcharts.html" class="menu-item">Amcharts</a>
                    </div>
                </div>

                <div class="nav-lavel">Apps</div>
                <div class="nav-item">
                    <a href="calendar.html"><i class="ik ik-calendar"></i><span>Calendar</span></a>
                </div>
                <div class="nav-item">
                    <a href="taskboard.html"><i class="ik ik-server"></i><span>Taskboard</span></a>
                </div>

                <div class="nav-lavel">Pages</div>

                <div class="nav-item has-sub">
                    <a href="#"><i class="ik ik-lock"></i><span>Authentication</span></a>
                    <div class="submenu-content">
                        <a href="login.html" class="menu-item">Login</a>
                        <a href="register.html" class="menu-item">Register</a>
                        <a href="forgot-password.html" class="menu-item">Forgot Password</a>
                    </div>
                </div>
                <div class="nav-item has-sub">
                    <a href="#"><i class="ik ik-file-text"></i><span>Other</span></a>
                    <div class="submenu-content">
                        <a href="profile.html" class="menu-item">Profile</a>
                        <a href="invoice.html" class="menu-item">Invoice</a>
                    </div>
                </div>
                <div class="nav-item">
                    <a href="layouts.html"><i class="ik ik-layout"></i><span>Layouts</span><span class="badge badge-success">New</span></a>
                </div>
                <div class="nav-lavel">Other</div>
                <div class="nav-item has-sub">
                    <a href="javascript:void(0)"><i class="ik ik-list"></i><span>Menu Levels</span></a>
                    <div class="submenu-content">
                        <a href="javascript:void(0)" class="menu-item">Menu Level 2.1</a>
                        <div class="nav-item has-sub">
                            <a href="javascript:void(0)" class="menu-item">Menu Level 2.2</a>
                            <div class="submenu-content">
                                <a href="javascript:void(0)" class="menu-item">Menu Level 3.1</a>
                            </div>
                        </div>
                        <a href="javascript:void(0)" class="menu-item">Menu Level 2.3</a>
                    </div>
                </div>
                <div class="nav-item">
                    <a href="javascript:void(0)" class="disabled"><i class="ik ik-slash"></i><span>Disabled Menu</span></a>
                </div>
                <div class="nav-item">
                    <a href="javascript:void(0)"><i class="ik ik-award"></i><span>Sample Page</span></a>
                </div>
                <div class="nav-lavel">Support</div>
                <div class="nav-item">
                    <a href="javascript:void(0)"><i class="ik ik-monitor"></i><span>Documentation</span></a>
                </div>
                <div class="nav-item">
                    <a href="javascript:void(0)"><i class="ik ik-help-circle"></i><span>Submit Issue</span></a>
                </div> --}}
            </nav>
        </div>
    </div>
</div>
