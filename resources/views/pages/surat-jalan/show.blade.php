@extends('layouts.app', ['title' => 'Detail Surat Jalan'])

@section('content')

    <div class="container-fluid">
        <div class="page-header">
            <h4 class="page-title">Detail Surat Jalan</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{route('dashboard')}}">
                        <i class="la la-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="la la-angle-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{route('surat-jalan.index')}}">Surat Jalan</a>
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
                                    <x-surat :pengambilan="$pengambilan" judul="Surat Pengambilan Tabung Elpiji 3KG">
                                        <p>Mohon bantuannya untuk pelaksanaan pengambilan tabung Elpiji 3 Kg kami sbb:</p>

                                        <table style="margin-left: 1rem">
                                            <tr>
                                                <td>&bull; </td>
                                                <td>Tanggal pengambilan &nbsp;</td>
                                                <td>: {{ tanggal($pengambilan->kuotaHarian->tanggal) }}</td>
                                            </tr>
                                            <tr>
                                                <td>&bull;</td>
                                                <td>Plat No. Truk &nbsp;</td>
                                                <td>: {{ $pengambilan->truk->plat_nomor }}</td>
                                            </tr>
                                            <tr>
                                                <td>&bull;</td>
                                                <td>Nama Pengemudi &nbsp;</td>
                                                <td class="text-uppercase">: {{ $pengambilan->sopir->nama }}</td>
                                            </tr>
                                            <tr>
                                                <td>&bull;</td>
                                                <td>No. SO/ SA &nbsp;</td>
                                                <td>: {{ $pengambilan->kuotaHarian->sa->no_sa }}</td>
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
                                    </x-surat>
                                </div>
                                @if ($pengambilan->penukarans->count())
                                    <div class="tab-pane fade" id="penukaran-nobd" role="tabpanel"
                                        aria-labelledby="penukaran-tab-nobd">

                                        <x-surat :pengambilan="$pengambilan" judul="Surat Penukaran Tabung Elpiji 3KG">
                                            <p>Mohon bantuannya untuk dapat melakukan penukaran tabung Elpiji 3 Kg sbb:</p>

                                            <table style="margin-left: 1rem; margin-bottom: .8rem">
                                                <tr>
                                                    <td>&bull; </td>
                                                    <td>Jumlah Tabung Rusak &nbsp;</td>
                                                    <td>: {{ $pengambilan->penukarans->count() }} tabung</td>
                                                </tr>
                                                <tr>
                                                    <td>&bull;</td>
                                                    <td>Plat No. Truk &nbsp;</td>
                                                    <td>: {{ $pengambilan->truk->plat_nomor }}</td>
                                                </tr>
                                                <tr>
                                                    <td>&bull;</td>
                                                    <td>Nama Pengemudi &nbsp;</td>
                                                    <td class="text-uppercase">: {{ $pengambilan->sopir->nama }}</td>
                                                </tr>
                                                <tr>
                                                    <td>&bull;</td>
                                                    <td>Sebab Penukaran Tabung &nbsp;</td>
                                                    <td>: ....................................</td>
                                                </tr>

                                            </table>

                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="2" style="width: 30px">No.</th>
                                                        <th rowspan="2">Merk & Seri Tabung</th>
                                                        <th colspan="7" class="text-center">Rincian Penukaran Tabung</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center" style="width: 55px">Bocor Body</th>
                                                        <th class="text-center" style="width: 55px">Valve</th>
                                                        <th class="text-center" style="width: 55px">Visual</th>
                                                        <th class="text-center" style="width: 55px">Hand Guard</th>
                                                        <th class="text-center" style="width: 55px">Foot Ring</th>
                                                        <th class="text-center" style="width: 55px">Berat Kurang</th>
                                                        <th class="text-center" style="width: 55px">Isi Air</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pengambilan->penukarans as $penukaran)
                                                        <tr>
                                                            <td class="text-center">{{ $loop->iteration }}</td>
                                                            <td>{{ $penukaran->no_seri }}</td>
                                                            <td class="text-center checkmark">
                                                                @if (collect($penukaran->rincian)->contains('bocor-body'))
                                                                    &#10003;
                                                                @endif
                                                            </td>
                                                            <td class="text-center checkmark">
                                                                @if (collect($penukaran->rincian)->contains('valve'))
                                                                    &#10003;
                                                                @endif
                                                            </td>
                                                            <td class="text-center checkmark">
                                                                @if (collect($penukaran->rincian)->contains('visual'))
                                                                    &#10003;
                                                                @endif
                                                            </td>
                                                            <td class="text-center checkmark">
                                                                @if (collect($penukaran->rincian)->contains('hand-guard'))
                                                                    &#10003;
                                                                @endif
                                                            </td>
                                                            <td class="text-center checkmark">
                                                                @if (collect($penukaran->rincian)->contains('foot-ring'))
                                                                    &#10003;
                                                                @endif
                                                            </td>
                                                            <td class="text-center checkmark">
                                                                @if (collect($penukaran->rincian)->contains('berat-kurang'))
                                                                    &#10003;
                                                                @endif
                                                            </td>
                                                            <td class="text-center checkmark">
                                                                @if (collect($penukaran->rincian)->contains('isi-air'))
                                                                    &#10003;
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </x-surat>
                                        <div class="page-break"></div>

                                    </div>
                                @endif

                                <div class="tab-pane fade" id="penyaluran-nobd" role="tabpanel"
                                    aria-labelledby="penyaluran-tab-nobd">

                                    <div class="surat-penyaluran">
                                        <div class="header">SURAT JALAN <br>
                                            PENYALURAN ELPIJI PSO (BERSUBSIDI) KE PANGKALAN / SUB PENYALUR <br>
                                            AGEN LPG PSO PT SERAYU AGUNG LESTARI
                                        </div>

                                        <p class="text-justify">Padan hari ini <span
                                                class="text-uppercase">{{ tanggal($pengambilan->kuotaHarian->tanggal, true) }}</span>,
                                            kami
                                            selaku
                                            Agen LPG PSO PT. SERAYU AGUNG LESTARI Kabupaten BANYUMAS Truck LPG No. Polisi R
                                            9859
                                            IH telah melakukan
                                            pengisian tabung LPG 3Kg di SP(P)BE <span
                                                class="text-uppercase">{{ $pengambilan->kuotaHarian->sa->sppbe->nama }}</span>,
                                            dengan ini
                                            kami
                                            menugaskan kepada Sopir a.n <span
                                                class="text-uppercase">{{ $pengambilan->sopir->nama }}</span>,
                                            Kernet a.n <span
                                                class="text-uppercase">{{ $pengambilan->kernet->nama }}</span>,
                                            untuk
                                            menyalurkan LPG 3Kg (bersubsidi) kepada Pangkalan/ Sub Penyalur sebagai berikut:
                                        </p>
                                        <table style="margin-bottom: 1rem">
                                            <thead class="text-center bg-lightgray">
                                                <tr>
                                                    <td rowspan="2" class="text-center" style="width: 20px;">No.</td>
                                                    <td rowspan="2" style="width: 75px">Nama Pangkalan</td>
                                                    <td rowspan="2" style="width: 110px">Alamat</td>
                                                    <td colspan="4">Penyaluran</td>
                                                    <td colspan="2">Pembayaran</td>
                                                    <td rowspan="2" style="width: 50px">Tanda Tangan</td>
                                                    <td rowspan="2">Pengalihan Ke</td>

                                                </tr>
                                                <tr>
                                                    <td>Diserahkan</td>
                                                    <td>Diterima</td>
                                                    <td style="width: 60px">Harga Satuan</td>
                                                    <td style="width: 70px">Bayar</td>
                                                    <td style="width: 40px">Cash</td>
                                                    <td style="width: 40px">Cashless</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pengambilan->penyalurans as $penyaluran)
                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td class="text-uppercase">{{ $penyaluran->nama }}</td>
                                                        <td>{{ $penyaluran->alamat }}</td>
                                                        <td class="text-center">{{ $penyaluran->pivot->kuantitas }}</td>
                                                        <td class="text-center">{{ $penyaluran->pivot->kuantitas }}</td>
                                                        <td>{{ rupiah($penyaluran->pivot->harga) }}</td>
                                                        <td class="text-right">{{ rupiah($penyaluran->pivot->bayar) }}
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                            <tfoot class="bg-lightgray">
                                                <tr>
                                                    <td colspan="3" class="text-center">Total Penyaluran</td>
                                                    <td class="text-center">
                                                        {{ $pengambilan->penyalurans->sum('pivot.kuantitas') }}</td>
                                                    <td class="text-center">
                                                        {{ $pengambilan->penyalurans->sum('pivot.kuantitas') }}</td>
                                                    <td></td>
                                                    <td class="text-right">
                                                        {{ rupiah($pengambilan->penyalurans->sum('pivot.bayar')) }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <p class="text-justify">Menyatakan dengan sebenarnya bahwa alokasi LPG 3Kg telah
                                            disalurkan ke pangkalan
                                            kami tersebut di atas, dan apabila tidak dapat kami terima oleh pangkalan, maka
                                            akan
                                            dialihkan ke pangkalan
                                            LPG 3Kg lainnya dengan jumlah yang tidak diterima diatas dengan rincian sebagai
                                            berikut: </p>

                                        <table style="margin-bottom: 1rem">
                                            <thead class="text-center bg-lightgray">
                                                <tr>
                                                    <td rowspan="2" class="text-center" style="width: 20px;">No.</td>
                                                    <td rowspan="2" style="width: 75px">Nama Pangkalan</td>
                                                    <td rowspan="2" style="width: 110px">Alamat</td>
                                                    <td colspan="4">Penyaluran</td>
                                                    <td colspan="2">Pembayaran</td>
                                                    <td rowspan="2" style="width: 50px">Tanda Tangan</td>
                                                    <td rowspan="2">Pengalihan Ke</td>

                                                </tr>
                                                <tr>
                                                    <td>Diserahkan</td>
                                                    <td>Diterima</td>
                                                    <td style="width: 60px">Harga Satuan</td>
                                                    <td style="width: 70px">Bayar</td>
                                                    <td style="width: 40px">Cash</td>
                                                    <td style="width: 40px">Cashless</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <tr>
                                                        <td class="text-center">{{ $i }}</td>
                                                        <td class="text-uppercase"></td>
                                                        <td></td>
                                                        <td class="text-center"></td>
                                                        <td class="text-center"></td>
                                                        <td>{{ rupiah(14500) }}</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                @endfor

                                            </tbody>
                                            <tfoot class="bg-lightgray">
                                                <tr>
                                                    <td colspan="3" class="text-center">Total Penyaluran</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <p class="text-justify">
                                            Surat jalan ini dibuat dengan sebenar-benarnya dan disaksikan oleh petugas Agen
                                            dan
                                            pangkalan sehingga resmi
                                            menjadi dokumen serah terima antara Agen dan Pangkalan.
                                        </p>
                                        <div>Agen PT. SERAYU AGUNG LESTARI</div>
                                        <div>Manager / Admin</div>
                                        <div><img src="{{asset('img/ttd-yuli.jpg')}}" width="120px"></div>
                                        <div class="text-uppercase"><u>{{ Setting::get()->nama_manager }}</u></div>
                                    </div>
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
                        <a class="nav-link active" id="pengambilan-tab-nobd" data-toggle="pill" href="#pengambilan-nobd"
                            role="tab" aria-controls="pengambilan-nobd" aria-selected="true">Pengambilan</a>
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
