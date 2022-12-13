<div>
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
</div>

<style>
    .checkmark {
        font-family: Verdana, Tahoma, "DejaVu Sans", sans-serif;
    }
</style>