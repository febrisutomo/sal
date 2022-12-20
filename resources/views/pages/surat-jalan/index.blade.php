@extends('layouts.app', ['title' => 'Surat Jalan'])

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <h4 class="page-title">Surat Jalan</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('dashboard') }}">
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

                <button class="btn p-0 mr-2">
                    <div class="input-group" style="width: 230px">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="la la-filter"></i></span>
                        </div>
                        <input type="text" name="date_range" class="form-control date-range">
                    </div>
                </button>
               

                <div class="dropdown d-inline-block mr-2">
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
                    Buat <span class="d-none d-md-inline-block">Surat Jalan</span>
                </a>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tbSuratJalan" class="table data-table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>ID</th>
                                        <th>Tanggal</th>
                                        <th>SP(P)BE</th>
                                        <th>No. SA</th>
                                        <th>Armada</th>
                                        {{-- <th>Sopir</th> --}}
                                        <th style="width: 80px">Total Pengambilan</th>
                                        <th style="width: 80px">Total Penyaluran</th>
                                        <th style="width: 60px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengambilans as $pengambilan)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>SJ-{{ str_pad($pengambilan->id, 5, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ tanggal($pengambilan->kuotaHarian->tanggal) }}</td>
                                            <td><a href="{{ route('sppbe.edit', $pengambilan->kuotaHarian->sa->sppbe ) }}" data-toggle="tooltip"
                                                title=""
                                                data-original-title="{{ $pengambilan->kuotaHarian->sa->sppbe->nama }}">{{ $pengambilan->kuotaHarian->sa->sppbe->kode }}</a></td>
                                            <td>{{ $pengambilan->kuotaHarian->sa->no_sa }}</td>
                                            <td><a href="{{ route('armada.truk.edit', $pengambilan->truk ) }}">{{ $pengambilan->truk->kode }}</a></td>
                                            {{-- <td>{{ $pengambilan->sopir->nama }}</td> --}}
                                            <td>{{ $pengambilan->jumlah }}</td>
                                            <td>{{ $pengambilan->penyaluran->total}}</td>
                                            <td class="text-center">
                                                <div class="btn-group dropdown">
                                                    <button class="btn btn-sm dropdown-toggle" type="button"
                                                        data-toggle="dropdown">
                                                        Aksi
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" role="menu"
                                                        aria-labelledby="dropdownMenu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('surat-jalan.show', $pengambilan) }}"><i
                                                                class="la la-eye mr-1"></i>Lihat</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('surat-jalan.edit', $pengambilan) }}"><i
                                                                class="la la-edit mr-1"></i>Edit</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('surat-jalan.print', $pengambilan) }}"
                                                            target="_blank"><i class="la la-print mr-1"></i>Print</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item delete-surat-jalan text-danger"
                                                            href="#"
                                                            data-pengambilan='@json($pengambilan)'><i
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

            tableExport('#tbSuratJalan')
            

            $('.date-range').daterangepicker({
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

            $('.date-range').on('apply.daterangepicker', function(ev, picker) {
                let start = picker.startDate.format('YYYY-MM-DD');
                let end = picker.endDate.format('YYYY-MM-DD');
                window.location.replace(app_url+'/surat-jalan?start='+start+'&end='+end);
            });

            $('body').on('click', '.delete-surat-jalan', function(e) {
                e.preventDefault()
                swal.fire({
                    title: 'Anda yakin ingin menghapus ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batalkan'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let id = $(this).data('pengambilan').id
                        $.ajax({
                            url: app_url + '/surat-jalan/' + id,
                            type: 'DELETE',
                            success: function(response) {
                                toastr.success(
                                    response.message,
                                    'Success', {
                                        timeOut: 1000,
                                        fadeOut: 1000,
                                        onHidden: function() {
                                            window.location.reload()
                                        }
                                    }
                                );
                            },
                            error: function(jqXHR) {
                                swal.fire({
                                    title: 'Error',
                                    text: jqXHR
                                        .responseJSON.message,
                                    icon: 'warning',
                                })

                            }
                        })
                    }
                })
            })

           


        })
    </script>
@endpush
