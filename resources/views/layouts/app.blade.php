<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name='viewport' content='width=device-width, initial-scale=1.0, shrink-to-fit=no' />
    {{-- <link rel="icon" href="{{ asset('img/favicon.ico" type="image/x-icon"/> --}}
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Serayu Agung Lestari</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900">
    <link rel="stylesheet" href="{{ asset('plugins/line-awesome/css/line-awesome.min.css') }}">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ready.min.css') }}">

    {{-- <link rel="stylesheet" href="{{ asset('js/plugin/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('js/plugin/sweetalert2/sweetalert2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">


    <link rel="stylesheet" href="{{ asset('js/plugin/daterangepicker/daterangepicker.css') }}">

    <style>
        .truncate {
            width: 100%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .required:after {
            content: " *";
            color: #f3545d;
        }

        /* .content .btn i {
            font-size: 1rem
        } */
        .dropdown-item i {
            font-size: 1rem
        }

        .btn-action::after {
            content: none;
        }

        .select2-container .select2-selection--single {
            height: auto;
            width: 100%
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        .select2-results__options .select2-results__option[aria-disabled="true"] {
            color: #f3545d;
            /* font-weight: bold */
        }

        /* .select2-results__options .select2-results__option[aria-disabled="true"]:after {
            content: ' (dipilih)'
        } */

        .colored-toast.swal2-icon-success {
            background-color: #35cd3a !important;
        }

        .colored-toast.swal2-icon-error {
            background-color: #f3545d !important;
        }

        .colored-toast.swal2-icon-warning {
            background-color: #ffa534 !important;
        }

        .colored-toast.swal2-icon-info {
            background-color: #05b4d8 !important;
        }

        .colored-toast.swal2-icon-question {
            background-color: #87adbd !important;
        }

        .colored-toast .swal2-title {
            color: white !important;
        }

        .colored-toast .swal2-close {
            color: white !important;
        }

        .colored-toast .swal2-html-container {
            color: white !important;
        }

        .swal2-title {
            font-size: 1.5em;
        }

        .swal2-html-container {
            font-size: 1rem;
        }
    </style>

    @stack('style')
</head>

<body>
    <x-toast />

    <div class="wrapper">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header">
                <!--
     Tip 1: You can change the background color of the logo header using: data-background-color="black | dark | blue | purple | light-blue | green | orange | red"
    -->
                <a href="index.html" class="big-logo">
                    <img src="{{ asset('img/logo-sal.png') }}" alt="logo img" class="logo-img">
                </a>
                <a href="index.html" class="logo">
                    <img src="{{ asset('img/logoheader-sal.png') }}" alt="navbar brand" class="navbar-brand">
                </a>
                <!-- <a href="" class="logo">
     <div class="navbar-brand" style="line-height: 20px;">SISJ PT SAL</div>
    </a> -->
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="la la-bars"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
            </div>
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-expand-lg">
                <!--
     Tip 1: You can change the background color of the navbar header using: data-background-color="black | dark | blue | purple | light-blue | green | orange | red"
    -->
                <div class="container-fluid">
                    <div class="navbar-minimize">
                        <button class="btn btn-minimize btn-rounded">
                            <i class="la la-navicon"></i>
                        </button>
                    </div>

                    {{-- <div class="collapse" id="search-nav">
                        <form class="navbar-left navbar-form nav-search ml-md-3 mr-md-3">
                            <div class="input-group">
                                <input type="text" placeholder="Search ..." class="form-control">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-search">
                                        <i class="la la-search search-icon"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div> --}}
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        {{-- <li class="nav-item toggle-nav-search hidden-caret">
                            <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button"
                                aria-expanded="false" aria-controls="search-nav">
                                <i class="flaticon-search-1"></i>
                            </a>
                        </li> --}}
                        <li class="nav-item  hidden-caret">
                            <div class="nav-link" id="date">
                            </div>
                            {{-- <div class="nav-link" id="time">
                            </div> --}}
                        </li>
                        {{-- <li class="nav-item dropdown hidden-caret">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="flaticon-envelope-1"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li> --}}
                        {{-- <li class="nav-item dropdown hidden-caret">
                            <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="flaticon-alarm"></i>
                                <span class="notification">3</span>
                            </a>
                            <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                                <li>
                                    <div class="dropdown-title">You have 4 new notification</div>
                                </li>
                                <li>
                                    <div class="notif-center">
                                        <a href="#">
                                            <div class="notif-icon notif-primary"> <i class="la la-user-plus"></i>
                                            </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    New user registered
                                                </span>
                                                <span class="time">5 minutes ago</span>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notif-icon notif-success"> <i class="la la-comment"></i>
                                            </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    Rahmad commented on Admin
                                                </span>
                                                <span class="time">12 minutes ago</span>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notif-img">
                                                <img src="{{ asset('img/profile2.jpg') }}" alt="Img Profile">
                                            </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    Reza send messages to you
                                                </span>
                                                <span class="time">12 minutes ago</span>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notif-icon notif-danger"> <i class="la la-heart"></i> </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    Farrah liked Admin
                                                </span>
                                                <span class="time">17 minutes ago</span>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <a class="see-all" href="javascript:void(0);">See all notifications<i
                                            class="la la-angle-right"></i> </a>
                                </li>
                            </ul>
                        </li> --}}
                        <li class="nav-item dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
                                aria-expanded="false"> <img src="{{ asset('img/profile.jpg') }}" alt="image profile"
                                    width="36" class="img-circle"></a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <li>
                                    <div class="user-box">
                                        <div class="u-img"><img src="{{ asset('img/profile.jpg') }}"
                                                alt="image profile">
                                        </div>
                                        <div class="u-text">
                                            <h4>Hizrian</h4>
                                            <p class="text-muted">hello@themekita.com</p><a href="profile.html"
                                                class="btn btn-rounded btn-danger btn-sm">View Profile</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">My Profile</a>
                                    <a class="dropdown-item" href="#">My Balance</a>
                                    <a class="dropdown-item" href="#">Inbox</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Account Setting</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Logout</a>
                                </li>
                            </ul>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link quick-sidebar-toggler">
                                <i class="flaticon-shapes-1"></i>
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <!--
    Tip 1: You can change the background color of the sidebar using: data-background-color="black | dark | blue | purple | light-blue | green | orange | red"
    Tip 2: you can also add an image using data-image attribute
   -->
            <div class="sidebar-background"></div>
            <div class="sidebar-wrapper scrollbar-inner">
                <div class="sidebar-content">
                    <div class="user">
                        <div class="photo">
                            <img src="{{ asset('img/profile.jpg') }}" alt="image profile">
                        </div>
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                                <span>
                                    Hizrian
                                    <span class="user-level">Administrator</span>
                                    <span class="caret"></span>
                                </span>
                            </a>
                            <div class="clearfix"></div>

                            <div class="collapse in" id="collapseExample">
                                <ul class="nav">
                                    <li>
                                        <a href="#profile">
                                            <span class="link-collapse">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#edit">
                                            <span class="link-collapse">Edit Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#settings">
                                            <span class="link-collapse">Settings</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="nav">
                        <li class="nav-item ">
                            <a href="index.html">
                                <i class="la la-dashboard"></i>
                                <p>Dashboard</p>
                                {{-- <span class="badge badge-count">5</span> --}}
                            </a>
                        </li>
                        {{-- <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="la la-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Components</h4>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a data-toggle="collapse" href="#base">
                                <i class="flaticon-layers"></i>
                                <p>Base</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="base">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="components/buttons.html">
                                            <span class="sub-item">Buttons</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components/gridsystem.html">
                                            <span class="sub-item">Grid System</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components/panels.html">
                                            <span class="sub-item">Panels</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components/notifications.html">
                                            <span class="sub-item">Notifications</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components/sweetalert.html">
                                            <span class="sub-item">Sweet Alert</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components/line-awesome-icons.html">
                                            <span class="sub-item">Line Awesome Icons</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components/flaticons.html">
                                            <span class="sub-item">Flaticons</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components/typography.html">
                                            <span class="sub-item">Typography</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li> --}}
                        <li class="nav-item {{ Request::routeIs('surat-jalan.*') ? 'active' : '' }}">
                            <a href="{{ route('surat-jalan.index') }}">
                                <i class="la la-file-alt"></i>
                                <p>Surat Jalan</p>
                            </a>
                        </li>
                        <li class="nav-item {{ Request::routeIs('kitir.*') ? 'active' : '' }}">
                            <a href="{{ route('kitir.index') }}">
                                <i class="la la-calendar"></i>
                                <p>Kitir Bulanan</p>
                            </a>
                        </li>
                        <li class="nav-item {{ Request::routeIs('sppbe.*') ? 'active' : '' }}">
                            <a href="{{ route('sppbe.index') }}">
                                <i class="la la-gas-pump"></i>
                                <p>SP(P)BE</p>
                            </a>
                        </li>
                        <li class="nav-item {{ Request::routeIs('pangkalan.*') ? 'active' : '' }}">
                            <a href="{{ route('pangkalan.index') }}">
                                <i class="la la-store-alt"></i>
                                <p>Pangkalan</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item {{ Request::routeIs('truk.*') ? 'active' : '' }}">
                            <a href="{{ route('truk.index') }}">
                                <i class="la la-truck"></i>
                                <p>Truk</p>
                            </a>
                        </li>
                        <li class="nav-item {{ Request::routeIs('sopir.*') ? 'active' : '' }}">
                            <a href="{{ route('sopir.index') }}">
                                <i class="la la-user"></i>
                                <p>Sopir</p>
                            </a>
                        </li> --}}
                        <li class="nav-item {{ Request::routeIs('armada.*') ? 'active' : '' }}">
                            <a data-toggle="collapse" href="#base">
                                <i class="la la-truck"></i>
                                <p>Armada</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ Request::routeIs('armada.*') ? 'show' : '' }}" id="base">
                                <ul class="nav nav-collapse">
                                    <li class="{{ Request::routeIs('armada.truk.*') ? 'active' : '' }}">
                                        <a href="{{ route('armada.truk.index') }}">
                                            <span class="sub-item">Truk</span>
                                        </a>
                                    </li>
                                    <li class="{{ Request::routeIs('armada.sopir.*') ? 'active' : '' }}">
                                        <a href="{{ route('armada.sopir.index') }}">
                                            <span class="sub-item">Sopir</span>
                                        </a>
                                    </li>
                                    <li class="{{ Request::routeIs('armada.kernet.*') ? 'active' : '' }}">
                                        <a href="{{ route('armada.kernet.index') }}">
                                            <span class="sub-item">Kernet</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="#">
                                <i class="la la-sliders-h"></i>
                                <p>Pengaturan</p>
                            </a>
                        </li>


                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="content">
                @yield('content')
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="http://www.themekita.com">
                                    ThemeKita
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Help
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Licenses
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright ml-auto">
                        2018, made with <i class="la la-heart heart text-danger"></i> by <a
                            href="http://www.themekita.com">ThemeKita</a>
                    </div>
                </div>
            </footer>
        </div>
        <div class="quick-sidebar">
            <a href="#" class="close-quick-sidebar">
                <i class="flaticon-cross"></i>
            </a>
            <div class="quick-sidebar-wrapper">
                <ul class="nav nav-tabs nav-line nav-color-primary" role="tablist">
                    <li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#messages"
                            role="tab" aria-selected="true">Messages</a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tasks" role="tab"
                            aria-selected="false">Tasks</a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab"
                            aria-selected="false">Settings</a> </li>
                </ul>
                <div class="tab-content mt-3">
                    <div class="tab-chat tab-pane fade show active" id="messages" role="tabpanel">
                        <div class="messages-contact">
                            <div class="quick-wrapper">
                                <div class="quick-scroll scrollbar-outer">
                                    <div class="quick-content contact-content">
                                        <span class="category-title mt-0">Recent</span>
                                        <div class="contact-list contact-list-recent">
                                            <div class="user">
                                                <a href="#">
                                                    <div class="user-image">
                                                        <img src="{{ asset('img/jm_denis.jpg') }}" alt="denis">
                                                        <span class="status online"></span>
                                                    </div>
                                                    <div class="user-data">
                                                        <span class="name">Jimmy Denis</span>
                                                        <span class="message">How are you ?</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="user">
                                                <a href="#">
                                                    <div class="user-image">
                                                        <img src="{{ asset('img/chadengle.jpg') }}" alt="chad">
                                                        <span class="status away"></span>
                                                    </div>
                                                    <div class="user-data">
                                                        <span class="name">Chad</span>
                                                        <span class="message">Ok, Thanks !</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="user">
                                                <a href="#">
                                                    <div class="user-image">
                                                        <img src="{{ asset('img/mlane.jpg') }}" alt="john doe">
                                                        <span class="status offline"></span>
                                                    </div>
                                                    <div class="user-data">
                                                        <span class="name">John Doe</span>
                                                        <span class="message">Ready for the meeting today
                                                            with...</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <span class="category-title">Contacts</span>
                                        <div class="contact-list">
                                            <div class="user">
                                                <a href="#">
                                                    <div class="user-image">
                                                        <img src="{{ asset('img/jm_denis.jpg') }}" alt="denis">
                                                        <span class="status"></span>
                                                    </div>
                                                    <div class="user-data2">
                                                        <span class="name">Jimmy Denis</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="user">
                                                <a href="#">
                                                    <div class="user-image">
                                                        <img src="{{ asset('img/chadengle.jpg') }}" alt="chad">
                                                        <span class="status away"></span>
                                                    </div>
                                                    <div class="user-data2">
                                                        <span class="name">Chad</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="user">
                                                <a href="#">
                                                    <div class="user-image">
                                                        <img src="{{ asset('img/talha.jpg') }}" alt="talha">
                                                        <span class="status offline"></span>
                                                    </div>
                                                    <div class="user-data2">
                                                        <span class="name">Talha</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="messages-wrapper">
                            <div class="messages-title">
                                <div class="user">
                                    <img src="{{ asset('img/chadengle.jpg') }}" alt="chad">
                                    <span class="name">Chad</span>
                                    <span class="last-active">Active 2h ago</span>
                                </div>
                                <button class="return">
                                    <i class="flaticon-left-arrow-3"></i>
                                </button>
                            </div>
                            <div class="messages-body messages-scroll scrollbar-outer">
                                <div class="message-content-wrapper">
                                    <div class="message message-in">
                                        <div class="message-pic">
                                            <img src="{{ asset('img/chadengle.jpg') }}" alt="chad">
                                        </div>
                                        <div class="message-body">
                                            <div class="message-content">
                                                <div class="name">Chad</div>
                                                <div class="content">Hello, Rian</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="message-content-wrapper">
                                    <div class="message message-out">
                                        <div class="message-body">
                                            <div class="message-content">
                                                <div class="content">
                                                    Hello, Chad
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="message-content-wrapper">
                                    <div class="message message-in">
                                        <div class="message-pic">
                                            <img src="{{ asset('img/chadengle.jpg') }}" alt="chad">
                                        </div>
                                        <div class="message-body">
                                            <div class="message-content">
                                                <div class="name">Chad</div>
                                                <div class="content">
                                                    When is the deadline of the project we are working on ?
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="message-content-wrapper">
                                    <div class="message message-out">
                                        <div class="message-body">
                                            <div class="message-content">
                                                <div class="content">
                                                    The deadline is about 2 months away
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="message-content-wrapper">
                                    <div class="message message-in">
                                        <div class="message-pic">
                                            <img src="{{ asset('img/chadengle.jpg') }}" alt="chad">
                                        </div>
                                        <div class="message-body">
                                            <div class="message-content">
                                                <div class="name">Chad</div>
                                                <div class="content">
                                                    Ok, Thanks !
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="messages-form">
                                <div class="messages-form-control">
                                    <input type="text" placeholder="Type here"
                                        class="form-control input-pill input-solid message-input">
                                </div>
                                <div class="messages-form-tool">
                                    <a href="#" class="attachment">
                                        <i class="flaticon-file"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Moment JS -->
    <script src="{{ asset('js/plugin/moment/moment.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    {{-- <script src="{{ asset('js/plugin/datatables/datatables.min.js') }}"></script> --}}
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

    <!-- Bootstrap Notify -->
    <script src="{{ asset('js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- Bootstrap Toggle -->
    <script src="{{ asset('js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>

    <!-- Dropzone -->
    <script src="{{ asset('js/plugin/dropzone/dropzone.min.js') }}"></script>

    <!-- Fullcalendar -->
    <script src="{{ asset('js/plugin/fullcalendar/fullcalendar.min.js') }}"></script>

    <!-- DateTimePicker -->
    <script src="{{ asset('js/plugin/datepicker/bootstrap-datetimepicker.min.js') }}"></script>

    <script src="{{ asset('js/plugin/daterangepicker/daterangepicker.js') }}"></script>

    <!-- Bootstrap Tagsinput -->
    <script src="{{ asset('js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>

    <!-- Bootstrap Wizard -->
    <script src="{{ asset('js/plugin/bootstrap-wizard/bootstrapwizard.js') }}"></script>

    <!-- jQuery Validation -->
    <script src="{{ asset('js/plugin/jquery.validate/jquery.validate.min.js') }}"></script>

    <!-- Summernote -->
    <script src="{{ asset('js/plugin/summernote/summernote-bs4.min.js') }}"></script>

    <!-- Select2 -->
    {{-- <script src="{{ asset('js/plugin/select2/select2.full.min.js') }}"></script> --}}
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>

    <!-- Sweet Alert -->
    {{-- <script src="{{ asset('js/plugin/sweetalert/sweetalert.min.js') }}"></script> --}}
    <script src="{{ asset('js/plugin/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- Ready Pro JS -->
    <script src="{{ asset('js/ready.min.js') }}"></script>


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

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
            // document.getElementById('time').innerHTML = "Pukul " + time
        }

        setInterval(refreshTime, 1000);


        const swal = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-danger ml-2'
            },
            buttonsStyling: false
        })

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            iconColor: 'white',
            customClass: {
                popup: 'colored-toast'
            },
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true
        })

        $('.select2').select2({
            allowClear: true,
            theme: "bootstrap"
        })

        $('.date-picker').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            autoApply: true,
            locale: {
                format: 'DD/MM/YYYY'
            },
        })

        const dataTable = $(".data-table").DataTable({
            buttons: [{
                    extend: 'print',
                    // exportOptions: {
                    //     columns: [0, 1, 2, 3, 4, 5]
                    // },
                    autoPrint: true,
                    customize: function(win) {
                        $(win.document.body).find('h1').css('text-align', 'center');
                        $(win.document.body).find('h1').css('font-size', '20px');
                    }
                },
                {
                    extend: 'copyHtml5',
                },
                {
                    extend: 'excelHtml5',

                },
                {
                    extend: 'csvHtml5',

                },
                {
                    extend: 'pdfHtml5',

                }
            ],
        })


        $(".export-button .print").on("click", function(e) {
            e.preventDefault();
            dataTable.button(0).trigger()
        });

        $(".export-button .copy").on("click", function(e) {
            e.preventDefault();
            dataTable.button(1).trigger()

        });

        $(".export-button .excel").on("click", function(e) {
            e.preventDefault();
            dataTable.button(2).trigger()

        });

        $(".export-button .csv").on("click", function(e) {
            e.preventDefault();
            dataTable.button(3).trigger()

        });

        $(".export-button .pdf").on("click", function(e) {
            e.preventDefault();
            dataTable.button(4).trigger()
        });
    </script>

    @stack('script')

</body>

</html>
