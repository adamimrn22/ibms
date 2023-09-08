<!DOCTYPE html>
<html class="loaded" lang="en" data-textdirection="ltr" style="--vh: 6.49px;">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }}</title>
    <meta name="base-url" content="{{ url('/') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/vendors/css/extensions/toastr.min.css') }}">
    <!-- END: Vendor CSS-->


    @yield('csslink')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-asset/vendors/js/tables/datatable/buttons.bootstrap5.min.js') }}">
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/css/components.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-asset/css/core/menu/menu-types/horizontal-menu.css') }}">

    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-asset/css/plugins/extensions/ext-component-toastr.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/css/style.css') }}">
    <!-- END: Custom CSS-->


</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="pace-done horizontal-layout horizontal-menu navbar-floating footer-static menu-expanded" data-open="hover"
    data-menu="horizontal-menu" data-col="">
    <div class="pace pace-inactive">
        <div class="pace-progress" data-progress-text="100%" data-progress="99"
            style="transform: translate3d(100%, 0px, 0px);">
            <div class="pace-progress-inner"></div>
        </div>
        <div class="pace-activity"></div>
    </div>

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center"
        data-nav="brand-center">

        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item">
                        <a class="nav-link menu-toggle" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-menu ficon">
                                <line x1="3" y1="12" x2="21" y2="12"></line>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <line x1="3" y1="18" x2="21" y2="18"></line>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="navbar-header d-xl-block d-none">
                <ul class="nav navbar-nav">
                    <li class="nav-item"><a class="navbar-brand" href="/">
                            <span class="brand-logo">

                            </span>
                            <h2 class="brand-text mb-0">iBMS</h2>
                        </a></li>
                </ul>
            </div>

            <ul class="nav navbar-nav align-items-center ms-auto">


                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link"
                        id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none"><span
                                class="user-name fw-bolder">{{ $user->first_name . ' ' . $user->last_name }}</span><span
                                class="user-status">
                                {{ $user->position->name }}
                            </span>
                        </div>
                        <span class="avatar"><img class="round"
                                src="https://ui-avatars.com/api/?name={{ $user->first_name }}+{{ $user->last_name }}"
                                alt="avatar" height="40" width="40"><span
                                class="avatar-status-online"></span></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-power me-50">
                                    <path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path>
                                    <line x1="12" y1="2" x2="12" y2="12"></line>
                                </svg>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="ms-2">
                                    @csrf
                                    <span type="submit">
                                        Logout
                                    </span>
                                </form>
                            </div>
                        </a>

                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- END: Header-->


    {{-- Sidebar --}}
    <!-- BEGIN: Main Menu-->
    <div class="horizontal-menu-wrapper">
        <div class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-light navbar-shadow menu-border container-xxl"
            role="navigation" data-menu="menu-wrapper" data-menu-type="floating-nav">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item me-auto"><a class="navbar-brand" href="/">
                            <h2 class="brand-text mb-0">iBMS</h2>
                        </a></li>
                    <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0"
                            data-bs-toggle="collapse"><svg xmlns="http://www.w3.org/2000/svg" width="14"
                                height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-x d-block d-xl-none text-primary toggle-icon font-medium-4">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg></a></li>
                </ul>
            </div>

            @php
                $currentPath = request()->path();
            @endphp

            <div class="shadow-bottom"></div>
            <!-- Horizontal menu content-->
            <div class="navbar-container main-menu-content" data-menu="menu-container">
                <!-- include ../../../includes/mixins-->
                <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">

                    <li class="nav-item my-1 my-lg-0   {{ request()->path() === 'User' ? 'active' : '' }}">
                        <a class="nav-link d-flex align-items-center " href="/">
                            <span>Halaman Utama</span>
                        </a>
                    </li>

                    <li class="dropdown nav-item {{ Str::contains(request()->path(), 'UKW/AlatTulis') || Str::contains(request()->path(), 'UKW/ViewAlatTulis') ? 'active' : '' }}"
                        data-menu="dropdown">
                        <a class="dropdown-toggle nav-link d-flex align-items-center" data-bs-toggle="dropdown">
                            <span>Pinjaman Alat Tulis</span>
                        </a>

                        <ul class="dropdown-menu" data-bs-popper="none">
                            <li data-menu="">
                                <a class="dropdown-item d-flex align-items-center"
                                    href="{{ route('AlatTulis.itemIndex') }}">
                                    <span>Pesan Pinjaman Alat Tulis</span>
                                </a>
                            </li>

                            <li data-menu="">
                                <a class="dropdown-item d-flex align-items-center"
                                    href="{{ route('AlatTulis.index') }}">
                                    <span>Pinjaman Alat Tulis Dashboard</span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item  my-1 my-lg-0">
                        <a class="nav-link d-flex align-items-center" href="{{ route('PinjamanUit.index') }}">
                            <span>Pinjaman Barang IT</span>
                        </a>
                    </li>

                    <li class="dropdown nav-item {{ Str::contains(request()->path(), '/UPSM/Ruang') ? 'active' : '' }}"
                        data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center"
                            data-bs-toggle="dropdown">
                            <span>Tempahan Ruang Kelas</span></a>

                        <ul class="dropdown-menu" data-bs-popper="none">
                            <li data-menu="">
                                <a class="dropdown-item d-flex align-items-center"
                                    href="{{ route('TempahRuang.index') }}">
                                    <span>Permohonan Ruang Kelas</span>
                                </a>
                            </li>

                            <li data-menu="">
                                <a class="dropdown-item d-flex align-items-center"
                                    href="{{ route('TempahRuang.viewTempahan') }}">
                                    <span>Tempahan Ruang Kelas</span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li
                        class="nav-item  my-1 my-lg-0 {{ Str::contains(request()->path(), '/UPSM/TempahanKereta') ? 'active' : '' }}">
                        <a class="nav-link d-flex align-items-center" href="{{ route('TempahKereta.index') }}">
                            <span>Tempahan Kenderaan</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">

                @yield('section')

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"
        style="touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
    </div>
    <div class="drag-target"
        style="touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
    </div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT © 2021<a
                    class="ms-25" href="http://kolejspace.edu.my" target="_blank">UTMSPACE
                    Services Sdn Bhd</a><span class="d-none d-sm-inline-block">, All rights
                    Reserved</span></span>

        </p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top waves-effect waves-float waves-light" type="button"><svg
            xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-arrow-up">
            <line x1="12" y1="19" x2="12" y2="5"></line>
            <polyline points="5 12 12 5 19 12"></polyline>
        </svg></button>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-asset/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-asset/vendors/js/ui/jquery.sticky.js') }}"></script>
    <script src="{{ asset('app-asset/vendors/js/extensions/toastr.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-asset/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-asset/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>

    @yield('script')


    <svg id="SvgjsSvg1001" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1"
        xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"
        style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;">
        <defs id="SvgjsDefs1002"></defs>
        <polyline id="SvgjsPolyline1003" points="0,0"></polyline>
        <path id="SvgjsPath1004" d="M0 0 "></path>
    </svg>
</body><!-- END: Body-->

</html>
