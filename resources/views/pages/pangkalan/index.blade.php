@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <h4 class="page-title">Pangkalan</h4>
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
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        
                                        <th class="text-center" style="width: 40px">No.</th>
                                        <th>Nama</th>
                                        <th>No. Reg.</th>
                                        <th>Kuota</th>
                                        <th style="width: 200px">Alamat</th>
                                        <th style="width: 100px">Aksi</th>
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
                                                <div class="dropdown">
                                                    <button class="btn btn-sm dropdown-toggle" type="button"
                                                        data-toggle="dropdown">
                                                        Aksi
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" role="menu"
                                                        aria-labelledby="dropdownMenu">

                                                        <a class="dropdown-item edit-pangkalan"
                                                            href="{{ route('pangkalan.edit', $pangkalan) }}"><i
                                                                class="la la-edit mr-1"></i>Edit</a>
                                                        {{-- <a class="dropdown-item"
                                                            href="{{ route('pangkalan.print', $pangkalan) }}"><i
                                                                class="la la-print mr-1"></i>Print</a>
                                                        <div class="dropdown-divider"></div> --}}
                                                        <a class="dropdown-item delete-pangkalan text-danger" href="#"
                                                            data-pangkalan='@json($pangkalan)'><i
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
            $('body').on('click', '.delete-pangkalan', function(e) {
                e.stopPropagation()
                swal.fire({
                    title: 'Apakah anda yakin?',
                    text: $(this).data('pangkalan').nama,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batalkan'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let id = $(this).data('pangkalan').id
                        $.ajax({
                            url: window.location.origin + '/pangkalan/' + id,
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
        })
    </script>
@endpush
