@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Surat Jalan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Surat Jalan</a></li>
                        <li class="breadcrumb-item active">Buat</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content" data-pengambilan='@json($pengambilan)'>
        <div class="container-fluid pb-3">
            <form action="{{ route('surat-jalan.update', $pengambilan) }}" method="POST" class="form-horizontal">
                @csrf
                @method('PUT')
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-download mr-2"></i> Pengambilan</h3>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="form-group col-lg-6">
                                <label for="tanggal" class="col-form-label required">Tanggal</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="tanggal" name="tanggal"
                                        placeholder="Pilih Tanggal" required>
                                </div>

                            </div>

                            <div class="form-group col-lg-6">
                                <label for="sppbe_id" class="col-form-label required">SP(P)BE</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-gas-pump"></i></span>
                                    </div>
                                    <select class="form-control select2" name="sppbe_id" id="sppbe_id"
                                        data-placeholder="Pilih SPPBE" onchange="getNoSA(this)" required>
                                        <option value=""></option>
                                    </select>
                                </div>

                            </div>
                            <div class="form-group col-lg-6">
                                <label for="no_sa" class="col-form-label required">No. SA</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                                    </div>
                                    <select class="form-control select2" name="kitir_id" id="no_sa"
                                        data-placeholder="Pilih No. SA" required>
                                        <option value=""></option>
                                    </select>
                                </div>

                            </div>

                            <div class="form-group col-lg-6">
                                <label for="truk" class="col-form-label required">Truk</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-truck"></i></span>
                                    </div>
                                    <select class="form-control select2" name="truk_id" id="truk"
                                        data-placeholder="Pilih Truk" required>
                                        <option value=""></option>
                                        @foreach ($truks as $truk)
                                            <option value="{{ $truk->id }}" @selected($pengambilan->truk->id == $truk->id)>
                                                {{ $truk->plat_nomor }} </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="form-group col-lg-6">
                                <label for="sopir" class="col-form-label required">Sopir</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <select class="form-control select2" name="sopir_id" id="sopir"
                                        data-placeholder="Pilih Sopir" required>
                                        <option value=""></option>
                                        @foreach ($sopirs as $sopir)
                                            <option value="{{ $sopir->id }}" @selected($pengambilan->sopir->id == $sopir->id)>
                                                {{ $sopir->nama }} </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="form-group col-lg-6">
                                <label for="kernet" class="col-form-label required">Kernet</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <select class="form-control select2" name="kernet_id" id="kernet"
                                        data-placeholder="Pilih Kernet" required>
                                        <option value=""></option>
                                        @foreach ($kernets as $kernet)
                                            <option value="{{ $kernet->id }}" @selected($pengambilan->kernet->id == $kernet->id)>
                                                {{ $kernet->nama }} </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <div class="card card-warning">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fas fa-exchange-alt mr-2"></i> Penukaran</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb_penukaran" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 30px; vertical-align: middle"
                                            rowspan="2">
                                            No.</th>
                                        <th rowspan="2" style="min-width: 250px; vertical-align: middle">Merk & Seri
                                            Tabung
                                        </th>
                                        <th class="text-center" colspan="7">Rincian Penukaran Tabung</th>
                                        <th rowspan="2"></th>
                                    </tr>
                                    <tr>
                                        <th>Bocor Body</th>
                                        <th>Valve</th>
                                        <th>Visual</th>
                                        <th>Hand Guard</th>
                                        <th>Foot Ring</th>
                                        <th>Berat Kurang</th>
                                        <th>Isi Air</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @forelse ($pengambilan->penukarans as $key => $penukaran)
                                        <tr>
                                            <td class="no text-center">{{ $key + 1 }}</td>
                                            <td>
                                                <input type="text" class="form-control no-seri"
                                                    name="penukaran[{{ $key }}][no_seri]"
                                                    value="{{ $penukaran->no_seri }}">
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="penukaran[{{ $key }}][rincian][]"
                                                    value="bocor-body" @checked(collect($penukaran->rincian)->contains('bocor-body'))>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="penukaran[{{ $key }}][rincian][]"
                                                    value="valve" @checked(collect($penukaran->rincian)->contains('valve'))>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="penukaran[{{ $key }}][rincian][]"
                                                    value="visual" @checked(collect($penukaran->rincian)->contains('visual'))>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="penukaran[{{ $key }}][rincian][]"
                                                    value="hand-guard" @checked(collect($penukaran->rincian)->contains('hand-guard'))>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="penukaran[{{ $key }}][rincian][]"
                                                    value="foot-ring" @checked(collect($penukaran->rincian)->contains('foot-ring'))>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="penukaran[{{ $key }}][rincian][]"
                                                    value="berat-kurang" @checked(collect($penukaran->rincian)->contains('berat-kurang'))>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="penukaran[0][rincian][]" value="isi-air"
                                                    @checked(collect($penukaran->rincian)->contains('isi-air'))>
                                            </td>

                                            <td class="text-center" style="width:60px">
                                                <button type="button" class="btn btn-danger"
                                                    onclick="deletePenukaran(this)"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="no text-center">1</td>
                                            <td>
                                                <input type="text" class="form-control no-seri"
                                                    name="penukaran[0][no_seri]">
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="penukaran[0][rincian][]" value="bocor-body">
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="penukaran[0][rincian][]" value="valve">
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="penukaran[0][rincian][]" value="visual">
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="penukaran[0][rincian][]" value="hand-guard">
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="penukaran[0][rincian][]" value="foot-ring">
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="penukaran[0][rincian][]"
                                                    value="berat-kurang">
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="penukaran[0][rincian][]" value="isi-air">
                                            </td>

                                            <td class="text-center" style="width:60px">
                                                <button type="button" class="btn btn-danger"
                                                    onclick="deletePenukaran(this)"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="100%">
                                            <button type="button" class="btn btn-warning" onclick="addPenukaran()"><i
                                                    class="fas fa-plus mr-2"></i>Tambah</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                </div>

                <div class="card card-success">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fas fa-upload mr-2"></i>Penyaluran</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb_penyaluran" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="required" style="width: 260px">Nama Pangkalan</th>
                                        <th>Alamat</th>
                                        <th class="text-right" style="width: 100px">Harga</th>
                                        <th class="text-right required" style="width: 120px">Kuantitas</th>
                                        <th class="text-right" style="width: 120px">Bayar</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($pengambilan->penyalurans as $penyaluran)
                                        <tr>
                                            <td class="no text-center" style="width: 30px">{{ $loop->iteration }}</td>
                                            <td>
                                                <select name="penyaluran[{{ $loop->iteration }}][pangkalan_id]"
                                                    class="form-control pangkalan select2"
                                                    data-placeholder="Pilih Pangkalan" style="width: 100%" required>
                                                    <option value=""></option>
                                                    @foreach ($pangkalans as $pangkalan)
                                                        <option value="{{ $pangkalan->id }}"
                                                            data-alamat="{{ $pangkalan->alamat }}"
                                                            @selected($penyaluran->id == $pangkalan->id)>
                                                            {{ $pangkalan->no_reg }} -
                                                            {{ $pangkalan->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="alamat">
                                                {{ $penyaluran->alamat }}
                                            </td>
                                            <td class="harga text-right" data-val="14500">
                                                {{ rupiah(14500) }}
                                            </td>
                                            <td class="text-right" style="max-width: 80px">
                                                <input type="number" name="penyaluran[{{ $loop->iteration }}][jumlah]"
                                                    onkeyup="hitungSubtotal(this)" onchange="validasiInput(this)"
                                                    class="form-control jumlah text-right"
                                                    value="{{ $penyaluran->pivot->kuantitas }}" min="0">
                                            </td>
                                            <td class="subtotal text-right">
                                                {{ rupiah($penyaluran->pivot->kuantitas * 14500) }}
                                            </td>
                                            <td class="text-center" style="width:60px">
                                                <button type="button" class="btn btn-danger"
                                                    onclick="deletePenyaluran(this)"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot id="tfoot">
                                    <tr>
                                        <td colspan="4">
                                            <button type="button" class="btn btn-success" onclick="addPenyaluran()"><i
                                                    class="fas fa-plus mr-2"></i>Tambah</button>
                                        </td>
                                        <td id="totalBarang" class="text-right">
                                            0
                                        </td>
                                        <td id="totalHarga" class="text-right">
                                            Rp 0
                                        </td>
                                        <td></td>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>

                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i> Update</button>
                </div>
            </form>
    </section>
@endsection

@push('script')
    <script>
        const pengambilan = $('.content').data('pengambilan')

        let tanggal = pengambilan.kitir.tanggal

        function rupiah(num) {
            return 'Rp ' + num.toLocaleString("id-ID", {
                style: "decimal"
            })
        }

        const harga = parseInt(document.querySelector('.harga').dataset.val)


        function getSppbe(tanggal) {

            $('select[name=sppbe_id]').attr('disabled', true)
            $('select[name=kitir_id]').attr('disabled', true)
            $('select[name=kitir_id').html('<option value=""></option>')
            $.ajax({
                url: window.location.origin + '/surat-jalan/get-sppbe',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    tanggal: tanggal
                },
                success: function(response) {
                    if (response.success) {
                        let options = `<option value=""></option>`
                        $.each(response.data, function(key, value) {
                            options +=
                                `<option value="${value.id}" ${ pengambilan.kitir.tanggal == tanggal && value.id == pengambilan.kitir.sa.sppbe_id ?'selected' : ''} >${value.nama}</option>`
                        })
                        $('select[name=sppbe_id]').html(options)

                        if (pengambilan.kitir.tanggal == tanggal) {
                            $('select[name=sppbe_id]').trigger('change')
                        }
                    }
                },
                complete: function() {
                    $('select[name=sppbe_id]').attr('disabled', false)
                    $('select[name=kitir_id]').attr('disabled', false)
                }
            })
        }

        function getNoSA(el) {

            $('select[name=kitir_id]').attr('disabled', true)
            $.ajax({
                url: window.location.origin + '/surat-jalan/get-no-sa',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    tanggal: tanggal,
                    sppbe_id: el.value
                },
                success: function(response) {
                    let options = `<option value=""></option>`
                    $.each(response.data, function(key, value) {
                        options +=
                            `<option value="${value.id}" ${key == 0 || pengambilan.kitir.id == value.id ? 'selected' : ''} >${value.sa.no_sa} (${value.sa.tipe}) (${parseInt(value.sisa_kuota)/560}/${parseInt(value.kuota)/560})</option>`
                    })
                    $('select[name=kitir_id]').html(options)
                },
                complete: function() {
                    $('select[name=kitir_id]').attr('disabled', false)
                }
            })
        }


        // PENYALURAN 
        function validasiInput(e) {
            if (e.value == '' || e.value < e.min) {
                e.value = 0
                hitungSubtotal(e)
            }
        }

        function hitungSubtotal(e) {
            const subtotal = e.parentElement.nextElementSibling
            subtotal.innerText = rupiah(e.value * harga)
            hitungTotal()
        }

        function hitungTotal() {
            let totalBarang = 0

            const nodeJumlah = document.querySelectorAll(".jumlah")

            nodeJumlah.forEach((element, index) => {
                if (element.value != '') {
                    totalBarang += parseInt(element.value)
                }
            });
            document.getElementById('totalBarang').innerText = totalBarang
            document.getElementById('totalHarga').innerText = rupiah(totalBarang * harga)
        }

        function reindexPenyaluran() {
            const nodePangkalan = document.querySelectorAll(".pangkalan")
            const nodeJumlah = document.querySelectorAll(".jumlah")
            const nodeNomor = document.querySelectorAll("#tb_penyaluran .no")

            nodeNomor.forEach((element, index) => {
                element.innerText = index + 1
            });

            nodePangkalan.forEach((element, index) => {
                const name = element.getAttribute('name').replace(/[0-9]/g, index)
                element.setAttribute('name', name)
            });

            nodeJumlah.forEach((element, index) => {
                const name = element.getAttribute('name').replace(/[0-9]/g, index)
                element.setAttribute('name', name)
            });
        }

        function reloadOption() {
            const selects = document.querySelectorAll("table select")
            const selected = []
            selects.forEach(select => {
                if (select.value !== '') {
                    selected.push(select.value)
                }
            });

            selects.forEach(select => {
                for (let i = 0; i < select.options.length; i++) {
                    const option = select.options[i];
                    if (selected.includes(option.value) && option.value !== select.value) {
                        option.setAttribute('disabled', true)
                    } else {
                        option.removeAttribute('disabled')
                    }
                }
            });
        }

        function addPenyaluran() {
            $('#tb_penyaluran tbody tr:first-child .pangkalan').select2('destroy')
            const clone = $('#tb_penyaluran tbody tr:first-child').clone(true)

            clone.find(".pangkalan").val(null).select2({
                placeholder: "Pilih Pangkalan",
                allowClear: true
            })

            clone.find(".jumlah").val(0)
            clone.find(".alamat").text("")
            clone.find(".subtotal").text("Rp 0")

            $('#tb_penyaluran tbody').append(clone)
            $('#tb_penyaluran tbody tr:first-child .pangkalan').select2({
                placeholder: "Pilih Pangkalan",
                allowClear: true
            })
            reindexPenyaluran()
            reloadOption()
        }

        function deletePenyaluran(el) {
            if (el.closest("tbody").children.length > 1) {
                el.closest('tr').remove()
                reindexPenyaluran()
                hitungTotal()
                reloadOption()
            } else {
                $(el).closest('tr').find(".pangkalan").val(null).trigger('change')
                $(el).closest('tr').find(".jumlah").val(0)
                $(el).closest('tr').find(".alamat").text("")
                $(el).closest('tr').find(".subtotal").text("Rp 0")
                hitungTotal()
            }
        }

        // PENUKARAN 
        function reindexPenukaran() {
            const trs = document.querySelectorAll("#tb_penukaran tbody tr")

            trs.forEach((tr, index) => {
                const no_seri = tr.querySelector(".no-seri")
                const name = no_seri.getAttribute('name').replace(/[0-9]/g, index)
                tr.querySelector(".no").innerText = index + 1
                no_seri.setAttribute('name', name)

                const cbs = tr.querySelectorAll("input[type=checkbox]")
                cbs.forEach(cb => {
                    const name = cb.getAttribute('name').replace(/[0-9]/g, index)
                    cb.setAttribute('name', name)
                })


            });
        }

        function addPenukaran() {
            const clone = $('#tb_penukaran tbody tr:first-child').clone(true)
            clone.find('.no-seri').val('')
            clone.find('input[type=checkbox]').prop('checked', false);
            $("#tb_penukaran tbody").append(clone)
            reindexPenukaran()
        }

        function deletePenukaran(el) {
            if (el.closest("tbody").children.length > 1) {
                el.closest('tr').remove()
            } else {
                $(el).closest('tr').find('.no-seri').val('')
                $(el).closest('tr').find('input[type=checkbox]').prop('checked', false).prop('required', false);
            }
            reindexPenukaran()
        }

        $(document).ready(function() {

            getSppbe(pengambilan.kitir.tanggal)

            hitungTotal()
            reloadOption()

            $('#tanggal').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                autoApply: true,
                locale: {
                    format: 'DD/MM/YYYY'
                },
                startDate: new Date(pengambilan.kitir.tanggal).toLocaleDateString('en-GB')
            })

            $('.select2').select2({
                allowClear: true
            })

            $('#tanggal').on('apply.daterangepicker', function(ev, picker) {
                tanggal = picker.startDate.format('YYYY-MM-DD');
                getSppbe(tanggal)
            });

            $('.pangkalan').on('change', function() {
                let alamat = $(this).find('option:selected').data('alamat');
                if (alamat) {
                    $(this).closest('tr').find('.alamat').text(alamat)
                } else {
                    $(this).closest('tr').find('.alamat').text('')
                }
                reloadOption()
            })

            $('.no-seri').on('change', function() {
                const cbx_group = $(this).closest('tr').find('input[type=checkbox]')
                if (this.value != '') {
                    cbx_group.prop('required', true);
                } else {
                    cbx_group.prop('required', false);
                }
            })

            $('input[type=checkbox]').on('change', function() {
                const cbx_group = $(this).closest('tr').find('input[type=checkbox]')
                if (cbx_group.is(':checked')) {
                    cbx_group.prop('required', false)
                    if ($(this).closest('tr').find('.no-seri').val() == '') {
                        $(this).closest('tr').find('.no-seri').prop('required', true)
                    }

                } else {
                    if ($(this).closest('tr').find('.no-seri').val() == '') {
                        $(this).closest('tr').find('.no-seri').prop('required', false)
                    } else {
                        cbx_group.prop('required', true)
                    }
                }
            })

        })
    </script>
@endpush

