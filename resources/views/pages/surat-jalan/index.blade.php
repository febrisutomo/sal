@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="page-header">
            <h4 class="page-title">Surat Jalan</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="la la-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="la la-angle-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Surat Jalan</a>
                </li>
                {{-- <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Buttons</a>
            </li> --}}
            </ul>
            <div class="ml-auto">
                {{-- <button>
                    <div class="input-group mr-2" style="width: 230px">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="la la-filter"></i></span>
                        </div>
                        <input type="text" name="daterange" class="form-control">
                    </div>
                </button> --}}

                <div class="dropdown d-inline-block mr-1">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="btn-label"><i class="la la-cloud-upload mr-1"></i></span>Export
                    </button>
                    <div class="dropdown-menu dropdown-menu-right export-button" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item excel" href="#"><i class="la la-file-excel mr-1"></i>Excel</a>
                        <a class="dropdown-item csv" href="#"><i class="las la-file-csv mr-1"></i>CSV</a>
                        <a class="dropdown-item print" href="#"><i class="la la-print mr-1"></i>Print</a>
                        <a class="dropdown-item copy" href="#"><i class="la la-copy mr-1"></i>Copy</a>
                    </div>
                </div>


                <a href="{{ route('surat-jalan.create') }}" class="btn btn-primary">
                    <span class="btn-label"><i class="la la-plus mr-1"></i></span>
                    Buat Surat Jalan
                </a>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Kitir</h4>
                            
                        </div>
                    </div> --}}
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table data-table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        {{-- <th>ID</th> --}}
                                        <th>Tanggal</th>
                                        <th>SP(P)BE</th>
                                        <th>No. SA</th>
                                        <th>Truk</th>
                                        <th>Sopir</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengambilans as $pengambilan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            {{-- <td>{{ $pengambilan->id }}</td> --}}
                                            <td>{{ tanggal($pengambilan->kuotaHarian->tanggal) }}</td>
                                            <td>{{ $pengambilan->kuotaHarian->sa->sppbe->nama }}</td>
                                            <td>{{ $pengambilan->kuotaHarian->sa->no_sa }}</td>
                                            <td>{{ $pengambilan->truk->plat_nomor }}</td>
                                            <td>{{ $pengambilan->sopir->nama }}</td>
                                            <td class="text-center">
                                                <div class="btn-group dropdown">
                                                    <button class="btn btn-sm dropdown-toggle" type="button"
                                                        data-toggle="dropdown">
                                                        Aksi
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" role="menu"
                                                        aria-labelledby="dropdownMenu">
                                                        <a class="dropdown-item" href="{{ route('surat-jalan.show', $pengambilan) }}"><i
                                                                class="la la-eye mr-1"></i>Lihat</a>
                                                        <a class="dropdown-item" href="{{ route('surat-jalan.edit', $pengambilan) }}"><i
                                                                class="la la-edit mr-1"></i>Edit</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('surat-jalan.print', $pengambilan) }}" target="_blank" ><i
                                                                class="la la-print mr-1"></i>Print</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item delete-surat-jalan text-danger" href="#"
                                                            data-id="{{ $pengambilan }}"><i
                                                                class="la la-trash mr-1"></i>Hapus</a>
                                                    </div>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('input[name=daterange]').daterangepicker({
                autoApply: false,
                alwaysShowCalendars: true,
                opens: 'left',
                cancelClass: 'btn-white',
                locale: {
                    format: "DD/MM/YYYY",
                },

                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf(
                        'month')],
                    'This Year': [moment().startOf('year'), moment().endOf('year')],
                    'All Time': [moment('2015-01-01'), moment().add(1, 'days')],
                },
            })


        })
    </script>
@endpush
