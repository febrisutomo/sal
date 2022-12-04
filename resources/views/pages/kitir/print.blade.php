<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Kitir Bulan {{ bulan($kitir->bulan_tahun) }}</title>
</head>

@php
    $bulanTahun = $kitir->bulan_tahun;
@endphp

<body>
    <h3 style="text-transform: uppercase">SA Reguler {{ bulan($kitir->bulan_tahun) }}
        ({{ $kitir->kuotaHarians->groupBy('tanggal')->count() }} HK)</h3>
    @foreach ($dates as $week)
        @php
            $last_week = $loop->last;
        @endphp
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 30px">No.</th>
                    <th style="width: 130px">Nama Agen</th>
                    <th style="width: 70px">Kab/Kota</th>
                    <th style="width: 40px">SP(P)BE</th>
                    <th style="width: 40px">No. SH</th>
                    <th style="width: 40px">Plant</th>
                    <th style="width: 40px">No. SA</th>
                    @foreach ($week as $day)
                        <th class="text-center {{ $loop->first && $day != null ? 'text-danger' : '' }}"
                            style="width: 30px; ">{{ $day }}</th>
                    @endforeach
                    @if ($last_week)
                        <th style="width: 30px">Total</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($sppbes as $sppbe)
                    <tr class="{{ $sppbe->kode }}">
                        <td class="text-center" style="vertical-align: middle">
                            {{ $loop->iteration }}</td>
                        <td style="vertical-align: middle">
                            PT SERAYU AGUNG LESTARI</td>
                        <td style="vertical-align: middle">
                            Kab. Banyumas</td>
                        <td class="text-center" style="vertical-align: middle">
                            {{ $sppbe->kode }}</td>
                        <td class="text-center" style="vertical-align: middle">
                            {{ $sppbe->no_sh }}</td>
                        <td class="text-center" style="vertical-align: middle">
                            {{ $sppbe->plant }}</td>
                        <td class="text-center no-sa">
                            @foreach ($kitir->sas->where('sppbe_id', $sppbe->id)->sortBy('tipe') as $sa)
                                @php
                                    $used = $sa->kuotaHarians->contains(function ($value, $key) use ($bulanTahun, $week) {
                                        return date('Y-m-d', strtotime($value->tanggal)) >= date('Y-m-d', strtotime($bulanTahun . '-' . $week[0])) && date('Y-m-d', strtotime($value->tanggal)) <= date('Y-m-d', strtotime($bulanTahun . '-' . ($week[count($week) - 1] ?? 31)));
                                    });
                                @endphp
                                <div
                                    class="{{ $sa->tipe == 'tambahan' ? 'text-danger' : '' }} {{ $used ? '' : 'd-none' }}">
                                    {{ $sa->no_sa }}
                                </div>
                            @endforeach

                        </td>
                        @foreach ($week as $day)
                            @php
                                $k = $sppbe->kuotaHarians->where('tanggal', $bulanTahun . '-' . str_pad($day, 2, '0', STR_PAD_LEFT));
                            @endphp
                            <td
                                class="text-right {{ $k->contains(function ($value, $key) {
                                    return $value->sa->tipe == 'tambahan';
                                })
                                    ? 'bg-warning text-danger'
                                    : '' }}">
                                @if ($k->count())
                                    {{ num_format($k->sum('kuota')) }}
                                @endif
                            </td>
                        @endforeach
                        @if ($last_week)
                            <td class="text-right subtotal">
                                {{ num_format($kitir->kuotaHarians->where('sa.sppbe_id', $sppbe->id)->sum('kuota')) }}
                            </td>
                        @endif

                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="7" class="no-border">
                    </th>
                    @foreach ($week as $day)
                        <th class="text-right">
                            @if ($day != null && $loop->iteration != 1)
                                {{ num_format($kitir->kuotaHarians->where('tanggal', $bulanTahun . '-' . str_pad($day, 2, '0', STR_PAD_LEFT))->sum('kuota')) }}
                            @endif
                        </th>
                    @endforeach
                    @if ($last_week)
                        <th class="text-right total">
                            {{ num_format($kitir->kuotaHarians->sum('kuota')) }}</th>
                    @endif
                </tr>
            </tfoot>
        </table>
    @endforeach
</body>

<style>
    @page {
        margin: 1rem 4rem;
    }

    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    .text-danger {
        color: red;
    }

    .text-center {
        text-align: center
    }

    .text-right {
        text-align: right
    }

    .table {
        /* width: fit-content; */
        border-collapse: collapse;
        font-size: 8px;
        margin-bottom: 1rem
    }

    .table th,
    .table td {
        padding: 3px;
        border: 1px solid black;
    }

    table .no-border {
        border: 0;
    }

    tbody tr:nth-child(odd) {
        background-color: lightskyblue;
    }

    tbody tr:nth-child(even) {
        background-color: lightpink;
    }

    .bg-warning {
        background-color: #ffda07 !important
    }



    /* .KMSU {
        background-color: lightgrey
    }

    .TE {
        background-color: lightpink
    }

    .KBJG {
        background-color: lightskyblue
    }

    .BGA {
        background-color: sandybrown
    }

    .bg-warning {
        background-color: yellow !important
    } */

    .d-none {
        display: none
    }
</style>

</html>
