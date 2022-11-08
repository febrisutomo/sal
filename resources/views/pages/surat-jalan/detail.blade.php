@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Surat Jalan</h1>
                </div>
                <div class="col-sm-6 d-flex justify-content-end">


                    <button type="button" class="btn btn-primary mr-2">
                        <i class="fas fa-print mr-2"></i>Print
                    </button>
                    <button type="button" class="btn btn-success mr-2">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </button>

                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid pb-3">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-primary">
                        {{-- <div class="card-header">
                            <h3 class="card-title">Data Surat Jalan</h3>
                        </div> --}}
                        <div class="card-body">
                            <div class="surat-pengambilan">
                                <x-kop-surat />

                                <div style="text-align: center; margin-bottom: 3rem">
                                    <b><u>SURAT PENGAMBILAN TABUNG ELPIJI 3 KG</u></b>
                                </div>

                                <p style="max-width: 50%">
                                    Kepada Yth,<br>
                                    SPBE / SP(P)BE<br>
                                    <b>{{ $pengambilan->kitir->sa->sppbe->nama }}</b><br>
                                    {{ $pengambilan->kitir->sa->sppbe->alamat }}
                                </p>

                                <p>Dengan Hormat,</p>

                                <p>Mohon bantuannya untuk pelaksanaan pengambilan tabung Elpiji 3 Kg kami sbb:</p>

                                <table style="margin-left: 1rem">
                                    <tr>
                                        <td>&bull; </td>
                                        <td>Tanggal pengambilan &nbsp;</td>
                                        <td>: {{ tanggal($pengambilan->kitir->tanggal) }}</td>
                                    </tr>
                                    <tr>
                                        <td>&bull;</td>
                                        <td>Plat No. Armada &nbsp;</td>
                                        <td>: {{ $pengambilan->armada->plat_nomor }}</td>
                                    </tr>
                                    <tr>
                                        <td>&bull;</td>
                                        <td>Nama Pengemudi &nbsp;</td>
                                        <td>: {{ $pengambilan->sopir->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>&bull;</td>
                                        <td>No. SO/ SA &nbsp;</td>
                                        <td>: {{ $pengambilan->kitir->sa->no_sa }}</td>
                                    </tr>
                                    <tr>
                                        <td>&bull;</td>
                                        <td>No. DO &nbsp;</td>
                                        <td>: ...............................</td>
                                    </tr>
                                    <tr>
                                        <td>&bull;</td>
                                        <td colspan="2">Kwitansi tabung yang diambil adalah sebagai berikut.</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>- Refill &nbsp;</td>
                                        <td>: 560 Tabung</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>- Total Pengambilan &nbsp;</td>
                                        <td>: 560 Tabung</td>
                                    </tr>
                                </table>

                                <p>Demikian kami sampaikan dan atas kerjasamanya kami ucapkan terima kasih.</p>

                                <br>
                                <div style="margin-bottom: 6rem">
                                    Banyumas, {{ tanggal($pengambilan->kitir->tanggal) }} <br>
                                    PT Serayu Agung Lestari
                                </div>

                                <table>
                                    <tr>
                                        <td>
                                            <u>DWI YULIARTO</u><br>
                                            Manager
                                        </td>
                                        <td style="width: 5rem"></td>
                                        <td>
                                            <u style="text-transform: uppercase">{{ $pengambilan->sopir->nama }}</u><br>
                                            Sopir
                                        </td>
                                    </tr>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Status</h5>
                        </div>
                        <div class="card-body">
                            
                        </div>
                    </div>
                </div>
            </div>


    </section>
@endsection

@php
    function tanggal($tanggal)
    {
        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
    
        $var = explode('-', $tanggal);
    
        return $var[2] . ' ' . $bulan[(int) $var[1]] . ' ' . $var[0];
    }
@endphp

@push('style')
    <style>
        .page-break {
            page-break-after: always;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid;
        }

        .table th,
        .table td {
            padding: 10px;
            border: 1px solid;
        }
    </style>
@endpush
