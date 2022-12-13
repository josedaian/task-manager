<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }} | @yield('page-title')</title>
        <link rel="icon" type="image/png" sizes="96x96" href="/favicon.ico">

        <link rel="stylesheet" href="{{ asset('themes/admin-lte/fonts/fonts.googleapis.css') }}">
        <link rel="stylesheet" href="{{ asset('themes/admin-lte/plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('themes/admin-lte/dist/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ asset('themes/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('themes/admin-lte/plugins/daterangepicker/daterangepicker.css') }}">

         <!-- SweetAlert2 -->
        <link rel="stylesheet" href="{{ asset('themes/admin-lte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
        <!-- Toastr -->
        <link rel="stylesheet" href="{{ asset('themes/admin-lte/plugins/toastr/toastr.min.css') }}">
        @yield('css')
    </head>
    <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            @include('layout.partials._navbar')
            @include('layout.partials._sidebar')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <div class="p-2">
                    @include('layout.partials._flashes')
                </div>
                @yield('content')
            </div>
        </div>
        
        <script src="{{ asset('themes/admin-lte/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('themes/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('themes/admin-lte/dist/js/adminlte.min.js') }}"></script>

        <script src="{{ asset('themes/admin-lte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('themes/admin-lte/plugins/jquery-validation/additional-methods.min.js') }}"></script>

        <script src="{{ asset('themes/admin-lte/plugins/moment/moment.min.js') }}"></script>
        <script src="{{ asset('themes/admin-lte/plugins/daterangepicker/daterangepicker.js') }}"></script>

        <script src="{{ asset('themes/admin-lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('themes/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('themes/admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('themes/admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

        <!-- SweetAlert2 -->
        <script src="{{ asset('themes/admin-lte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
        <!-- Toastr -->
        <script src="{{ asset('themes/admin-lte/plugins/toastr/toastr.min.js') }}"></script>

        @yield('js')
        @stack('scripts')
        <!-- END PAGE LEVEL JS -->
    </body>
</html>