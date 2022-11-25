@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <h4 class="page-title">Truk</h4>
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
                    <a href="#">Armada</a>
                </li>
                <li class="separator">
                    <i class="la la-angle-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Truk</a>
                </li>
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
                <a href="{{ route('armada.truk.create') }}" class="btn btn-primary">
                    <span class="btn-label"><i class="la la-plus mr-1"></i></span>
                    Tambah Truk
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
                                        <th>Kode</th>
                                        <th>Plat Nomor</th>
                                    <th>Merk / Type</th>
                                        <th>Sopir</th>
                                        <th>Kernet</th>
                                        <th style="width: 100px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($truks as $truk)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $truk->kode }}</td>
                                            <td>{{ $truk->plat_nomor }}</td>
                                            <td>{{ $truk->merk }}</td>
                                            <td>{{ $truk->sopir->nama }}</td>
                                            <td>{{ $truk->kernet->nama }}</td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-sm dropdown-toggle" type="button"
                                                        data-toggle="dropdown">
                                                        Aksi
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" role="menu"
                                                        aria-labelledby="dropdownMenu">

                                                        <a class="dropdown-item edit-truk"
                                                            href="{{ route('armada.truk.edit', $truk) }}"><i
                                                                class="la la-edit mr-1"></i>Edit</a>
                                                        {{-- <a class="dropdown-item"
                                                            href="{{ route('armada.truk.print', $truk) }}"><i
                                                                class="la la-print mr-1"></i>Print</a>
                                                        <div class="dropdown-divider"></div> --}}
                                                        <a class="dropdown-item delete-truk text-danger" href="#"
                                                            data-truk='@json($truk)'><i
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
            $('body').on('click', '.delete-truk', function(e) {
                e.stopPropagation()
                swal.fire({
                    title: 'Apakah anda yakin?',
                    text: $(this).data('truk').kode,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batalkan'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let id = $(this).data('truk').id
                        $.ajax({
                            url: window.location.origin + '/truk/' + id,
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
