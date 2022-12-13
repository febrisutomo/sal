<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name='viewport' content='width=device-width, initial-scale=1.0, shrink-to-fit=no' />
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . ' - ' . config('app.name') : config('app.name') }}</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900">
    <link rel="stylesheet" href="{{ asset('plugins/line-awesome/css/line-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/jquery-ui-1.12.1.custom/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/jquery-scrollbar/jquery.scrollbar.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/datatables/datatables.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ready.min.css') }}">

    <style>
        /* .btn {
            padding: .6rem;
        } */


        form .row {
            margin-left: 0;
            margin-right: 0;
        }

        form [class^="col-"] {
            padding-left: 0;
            padding-right: 0;
        }

        .input-group {
            flex-wrap: unset
        }

        .select2-container {
            width: 100% !important
        }

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

        .swal2-title {
            font-size: 1.2rem;
        }

        .swal2-html-container {
            font-size: .8rem;
        }

        .green-tooltip::before,
        .blue-tooltip::before {
            border: none;
        }

        .green-tooltip {
            background: transparent;
            border: none;
            font-weight: bold;
            color: seagreen;
            box-shadow: none;
        }

        .blue-tooltip {
            background: transparent;
            border: none;
            color: navy;
            box-shadow: none;
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
                    <div class="navbar-left mx-3 px-3 d-none d-md-block">
                        <span id="date" class="mr-3"></span>
                        <span id="time"></span>
                    </div>
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        {{-- <li class="nav-item toggle-nav-search hidden-caret">
                            <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button"
                                aria-expanded="false" aria-controls="search-nav">
                                <i class="la la-search"></i>
                            </a>
                        </li> --}}
                        {{-- <li class="nav-item dropdown hidden-caret">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-envelope"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown hidden-caret">
                            <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-bell"></i>
                                <span class="notification">3</span>
                            </a>
                            <ul class="dropdown-menu notif-box " aria-labelledby="notifDropdown">
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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"
                                aria-expanded="false"><i class="la la-user" style="font-size: 26px"></i></a>

                            <ul class="dropdown-menu mt-3">

                                <a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="la la-user"></i>
                                    Profil Saya</a>
                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'manager')
                                    <a class="dropdown-item" href="{{ route('setting.edit') }}"><i
                                            class="la la-cog"></i>
                                        Pengaturan</a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item logout-btn" href="{{ route('logout') }}">
                                    <i class="la la-power-off"></i> Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <div class=" font-weight-bold">{{ Auth::user()->name }}</div>
                            <small class="text-capitalize">{{ Auth::user()->role }}</small>
                        </li>
                        {{-- <li class="nav-item dropdown">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
                                aria-expanded="false"> <img src="{{ asset('img/profile.jpg') }}" alt="user-img"
                                    width="36" class="img-circle"><span>{{ Auth::user()->name }}</span> </a>
                            <ul class="dropdown-menu mt-3">
                                
                                <a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="la la-user"></i>
                                    Profil Saya</a>
                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'manager')
                                    <a class="dropdown-item" href="{{ route('setting.edit') }}"><i
                                            class="la la-cog"></i>
                                        Pengaturan</a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item logout-btn" href="{{ route('logout') }}">
                                    <i class="la la-power-off"></i> Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                            <!-- /.dropdown-user -->
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
                    {{-- <div class="user">
                        <div class="photo">
                            <img src="{{ asset('img/profile.jpg') }}" alt="image profile">
                        </div>
                        <div class="info">
                            <a href="{{ route('profile.edit') }}">
                                <span>
                                    {{ Auth::user()->name }}

                                    <span class="user-level text-capitalize">{{ Auth::user()->role }}</span>
                                    <span class="caret"></span>
                                </span>
                            </a>
                            <div class="clearfix"></div>

                            <div class="collapse in" id="collapseExample">
                                <ul class="nav">
                                    <li>
                                        <a href="#profile">
                                            <span class="link-collapse">Profil Saya</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#edit">
                                            <span class="link-collapse">Ubah Password</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#settings">
                                            <span class="link-collapse">Keluar</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> --}}
                    <ul class="nav">
                        <li class="nav-item {{ Request::routeIs('dashboard') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">
                                <i class="la la-dashboard"></i>
                                <p>Dashboard</p>
                                {{-- <span class="badge badge-count">5</span> --}}
                            </a>
                        </li>

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

                        <li class="nav-item {{ Request::routeIs('armada.*') ? 'active' : '' }}">
                            <a data-toggle="collapse" href="#armada">
                                <i class="la la-truck"></i>
                                <p>Armada</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ Request::routeIs('armada.*') ? 'show' : '' }}" id="armada">
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

                        @if (Auth::user()->role == 'admin')
                            <li class="nav-item {{ Request::routeIs('user.*') ? 'active' : '' }}">
                                <a href="{{ route('user.index') }}">
                                    <i class="la la-users-cog"></i>
                                    <p>Pengguna</p>
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'manager')
                            <li class="nav-item {{ Request::routeIs('setting.*') ? 'active' : '' }}">
                                <a href="{{ route('setting.edit') }}">
                                    <i class="la la-cog"></i>
                                    <p>Pengaturan</p>
                                </a>
                            </li>
                        @endif

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
                    {{-- <nav class="pull-left">
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
                    </nav> --}}
                    <div class="copyright ml-auto">
                        2022, made with <i class="la la-heart heart text-danger"></i> by <a href="#">Febri
                            Sutomo</a>
                    </div>
                </div>
            </footer>
        </div>

    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('plugins/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('plugins/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Moment JS -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('plugins/chart.js/chart.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('plugins/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }} "></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }} "></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }} "></script>


    <!-- DateTimePicker -->
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>


    <!-- jQuery Validation -->
    <script src="{{ asset('plugins/jquery.validate/jquery.validate.min.js') }}"></script>


    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>


    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>



    <script script script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>


    <!-- Ready Pro JS -->
    <script src="{{ asset('js/ready.min.js') }}"></script>


    <script>
        function rupiah(num) {
            return 'Rp ' + num.toLocaleString("id-ID", {
                style: "decimal"
            })
        }

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
            const time = new Date().toLocaleTimeString('id-ID');
            document.getElementById('date').innerHTML = date
            document.getElementById('time').innerHTML = "Pukul " + time
        }

        setInterval(refreshTime, 1000);


        const swal = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-danger ml-2'
            },
            buttonsStyling: false
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

        $.extend($.fn.dataTable.defaults, {
            language: {
                search: "Pencarian",
                lengthMenu: "Menampilkan _MENU_ data per halaman",
                zeroRecords: "Tidak ada yang ditemukan",
                info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                infoEmpty: "Tidak ada data yang tersedia",
                emptyTable: "Tidak ada data yang tersedia",
                infoFiltered: "(filtered from _MAX_ total records)",
                paginate: {
                    first: '<i class="las la-angle-double-left"></i>',
                    previous: '<i class="las la-angle-left"></i>',
                    next: '<i class="las la-angle-right"></i>',
                    last: '<i class="las la-angle-double-right"></i>'
                },
            }
        });

        const tableExport = (selector) => {

            let count_columns = $(selector + " tr th").length
            let columns = [...Array(count_columns - 1).keys()]

            $(selector).DataTable({
                buttons: [{
                        extend: 'print',
                        exportOptions: {
                            columns: columns
                        },
                        autoPrint: true,
                        customize: function(win) {
                            $(win.document.body).find('h1').css('text-align', 'center');
                            $(win.document.body).find('h1').css('font-size', '20px');
                        }
                    },
                    {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: columns
                        },

                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: columns
                        },

                    },
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: columns
                        },

                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: columns
                        },

                    }
                ],

            })

            $(".export-button .print").on("click", function(e) {
                e.preventDefault();
                $(selector).DataTable().button(0).trigger()
            });

            $(".export-button .copy").on("click", function(e) {
                e.preventDefault();
                $(selector).DataTable().button(1).trigger()

            });

            $(".export-button .excel").on("click", function(e) {
                e.preventDefault();
                $(selector).DataTable().button(2).trigger()

            });

            $(".export-button .csv").on("click", function(e) {
                e.preventDefault();
                $(selector).DataTable().button(3).trigger()

            });

            $(".export-button .pdf").on("click", function(e) {
                e.preventDefault();
                $(selector).DataTable().button(4).trigger()
            });
        }


        $('.logout-btn').on('click', function(e) {
            e.preventDefault()

            swal.fire({
                title: 'Anda yakin ingin keluar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Batalkan'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#logout-form').submit()
                }
            })
        })


        $(".number").each((i, el) => {
            el.innerText = parseInt(el.innerText).toLocaleString('id-ID')
        })
    </script>

    @stack('script')

</body>

</html>
