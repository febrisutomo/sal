<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Cetak Surat Jalan</title>
</head>

<body>

    <x-surat-pengambilan :pengambilan="$pengambilan" />
    <div class="page-break"></div>

    @if ($pengambilan->penukarans->count())
        <x-surat-penukaran :pengambilan="$pengambilan" />
        <div class="page-break"></div>
    @endif

    <x-surat-penyaluran :pengambilan="$pengambilan" />

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


</style>
