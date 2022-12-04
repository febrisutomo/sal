@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <h4 class="page-title">Dashboard</h4>
            {{-- <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('dashboard') }}">
                        <i class="la la-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="la la-angle-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Armada</a>
                </li>
                <li class="separator">
                    <i class="la la-angle-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Kernet</a>
                </li>
            </ul> --}}
            <div class="ml-auto">
                <ul class="nav nav-pills nav-secondary ">
                    <li class="nav-item ">
                        <a class="nav-link {{ Request::query('filter') == '' || Request::query('filter') == 'today'  ? 'active' : ''}} mb-0" href="{{ route('dashboard') }}">Hari ini</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::query('filter') == 'week' ? 'active' : ''}} mb-0" href="{{ route('dashboard', ['filter' => 'week']) }}">Minggu ini</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::query('filter') == 'month' ? 'active' : ''}} mb-0" href="{{ route('dashboard', ['filter' => 'month']) }}">Bulan ini</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::query('filter') == 'all' || !collect(['today', 'week', 'month', 'all', ''])->contains(Request::query('filter')) ? 'active' : ''}} mb-0" href="{{ route('dashboard', ['filter' => 'all']) }}">Semua</a>
                    </li>
                </ul>
            </div>


        </div>
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center icon-warning">
                                    <i class="la la-download"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Pengambilan</p>
                                    <h4 class="card-title number">{{ $pengambilans->sum('jumlah') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center icon-success">
                                    <i class="la la-upload"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Penyaluran</p>
                                    <h4 class="card-title number">{{ $pengambilans->sum('total_penyaluran') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center icon-danger">
                                    <i class="la la-exchange"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Penukaran</p>
                                    <h4 class="card-title number">{{ $pengambilans->sum('total_penukaran ') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center icon-primary">
                                    <i class="la la-warehouse"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Stok Gudang</p>
                                    <h4 class="card-title number">{{ $stok_gudang  }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  

        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">SA Hari Ini</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-full-width">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No. SA</th>
                                        <th>Tipe</th>
                                        <th>SP(P)BE</th>
                                        <th class="text-right">Kuota</th>
                                        <th class="text-right">Diambil</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($kuota_harians as $item)
                                        <tr>
                                            <td>{{ $item->sa->no_sa }}</td>
                                            <td>{{ $item->sa->tipe }}</td>
                                            <td>{{ $item->sa->sppbe->nama }}</td>
                                            <td class="number text-right">{{ $item->kuota }}</td>
                                            <td class="number text-right">{{ $item->diambil }}</td>
                                            <td class="text-center">
                                                {{-- <div class="btn-group dropdown">
                                                <button class="btn btn-sm dropdown-toggle" type="button"
                                                    data-toggle="dropdown">
                                                    Aksi
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" role="menu"
                                                    aria-labelledby="dropdownMenu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('surat-jalan.index') }}"><i
                                                            class="la la-eye mr-1"></i>Lihat</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('surat-jalan.create', ['sppbe_id' => $item->sa->sppbe_id, 'kuota_harian_id' => $item->id]) }}"><i
                                                            class="la la-truck mr-1"></i>Ambil</a>
                                                </div>

                                            </div> --}}
                                                @if ($item->diambil == $item->kuota)
                                                    <a href="{{ route('surat-jalan.index', ['tanggal' => date('Y-m-d'), 'no_sa' => $item->sa->no_sa]) }}"
                                                        class="btn btn-success btn-sm btn-rounded">Lihat</a>
                                                @else
                                                    <a href="{{ route('surat-jalan.create', ['sppbe_id' => $item->sa->sppbe_id, 'no_sa' => $item->sa->no_sa]) }}"
                                                        class="btn btn-primary btn-sm btn-rounded">Ambil</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty

                                        <tr>
                                            <td class="text-center" colspan="100%">Tidak ada pengambilan untuk hari ini!.</td>
                                        </tr>
                                    @endforelse


                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-right" colspan="3">Total</th>
                                        <th class="number text-right">{{ $kuota_harians->sum('kuota') }}</th>
                                        <th class="number text-right">{{ $kuota_harians->sum('diambil') }}</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Task</h4>
                        {{-- <p class="card-category">Complete</p> --}}
                    </div>
                    <div class="card-body">
                        <div id="task-complete" class="chart-circle mt-4 mb-3"></div>
                    </div>
                    <div class="card-footer">
                        <div class="legend"><i class="la la-circle text-primary"></i> Completed</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        let kuota = parseInt({{ $kuota_harians->sum('kuota') }})
        let diambil = parseInt({{ $kuota_harians->sum('diambil') }})

        let complete = (diambil / kuota * 100)

        if (kuota == 0) {
            complete = 100
        }

        console.log(complete);
        Circles.create({
            id: 'task-complete',
            radius: 75,
            value: complete,
            maxValue: 100,
            width: 8,
            text: function(value) {
                return value + '%';
            },
            colors: ['#eee', '#1D62F0'],
            duration: 400,
            wrpClass: 'circles-wrp',
            textClass: 'circles-text',
            styleWrapper: true,
            styleText: true
        })
    </script>
@endpush
