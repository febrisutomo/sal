@extends('layouts.app')

@section('content')
    <div class="data" data-kitir='@json($kitir)'></div>
    <div class="container-fluid">
        <div class="page-header">
            <h4 class="page-title">Edit Kitir</h4>
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
                    <a href="{{ route('kitir.index') }}">Kitir Bulanan</a>
                </li>
                <li class="separator">
                    <i class="la la-angle-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Edit</a>
                </li>
            </ul>
            <div class="ml-auto">
                <a href="{{ route('kitir.print', $kitir) }}" target="_blank" class="btn btn-secondary">
                    <span class="btn-label"><i class="la la-print mr-1"></i></span>
                    Print
                </a>
                {{-- <a href="{{route('kitir.rdit', $kitir)}}" class="btn btn-primary">
                    <i class="la la-edit mr-1"></i>
                    Edit
                </a> --}}
            </div>


        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="card-body">
                        @foreach ($dates as $week)
                            @php
                                $last = $loop->last;
                            @endphp
                            <h6>Minggu ke-{{ $loop->iteration }}</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm mb-3" style="width: fit-content">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 40px">No.</th>
                                            <th style="width: 80px">SPPBE</th>
                                            <th style="width: 120px">No. SA</th>
                                            @foreach ($week as $day)
                                                <th class="text-center  {{ $day == null ? 'bg-light' : '' }} {{ $loop->first && $day != null ? 'text-danger' : '' }} "
                                                    style="width: 90px;">{{ $day }}</th>
                                            @endforeach
                                            @if ($last)
                                                <th class=" text-center" style="width: 80px">Total</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sppbes as $sppbe)
                                            @php
                                                $sas = $kitir->sas->where('sppbe_id', $sppbe->id)->sortBy('tipe');
                                            @endphp
                                            <tr data-sppbe='@json($sppbe)'
                                                data-sa='@json($sas->first())' data-count="{{ $sas->count() }}">
                                                <td rowspan="{{ $sas->count() ?: 1 }}" class="text-center"
                                                    style="vertical-align: middle">{{ $loop->iteration }}</td>
                                                <td rowspan="{{ $sas->count() ?: 1 }}" style="vertical-align: middle">
                                                    {{ $sppbe->kode }}</td>
                                                <td class="no-sa" style="cursor: pointer; position: relative;">
                                                    @if ($sas->count())
                                                        <div class="{{ $sas->first()->tipe == 'tambahan' ? 'text-danger' : '' }}"
                                                            style="margin-right:56px">
                                                            {{ $sas->first()->no_sa }}
                                                        </div>
                                                        <div class="btn-action">
                                                            @if ($sas->count() == 1)
                                                                <button class="btn btn-link add-sa d-block"
                                                                    title="tambah"><span class="btn-label"><i
                                                                            class="la la-plus"></span></i></button>
                                                            @endif
                                                            <button class="btn btn-link text-danger delete-sa d-block"
                                                                title="hapus"><span class="btn-label"><i
                                                                        class="la la-trash"></span></i></button>

                                                        </div>
                                                    @endif

                                                </td>
                                                @foreach ($week as $day)
                                                    @php
                                                        $kuotaHarian = $sas
                                                            ->first()
                                                            ?->kuotaHarians->where('tanggal', $kitir->bulan_tahun . '-' . str_pad($day, 2, '0', STR_PAD_LEFT))
                                                            ->first();
                                                    @endphp
                                                    <td class="text-right  {{ $day == null ? 'bg-light' : '' }} {{ $day != null && $loop->iteration != 1 ? 'kuota' : '' }}"
                                                        style="position:relative; {{ $day != null && $loop->iteration != 1 ? 'cursor:pointer' : '' }}"
                                                        data-tanggal="{{ $kitir->bulan_tahun . '-' . str_pad($day, 2, '0', STR_PAD_LEFT) }}"
                                                        data-kitir='@json($kuotaHarian)'>
                                                        <div style="margin-right:24px">{{ $kuotaHarian?->kuota }}</div>

                                                        @if ($kuotaHarian)
                                                            <div class="btn-action">
                                                                <button class="btn  btn-link text-danger delete-kuota"
                                                                    title="hapus"><span class="btn-label"><i
                                                                            class="la la-trash"></span></i></button>
                                                            </div>
                                                        @endif
                                                    </td>
                                                @endforeach
                                                @if ($last)
                                                    <th class="text-right subtotal">
                                                        {{ $kitir->kuotaHarians->where('sa_id', $sas->first()?->id)->sum('kuota') }}
                                                    </th>
                                                @endif

                                            </tr>
                                            @if ($sas->count() > 1)
                                                <tr data-sppbe='@json($sppbe)'
                                                    data-sa='@json($sas->last())'
                                                    data-count="{{ $sas->count() }}">
                                                    <td class="no-sa" style="cursor: pointer; position: relative;"
                                                        style="margin-right:56px">
                                                        @if ($sas->count())
                                                            <div
                                                                class="{{ $sas->last()->tipe == 'tambahan' ? 'text-danger' : '' }}">
                                                                {{ $sas->last()->no_sa }}
                                                            </div>
                                                            <div class="btn-action">
                                                                @if ($sas->count() == 1)
                                                                    <button class="btn  btn-link add-sa d-block"
                                                                        title="tambah"><span class="btn-label"><i
                                                                                class="la la-plus"></span></i></button>
                                                                @endif
                                                                <button class="btn btn-link text-danger delete-sa d-block"
                                                                    title="hapus"><span class="btn-label"><i
                                                                            class="la la-trash"></span></i></button>

                                                            </div>
                                                        @endif

                                                    </td>
                                                    @foreach ($week as $day)
                                                        @php
                                                            $kuotaHarian = $sas
                                                                ->last()
                                                                ?->kuotaHarians->where('tanggal', $kitir->bulan_tahun . '-' . str_pad($day, 2, '0', STR_PAD_LEFT))
                                                                ->last();
                                                        @endphp
                                                        <td class="text-right  {{ $day == null ? 'bg-light' : '' }} {{ $day != null && $loop->iteration != 1 ? 'kuota' : '' }} "
                                                            style="position:relative; {{ $day != null && $loop->iteration != 1 ? 'cursor:pointer' : '' }}"
                                                            data-tanggal="{{ $kitir->bulan_tahun . '-' . str_pad($day, 2, '0', STR_PAD_LEFT) }}"
                                                            data-kitir='@json($kuotaHarian)'>
                                                            <div style="margin-right:24px">{{ $kuotaHarian?->kuota }}</div>
                                                            @if ($kuotaHarian)
                                                                <div class="btn-action">
                                                                    <button class="btn btn-link text-danger delete-kuota"
                                                                        title="hapus"><span class="btn-label"><i
                                                                                class="la la-trash"></span></i></button>
                                                                </div>
                                                            @endif
                                                        </td>
                                                    @endforeach
                                                    @if ($last)
                                                        <th class="text-right subtotal">
                                                            {{ $kitir->kuotaHarians->where('sa_id', $sas->last()?->id)->sum('kuota') }}
                                                        </th>
                                                    @endif
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3">
                                            </th>
                                            @foreach ($week as $day)
                                                <th class="text-right {{ $day == null ? 'bg-light' : '' }}">
                                                    @if ($day != null && $loop->iteration != 1)
                                                        <div style="margin-right:24px">
                                                            {{ $kitir->kuotaHarians->where('tanggal', $kitir->bulan_tahun . '-' . str_pad($day, 2, '0', STR_PAD_LEFT))->sum('kuota') }}
                                                        </div>
                                                    @endif
                                                </th>
                                            @endforeach
                                            @if ($last)
                                                <th class="text-right">
                                                    <div class="total">{{ $kitir->kuotaHarians->sum('kuota') }}</div>
                                                </th>
                                            @endif
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalNoSA" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form class="needs-validation" novalidate>
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">KMSU (10-2022)</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group ">
                            <label>No. SA <span class="text-capitalize">reguler</span></label>
                            <input type="number" class="form-control" name="no_sa" placeholder="Masukkan No. SA"
                                required>
                            <div class="feedback"></div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary btn-save">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalKuota" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form class="needs-validation" novalidate>
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">KMSU (10-2022)</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kuota <span class="text-capitalize">reguler</span></label>
                            <input type="number" class="form-control" name="kuota" placeholder="Masukkan kuota"
                                required>
                            <div class="feedback"></div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary btn-save">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {


            const kitir = $('.data').data('kitir')

            let bulan = new Date(kitir.bulan_tahun + '-01').toLocaleDateString('id-ID', {
                year: 'numeric',
                month: 'long'
            })

            $('.card-title').text('SA ' + bulan)


            $('.no-sa').on('click', function() {
                let sa = $(this).parent().data('sa')
                let sppbe = $(this).parent().data('sppbe')

                $('#modalNoSA').modal('show')
                $('#modalNoSA').data('sppbe', sppbe)
                $('#modalNoSA .modal-title').text(sppbe.kode + ' (' + bulan + ')')
                $('#modalNoSA').data('id', sa ? sa.id : '')
                $('#modalNoSA label span').text(sa ? sa.tipe : 'reguler')
                $('#modalNoSA input').val($(this).text().trim())

            })


            $('.add-sa').on('click', function(e) {
                e.stopPropagation()

                let sa = $(this).closest('tr').data('sa')
                let sppbe = $(this).closest('tr').data('sppbe')

                $('#modalNoSA').modal('show')
                $('#modalNoSA').data('sppbe', sppbe)
                $('#modalNoSA .modal-title').text(sppbe.kode +
                    ' (' + bulan + ' )')
                if (sa.tipe == 'reguler') {
                    $('#modalNoSA label span').text('tambahan')
                } else {
                    $('#modalNoSA label span').text('reguler')
                }
                $('#modalNoSA').data('id', '')
                $('#modalNoSA input').val('')
            })


            $('#modalNoSA form').on('submit', function(e) {
                e.preventDefault()

                $('#modalNoSA .feedback').removeClass('invalid-feedback').text('')
                $('#modalNoSA input').removeClass('is-invalid')
                $('#modalNoSA button[type=submit]').prop('disabled', true).text('Menyimpan...')

                let id = $('#modalNoSA').data('id')
                let url = window.location.origin + '/sa/'
                let type = 'POST'

                if (id != '') {
                    url += id
                    type = 'PUT'
                }

                // console.log(data); 
                $.ajax({
                    url: url,
                    type: type,
                    data: {
                        kitir_id: kitir.id,
                        bulan_tahun: kitir.bulan_tahun + '-01',
                        sppbe_id: $('#modalNoSA').data('sppbe').id,
                        no_sa: $('#modalNoSA input').val(),
                        tipe: $('#modalNoSA label span').text(),
                    },
                    success: function(response) {
                        $('#modalNoSA').modal('hide')
                        Toast.fire({
                            icon: 'success',
                            title: response.message,
                        }).then(function() {
                            location.reload()
                        })

                    },
                    error: function(jqXHR) {
                        if (jqXHR.status == 419) {
                            $('#modalNoSA').modal('hide')
                            swal.fire({
                                title: 'Session Expired',
                                text: 'Silahkan login kembali!',
                                icon: 'warning',
                            }).then((result) => {
                                location.reload()
                            })
                        }
                        $('#modalNoSA .feedback').addClass('invalid-feedback').text(jqXHR
                            .responseJSON.message)
                        $('#modalNoSA input').addClass('is-invalid')
                    },
                    complete: function() {
                        $('#modalNoSA button[type=submit]').prop('disabled', false).text(
                            'Simpan')

                    }
                })
            })

            $('#modalNoSA').on('hidden.bs.modal', function(event) {
                $('#modalNoSA .feedback').removeClass('invalid-feedback').text('')
                $('#modalNoSA input').removeClass('is-invalid')
            })

            $('.delete-sa').on('click', function(e) {
                e.stopPropagation()
                swal.fire({
                    title: 'Apakah anda yakin?',
                    text: 'No. SA : ' + $(this).closest('tr').data('sa').no_sa,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batalkan'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let id = $(this).closest('tr').data('sa').id
                        $.ajax({
                            url: window.location.origin + '/sa/' + id,
                            type: 'delete',
                            success: function(response) {
                                Toast.fire({
                                    icon: 'success',
                                    title: response.message,
                                }).then(function() {
                                    location.reload()
                                })
                            }
                        })
                    }
                })
            })


            // KUOTA

            $('.kuota').on('click', function() {
                let sa = $(this).parent().data('sa')
                let sppbe = $(this).parent().data('sppbe')
                let kitir = $(this).data('kitir')
                let tanggal = $(this).data('tanggal')

                if (sa) {
                    $('#modalKuota').modal('show')
                    $('#modalKuota').data('sa-id', sa.id)
                    $('#modalKuota').data('id', kitir ? kitir.id : '')
                    $('#modalKuota').data('tanggal', tanggal)
                    $('#modalKuota .modal-title').text(sppbe.kode + ' (' + new Date(tanggal)
                        .toLocaleDateString('id-ID', {
                            year: 'numeric',
                            month: 'short',
                            day: 'numeric'
                        }) + ')')
                    $('#modalKuota input').val($(this).text().trim())
                    $('#modalKuota label span').text(sa.tipe)

                } else {
                    swal.fire({
                        title: 'Masukkan No. SA terlebih dahulu!',
                        icon: 'warning',
                    }).then((result) => {
                        $('#modalNoSA').modal('show')
                        $('#modalNoSA').data('sppbe', sppbe)
                        $('#modalNoSA .modal-title').text(sppbe.kode + ' (' + bulan + ')')
                        $('#modalNoSA').data('id', '')
                        $('#modalNoSA label span').text('reguler')
                        $('#modalNoSA input').val('')
                    })

                }
            })

            $('#modalKuota form').on('submit', function(e) {
                e.preventDefault()

                $('#modalKuota .feedback').removeClass('invalid-feedback').text('')
                $('#modalKuota input').removeClass('is-invalid')
                $('#modalKuota button[type=submit]').prop('disabled', true).text('Menyimpan...')

                let id = $('#modalKuota').data('id')
                let url = window.location.origin + '/kuota-harian/'
                let type = 'POST'

                if (id != '') {
                    url += id
                    type = 'PUT'
                }

                $.ajax({
                    url: url,
                    type: type,
                    data: {
                        sa_id: $('#modalKuota').data('sa-id'),
                        kuota: $('#modalKuota input').val(),
                        tanggal: $('#modalKuota').data('tanggal')
                    },
                    success: function(response) {
                        $('#modalKuota').modal('hide')
                        Toast.fire({
                            icon: 'success',
                            title: response.message,
                        }).then(function() {
                            location.reload()
                        })

                    },
                    error: function(jqXHR) {
                        if (jqXHR.status == 419) {
                            $('#modalKuota').modal('hide')
                            swal.fire({
                                title: 'Session Expired',
                                text: 'Silahkan login kembali!',
                                icon: 'warning',
                            }).then((result) => {
                                location.reload()
                            })
                        }
                        $('#modalKuota .feedback').addClass('invalid-feedback').text(jqXHR
                            .responseJSON.message)
                        $('#modalKuota input').addClass('is-invalid')
                    },
                    complete: function() {
                        $('#modalKuota button[type=submit]').prop('disabled', false).text(
                            'Simpan')

                    }
                })

            })

            $('#modalKuota').on('hidden.bs.modal', function(event) {
                $('#modalKuota .feedback').removeClass('invalid-feedback').text('')
                $('#modalKuota input').removeClass('is-invalid')
            })



            $('.delete-kuota').on('click', function(e) {
                e.stopPropagation()
                let id = $(this).parent().parent().data('kitir').id
                $.ajax({
                    url: window.location.origin + '/kuota-harian/' + id,
                    type: 'delete',
                    success: function(response) {
                        Toast.fire({
                            icon: 'success',
                            title: response.message,
                        }).then(function() {
                            location.reload()
                        })
                    }
                })


            })




        })
    </script>
@endpush

@push('style')
    <style>

        .btn-action {
            height: fit-content;
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            margin: auto 0;
            display: none;
        }

        .kuota:hover .btn-action,
        .no-sa:hover .btn-action {
            display: flex;

        }

        .table-sm td,
        .table th {
            padding: 6px !important;
        }

        .btn-action .btn {
            padding: 6px;
        }
    </style>
@endpush