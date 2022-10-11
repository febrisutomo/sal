<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

     <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Serayu Agung Lestari</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4/select2-bootstrap4.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/main.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    {{-- <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}"> --}}

    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">

    <style>
        .required:after {
            content: " *";
            color: red;
        }
    </style>

    @stack('style')
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('img/AdminLTELogo.png') }}') }}" alt="AdminLTELogo" height="60"
                width="60">
        </div> --}}
        <nav class="main-header navbar navbar-expand navbar-white">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>
                <li class="nav-item">
                    <div class="nav-link" id="date"></div>
                </li>
                <li class="nav-item">
                    <div class="nav-link" id="time"></div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <div class="nav-link py-1">
                        <label class="theme-switch" for="checkbox">
                            <input type="checkbox" id="checkbox" />
                            <div class="slider"></div>
                            <i class="fas fa-moon"></i>
                            <i class="fas fa-sun"></i>
                        </label>
                    </div>
                </li>

                <li class="dropdown mr-3">
                    <a class="dropdown-toggle font-weight-bold text-dark d-flex align-items-center"
                        data-toggle="dropdown" href="#">
                        <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" class="lazy img-circle"
                            width="40" height="40" alt="" />
                        <div class="ml-2 text-dark d-none d-xl-block">
                            <div>{{ Auth::user()->name }}</div>
                            {{-- <div class="badge bg-success">Admin</div> --}}
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right mt-2" aria-labelledby="navbarDropdownMenuLink">
                        <label class="font-weight-bold mb-0 text-uppercase ml-3">Account</label>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/account"><i class="fa fa-user-circle"></i> My Profile</a>
                        <a href="#" class="dropdown-item" onclick="return confirm('Anda yakin ingin keluar?')"><i
                                class="fa fa-sign-out-alt"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>


        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="/docs/3.2/index.html" class="brand-link logo-switch">
                <img src="{{ asset('img/logo-sal.png') }}" alt="SAL" class="brand-image-xl logo-xs">
                <img src="{{ asset('img/logo-sal-xl.png') }}" alt="SAL" class="brand-image-xs logo-xl"
                    style="left: 12px">
            </a>
            <div class="sidebar">
                {{-- <div class="form-inline mt-2">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div> --}}
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview"
                        role="menu">
                        <li class="nav-item">
                            <a href="/docs/3.2/index.html" class="nav-link">
                                <i class="nav-icon fas fa-microchip"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('surat-jalan.index') }}" class="nav-link {{ Request::routeIs('surat-jalan.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-file-contract"></i>
                                <p>
                                    Surat Jalan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kitir.index') }}" class="nav-link {{ Request::routeIs('kitir.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Kitir Bulanan
                                </p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="/docs/3.2/components" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Components
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/docs/3.2/components/main-header.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Main Header</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/docs/3.2/components/main-sidebar.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Main Sidebar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/docs/3.2/components/control-sidebar.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Control Sidebar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/docs/3.2/components/cards.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Card</p>
                                    </a>
                                </li>

                            </ul>
                        </li> --}}

                    </ul>
                </nav>
            </div>
        </aside>
        <div class="content-wrapper">
            @yield('content')
        </div>
        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
                v3.2
            </div>
            <strong>Copyright &copy; 2014-2022 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    {{-- <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script> --}}
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }} "></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }} "></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }} "></script>
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('plugins/fullcalendar/main.js')}}"></script>
    <script src="{{ asset('plugins/fullcalendar/locales-all.min.js')}}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{ asset('js/adminlte.min.js') }}"></script>

    <script>
        const refreshTime = () => {
            const date = new Date().toLocaleDateString('id-ID', {
                timeZone: 'Asia/Jakarta',
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
            });
            const time = new Date().toLocaleTimeString('en-US', {
                timeZone: 'Asia/Jakarta',
                hour12: false,
            });
            document.getElementById('date').innerHTML = date
            document.getElementById('time').innerHTML = "Pukul " + time
        }

        setInterval(refreshTime, 1000);

        var toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');
        var currentTheme = localStorage.getItem('theme');
        var mainHeader = document.querySelector('.main-header');

        if (currentTheme) {
            if (currentTheme === 'dark') {
                if (!document.body.classList.contains('dark-mode')) {
                    document.body.classList.add("dark-mode");
                }
                if (mainHeader.classList.contains('navbar-white')) {
                    mainHeader.classList.add('navbar-dark');
                    mainHeader.classList.remove('navbar-white');
                }
                toggleSwitch.checked = true;
            }
        }

        function switchTheme(e) {
            if (e.target.checked) {
                if (!document.body.classList.contains('dark-mode')) {
                    document.body.classList.add("dark-mode");
                }
                if (mainHeader.classList.contains('navbar-white')) {
                    mainHeader.classList.add('navbar-dark');
                    mainHeader.classList.remove('navbar-white');
                }
                localStorage.setItem('theme', 'dark');
            } else {
                if (document.body.classList.contains('dark-mode')) {
                    document.body.classList.remove("dark-mode");
                }
                if (mainHeader.classList.contains('navbar-dark')) {
                    mainHeader.classList.add('navbar-white');
                    mainHeader.classList.remove('navbar-dark');
                }
                localStorage.setItem('theme', 'light');
            }
        }

        toggleSwitch.addEventListener('change', switchTheme, false);
    </script>
    @stack('script')
</body>

</html>
