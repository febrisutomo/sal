<div>
    <table class="text-center"
        style="width: 100%; padding-bottom: 4px; border-bottom: 4px double black; margin-bottom: 1rem">
        <tr> 
            <td><img src="{{ asset('img/logo-sal.png') }}" height="90"></td>
            <td>
                <div class="font-weight-bold text-uppercase" style="font-size: 1.5rem">{{ Setting::get()->nama_perusahaan }}</div>
                <div class="font-weight-bold" style="font-size: 1.2rem">AGEN GAS ELPIJI 3 KG</div>
                <div style="font-size: 0.8rem">{{ Setting::get()->alamat }}<br>
                    Telp/Fax: {{ Setting::get()->telepon }}, E-mail : {{ Setting::get()->email }}</div>
            </td>
            <td><img src="{{ asset('img/logo-elpiji.png') }}" height="90"></td>
        </tr>
    </table>

    <div class="text-center" style="margin-bottom: 2rem">
        <div class="text-uppercase font-weight-bold" style="text-decoration: underline">{{ $judul }}</div>
        </b>
    </div>

    <p style="max-width: 50%">
        Kepada Yth,<br>
        SPBE / SP(P)BE<br>
        <b class="text-uppercase">{{ $pengambilan->kuotaHarian->sa->sppbe->nama }}</b><br>
        {{ $pengambilan->kuotaHarian->sa->sppbe->alamat }} <br>
    </p>

    <p>Dengan Hormat,</p>

    {{ $slot }}

    <p>Demikian kami sampaikan dan atas kerjasamanya kami ucapkan terima kasih.</p>

    <br>
    <div style="margin-bottom: 1rem">
        Banyumas, {{ tanggal($pengambilan->created_at) }} <br>
        {{ Setting::get()->nama_perusahaan }}
    </div>

    <table>
        <tr>
            <td style="vertical-align: bottom">
                <div>
                    <img src="{{asset('img/ttd-yuli.jpg')}}" width="150px">
                </div>
                <u class="text-uppercase">{{ Setting::get()->nama_manager }}</u><br>
                <i>Manager</i>
            </td>
            <td style="width: 5rem"></td>
            <td style="vertical-align: bottom">
                <div>
                    <img src="{{asset('img/sopir/'.$pengambilan->sopir->ttd)}}" width="150px">
                </div>
                <u class="text-uppercase">{{ $pengambilan->sopir->nama }}</u><br>
                <i>Sopir</i>
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
        padding: 4px;
        border: 1px solid;
    }
</style>.
