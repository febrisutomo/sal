@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kitir Bulanan</h1>
                </div>
                <div class="col-sm-6 d-flex justify-content-end">
                    <form action="{{ route('kitir.index') }}">
                        <input type="month" class="form-control" name="bulan" min="2020-01" max="2030-12"
                            name="datepicker" id="datepicker" style="width: 200px" value="{{ $bulan }}" />
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid pb-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title card-sa"></h4>
                </div>
                <div class="card-body">
                    @foreach ($dates as $weeks)
                        @php
                            $last = $loop->last;
                        @endphp
                        <table class="table table-bordered table-sm mb-3"
                            style="width: fit-content">
                            <thead>
                                <tr>
                                    <th class="bg-primary text-center" style="width: 40px">No.</th>
                                    <th class="bg-primary text-center" style="width: 80px">SPPBE</th>
                                    <th class="bg-primary text-center" style="width: 120px">No. SA</th>
                                    @foreach ($weeks as $day)
                                        <th class="text-center  {{ $day == null ? 'bg-secondary' : 'bg-primary' }} {{ $loop->first && $day != null ? 'bg-danger' : '' }} "
                                            style="width: 80px;">{{ $day }}</th>
                                    @endforeach
                                    @if ($last)
                                        <th class="bg-primary text-center" style="width: 80px">Total</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sppbes as $sppbe)
                                    @php
                                        $sa = $sas->where('sppbe_id', $sppbe->id)->sortBy('tipe');
                                    @endphp
                                    <tr data-sppbe='@json($sppbe)' data-sa='@json($sa->first())'
                                        data-count="{{ $sa->count() }}">
                                        <td rowspan="{{ $sa->count() ?: 1 }}" class="text-center"
                                            style="vertical-align: middle">{{ $loop->iteration }}</td>
                                        <td rowspan="{{ $sa->count() ?: 1 }}" class="text-center"
                                            style="vertical-align: middle">
                                            {{ $sppbe->kode }}</td>
                                        <td class="text-center no-sa" style="cursor: pointer; position: relative;">
                                            @if ($sa->count())
                                                <div class="{{ $sa->first()->tipe == 'tambahan' ? 'text-danger' : '' }}">
                                                    {{ $sa->first()->no_sa }}
                                                </div>
                                                <div class="btn-action">
                                                    <button class="btn btn-sm btn-danger delete-sa d-block"
                                                        title="hapus"><i class="fas fa-trash"></i></button>
                                                    @if ($sa->count() == 1)
                                                        <button class="btn btn-sm btn-primary add-sa d-block"
                                                            title="tambah"><i class="fas fa-plus"></i></button>
                                                    @endif
                                                </div>
                                            @endif

                                        </td>
                                        @foreach ($weeks as $day)
                                            @php
                                                $kitir = $sa
                                                    ->first()
                                                    ?->kitirs->where('tanggal', $bulan . '-' . str_pad($day, 2, '0', STR_PAD_LEFT))
                                                    ->first();
                                            @endphp
                                            <td class="text-center  {{ $day == null ? 'bg-light' : '' }} {{ $day != null && $loop->iteration != 1 ? 'kuota' : '' }}"
                                                style="width: 100px; position:relative; {{ $day != null && $loop->iteration != 1 ? 'cursor:pointer' : '' }}"
                                                data-tanggal="{{ $bulan . '-' . $day }}"
                                                data-kitir='@json($kitir)'>
                                                {{ $kitir?->kuota }}
                                                @if ($kitir)
                                                    <div class="btn-action">
                                                        <button class="btn btn-sm btn-danger delete-kuota" title="hapus"><i
                                                                class="fas fa-trash"></i></button>
                                                    </div>
                                                @endif
                                            </td>
                                        @endforeach
                                        @if ($last)
                                            <td class="text-center subtotal">
                                                {{ $kitirs->where('sa_id', $sa->first()?->id)->sum('kuota') }}</td>
                                        @endif

                                    </tr>
                                    @if ($sa->count() > 1)
                                        <tr data-sppbe='@json($sppbe)' data-sa='@json($sa->last())'
                                            data-count="{{ $sa->count() }}">
                                            <td class="text-center no-sa" style="cursor: pointer; position: relative;">
                                                @if ($sa->count())
                                                    <div
                                                        class="{{ $sa->last()->tipe == 'tambahan' ? 'text-danger' : '' }}">
                                                        {{ $sa->last()->no_sa }}
                                                    </div>
                                                    <div class="btn-action">
                                                        <button class="btn btn-sm btn-danger delete-sa d-block"
                                                            title="hapus"><i class="fas fa-trash"></i></button>
                                                        @if ($sa->count() == 1)
                                                            <button class="btn btn-sm btn-primary add-sa d-block"
                                                                title="tambah"><i class="fas fa-plus"></i></button>
                                                        @endif
                                                    </div>
                                                @endif

                                            </td>
                                            @foreach ($weeks as $day)
                                                @php
                                                    $kitir = $sa
                                                        ->last()
                                                        ?->kitirs->where('tanggal', $bulan . '-' . str_pad($day, 2, '0', STR_PAD_LEFT))
                                                        ->last();
                                                @endphp
                                                <td class="text-center  {{ $day == null ? 'bg-light' : '' }} {{ $day != null && $loop->iteration != 1 ? 'kuota' : '' }} "
                                                    style="width: 100px; position:relative; {{ $day != null && $loop->iteration != 1 ? 'cursor:pointer' : '' }}"
                                                    data-tanggal="{{ $bulan . '-' . $day }}"
                                                    data-kitir='@json($kitir)'>
                                                    {{ $kitir?->kuota }}
                                                    @if ($kitir)
                                                        <div class="btn-action">
                                                            <button class="btn btn-sm btn-danger delete-kuota"
                                                                title="hapus"><i class="fas fa-trash"></i></button>
                                                        </div>
                                                    @endif
                                                </td>
                                            @endforeach
                                            @if ($last)
                                                <td class="text-center">
                                                    {{ $kitirs->where('sa_id', $sa->last()?->id)->sum('kuota') }}</td>
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3">
                                    </td>
                                    @foreach ($weeks as $day)
                                        <td class="text-center {{ $day == null ? 'bg-light' : '' }}">
                                            @if ($day != null && $loop->iteration != 1)
                                                {{ $kitirs->where('tanggal', $bulan . '-' . str_pad($day, 2, '0', STR_PAD_LEFT))->sum('kuota') }}
                                            @endif
                                        </td>
                                    @endforeach
                                    @if ($last)
                                        <th class="text-center total"></th>
                                    @endif
                                </tr>
                            </tfoot>
                        </table>
                    @endforeach

                    {{-- <table class="table table-bordered " style="width: fit-content">
                        <thead>
                            <tr>
                                <th class="bg-primary text-center" style="width: 40px">No.</th>
                                <th class="bg-primary text-center" style="width: 80px">SPPBE</th>
                                <th class="bg-primary text-center" style="width: 80px">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sppbes as $sppbe)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $sppbe->kode }}</td>
                                    <td class="text-center">100</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table> --}}

                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modalNoSA" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">KMSU (10-2022)</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>No. SA <span class="text-capitalize">reguler</span></label>
                            <input type="number" class="form-control" name="no_sa" placeholder="No. SA" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
                <form action="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">KMSU (10-2022)</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kuota <span class="text-capitalize">reguler</span></label>
                            <input type="number" class="form-control" name="kuota" placeholder="Kuota" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('input[name=bulan]').on('change', function() {
                $(this).closest('form').submit()
            })

            let bulan = $('input[name=bulan]').val()
            bulan = new Date(bulan + '-01').toLocaleDateString('id-ID', {
                year: 'numeric',
                month: 'long'
            })
            $('.card-sa').text('SA ' + bulan)


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
                    ' (' + $(
                        'input[name=bulan]').val() + ' )')
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

                let id = $('#modalNoSA').data('id')
                let url = 'sa/'
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
                        bulan_tahun: $('input[name=bulan').val() + '-01',
                        sppbe_id: $('#modalNoSA').data('sppbe').id,
                        no_sa: $('#modalNoSA input').val(),
                        tipe: $('#modalNoSA label span').text(),
                    },
                    success: function(response) {
                        $('#modalNoSA').modal('hide')
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            location.reload()
                        })

                    },
                    error: function(jqXHR) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: jqXHR.responseJSON.message,
                        })
                    }
                })
            })



            $('.delete-sa').on('click', function(e) {
                e.stopPropagation()
                Swal.fire({
                    title: 'Anda yakin ingin menghapus No. SA ini?',
                    text: 'No. SA : ' + $(this).closest('tr').data('sa').no_sa,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batalkan'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let id = $(this).closest('tr').data('sa').id
                        $.ajax({
                            url: 'sa/' + id,
                            type: 'delete',
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
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
                    Swal.fire({
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

                let id = $('#modalKuota').data('id')
                let url = 'kitir/'
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
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            location.reload()
                        })

                    },
                    error: function(jqXHR) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: jqXHR.responseJSON.message,
                        })
                    }
                })

            })

            $('.delete-kuota').on('click', function(e) {
                e.stopPropagation()
                let id = $(this).parent().parent().data('kitir').id
                $.ajax({
                    url: 'kitir/' + id,
                    type: 'delete',
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            location.reload()
                        })
                    }
                })


            })

           
            let total = 0
            $('.subtotal').each(function(){
                total += parseInt(this.innerText)
            })
            $('.total').text(total)


        })
    </script>
@endpush

@push('style')
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        /* th,
                                                                td {
                                                                    padding: 6px 12px !important;
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
            display: block;
        }

        .btn-sm {
            font-size: 10px;
        }
    </style>
@endpush
