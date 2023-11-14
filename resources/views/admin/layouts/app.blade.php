<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        TETHUNA - ADMIN PANEL
        @if (!empty($title))
            - {{ $title }}
        @endif
        @if (!empty($subtitle))
            - {{ $subtitle }}
        @endif
    </title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/front/img/favicon.png') }}" />

    @stack('styles')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <style>
        .table-responsive .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0 !important;
            border: none !important;
        }

        .table-responsive .dataTables_wrapper .dataTables_length select {
            padding: .25rem 1.5rem .25rem 1rem !important;
        }
    </style>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('admin.layouts.sidebar')
        <!--  Sidebar End -->

        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('admin.layouts.header')
            <!--  Header End -->

            <div class="container-fluid">
                <!-- Start Content -->
                @yield('content')
                <!-- End Content -->

                <!-- Start Footer -->
                @include('admin.layouts.footer')
                <!-- End Footer -->
            </div>
        </div>

    </div>

    <!--  Import Js Files -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!--  Core Js -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>

    <!--  Custom Js -->
    <script>
        $("#success-alert").fadeTo(3000, 500).slideUp(500, function() {
            $("#success-alert").slideUp(500);
        });
        $("#danger-alert").fadeTo(3000, 500).slideUp(500, function() {
            $("#danger-alert").slideUp(500);
        });
    </script>

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

    @stack('scripts')
</body>

</html>
