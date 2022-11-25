<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Surat Jalan</title>
</head>

<body>
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

    <div class="page-break"></div>

    @if ($pengambilan->penukarans->count())
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
                        <th colspan="7">Rincian Penukaran Tabung</th>
                    </tr>
                    <tr>
                        <th style="width: 55px">Bocor Body</th>
                        <th style="width: 55px">Valve</th>
                        <th style="width: 55px">Visual</th>
                        <th style="width: 55px">Hand Guard</th>
                        <th style="width: 55px">Foot Ring</th>
                        <th style="width: 55px">Berat Kurang</th>
                        <th style="width: 55px">Isi Air</th>
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
    @endif



    <div class="surat-penyaluran">
        <div class="header">SURAT JALAN <br>
            PENYALURAN ELPIJI PSO (BERSUBSIDI) KE PANGKALAN / SUB PENYALUR <br>
            AGEN LPG PSO PT SERAYU AGUNG LESTARI
        </div>

        <p class="text-justify">Padan hari ini <span
                class="text-uppercase">{{ tanggal($pengambilan->kuotaHarian->tanggal, true) }}</span>, kami
            selaku
            Agen LPG PSO PT. SERAYU AGUNG LESTARI Kabupaten BANYUMAS Truck LPG No. Polisi R 9859 IH telah melakukan
            pengisian tabung LPG 3Kg di SP(P)BE <span
                class="text-uppercase">{{ $pengambilan->kuotaHarian->sa->sppbe->nama }}</span>, dengan ini
            kami
            menugaskan kepada Sopir a.n <span class="text-uppercase">{{ $pengambilan->sopir->nama }}</span>,
            Kernet a.n <span class="text-uppercase">{{ $pengambilan->kernet->nama }}</span>, untuk
            menyalurkan LPG 3Kg (bersubsidi) kepada Pangkalan/ Sub Penyalur sebagai berikut:</p>
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
                    <td style="width: 55px">Harga Satuan</td>
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
                        <td class="text-right">{{ rupiah($penyaluran->pivot->bayar) }}</td>
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
                    <td class="text-center">{{ $pengambilan->penyalurans->sum('pivot.kuantitas') }}</td>
                    <td class="text-center">{{ $pengambilan->penyalurans->sum('pivot.kuantitas') }}</td>
                    <td></td>
                    <td class="text-right">{{ rupiah($pengambilan->penyalurans->sum('pivot.bayar')) }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        <p class="text-justify">Menyatakan dengan sebenarnya bahwa alokasi LPG 3Kg telah disalurkan ke pangkalan
            kami tersebut di atas, dan apabila tidak dapat kami terima oleh pangkalan, maka akan dialihkan ke pangkalan
            LPG 3Kg lainnya dengan jumlah yang tidak diterima diatas dengan rincian sebagai berikut: </p>

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
                    <td style="width: 55px">Harga Satuan</td>
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
                        <td>{{ rupiah(14250) }}</td>
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
            Surat jalan ini dibuat dengan sebenar-benarnya dan disaksikan oleh petugas Agen dan pangkalan sehingga resmi
            menjadi dokumen serah terima antara Agen dan Pangkalan.
        </p>
        <div>Agen PT. SERAYU AGUNG LESTARI</div>
        <div>Manager / Admin</div>
        <div>
            <img src="{{asset('img/ttd-yuli.jpg')}}" width="120px">
        </div>
        <div><u>DWI YULIARTO</u></div>
    </div>



</body>

</html>

<style>
    .text-center {
        text-align: center
    }

    .text-right {
        text-align: right
    }

    .text-justify {
        text-align: justify
    }

    .font-weight-bold {
        font-weight: bold
    }

    .text-uppercase {
        text-transform: uppercase
    }

    .page-break {
        page-break-after: always;
    }

    .bg-lightgray {
        background-color: lightgray;
    }

    .surat-penyaluran {
        font-family: Arial, Helvetica, sans-serif;
        font-size: .7rem;
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


