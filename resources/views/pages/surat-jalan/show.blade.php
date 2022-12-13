@extends('layouts.app', ['title' => 'Detail Surat Jalan'])

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <h4 class="page-title">Detail Surat Jalan</h4>
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
                    <a href="{{ route('surat-jalan.index') }}">Surat Jalan</a>
                </li>
                <li class="separator">
                    <i class="la la-angle-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Detail</a>
                </li>
            </ul>
            <div class="ml-auto">

                <a href="{{ route('surat-jalan.print', $pengambilan) }}" target="_blank" class="btn btn-secondary mr-2">
                    <span class="btn-label"><i class="la la-print mr-1"></i></span>
                    Print
                </a>

                <a href="{{ route('surat-jalan.edit', $pengambilan) }}" class="btn btn-primary">
                    <span class="btn-label"><i class="la la-edit mr-1"></i></span>
                    Edit
                </a>

            </div>

        </div>
        <div class="row">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-body">
                        <div class="tab-content" id="v-pills-without-border-tabContent">
                            <div class="tab-pane fade show active" id="pengambilan-nobd" role="tabpanel"
                                aria-labelledby="pengambilan-tab-nobd">
                                <x-surat-pengambilan :pengambilan="$pengambilan" />
                            </div>
                            @if ($pengambilan->penukarans->count())
                                <div class="tab-pane fade" id="penukaran-nobd" role="tabpanel"
                                    aria-labelledby="penukaran-tab-nobd">
                                    <x-surat-penukaran :pengambilan="$pengambilan" />
                                </div>
                            @endif

                            <div class="tab-pane fade" id="penyaluran-nobd" role="tabpanel"
                                aria-labelledby="penyaluran-tab-nobd">

                                <x-surat-penyaluran :pengambilan="$pengambilan" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Surat Jalan</h4>
                    </div>
                    <div class="card-body">
                        <div class="nav flex-column nav-pills nav-primary nav-pills-no-bd" id="v-pills-tab-without-border"
                            role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="pengambilan-tab-nobd" data-toggle="pill"
                                href="#pengambilan-nobd" role="tab" aria-controls="pengambilan-nobd"
                                aria-selected="true">Pengambilan</a>
                            @if ($pengambilan->penukarans->count())
                                <a class="nav-link" id="penukaran-tab-nobd" data-toggle="pill" href="#penukaran-nobd"
                                    role="tab" aria-controls="penukaran-nobd" aria-selected="false">Penukaran</a>
                            @endif
                            <a class="nav-link" id="penyaluran-tab-nobd" data-toggle="pill" href="#penyaluran-nobd"
                                role="tab" aria-controls="penyaluran-nobd" aria-selected="false">Penyaluran</a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection



@push('style')
    <style>
        .bg-lightgray {
            background-color: lightgray;
        }

        .surat-penyaluran,
        .surat-penyaluran p {
            font-size: .6rem;
        }

        .surat-penyaluran table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid;

        }

        .surat-penyaluran table th,
        .surat-penyaluran table td {
            padding: 4px;
            border: 1px solid;
        }

        .surat-penyaluran .header {
            line-height: 1.2rem;
            text-align: center;
            border-bottom: 3px solid;
            margin-bottom: .8rem;
            padding-bottom: .5rem;
            font-weight: bold
        }

        .checkmark {
            font-family: Verdana, Tahoma, "DejaVu Sans", sans-serif;
        }
    </style>
@endpush
