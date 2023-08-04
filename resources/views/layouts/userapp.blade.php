<!DOCTYPE html>
<html class="loading bordered-layout" lang="en" data-layout="bordered-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }}</title>
    <meta name="base-url" content="{{ url('/') }}">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/vendors/css/vendors.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/vendors/css/extensions/toastr.min.css') }}">

    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-asset/css/plugins/extensions/ext-component-toastr.min.css') }}">

    <link rel="stylesheet" href="{{ asset('app-asset/css/userstlye.css') }}">
    @yield('csslink')


    <!-- END: Vendor CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-asset/vendors/js/tables/datatable/buttons.bootstrap5.min.js') }}">
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/css/themes/bordered-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-asset/css/plugins/extensions/ext-component-toastr.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-invoice-list.css"> --}}
    <!-- END: Page CSS-->

</head>

<!-- BEGIN: Body-->

<body>

    <!-- BEGIN: Header-->
    <x-user.header />
    <!-- END: Header-->

    <x-user.navbar />

    <!-- BEGIN: Content-->
    @yield('layout')
    <!-- END: Content-->

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light bg-white">
        @php
            $currentDate = new DateTime();
            $year = $currentDate->format('Y');
        @endphp
        <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT
                ©{{ $year }}<a class="ms-25" href="http://www.kolejspace.edu.my/" target="_blank">KOLEJ
                    SPACE</a><span class="d-none d-sm-inline-block">, All rights
                    Reserved</span>
            </span>
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
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-asset/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-asset/js/core/app.js') }}"></script>
    <script src="{{ asset('app-asset/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <!-- END: Theme JS-->
    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->
    <script src="{{ asset('app-asset/vendors/js/extensions/toastr.min.js') }}"></script>
    <script src="{{ asset('app-asset/js/scripts/extensions/ext-component-toastr.js') }}"></script>
    @yield('script')
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 48,
                    height: 48
                });
            }
        })
    </script>

</body>
<!-- END: Body-->
