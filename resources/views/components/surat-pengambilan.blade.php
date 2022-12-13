<div>
    <x-surat :pengambilan="$pengambilan" judul="Surat Pengambilan Tabung Elpiji 3KG">
        <p>Mohon bantuannya untuk pelaksanaan pengambilan tabung Elpiji 3 Kg kami sbb:</p>

        <table style="margin-left: 1rem">
            <tr>
                <td>&bull; </td>
                <td>Tanggal pengambilan &nbsp;</td>
                <td>:
                    @if (date('d-m-Y', strtotime($pengambilan->created_at)) <= date('d-m-Y', strtotime($pengambilan->kuotaHarian->tanggal)))
                        {{ tanggal($pengambilan->kuotaHarian->tanggal) }}
                    @else
                        {{ tanggal($pengambilan->created_at) }} (Pending
                        {{ tanggal($pengambilan->kuotaHarian->tanggal) }})
                    @endif
                </td>
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