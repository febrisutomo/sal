@extends('layouts.app', ['title' => 'Buat Surat Jalan'])

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <h4 class="page-title">Buat Surat Jalan</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('dashboard') }}">
                        <i class="la la-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="la la-angle-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('surat-jalan.index') }}">Surat Jalan</a>
                </li>
                <li class="separator">
                    <i class="la la-angle-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Buat</a>
                </li>
            </ul>
            <div class="ml-auto">


            </div>


        </div>
        <div class="row">
            <div class="col-md-12">
                <form id="suratJalan" action="{{ route('surat-jalan.store') }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Pengambilan</h4>
                        </div>

                        <div class="card-body">

                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <div class="form-group form-show-validation">
                                        <label for="tanggal" class="required">Tanggal</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="la la-calendar-o"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control tanggal" id="tanggal" name="tanggal"
                                                placeholder="Pilih Tanggal" value="{{ old('tanggal', date('d/m/Y')) }}"
                                                required>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group form-show-validation">
                                        <label for="sppbe_id" class="required">SP(P)BE</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="la la-gas-pump"></i></span>
                                            </div>
                                            <select class="form-control select2 " name="sppbe_id" id="sppbe_id"
                                                data-placeholder="Pilih SPPBE" required>
                                                <option value=""></option>
                                                @foreach ($sppbes as $sppbe)
                                                    <option value="{{ $sppbe->id }}" @selected($sppbe_id == $sppbe->id)>
                                                        {{ $sppbe->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group form-show-validation">
                                        <label for="no_sa" class="required">No. SA</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="la la-file-invoice"></i></span>
                                            </div>
                                            <select class="form-control select2" name="kuota_harian_id" id="no_sa"
                                                data-placeholder="Pilih No. SA" required>
                                                <option value=""></option>
                                            </select>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="form-group form-show-validation">
                                        <label for="truk" class="required">Truk</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="la la-truck"></i></span>
                                            </div>
                                            <select class="form-control select2" name="truk_id" id="truk"
                                                data-placeholder="Pilih Truk" required>
                                                <option value=""></option>
                                                @foreach ($truks as $truk)
                                                    <option value="{{ $truk->id }}"
                                                        data-truk='@json($truk)'> {{ $truk->kode }} |
                                                        {{ $truk->plat_nomor }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group form-show-validation">
                                        <label for="sopir" class="required">Sopir</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="la la-user"></i></span>
                                            </div>
                                            <select class="form-control select2" name="sopir_id" id="sopir"
                                                data-placeholder="Pilih Sopir" required>
                                                <option value=""></option>
                                                @foreach ($sopirs as $sopir)
                                                    <option value="{{ $sopir->id }}"> {{ $sopir->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group form-show-validation">
                                        <label for="kernet" class="required">Kernet</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="la la-user"></i></span>
                                            </div>
                                            <select class="form-control select2" name="kernet_id" id="kernet"
                                                data-placeholder="Pilih Kernet" required>
                                                <option value=""></option>
                                                @foreach ($kernets as $kernet)
                                                    <option value="{{ $kernet->id }}"> {{ $kernet->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>
                       
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Penukaran</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="la la-barcode"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="add_penukaran"
                                        placeholder="Masukkan nomor seri">
                                </div>
                            </div>
                            <div class="table-responsive mb-3 px-2">
                                <table id="tb_penukaran" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 30px; vertical-align: middle"
                                                rowspan="2">
                                                No.</th>
                                            <th rowspan="2" style="min-width: 250px; vertical-align: middle">Merk &
                                                Seri
                                                Tabung
                                            </th>
                                            <th class="text-center" colspan="7">Rincian Penukaran
                                                Tabung</th>
                                            <th rowspan="2" style="width:40px"></th>
                                        </tr>
                                        <tr>
                                            <th style="width: 80px;">Bocor Body</th>
                                            <th style="width: 80px;">Valve</th>
                                            <th style="width: 80px;">Visual</th>
                                            <th style="width: 80px;">Hand Guard</th>
                                            <th style="width: 80px;">Foot Ring</th>
                                            <th style="width: 80px;">Berat Kurang</th>
                                            <th style="width: 80px;">Isi Air</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <tr class="empty-data">
                                            <td colspan="100%" class="text-center">Tidak ada data.</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Penyaluran</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <div class="form-group form-show-validation">
                                        <label for="tanggalPenyaluran" class="required">Tanggal</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="la la-calendar-o"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control tanggal" id="tanggalPenyaluran"
                                                name="tanggal_penyaluran" placeholder="Pilih Tanggal"
                                                value="{{ old('tanggal_penyaluran', date('d/m/Y')) }}" required>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group form-show-validation">
                                        <label for="trukPenyaluran" class="required">Truk</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="la la-truck"></i></span>
                                            </div>
                                            <select class="form-control select2" name="truk_id_penyaluran"
                                                id="trukPenyaluran" data-placeholder="Pilih Truk" required>
                                                <option value=""></option>
                                                @foreach ($truks as $truk)
                                                    <option value="{{ $truk->id }}"
                                                        data-truk='@json($truk)'> {{ $truk->kode }} |
                                                        {{ $truk->plat_nomor }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group form-show-validation">
                                        <label for="sopirPenyaluran" class="required">Sopir</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="la la-user"></i></span>
                                            </div>
                                            <select class="form-control select2" name="sopir_id_penyaluran"
                                                id="sopirPenyaluran" data-placeholder="Pilih Sopir" required>
                                                <option value=""></option>
                                                @foreach ($sopirs as $sopir)
                                                    <option value="{{ $sopir->id }}"> {{ $sopir->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group form-show-validation">
                                        <label for="kernetPenyaluran" class="required">Kernet</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="la la-user"></i></span>
                                            </div>
                                            <select class="form-control select2" name="kernet_id_penyaluran"
                                                id="kernetPenyaluran" data-placeholder="Pilih Kernet" required>
                                                <option value=""></option>
                                                @foreach ($kernets as $kernet)
                                                    <option value="{{ $kernet->id }}"> {{ $kernet->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group form-show-validation">
                                        <label for="add_penyaluran">Pangkalan</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="la la-store-alt"></i></span>
                                            </div>
                                            <select name="add_penyaluran" id="add_penyaluran" class="form-control"
                                                data-placeholder="Pilih Pangkalan">
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive mb-3 px-2">
                                <table id="tb_penyaluran" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 30px">No.</th>
                                            <th style="width: 200px">Nama Pangkalan</th>
                                            <th>Alamat</th>
                                            <th class="text-right" style="width: 100px">Harga</th>
                                            <th class="text-right" style="width: 120px">Kuantitas</th>
                                            <th class="text-right" style="width: 130px">Bayar</th>
                                            <th style="width: 40px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="empty-data">
                                            <td colspan="100%" class="text-center">Tidak ada data.</td>
                                        </tr>
                                    </tbody>
                                    <tfoot id="tfoot">
                                        <tr>
                                            <th class="text-right" colspan="4">
                                                Total
                                            </th>
                                            <th class="total-penyaluran" class="text-right">
                                                0
                                            </th>
                                            <th id="totalHarga" class="text-right">
                                                Rp 0
                                            </th>
                                            <th></th>
                                        </tr>
                                        <tr>

                                        </tr>
                                    </tfoot>

                                </table>


                            </div>
                            <div class="table-responsive px-2">
                                <table class="table table-bordered" style="width: 400px">
                                    <tr>
                                        <th>Stok Gudang</th>
                                        <th class="text-right" id="stokGudang">
                                            {{ Setting::get()->stok_awal + $pengambilans->sum('jumlah') - $pengambilans->sum('total_penyaluran') }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Total Pengambilan</th>
                                        <th class="text-right">560</th>
                                    </tr>
                                    <tr>
                                        <th>Total Penyaluran</th>
                                        <th class="text-right total-penyaluran">0</th>
                                    </tr>
                                    <tr class="stok-gudang">
                                        <th>Simpan ke Gudang</th>
                                        <th class="text-right">0</th>
                                    </tr>
                                </table>

                            </div>
                        </div>
                    </div>

                     {{-- <div class="card-footer"> --}}
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary"><span class="btn-label"><i
                                            class="la la-save mr-1"></i></span>Simpan</button>
                            </div>
                        {{-- </div> --}}
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(window).on('keydown', function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                return false;
            }
        });


        $(document).ready(function() {

            let stok_gudang = parseInt($('#stokGudang').text().trim())
            let total_pengambilan = 560
            let total_penyaluran = 0
            let no_sa = parseInt({{ $no_sa }})

            let tanggal = moment($('#tanggal').val(), 'DD/MM/YYYY').format('YYYY-MM-DD')


            const harga = parseInt({{ Setting::get()->harga }})

            function getNoSA() {
                $('select[name=kuota_harian_id]').attr('disabled', true)
                $.ajax({
                    url: window.location.origin + '/surat-jalan/get-no-sa',
                    type: 'POST',
                    data: {
                        tanggal: tanggal,
                        sppbe_id: $('select[name=sppbe_id]').val()
                    },
                    success: function(response) {
                        let options = `<option value=""></option>`
                        $.each(response.data, function(key, value) {
                            options +=
                                `<option value="${value.id}" ${value.diambil == value.kuota ? 'disabled' : ''} ${value.sa.no_sa == no_sa ? 'selected' : ''} >${value.sa.no_sa} (${value.sa.tipe}) (${parseInt(value.diambil)}/${parseInt(value.kuota)})</option>`
                        })
                        $('select[name=kuota_harian_id]').html(options)
                    },
                    complete: function() {
                        $('select[name=kuota_harian_id]').attr('disabled', false)
                    }
                })
            }

            getNoSA()


            $("#suratJalan").validate({
                highlight: function(element) {
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                success: function(element) {
                    $(element).closest('.form-group').removeClass('has-error')
                },
                errorPlacement: function(error, element) {
                    let formGroup = element.closest('.form-group');
                    error.appendTo(formGroup);
                }
            });

            $('select').on('change', function() {
                $(this).valid();
            })

            $('.tanggal').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                autoApply: true,
                locale: {
                    format: 'DD/MM/YYYY'
                },
            })

            $('#tanggal').on('change', function() {
                tanggal = moment(this.value, 'DD/MM/YYYY').format('YYYY-MM-DD')
                getNoSA()
                $('#tanggalPenyaluran').val(this.value)

            })

            $('#tanggal').on('apply.daterangepicker', function(ev, picker) {
                tanggal = picker.startDate.format('YYYY-MM-DD');
                getNoSA()
                $('#tanggalPenyaluran').val(this.value)
            });

            $('select[name="sppbe_id"]').on('change', function() {
                getNoSA()
            })


            $('select[name="truk_id').on('change', function() {
                let truk = $('select[name=truk_id] option:selected').data('truk')

                $('select[name=truk_id_penyaluran').val(this.value).trigger('change');

                if (truk) {
                    $('select[name=sopir_id]').val(truk.sopir_id).trigger('change');
                    $('select[name=kernet_id]').val(truk.kernet_id).trigger('change');
                    $('select[name=sopir_id_penyaluran]').val(truk.sopir_id).trigger('change');
                    $('select[name=kernet_id_penyaluran]').val(truk.kernet_id).trigger('change');
                } else {
                    $('select[name=sopir_id]').val(null).trigger('change');
                    $('select[name=kernet_id]').val(null).trigger('change');
                    $('select[name=sopir_id_penyaluran]').val(null).trigger('change');
                    $('select[name=kernet_id_penyaluran]').val(null).trigger('change');
                }

            })

            $('select[name=sopir_id]').on('change', function(){
                $('select[name=sopir_id_penyaluran]').val(this.value).trigger('change');
            })
            $('select[name=kernet_id]').on('change', function(){
                $('select[name=kernet_id_penyaluran]').val(this.value).trigger('change');
            })


            // PENUKARAN 

            function reindexPenukaran() {

                $('#tb_penukaran tbody tr:not(.empty-data)').each((i, el) => {
                    const no = $(el).find('.no')
                    const no_seri = $(el).find('input[name*="no_seri"]')
                    const rincians = $(el).find('input[name*="rincian"]')
                    no.text(i + 1)
                    no_seri.attr('name', no_seri.attr('name').replace(/[0-9]/g, i))
                    rincians.attr('name', rincians.attr('name').replace(/[0-9]/g, i))
                })

            }

            $('input[name="add_penukaran"]').on('keydown', function(e) {
                if (e.keyCode == 13 && $(this).val().trim() != '') {
                    let tr = `<tr>
                                            <td class="no text-center">1</td>
                                            <td>
                                                    <input type="hidden" class="form-control"
                                                        name="penukaran[0][no_seri]" value="${$(this).val()}" required>
                                                    ${$(this).val()}

                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="penukaran[0][rincian][]" value="bocor-body"
                                                    required>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="penukaran[0][rincian][]" value="valve"
                                                    required>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="penukaran[0][rincian][]" value="visual"
                                                    required>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="penukaran[0][rincian][]" value="hand-guard"
                                                    required>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="penukaran[0][rincian][]" value="foot-ring"
                                                    required>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="penukaran[0][rincian][]"
                                                    value="berat-kurang" required>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="penukaran[0][rincian][]" value="isi-air"
                                                    required>
                                            </td>

                                            <td class="text-center">
                                                <button type="button"
                                                    class="btn btn-link text-danger delete-penukaran"><span
                                                        class="btn-label"><i class="la la-trash"></i></span></button>
                                            </td>
                                        </tr>`

                    if ($('#tb_penukaran tbody tr.empty-data')) {
                        $('#tb_penukaran tbody tr.empty-data').remove()
                    }
                    $('#tb_penukaran tbody').append(tr)
                    $(this).val('')
                    reindexPenukaran()
                }
            })

            $('body').on('click', '.delete-penukaran', function() {
                if ($('#tb_penukaran tbody tr:not(.empty-data)').length == 1) {
                    let tr = `<tr class="empty-data">
                                            <td colspan="100%" class="text-center">Tidak ada data.</td>
                                        </tr>`
                    $('#tb_penukaran tbody').append(tr)
                }
                $(this).closest('tr').remove()
                reindexPenukaran()
            })


            $('input[type=checkbox]').on('change', function() {
                const cbx_group = $(this).closest('tr').find('input[type=checkbox]')

                if (cbx_group.is(':checked')) {
                    cbx_group.prop('required', false)
                } else {
                    cbx_group.prop('required', true)
                }
            })


            // PENYALURAN 

            function validasiInput(el) {
                if (el.value == '' || el.value < el.min) {
                    el.value = 0
                    hitungSubtotal(el)
                }
                if (total_penyaluran > total_pengambilan + stok_gudang) {
                    swal.fire({
                        icon: 'warning',
                        title: 'Stok gudang tidak mencukupi!',
                    })
                    el.value = el.dataset.kuota
                    hitungSubtotal(el)
                }

            }

            function hitungSubtotal(el) {
                const jumlah = $(el).closest('tr').find('input[name*="jumlah"]').val()
                const subtotal = $(el).closest('tr').find('.subtotal').text(rupiah(jumlah * harga))
                hitungTotal()
            }

            function hitungTotal() {
                total_penyaluran = 0

                $('input[name*="jumlah"]').each(function() {
                    if (this.value != '') {
                        total_penyaluran += parseInt(this.value)
                    }
                })

                if (total_penyaluran > total_pengambilan) {
                    let td =
                        `  <th class="text-warning">Ambil dari Gudang</th>
                                        <th class="text-right text-warning">${total_penyaluran - total_pengambilan}</th>`
                    $('.stok-gudang').html(td)
                } else {
                    let td =
                        `  <th class="text-success">Simpan ke Gudang</th>
                                        <th class="text-right text-success">${total_pengambilan - total_penyaluran}</th>`
                    $('.stok-gudang').html(td)
                }
                $('.total-penyaluran').text(total_penyaluran)
                $('#totalHarga').text(rupiah(total_penyaluran * harga))

            }

            function reindexPenyaluran() {
                $('#tb_penyaluran tbody tr:not(.empty-data)').each((i, el) => {
                    const no = $(el).find('.no')
                    const pangkalan = $(el).find('input[name*="pangkalan_id"]')
                    const jumlah = $(el).find('input[name*="jumlah"]')
                    no.text(i + 1)
                    pangkalan.attr('name', pangkalan.attr('name').replace(/[0-9]/g, i))
                    jumlah.attr('name', jumlah.attr('name').replace(/[0-9]/g, i))
                })
            }

            function reloadOption() {

                // console.log(true);
                let selected = []

                $('#tb_penyaluran input[name*="pangkalan_id"]').each(function() {
                    selected.push(this.value)
                })

                $('select[name="add_penyaluran"] option').each(function() {
                    if (selected.includes(this.value)) {
                        this.setAttribute('disabled', true)
                    } else {
                        this.removeAttribute('disabled')
                    }
                })

            }

            $('select[name="add_penyaluran"]').rules('add', {
                required: function() {
                    return $('input[name*=pangkalan_id]').length == 0
                },
                messages: {
                    required: "Harap masukkan penyaluran!.",
                }
            })

            function formatPangkalan(pangkalan) {
                if (!pangkalan.id) {
                    return pangkalan.nama;
                }
                var $pangkalan = $(
                    '<div><b>' + pangkalan.nama + '</b></div><div>' +
                    pangkalan.alamat + ' | kuota: ' + pangkalan.kuota + '</div><div>'
                );
                return $pangkalan;
            };

            function matchCustom(params, data) {

                if ($.trim(params.term) === '') {
                    return data;
                }

                keywords = params.term.split(" ");

                for (var i = 0; i < keywords.length; i++) {

                    if ((data.nama.toUpperCase()).indexOf((keywords[i]).toUpperCase()) == -1 && (data.alamat
                            .toUpperCase()).indexOf((keywords[i]).toUpperCase()) == -1)
                        return null;

                }
                return data;
            }

            $('select[name="add_penyaluran"]').select2({
                data: @json($pangkalans),
                allowClear: true,
                theme: "bootstrap",
                templateResult: formatPangkalan,
                matcher: matchCustom
            });

            $('select[name="add_penyaluran"]').val('').trigger('change.select2')

            $('select[name="add_penyaluran"]').on('select2:select', function(e) {

                let pangkalan = e.params.data;
                if (total_penyaluran + pangkalan.kuota > total_pengambilan + stok_gudang) {
                    swal.fire({
                        icon: 'warning',
                        title: 'Stok gudang tidak mencukupi!',
                    })
                } else {
                    let tr = `<tr>
                                            <td class="no text-center">1</td>
                                            <td>
                                                <input type="hidden" name="penyaluran[0][pangkalan_id]" value="${pangkalan.id}">
                                                ${pangkalan.nama}

                                            </td>
                                            <td class="alamat">
                                                ${pangkalan.alamat}
                                            </td>

                                            <td class="harga text-right">
                                                ${rupiah(harga)}
                                            </td>
                                            <td class="text-right">
                                                <input type="number" name="penyaluran[0][jumlah]"
                                                   
                                                    class="form-control text-right" data-kuota="${pangkalan.kuota}" value="${pangkalan.kuota}" min="0">
                                            </td>
                                            <td class="subtotal text-right">
                                                    ${rupiah(pangkalan.kuota * harga)}
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-link text-danger delete-penyaluran"><span class="btn-label"><i
                                                            class="la la-trash"></i></span></button>
                                            </td>
                                        </tr>`
                    if ($('#tb_penyaluran tbody tr.empty-data')) {
                        $('#tb_penyaluran tbody tr.empty-data').remove()
                    }
                    $('#tb_penyaluran tbody').append(tr)
                    reindexPenyaluran()
                    hitungTotal()
                    reloadOption()
                }

                $(this).val('').trigger('change')

            })


            $('body').on('click', '.delete-penyaluran', function() {
                if ($('#tb_penyaluran tbody tr:not(.empty-data)').length == 1) {
                    let tr = `<tr class="empty-data">
                                            <td colspan="100%" class="text-center">Tidak ada data.</td>
                                        </tr>`
                    $('#tb_penyaluran tbody').append(tr)
                }
                $(this).closest('tr').remove()
                reindexPenyaluran()
                hitungTotal()
                reloadOption()
            })

            $('body').on('change', 'input[name*="jumlah"]', function() {
                validasiInput(this)
            })
            $('body').on('keyup', 'input[name*="jumlah"]', function() {
                hitungSubtotal(this)
            })

        })
    </script>
@endpush
