@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Buat Kitir Bulanan</h1>
                </div>
                <div class="col-sm-6 d-flex justify-content-end">
                    <form action="{{ route('kitir.index') }}">
                        <input type="month" class="form-control" name="month" min="2020-01" max="2030-12"
                            name="datepicker" id="datepicker" style="width: 200px" value="{{ $month }}" />
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid pb-3">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">

                            <h4 class="card-title card-sa">SA Oktober 2022</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No. SA</th>
                                        <th>SPPBE</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>123456</td>
                                        <td>KMSU</td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="100%">
                                            <button class="btn btn-sm btn-primary">Tambah</button>

                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            {{-- @foreach ($sppbes as $sppbe)
                                <div class="form-group">
                                    <label>{{ $sppbe->kode }}</label>
                                    <input type="text" class="form-control no-sa" name="{{ $sppbe->kode }}" readonly>
                                </div>
                            @endforeach --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body pt-0">
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modal-sa">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah SA</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input name="id" type="hidden">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal">
                    </div>
                    <div class="form-group">
                        <label for="sppbe_id">SPPBE</label>
                        <select type="text" class="form-control" id="sppbe_id" name="sppbe_id">
                            <option value="">Pilih SPBE</option>
                            @foreach ($sppbes as $sppbe)
                                <option value="{{ $sppbe->id }}">{{ $sppbe->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="form-group">
                        <label for="tipe">Tipe</label>
                        <select class="form-control" name="tipe" id="tipe">
                            <option value="reguler">Reguler</option>
                            <option value="tambahan">Tambahan</option>
                        </select>
                    </div> --}}
                    <div class="form-group">
                        <label for="no_sa">No. SA</label>
                        <select type="text" class="form-control" id="no_sa" name="no_sa">
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="kuota">Kuota</label>
                        <input type="text" class="form-control" id="kuota" name="kuota">
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-danger btn-delete" hidden>Hapus</button>
                    <button type="button" class="btn btn-primary btn-update" hidden>Update</button>
                    <button type="button" class="btn btn-primary btn-store">Tambahkan</button>
                </div>
            </div>

        </div>

    </div>
    @endsection @push('script')
    <script>
        $(document).ready(function() {

            // $('.edit-sa').on('click', function() {
            //     var bol = $('.no-sa').attr('readonly')
            //     $('.no-sa').attr('readonly', !bol)
            //     $(this).text(bol ? 'Simpan' : 'Edit')
            // })

            $('input[name=month]').on('change', function() {
                $(this).closest('form').submit()
            })


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            const kitirs = @json($kitirs);
            let events = []
            kitirs.forEach(el => {
                events.push({
                    id: el.id,
                    title: el.sa.sppbe.kode + ' (' + el.kuota + ')',
                    start: new Date(el.tanggal).toLocaleDateString('en-CA'),
                    color: el.sa.tipe == 'reguler' ? '#0073b7' : '#f56954',
                    extendedProps: {
                        sa: el.sa,
                        kuota: el.kuota,
                    },
                })
            });
            let calendarEl = document.getElementById('calendar');
            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id',
                initialDate: '{{ $month }}',
                themeSystem: 'bootstrap',
                headerToolbar: {
                    start: 'title', // will normally be on the left. if RTL, will be on the right
                    center: '',
                    end: '' // will normally be on the right. if RTL, will be on the left
                },
                showNonCurrentDates: false,
                events: events,

                eventClick: function(info) {
                    let data = info.event.extendedProps;
                    $('#modal-sa').modal('show')
                    $('#modal-sa .modal-title').text('Ubah SA')
                    $('#modal-sa .btn-delete').attr('hidden', false)
                    $('#modal-sa .btn-update').attr('hidden', false)
                    $('#modal-sa .btn-store').attr('hidden', true)
                    $('input[name=id]').val(info.event.id)
                    $('select[name=sppbe_id]').val(data.sa.sppbe.id)
                    $('input[name=tanggal]').val(moment(info.event.start).format('YYYY-MM-DD'))
                    $('input[name=kuota]').val(data.kuota)


                    function getSA() {
                        let tanggal = $('input[name=tanggal]').val()
                        let id = $('select[name=sppbe_id]').val()
                        $.ajax({
                            url: 'kitir/get-sa/',
                            type: 'POST',
                            data: {
                                sppbe_id: id,
                                bulan: moment(tanggal).month() + 1,
                                tahun: moment(tanggal).year(),
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.success) {
                                    let options = ``
                                    $.each(response.data, function(key, value) {
                                        options +=
                                            `<option value="${value.no_sa}" > ${value.no_sa} (${value.tipe})</option>`
                                    })
                                    $('select[name=no_sa]').html(options)

                                }
                            },
                        })
                    }

                    getSA()

                    $('select[name=sppbe_id]').on('change', function() {
                        getSA()
                    })

                },

                selectable: true,
                select: function(info) {
                    $('#modal-sa').modal('show')
                    $('#modal-sa .modal-title').text('Tambah SA')
                    $('#modal-sa .btn-delete').attr('hidden', true)
                    $('#modal-sa .btn-update').attr('hidden', true)
                    $('#modal-sa .btn-store').attr('hidden', false)
                    $('input[name=id]').val(null)
                    $('select[name=sppbe_id]').val(null)
                    $('input[name=tanggal]').val(moment(info.start).format('YYYY-MM-DD'))
                    $('input[name=no_sa]').val(null)
                    $('select[name=tipe]').val('reguler')
                    $('input[name=kuota]').val(null)

                    $('.btn-store').on('click', function() {

                        if ($(this).attr('disabled')) {
                            return
                        }

                        $(this).attr('disabled', true).text('Processing...')
                        $.ajax({
                            url: "/kitir",
                            type: "POST",
                            data: {
                                tanggal: $('input[name=tanggal]').val(),
                                no_sa: $('input[name=no_sa]').val(),
                                sppbe_id: $('select[name=sppbe_id]').val(),
                                tipe: $('select[name=tipe]').val(),
                                kuota: $('input[name=kuota]').val()
                            }
                        }).done(function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                let data = response.data
                                calendar.addEvent({
                                    id: data.id,
                                    title: data.sppbe.kode + ' (' + data
                                        .kuota + ')',
                                    start: new Date(data.tanggal)
                                        .toLocaleDateString('en-CA'),
                                    color: data.tipe == 'reguler' ?
                                        '#0073b7' : '#f56954',
                                    extendedProps: {
                                        sppbe: data.sppbe,
                                        no_sa: data.no_sa,
                                        kuota: data.kuota,
                                        tipe: data.tipe
                                    },
                                })
                            })
                        }).fail(function(jqXHR) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: jqXHR.responseJSON.message,
                            }).then(function() {
                                $('#modal-sa').modal('show')
                            })
                        }).always(function() {
                            $('#modal-sa').modal('hide')
                            $('.btn-store').attr('disabled', false).text(
                                'Tambahkan')
                        })
                    })
                }
            });
            calendar.render();

            $('.btn-delete').on('click', function() {
                Swal.fire({
                    title: 'Anda yakin?',
                    text: "Anda tidak dapat mengembalikan ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batalkan'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let id = $('input[name=id]').val()
                        $.ajax({
                            url: "/kitir/" + id,
                            type: 'delete',
                            data: {
                                "id": id,
                            }
                        }).done(function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                var event = calendar.getEventById(id)
                                event.remove();
                            })
                        }).fail(function(jqXHR) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: jqXHR.responseJSON.message,
                            }).then(function() {
                                $('#modal-sa').modal('show')
                            });
                        }).always(function() {
                            $('#modal-sa').modal('hide')
                        })
                    }
                })
            })

            $('.btn-update').on('click', function() {
                $(this).attr('disabled', true).text('Processing...')
                let id = $('input[name=id]').val()
                $.ajax({
                    url: "/kitir/" + id,
                    type: "PUT",
                    data: {
                        tanggal: $('input[name=tanggal]').val(),
                        no_sa: $('input[name=no_sa]').val(),
                        sppbe_id: $('select[name=sppbe_id]').val(),
                        tipe: $('select[name=tipe]').val(),
                        kuota: $('input[name=kuota]').val()
                    }
                }).done(function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        calendar.getEventById(id).remove()
                        let data = response.data
                        calendar.addEvent({
                            id: data.id,
                            title: data.sppbe.kode + ' (' + data
                                .kuota + ')',
                            start: new Date(data.tanggal)
                                .toLocaleDateString('en-CA'),
                            color: data.tipe == 'reguler' ?
                                '#0073b7' : '#f56954',
                            extendedProps: {
                                sppbe: data.sppbe,
                                no_sa: data.no_sa,
                                kuota: data.kuota,
                                tipe: data.tipe
                            },
                        })
                    })
                }).fail(function(jqXHR) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: jqXHR.responseJSON.message,
                    }).then(function() {
                        $('#modal-sa').modal('show')
                    })
                }).always(function() {
                    $('.btn-update').attr('disabled', false).text(
                        'Update')
                    $('#modal-sa').modal('hide')
                })
            })

            function syncCardTitle() {
                $('.card-sa').text($('.fc-toolbar-title').text())
            }

            syncCardTitle()
            $('.fc-prev-button').on('click', function() {
                syncCardTitle()
            })
            $('.fc-next-button').on('click', function() {
                syncCardTitle()
            })

        });
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

        .select2-results__options .select2-results__option[aria-disabled="true"] {
            color: red;
        }

        .fc-day-sun {
            color: red
        }

        .fc-header-toolbar.fc-toolbar {
            margin-bottom: 0 !important;
        }
    </style>
@endpush
