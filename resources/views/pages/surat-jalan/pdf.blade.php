<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <x-surat :pengambilan="$pengambilan" judul="Surat Pengambilan Tabung Elpiji 3KG">
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
    </x-surat>

    <div class="page-break"></div>

    <x-surat :pengambilan="$pengambilan" judul="Surat Penyaluran Tabung Elpiji 3KG">
        <table class="table">
            <thead>
                <tr>
                    <th rowspan="2" style="width: 20px; text-align:center">No.</th>
                    <th rowspan="2" style="width: 60px">Nama Pangkalan</th>
                    <th rowspan="2" style="width: 150px">Alamat</th>
                    <th colspan="4">Penyaluran</th>
                    <th colspan="2">Pembayaran</th>
                    <th rowspan="2">Tanda Tangan</th>
                    <th rowspan="2">Pengalihan Ke</th>

                </tr>
                <tr>
                    <th>Diserahkan</th>
                    <th>Diterima</th>
                    <th>Harga Satuan</th>
                    <th>Bayar</th>
                    <th style="width: 60px">Cash</th>
                    <th style="width: 60px">Cashless</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengambilan->penyalurans as $penyaluran)
                    <tr>
                        <td style="text-align:center">{{ $loop->iteration }}</td>
                        <td style="text-transform: uppercase">{{ $penyaluran->nama }}</td>
                        <td>{{ $penyaluran->alamat }}</td>
                        <td>{{ $penyaluran->pivot->kuantitas }}</td>
                        <td>{{ $penyaluran->pivot->kuantitas }}</td>
                        <td>{{ rupiah($penyaluran->pivot->harga) }}</td>
                        <td>{{ rupiah($penyaluran->pivot->kuantitas * $penyaluran->pivot->harga) }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </x-surat>



</body>

</html>

<style>
    .page-break {
        page-break-after: always;
    }
</style>
