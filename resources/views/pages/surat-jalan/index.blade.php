@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Surat Jalan</h1>
                </div>
                <div class="col-sm-6 d-flex justify-content-end">

                    <div class="input-group mr-2" style="width: 230px">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-filter"></i></span>
                        </div>
                        <input type="text" name="daterange" class="form-control">
                    </div>

                    </button>

                    <button type="button" class="btn btn-default dropdown-toggle mr-2"
                        data-toggle="dropdown">
                        <i class="fas fa-cloud-download-alt mr-2"></i>Export
                    </button>
                    <div class="dropdown-menu export-button">
                        <a class="dropdown-item excel" href="#"><i class="fas fa-file-excel mr-2"></i>Excel</a>
                        <a class="dropdown-item csv" href="#"><i class="fas fa-file-csv mr-2"></i>CSV</a>
                        <a class="dropdown-item print" href="#"><i class="fas fa-print mr-2"></i>Print</a>
                        <a class="dropdown-item copy" href="#"><i class="fas fa-copy mr-2"></i>Copy</a>
                    </div>
                    <a href="{{ route('surat-jalan.create') }}" class="btn btn-primary"><i
                            class="fas fa-plus mr-2"></i>Surat Jalan Baru</a>
                    {{-- <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Surat Jalan</a></li>
                        <li class="breadcrumb-item active">Buat</li>
                    </ol> --}}
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid pb-3">
            <div class="card card-primary">
                {{-- <div class="card-header">
                    <h3 class="card-title">Data Surat Jalan</h3>
                </div> --}}
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>SP(P)BE</th>
                                    <th>No. SA</th>
                                    <th>Armada</th>
                                    <th>Sopir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengambilans as $pengambilan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pengambilan->kitir->tanggal }}</td>
                                        <td>{{ $pengambilan->kitir->sa->sppbe->nama }}</td>
                                        <td>{{ $pengambilan->kitir->sa->no_sa }}</td>
                                        <td>{{ $pengambilan->armada->plat_nomor }}</td>
                                        <td>{{ $pengambilan->sopir->nama }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                            <a href="{{ route('surat-jalan.show', $pengambilan->id)}}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('surat-jalan.pdf', $pengambilan)}}" class="btn btn-sm btn-info"><i class="fas fa-file-pdf"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

    </section>
@endsection

@push('script')
    <script>
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
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                    'month')],
                'This Year': [moment().startOf('year'), moment().endOf('year')],
                'All Time': [moment('2015-01-01'), moment().add(1, 'days')],
            },
        })
        const dataTable = $("table").DataTable({
            buttons: [{
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
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
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
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
@endpush
