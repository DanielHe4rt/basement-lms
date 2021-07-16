<html class="perfect-scrollbar-off" lang="en">
<head>
    <meta charset="utf-8">
    <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>
        {{ config('app.name')  }}
    </title>
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport">

<body>
<!-- Start Navbar -->
@yield('navbar', View::make('auth::components.navbar'))
<!-- End Navbar -->
<div class="wrapper wrapper-full-page">
    <div class="page-header @yield('page')-page header-filter" filter-color="black">
        <div class="container">
            @yield('content')
        </div>
        @yield('footer', View::make('auth::components.footer'))
    </div>
</div>

<script src="{{asset('js/admin.js')}}"></script>
@yield('scripts')

</body>
</html>
