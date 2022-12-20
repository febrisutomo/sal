@extends('layouts.app', ['title' => 'Kernet'])

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <h4 class="page-title">Kernet</h4>
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
                    <a href="#">Armada</a>
                </li>
                <li class="separator">
                    <i class="la la-angle-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Kernet</a>
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
                <a href="{{ route('armada.kernet.create') }}" class="btn btn-primary">
                    <span class="btn-label"><i class="la la-plus mr-1"></i></span>
                    Tambah Kernet
                </a>
            </div>


        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tbKernet" class="table table-bordered data-table">
                                <thead>
                                    <tr>

                                        <th class="text-center" style="width: 40px">No.</th>
                                        <th>Nama</th>
                                        <th>No. HP</th>
                                        <th>Alamat</th>
                                        <th style="width: 80px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kernets as $kernet)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $kernet->nama }}</td>
                                            <td>{{ $kernet->no_hp }}</td>
                                            <td>{{ $kernet->alamat }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('armada.kernet.edit', $kernet) }}" data-toggle="tooltip"
                                                    title="" class="btn btn-link btn-primary px-2"
                                                    data-original-title="Edit"><span class="btn-label"><i
                                                            class="la la-edit"></i></span>

                                                </a>
                                                <button type="button" data-toggle="tooltip" title=""
                                                    class="btn btn-link btn-danger delete-kernet px-2"
                                                    data-kernet='@json($kernet)' data-original-title="Hapus">
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
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('body').on('click', '.delete-kernet', function(e) {
                e.preventDefault()
                swal.fire({
                    title: 'Anda yakin ingin menghapus ini?',
                    text: 'Nama: ' + $(this).data('kernet').nama,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batalkan'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let id = $(this).data('kernet').id
                        $.ajax({
                            url: app_url + '/kernet/' + id,
                            type: 'delete',
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

                            },
                        })
                    }
                })
            })
            tableExport('#tbKernet')
        })
    </script>
@endpush
