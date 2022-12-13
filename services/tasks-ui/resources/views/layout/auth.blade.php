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
        @yield('css')
    </head>
    <body class="hold-transition login-page">
        <div class="p-2">
            @include('layout.partials._flashes')
        </div>
        @yield('content')
        
        <script src="{{ asset('themes/admin-lte/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('themes/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('themes/admin-lte/dist/js/adminlte.min.js') }}"></script>

        <script src="{{ asset('themes/admin-lte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('themes/admin-lte/plugins/jquery-validation/additional-methods.min.js') }}"></script>
        @yield('js')
        @stack('scripts')
        <!-- END PAGE LEVEL JS -->
    </body>
</html>