@extends('layouts.app', ['title' => 'Pangkalan'])

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <h4 class="page-title">Pangkalan</h4>
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
                    <a href="#">Pangkalan</a>
                </li>
                {{-- <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Buttons</a>
            </li> --}}
            </ul>
            <div class="ml-auto">
                <a href="{{ route('pangkalan.maps') }}" class="btn btn-success mr-2">
                    <span class="btn-label"><i class="la la-map mr-1"></i></span>
                    Peta
                </a>
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
                <a href="{{ route('pangkalan.create') }}" class="btn btn-primary">
                    <span class="btn-label"><i class="la la-plus mr-1"></i></span>
                    Tambah Pangkalan
                </a>
            </div>


        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tbPangkalan" class="table table-bordered data-table">
                                <thead>
                                    <tr>

                                        <th class="text-center" style="width: 40px">No.</th>
                                        <th>Nama</th>
                                        <th>No. Reg.</th>
                                        <th>Kuota</th>
                                        <th>Alamat</th>
                                        <th style="width: 80px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pangkalans as $pangkalan)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $pangkalan->nama }}</td>
                                            <td>{{ $pangkalan->no_reg }}</td>
                                            <td>{{ $pangkalan->kuota }}</td>
                                            <td>{{ $pangkalan->alamat }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('pangkalan.edit', $pangkalan) }}" data-toggle="tooltip"
                                                    title="" class="btn btn-link btn-primary px-2"
                                                    data-original-title="Edit"><span class="btn-label"><i
                                                            class="la la-edit"></i></span>

                                                </a>
                                                <button type="button" data-toggle="tooltip" title=""
                                                    class="btn btn-link btn-danger delete-pangkalan px-2"
                                                    data-pangkalan='@json($pangkalan)' data-original-title="Hapus">
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
            tableExport('#tbPangkalan')
            
            $('body').on('click', '.delete-pangkalan', function(e) {
                e.preventDefault()
                swal.fire({
                    title: 'Anda yakin ingin menghapus ini?',
                    text: 'Nama: ' + $(this).data('pangkalan').nama,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batalkan'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let id = $(this).data('pangkalan').id
                        $.ajax({
                            url: app_url + '/pangkalan/' + id,
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

        })
    </script>
@endpush
