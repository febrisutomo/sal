<div>
    <table
        style="width: 100%; text-align: center; padding-bottom: 4px; border-bottom: 4px double black; margin-bottom: 1rem">
        <tr>
            <td><img src="{{ asset('img/logo-sal.png') }}" height="90"></td>
            <td>
                <h1 style="margin: 0">PT SERAYU AGUNG LESTARI</h1>
                <h3 style="margin: 0">AGEN GAS ELPIJI 3 KG</h3>
                <div style="font-size: 0.9rem">Alamat: Jl. Kulon No. 674 Sudagaran, Banyumas, Jawa Tengah 53192 <br>
                    Telp/Fax: 0281-796009, E-mail : ptserayuagunglestari@gmail.com</div>
            </td>
            <td><img src="{{ asset('img/logo-elpiji.png') }}" height="90"></td>
        </tr>
    </table>

    <div style="text-align: center; margin-bottom: 3rem">
        <div style="text-transform: uppercase; font-weight:bold; text-decoration: underline">{{ $judul }}</div>
        </b>
    </div>

    <p style="max-width: 50%">
        Kepada Yth,<br>
        SPBE / SP(P)BE<br>
        <b>{{ $pengambilan->kitir->sa->sppbe->nama }}</b><br>
        {{ $pengambilan->kitir->sa->sppbe->alamat }}
    </p>

    <p>Dengan Hormat,</p>

    {{ $slot }}

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


<style>
   
    .table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid;
    }

    .table th,
    .table td {
        padding: 6px;
        border: 1px solid;
    }
</style>.
