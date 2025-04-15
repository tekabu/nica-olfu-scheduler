<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- Sidebar header -->
        <div class="sidebar-section">
            <div class="sidebar-section-body d-flex justify-content-center">
                <h5 class="sidebar-resize-hide flex-grow-1 my-auto">Navigation</h5>

                <div>
                    <button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                        <i class="ph-arrows-left-right"></i>
                    </button>

                    <button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
                        <i class="ph-x"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- /sidebar header -->


        <!-- Main navigation -->
        <div class="sidebar-section">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="ph-house"></i>
                        <span>Calendar</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="ph-chart-pie"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item nav-item-submenu {{ in_array(request()->route()->getName(), ['feedback', 'events']) ? 'nav-item-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="ph-chat-circle-dots"></i>
                        <span>Feedback and Event</span>
                    </a>
                    <ul class="nav-group-sub collapse {{ in_array(request()->route()->getName(), ['feedbacks', 'feedbacks.view', 'events']) ? 'show' : '' }}">
                        @if(in_array($user->user_type, [USER_TYPE_STUDENT]))
                        <li class="nav-item">
                            <a href="{{ route('feedbacks') }}" class="nav-link {{ in_array(request()->route()->getName(), ['feedbacks', 'feedbacks.view']) ? 'active' : '' }}">
                                <i class="ph-chat-circle-dots"></i>
                                <span>Feedback</span>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('events') }}" class="nav-link {{ request()->routeIs('events') ? 'active' : '' }}">
                                <i class="ph-confetti"></i>
                                <span>Events</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @if(in_array($user->user_type, [USER_TYPE_SUPER_ADMIN, USER_TYPE_ADMIN]))
                <li class="nav-item nav-item-submenu {{ in_array(request()->route()->getName(), ['campuses', 'courses', 'year-levels']) ? 'nav-item-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="ph-graduation-cap"></i>
                        <span>Academic Management</span>
                    </a>
                    <ul class="nav-group-sub collapse {{ in_array(request()->route()->getName(), ['campuses', 'courses', 'year-levels']) ? 'show' : '' }}">
                        <li class="nav-item">
                            <a href="{{ route('campuses') }}" class="nav-link {{ request()->routeIs('campuses') ? 'active' : '' }}">
                                <i class="ph-house-simple"></i>
                                <span>Campuses</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('courses') }}" class="nav-link {{ request()->routeIs('courses') ? 'active' : '' }}">
                                <i class="ph-list"></i>
                                <span>Courses</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('year-levels') }}" class="nav-link {{ request()->routeIs('year-levels') ? 'active' : '' }}">
                                <i class="ph-list-plus"></i>
                                <span>Year Levels</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('locations') }}" class="nav-link {{ request()->routeIs('locations') ? 'active' : '' }}">
                                <i class="ph-map-pin"></i>
                                <span>Locations</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-item-submenu {{ in_array(request()->route()->getName(), ['students', 'program-heads', 'admins']) ? 'nav-item-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="ph-users-three"></i>
                        <span>Users</span>
                    </a>
                    <ul class="nav-group-sub collapse {{ in_array(request()->route()->getName(), ['students', 'program-heads', 'admins']) ? 'show' : '' }}">
                        <li class="nav-item">
                            <a href="{{ route('students') }}" class="nav-link {{ request()->routeIs('students') ? 'active' : '' }}">
                                <i class="ph-graduation-cap"></i>
                                <span>Students</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('program-heads') }}" class="nav-link {{ request()->routeIs('program-heads') ? 'active' : '' }}">
                                <i class="ph-user"></i>
                                <span>Program Heads</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admins') }}" class="nav-link {{ request()->routeIs('admins') ? 'active' : '' }}">
                                <i class="ph-users-three"></i>
                                <span>Admins</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                <!-- Main -->
                @if(in_array($user->user_type, [USER_TYPE_SUPER_ADMIN, USER_TYPE_ADMIN]))

                @endif
                @if(in_array($user->user_type, [USER_TYPE_SUPER_ADMIN, USER_TYPE_ADMIN, USER_TYPE_PROGRAM_HEAD]))
                <li class="nav-item">
                    <a href="{{ route('scanner') }}" class="nav-link {{ request()->routeIs('scanner') ? 'active' : '' }}">
                        <i class="ph-scan"></i>
                        <span>Facial & QR Scanner</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('attendance') }}" class="nav-link {{ request()->routeIs('attendance') ? 'active' : '' }}">
                        <i class="ph-notebook"></i>
                        <span>Attendance</span>
                    </a>
                </li>
                @endif
                @if(in_array($user->user_type ?? false, [USER_TYPE_STUDENT]))
                <li class="nav-item">
                    <a href="{{ route('student-attendance') }}" class="nav-link {{ request()->routeIs('student-attendance') ? 'active' : '' }}">
                        <i class="ph-notebook"></i>
                        <span>Attendance</span>
                    </a>
                </li>
                @endif
                @if(in_array($user->user_type, [USER_TYPE_SUPER_ADMIN, USER_TYPE_ADMIN, USER_TYPE_PROGRAM_HEAD]))
                <li class="nav-item">
                    <a href="{{ route('statistics') }}" class="nav-link {{ request()->routeIs('statistics') ? 'active' : '' }}">
                        <i class="ph-chart-line"></i>
                        <span>Statistics</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>
<!-- /main sidebar -->