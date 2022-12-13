@extends('layouts.app', ['title' => 'Edit Kitir'])

@section('content')
    <div class="data" data-kitir='@json($kitir)'></div>
    <div class="container-fluid">
        <div class="page-header">
            <h4 class="page-title">Edit Kitir</h4>
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
                    <span class="btn-label"><i class="la la-print mr-2"></i></span>
                    Print
                </a>
            </div>


        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="card-body">
                        @foreach ($weeks as $week_index => $week)
                          
                            <h6>Minggu ke-{{ $week_index + 1 }}</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered  table-sm mb-3 tb-striped" style="width: fit-content">
                                    <tr>
                                        <th class="text-center" style="width: 40px">No.</th>
                                        <th style="width: 80px">SPPBE</th>
                                        <th style="width: 120px">No. SA</th>
                                        @foreach ($week as $day_index => $day)
                                            <th class="text-center  {{ $day == null ? 'bg-light' : '' }} {{ $day_index == 0 && $day != null ? 'text-danger' : '' }} "
                                                style="width: 90px;">{{ $day }}</th>
                                        @endforeach
                                        @if ($week_index + 1 == count($weeks))
                                            <th class=" text-center" style="width: 80px">Total</th>
                                        @endif
                                    </tr>

                                    @foreach ($sppbes as $sppbe_index => $sppbe)
                                        @php
                                            $sas = $kitir->sas->where('sppbe_id', $sppbe->id)->sortBy('tipe');
                                        @endphp
                                        @forelse ($sas as $sa)
                                            <tr data-sppbe='@json($sppbe)'
                                                data-sa='@json($sa)' data-count="{{ $sas->count() }}">
                                                @if ($loop->first)
                                                    <td rowspan="{{ $sas->count() ?: 1 }}" class="text-center"
                                                        style="vertical-align: middle">{{ $sppbe_index+1 }}</td>
                                                    <td rowspan="{{ $sas->count() ?: 1 }}" style="vertical-align: middle">
                                                        <a href="{{ route('sppbe.edit', $sppbe) }}" data-toggle="tooltip"
                                                            title=""
                                                            data-original-title="{{ $sppbe->nama }}">{{ $sppbe->kode }}</a>
                                                    </td>
                                                @endif

                                                <td class="no-sa {{ $sppbe->kode }}"
                                                    style="cursor: pointer; position: relative;">
                                                    <div class="{{ $sa?->tipe }} {{ $sa?->tipe == 'tambahan' ? 'text-danger' : '' }}"
                                                        style="margin-right:56px" data-toggle="tooltip" title=""
                                                        data-original-title="Ubah">
                                                        {{ $sa?->no_sa ?? '..........' }}
                                                    </div>
                                                    @if ($sas->count())
                                                        <div class="btn-action">
                                                            <button class="btn btn-link add-sa d-block"
                                                                data-toggle="tooltip" title=""
                                                                data-original-title="Tambah"><span class="btn-label"><i
                                                                        class="la la-plus"></span></i></button>
                                                            <button class="btn btn-link text-danger delete-sa d-block"
                                                                data-toggle="tooltip" title=""
                                                                data-original-title="Hapus"><span class="btn-label"><i
                                                                        class="la la-trash"></span></i></button>

                                                        </div>
                                                    @endif


                                                </td>
                                                @foreach ($week as $day)
                                                    @php
                                                        $kuotaHarian = $sa?->kuotaHarians->where('tanggal', $kitir->bulan_tahun . '-' . str_pad($day, 2, '0', STR_PAD_LEFT))->first();
                                                    @endphp
                                                    <td class="text-right  {{ $day == null ? 'bg-light' : 'kuota' }}"
                                                        style="position:relative; {{ $day != null ? 'cursor:pointer' : '' }}"
                                                        data-tanggal="{{ $kitir->bulan_tahun . '-' . str_pad($day, 2, '0', STR_PAD_LEFT) }}"
                                                        data-id="{{ $kuotaHarian?->id }}"
                                                        data-selector="{{ $sa?->id }}-{{ $day }}">
                                                        @if ($day != null)
                                                            <div class="kuota-val" style="margin-right:24px"
                                                                data-toggle="tooltip" title=""
                                                                data-original-title="Ubah">
                                                                {{ $kuotaHarian?->kuota ?? '.....' }}</div>

                                                            <div class="btn-action btn-kuota">
                                                                <button class="btn  btn-link text-danger delete-kuota"
                                                                    data-toggle="tooltip" title=""
                                                                    data-original-title="Hapus"><span class="btn-label"><i
                                                                            class="la la-trash"></span></i></button>
                                                            </div>
                                                        @endif
                                                    </td>
                                                @endforeach
                                                @if ($week_index + 1 == count($weeks))
                                                    <td class="text-right subtotal">
                                                        {{-- {{ $kitir->kuotaHarians->where('sa_id', $sa?->id)->sum('kuota') }} --}}
                                                    </td>
                                                @endif

                                            </tr>
                                        @empty
                                            <tr data-sppbe='@json($sppbe)' data-sa='' data-count="">
                                                <td class="text-center" style="vertical-align: middle">
                                                    {{ $loop->iteration }}</td>
                                                <td style="vertical-align: middle">
                                                    <a href="{{ route('sppbe.edit', $sppbe) }}" data-toggle="tooltip"
                                                        title=""
                                                        data-original-title="{{ $sppbe->nama }}">{{ $sppbe->kode }}</a>
                                                </td>

                                                <td class="no-sa {{ $sppbe->kode }}"
                                                    style="cursor: pointer; position: relative;">
                                                    <div class="" style="margin-right:56px" data-toggle="tooltip"
                                                        title="" data-original-title="Ubah">
                                                        ..........
                                                    </div>
                                                    @if ($sas->count())
                                                        <div class="btn-action">
                                                            <button class="btn btn-link add-sa d-block"
                                                                data-toggle="tooltip" title=""
                                                                data-original-title="Tambah"><span class="btn-label"><i
                                                                        class="la la-plus"></span></i></button>
                                                            <button class="btn btn-link text-danger delete-sa d-block"
                                                                data-toggle="tooltip" title=""
                                                                data-original-title="Hapus"><span class="btn-label"><i
                                                                        class="la la-trash"></span></i></button>

                                                        </div>
                                                    @endif


                                                </td>
                                                @foreach ($week as $day)
                                                    <td class="text-right  {{ $day == null ? 'bg-light' : 'kuota' }}"
                                                        style="position:relative; {{ $day != null ? 'cursor:pointer' : '' }}"
                                                        data-tanggal="{{ $kitir->bulan_tahun . '-' . str_pad($day, 2, '0', STR_PAD_LEFT) }}"
                                                        data-id="" data-selector="">
                                                        @if ($day != null)
                                                            <div class="kuota-val" style="margin-right:24px"
                                                                data-toggle="tooltip" title=""
                                                                data-original-title="Ubah">.....</div>

                                                            <div class="btn-action btn-kuota">
                                                                <button class="btn  btn-link text-danger delete-kuota"
                                                                    data-toggle="tooltip" title=""
                                                                    data-original-title="Hapus"><span class="btn-label"><i
                                                                            class="la la-trash"></span></i></button>
                                                            </div>
                                                        @endif
                                                    </td>
                                                @endforeach
                                                @if ($week_index + 1 == count($weeks))
                                                    <td class="text-right subtotal">
                                                        {{-- {{ $kitir->kuotaHarians->where('sa_id', $sa?->id)->sum('kuota') }} --}}
                                                    </td>
                                                @endif

                                            </tr>
                                        @endforelse
                                    @endforeach

                                    <tr class="tfoot">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        @foreach ($week as $day)
                                            <td class="text-right {{ $day == null ? 'bg-light' : '' }}">
                                                @if ($day != null)
                                                    <div style="margin-right:24px">
                                                        <span class="kuota-val"></span>
                                                        {{-- {{ $kitir->kuotaHarians->where('tanggal', $kitir->bulan_tahun . '-' . str_pad($day, 2, '0', STR_PAD_LEFT))->sum('kuota') }} --}}
                                                    </div>
                                                @endif
                                            </td>
                                        @endforeach
                                        @if ($week_index + 1 == count($weeks))
                                            <td class="text-right subtotal">
                                                {{-- {{ $kitir->kuotaHarians->sum('kuota') }} --}}
                                            </td>
                                        @endif
                                    </tr>
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
                        <div class="form-group">
                            <label>No. SA <span class="text-capitalize">reguler</span></label>
                            <input type="number" class="form-control" name="no_sa" placeholder="Masukkan No. SA"
                                required>
                            <div class="feedback"></div>
                        </div>
                        {{-- <div class="form-group mb-3">
                            <label>Tipe </label>
                            <select name="tipe" class="form-control">
                                <option value="reguler">Reguler</option>
                                <option value="tambahan">Tambahan</option>
                            </select>
                        </div> --}}

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

                if (sa.tipe == 'tambahan') {
                    $('#modalNoSA label').addClass('text-danger')
                }
                else{
                    $('#modalNoSA label').removeClass('text-danger')
                }
                $('#modalNoSA input').val($(this).text().trim())

            })


            $('.add-sa').on('click', function(e) {
                e.stopPropagation()

                let sa = $(this).closest('tr').data('sa')
                let sppbe = $(this).closest('tr').data('sppbe')

                let reguler = $(`.no-sa.${sppbe.kode}>.reguler`, this.closest('table')).length

                let tipe = 'reguler'
                if (reguler == 1) {
                    tipe = 'tambahan'
                }

                $('#modalNoSA').modal('show')
                $('#modalNoSA').data('sppbe', sppbe)
                $('#modalNoSA .modal-title').text(sppbe.kode +
                    ' (' + bulan + ' )')
                $('#modalNoSA label span').text(tipe)
                if (tipe == 'tambahan') {
                    $('#modalNoSA label').addClass('text-danger')
                }
                else{
                    $('#modalNoSA label').removeClass('text-danger')
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
                        toastr.success(
                            response.message,
                            'Success', {
                                timeOut: 1000,
                                fadeOut: 1000,
                                onHidden: function() {
                                    window.location.reload();
                                }
                            }
                        );

                    },
                    error: function(jqXHR) {
                        if (jqXHR.status == 419) {
                            $('#modalNoSA').modal('hide')
                            swal.fire({
                                title: 'Session Expired',
                                text: 'Silahkan login kembali!',
                                icon: 'warning',
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
                    title: 'Anda yakin ingin menghapus ini?',
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
                                toastr.success(
                                    response.message,
                                    'Success', {
                                        timeOut: 1000,
                                        fadeOut: 1000,
                                        onHidden: function() {
                                            window.location.reload();
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


            // KUOTA

            $('.kuota').on('click', function() {
                let sa = $(this).parent().data('sa')
                let sppbe = $(this).parent().data('sppbe')
                let id = $(this).data('id')
                let tanggal = $(this).data('tanggal')

                let selector = $(this).data('selector')

                if (sa) {
                    $('#modalKuota').modal('show')
                    $('#modalKuota').data('sa-id', sa.id)
                    $('#modalKuota').data('id', id)
                    $('#modalKuota').data('tanggal', tanggal)
                    $('#modalKuota').data('selector', selector)
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

                let selector = $('#modalKuota').data('selector')

                let id = $('#modalKuota').data('id')
                let url = window.location.origin + '/kuota-harian/'
                let tanggal = $('#modalKuota').data('tanggal')
                let kuota = $('#modalKuota input').val()
                let sa_id = $('#modalKuota').data('sa-id')
                let type = 'POST'

                if (id != '') {
                    url += id
                    type = 'PUT'
                }

                $.ajax({
                    url: url,
                    type: type,
                    data: {
                        sa_id: sa_id,
                        kuota: kuota,
                        tanggal: tanggal
                    },
                    success: function(response) {
                        $('#modalKuota').modal('hide')

                        toastr.success(
                            response.message,
                            'Success'
                        );

                        $(`[data-selector=${selector}] .kuota-val`).text(kuota)
                        $(`[data-selector=${selector}]`).data('id', response.id)
                        updateTotal()

                    },
                    error: function(jqXHR) {
                        if (jqXHR.status == 419) {
                            $('#modalKuota').modal('hide')
                            swal.fire({
                                title: 'Session Expired',
                                text: 'Silahkan login kembali!',
                                icon: 'warning',
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

                let selector = $(this).closest('.kuota').data('selector')

                let id = $(this).parent().parent().data('id')
                $.ajax({
                    url: window.location.origin + '/kuota-harian/' + id,
                    type: 'delete',
                    success: function(response) {

                        toastr.success(
                            response.message,
                            'Success'
                        );
                        $(`[data-selector=${selector}] .kuota-val`).text('.....')
                        $(`[data-selector=${selector}]`).data('id', '')
                        updateTotal()

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


            })


            function updateTotal() {
                $('table').each(function(indexTable, table) {
                    $('table:eq(1) tr:eq(1) .kuota-val').each(function(i) {
                        let total = 0;
                        $('tr:gt(0)', table).each(function() {
                            $('.kuota-val', this).each(function(j) {
                                if (j == i) {
                                    if (!$(this).closest('tr').is(':last-child')) {
                                        if (!isNaN(parseInt(this.innerText))) {
                                            total += parseInt(this.innerText)
                                        }
                                    } else {
                                        this.innerText = total
                                    }
                                }
                            })
                        })

                    });
                })


                $('table:first tr:gt(0)').each(function(index) {
                    let total = 0
                    $('table').each(function(indexTable, table) {
                        $('tr:gt(0)', table).each(function(indexTr, tr) {
                            if (indexTr == index) {
                                $('.kuota-val', tr).each(function() {
                                    if (!isNaN(parseInt(this.innerText))) {
                                        total += parseInt(this.innerText)
                                    }
                                })
                                if ($(table).is(':last-child')) {
                                    $('.subtotal', tr).text(total)
                                }

                            }

                        })

                    })
                })

                $('.btn-kuota').each(function() {
                    if (isNaN(parseInt(this.parentElement.innerText))) {
                        $('.delete-kuota', this).hide()
                    } else {
                        $('.delete-kuota', this).show()
                    }
                })
            }


            updateTotal()

        })
    </script>
@endpush

@push('style')
    <style>
        /* .tb-striped tbody:nth-child(even) {
                                                                                                                                                    background-color: #b7dfff;
                                                                                                                                                }

                                                                                                                                                .tb-striped tbody:nth-child(odd) {
                                                                                                                                                    background-color: #ffbdfc;
                                                                                                                                                }

                                                                                                                                                .tb-striped tr:nth-child(even) {
                                                                                                                                                    background-color: #fffc5d;
                                                                                                                                                } */



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

        .tfoot,
        .subtotal {
            font-weight: bold
        }
    </style>
@endpush
