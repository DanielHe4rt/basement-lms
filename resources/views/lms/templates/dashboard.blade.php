<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('css')
</head>
<body>

<div class="wrapper ">
    @yield('sidebar', View::make('lms.components.dashboard-sidebar'))
    <div class="main-panel">
        <!-- Navbar -->
        @yield('navbar', View::make('lms.components.dashboard-navbar'))

        <!-- End Navbar -->
        <div class="content">
            @yield('content')
        </div>
        @yield('footer', View::make('lms.components.dashboard-footer'))
    </div>
</div>
@yield('extras')

<script src="{{asset('js/admin.js')}}"></script>
@yield('scripts')
</body>
</html>
