<!DOCTYPE html>
<html lang="en" dir="ltr">
@include('base.head')

<body>
    @if($navbar_visible ?? true)
        @include('base.navbar')
    @endif

    <!-- Page content -->
    <div class="page-content">
        @include('base.sidebar')

        @yield('main-content')
        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Inner content -->
            <div class="content-inner">

                @if(($header_visible ?? true) && ($header_title ?? false))
                    @section('header')
                    <!-- Page header -->
                    <div class="page-header page-header-light shadow">
                        <div class="page-header-content d-lg-flex">
                            @section('header-content')
                            <div class="d-flex">
                                <h4 class="page-title mb-0">
                                    {{ $header_title }}
                                </h4>
                            </div>
                            @yield('header_right')
                            @show
                        </div>
                    </div>
                    <!-- /page header -->
                    @show
                @endif

                @section('content-area')
                <!-- Content area -->
                <div class="content">
                    @yield('content')
                </div>
                <!-- /content area -->
                @show
                
                @if($footer_visible ?? true)
                    @section('footer')
                        @include('base.footer')
                    @show
                @endif
            </div>
            <!-- /inner content -->
        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->
    @yield('scripts')
</body>
</html>
