<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'DigitalMesh') }} - @yield('title')</title>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    @yield('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper" id="app">
        <nav class="main-header navbar navbar-expand navbar-dark navbar-indigo">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }}
                  </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                     {{ __('Logout') }}
                     </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('/') }}" class="brand-link">
                <img src="/img/dm-icon.png" alt="AdminLTE Logo" style="opacity: 1.8;" class="brand-image elevation-3">
                <span class="brand-text font-weight-light pl-3 pt-1">{{ config('app.name', 'DigitalMesh') }}</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        @if (Route::has('banner.index'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('banner.index') }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>{{__('Banner')}}</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="wrapper">
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">@yield('title')</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                @yield('breadcrumbs')
                            </div>
                        </div>
                    </div>
                </div>
                <section class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </section>
            </div>
            <footer class="main-footer">
                <strong>Copyright &copy; {{date('Y')}} {{ config('app.name', 'DigitalMesh') }}</strong> All rights reserved.
            </footer>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('js/adminlte.js') }}"></script>
    <script src="{{ asset('js/q.min.js') }}"></script>
    <script src="{{ asset('js/base_app.js') }}"></script>
    @yield('pagescript')
</body>

</html>