<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>CMS</title>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ config('app.url') }}/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ config('app.url') }}/assets/modules/fontawesome/css/all.min.css">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ config('app.url') }}/assets/modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="{{ config('app.url') }}/assets/modules/weather-icon/css/weather-icons.min.css">
    <link rel="stylesheet" href="{{ config('app.url') }}/assets/modules/weather-icon/css/weather-icons-wind.min.css">
    <link rel="stylesheet" href="{{ config('app.url') }}/assets/modules/summernote/summernote-bs4.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ config('app.url') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ config('app.url') }}/assets/css/components.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stack('css')
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                                    class="fas fa-search"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    @if (Auth::user()->role == 'admin')
                        @include('admin.notifikasi.notifikasi')
                    @endif
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{ config('app.url') }}/assets/img/avatar/avatar-1.png"
                                class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item has-icon text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.html">KERJASAMA</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">KS</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="dropdown {{ request()->is('home') ? 'active' : '' }}">
                            <a href="/home" class="nav-link"><i class="fas fa-home"></i><span>Home</span></a>
                        </li>
                        <li class="menu-header">Data</li>
                        @if (Auth::user()->role == 'admin')
                            <li class="{{ request()->segment(1) == 'kerjasama' ? 'active' : '' }}"><a class="nav-link"
                                    href="{{ url('/kerjasama') }}"><i class="fas fa-table"></i>
                                    <span>Data Kerja
                                        Sama</span></a></li>
                            <li class="{{ request()->segment(1) == 'aktivitas' ? 'active' : '' }}"><a class="nav-link"
                                    href="{{ url('/aktivitas') }}"><i class="fas fa-solid fa-list-check"></i><span>Data
                                        Aktivitas</span></a></li>
                            <li class="{{ request()->segment(1) == 'user' ? 'active' : '' }}"><a class="nav-link"
                                    href="{{ url('/user') }}"><i class="fas fa-solid fa-users"></i><span>Data
                                        User</span></a>
                            </li>
                            <li class="{{ request()->segment(1) == 'file-mou' ? 'active' : '' }}"><a class="nav-link"
                                    href="{{ url('/file-mou') }}"><i class="fas fa-solid fa-file"></i><span>Data
                                        File
                                        MOU</span></a>
                            </li>
                            <li class="{{ request()->segment(1) == 'panduan' ? 'active' : '' }}"><a class="nav-link"
                                    href="{{ url('/panduan/' . ($id = 1)) }}"><i
                                        class="fas fa-solid fa-comments"></i><span>Panduan</span></a>
                            </li>
                            <li class="{{ request()->segment(1) == 'visi-misi' ? 'active' : '' }}"><a class="nav-link"
                                    href="{{ url('/visi-misi/' . ($id = 1)) }}"><i
                                        class="fas fa-solid fa-envelope"></i><span>Visi Misi</span></a>
                            </li>
                            <li class="{{ request()->segment(1) == 'struktur' ? 'active' : '' }}"><a class="nav-link"
                                    href="{{ url('/struktur/' . ($id = 1)) }}"><i
                                        class="fa-solid fa-folder-tree"></i><span>Struktur Organisasi</span></a>
                            </li>
                        @endif
                        @if (Auth::user()->role == 'prodi')
                            <li class="{{ request()->segment(1) == 'kerjasama' ? 'active' : '' }}"><a
                                    class="nav-link" href="{{ url('/kerjasama') }}"><i class="fas fa-table"></i>
                                    <span>Data Kerja
                                        Sama</span></a></li>
                            <li class="{{ request()->segment(1) == 'aktivitas' ? 'active' : '' }}"><a
                                    class="nav-link" href="{{ url('/aktivitas') }}"><i
                                        class="fas fa-plus-square"></i><span>Data
                                        Aktivitas</span></a></li>
                            <li class="{{ request()->segment(1) == 'file-mou' ? 'active' : '' }}"><a class="nav-link"
                                    href="{{ url('/file-mou') }}"><i class="fas fa-solid fa-file"></i><span>Data
                                        File
                                        MOU</span></a>
                            </li>
                        @endif
                        @if (Auth::user()->role == 'mitra')
                            <li class="{{ request()->segment(1) == 'pengajuan-kerja-sama' ? 'active' : '' }}"><a
                                    class="nav-link" href="/pengajuan-kerja-sama"><i class="fas fa-table"></i>
                                    <span>Pengajuan Kerjasama</span></a></li>
                        @endif
                    </ul>
                </aside>
            </div>
            @yield('content')
            <footer class="main-footer">
                <div class="footer-left">
                    <div class="text-center">
                        <p>Page Load {{ round(microtime(true) - LARAVEL_START, 3) }}s
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- General JS Scripts -->
    <script src="{{ config('app.url') }}/assets/modules/jquery.min.js"></script>
    <script src="{{ config('app.url') }}/assets/modules/popper.js"></script>
    <script src="{{ config('app.url') }}/assets/modules/tooltip.js"></script>
    <script src="{{ config('app.url') }}/assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ config('app.url') }}/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="{{ config('app.url') }}/assets/modules/moment.min.js"></script>
    <script src="{{ config('app.url') }}/assets/js/stisla.js"></script>
    <!-- JS Libraies -->
    <script src="{{ config('app.url') }}/assets/modules/simple-weather/jquery.simpleWeather.min.js"></script>
    <script src="{{ config('app.url') }}/assets/modules/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="{{ config('app.url') }}/assets/modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="{{ config('app.url') }}/assets/modules/summernote/summernote-bs4.js"></script>
    <script src="{{ config('app.url') }}/assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
    <!-- Template JS File -->
    <script src="{{ config('app.url') }}/assets/js/scripts.js"></script>
    <script src="{{ config('app.url') }}/assets/js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireScripts
    @stack('js')
</body>

</html>
