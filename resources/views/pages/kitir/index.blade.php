@extends('layouts.app', ['title' => 'Kitir'])

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <h4 class="page-title">Kitir Bulanan</h4>
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
                    <a href="#">Kitir Bulanan</a>
                </li>
            </ul>
            <div class="ml-auto">
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
                <button class="btn btn-primary add-kitir">
                    <span class="btn-label"><i class="la la-plus mr-1"></i></span>
                    Tambah Kitir
                </button>
            </div>


        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tbKitir" class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 40px">No.</th>
                                        <th>Bulan</th>
                                        <th class="text-center" style="width: 80px">Total</th>
                                        <th class="text-center" style="width: 80px">Hari Kerja</th>
                                        <th class="text-center" style="width: 120px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kitirs as $kitir)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-uppercase">{{ bulan($kitir->bulan_tahun) }}</td>
                                            <td class="text-center number">{{ $kitir->kuotaHarians->sum('kuota') }}</td>
                                            <td class="text-center">{{ $kitir->kuotaHarians->groupBy('tanggal')->count() }}
                                            </td>
                                          
                                            <td class="text-center">
                              
                                                
                                                    <a href="{{ route('kitir.edit', $kitir) }}" data-toggle="tooltip"
                                                        title="" class="btn btn-link btn-primary px-2"
                                                        data-original-title="Edit"><span class="btn-label"><i class="la la-edit"></i></span>
                                                        
                                                    </a>
                                                    <a href="{{ route('kitir.print', $kitir) }}" target="_blank" data-toggle="tooltip"
                                                        title="" class="btn btn-link btn-secondary px-2"
                                                        data-original-title="Cetak"><span class="btn-label"><i class="la la-print"></i></span>
                                                        
                                                    </a>
                                                    <button type="button" data-toggle="tooltip" title=""
                                                        class="btn btn-link btn-danger delete-kitir px-2"
                                                        data-id="{{ $kitir->bulan_tahun }}" data-original-title="Hapus">
                                                        <span class="btn-label"><i class="la la-trash"></i></span>
                                                    </button>
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

    <div class="modal fade" id="modalKitir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form class="needs-validation" novalidate>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Kitir Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Bulan</label>
                            <input type="month" class="form-control" name="bulan_tahun" min="2020-01" max="2030-12"
                                name="datepicker" id="datepicker" />
                            <div class="feedback"></div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            {{-- <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button> --}}
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
            $('.add-kitir').on('click', function() {
                $('#modalKitir').modal('show')
            })

            $('#modalKitir form').on('submit', function(e) {
                e.preventDefault()
                $('#modalKitir button[type=submit]').prop('disabled', true).text(
                    'Menyimpan...')
                let bulan_tahun = $('input[name="bulan_tahun"]').val()
                $.ajax({
                    url: window.location.origin + '/kitir',
                    type: 'POST',
                    data: {
                        bulan_tahun: bulan_tahun
                    },
                    success: function(response) {
                        $('#modalKitir').modal('hide')
                        toastr.success(
                            response.message,
                            'Success', {
                                timeOut: 1000,
                                fadeOut: 1000,
                                onHidden: function() {
                                    window.location.href = window.location.origin +
                                        '/kitir/' +
                                        bulan_tahun + '/edit';
                                }
                            }
                        );
                    },
                    error: function(jqXHR) {
                        if (jqXHR.status == 419) {
                            $('#modalKitir').modal('hide')
                            swal.fire({
                                title: 'Session Expired',
                                text: 'Silahkan login kembali!',
                                icon: 'warning',
                            })
                        }
                        $('#modalKitir .feedback').addClass('invalid-feedback').text(jqXHR
                            .responseJSON.message)
                        $('#modalKitir input').addClass('is-invalid')
                    },
                    complete: function() {
                        $('#modalKitir button[type=submit]').prop('disabled', false).text(
                            'Simpan')

                    }
                })
            })

            $('body').on('click', '.delete-kitir', function(e) {
                e.preventDefault()
                swal.fire({
                    title: 'Anda yakin ingin menghapus ini?',
                    text: 'Bulan : ' + new Date(this.dataset.id + '-01').toLocaleDateString(
                        'id-ID', {
                            year: 'numeric',
                            month: 'long'
                        }),
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batalkan'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let id = $(this).data('id')
                        $.ajax({
                            url: window.location.origin + '/kitir/' + id,
                            type: 'delete',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
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

            tableExport('#tbKitir', [0, 1, 2, 3])
        })
    </script>
@endpush
