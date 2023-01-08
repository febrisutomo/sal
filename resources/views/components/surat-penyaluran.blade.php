<div>
    @php
        $harga = 14250;
    @endphp
    <div class="surat-penyaluran">
        <div class="header">SURAT JALAN <br>
            PENYALURAN ELPIJI PSO (BERSUBSIDI) KE PANGKALAN / SUB PENYALUR <br>
            AGEN LPG PSO PT SERAYU AGUNG LESTARI
        </div>

        @php
            $tanggal = explode(' ', strtoupper(str_replace(',', '', tanggal($pengambilan->penyaluran->tanggal, true))));
        @endphp
        <p class="text-justify">Padan hari ini {{ $tanggal[0] }} tanggal {{ $tanggal[1] }} bulan {{ $tanggal[2] }}
            tahun {{ $tanggal[3] }}, kami
            selaku
            Agen LPG PSO PT. SERAYU AGUNG LESTARI Kabupaten BANYUMAS Truck LPG No. Polisi {{ $pengambilan->penyaluran->truk->plat_nomor }} telah melakukan
            pengisian tabung LPG 3Kg di SP(P)BE <span
                class="text-uppercase">{{ $pengambilan->kuotaHarian->sa->sppbe->nama }}</span>, dengan ini
            kami
            menugaskan kepada Sopir a.n <span class="text-uppercase">{{ $pengambilan->penyaluran->sopir->nama }}</span>,
            Kernet a.n <span class="text-uppercase">{{ $pengambilan->penyaluran->kernet->nama }}</span>, untuk
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
                @foreach ($pengambilan->penyaluran->pangkalans as $pangkalan)
                        @php
                            if ($loop->first) {
                                $harga = $pangkalan->pivot->harga;
                            }
                        @endphp
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-uppercase">{{ $pangkalan->nama }}</td>
                        <td>{{ $pangkalan->alamat }}</td>
                        <td class="text-center">{{ $pangkalan->pivot->kuantitas }}</td>
                        <td class="text-center">{{ $pangkalan->pivot->kuantitas }}</td>
                        <td>{{ rupiah($pangkalan->pivot->harga) }}</td>
                        <td class="text-right">{{ rupiah($pangkalan->pivot->bayar) }}</td>
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
                    <td class="text-center">{{ $pengambilan->penyaluran->total }}</td>
                    <td class="text-center">{{ $pengambilan->penyaluran->total }}</td>
                    <td></td>
                    <td class="text-right">{{ rupiah($pengambilan->penyaluran->total_bayar) }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        <p class="text-justify">Menyatakan dengan sebenarnya bahwa alokasi LPG 3Kg telah disalurkan ke pangkalan
            kami tersebut di atas, dan apabila tidak dapat kami terima oleh pangkalan, maka akan dialihkan ke pangkalan
            dengan jumlah yang tidak diterima tersebut di atas, dan dialhikan kepada pangkalan LPG 3Kg lainnya dengan
            rincian sebagai berikut:</p>

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
                        <td>{{ rupiah($harga) }}</td>
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
            <img src="{{ asset('img/'.Setting::get()->ttd_manager) }}" height="85px">
        </div>
        <div><u class="text-uppercase">{{ Setting::get()->nama_manager }}</u></div>
    </div>
</div>

<style>
     .surat-penyaluran, .surat-penyaluran p {
        font-family: sans-serif;
        /* font-family: Arial, Helvetica, sans-serif; */
        font-size: .7rem;
    }

    .surat-penyaluran table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid;
    }

    .surat-penyaluran table th,
    .surat-penyaluran table td {
        font-family: sans-serif;
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

    .bg-lightgray {
        background-color: lightgray;
    }
</style>