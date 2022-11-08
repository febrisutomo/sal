@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Buat Surat Jalan</h1>
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
    <section class="content">
        <div class="container-fluid pb-3">
            <form action="{{ route('surat-jalan.store') }}" method="POST" class="form-horizontal">
                @csrf
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-gas-pump mr-2"></i> Pengambilan</h3>
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
                                <label for="armada" class="col-form-label required">Armada</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-truck"></i></span>
                                    </div>
                                    <select class="form-control select2" name="armada_id" id="armada"
                                        data-placeholder="Pilih Armada" required>
                                        <option value=""></option>
                                        @foreach ($armadas as $armada)
                                            <option value="{{ $armada->id }}"> {{ $armada->plat_nomor }} </option>
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
                                        data-placeholder="Pilih No. sopir" required>
                                        <option value=""></option>
                                        @foreach ($sopirs as $sopir)
                                            <option value="{{ $sopir->id }}"> {{ $sopir->nama }} </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <div class="card card-success">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fas fa-random mr-2"></i>Penyaluran</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb_penyaluran" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="required">Pangkalan</th>
                                        <th class="text-right">Harga</th>
                                        <th class="text-right required">Kuantitas</th>
                                        <th class="text-right">Bayar</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td class="no text-center" style="width: 30px">1</td>
                                        <td>
                                            <select name="penyaluran[0][pangkalan_id]"
                                                class="form-control pangkalan select2" data-placeholder="Pilih Pangkalan"
                                                onchange="reloadOption()" style="width: 100%" required>
                                                <option value=""></option>
                                                @foreach ($pangkalans as $pangkalan)
                                                    <option value="{{ $pangkalan->id }}">{{ $pangkalan->no_reg }} -
                                                        {{ $pangkalan->nama }}</option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td class="harga text-right" data-val="14500">
                                            Rp 14.500,00
                                        </td>
                                        <td class="text-right" style="max-width: 80px">
                                            <input type="number" name="penyaluran[0][jumlah]"
                                                onkeydown="hitungSubtotal(this)" onchange="validasiInput(this)"
                                                class="form-control jumlah text-right" value="0" min="0">
                                        </td>
                                        <td class="subtotal text-right">
                                            Rp 0,00
                                        </td>
                                        <td class="text-center" style="width:60px">
                                            <button type="button" class="btn btn-danger"
                                                onclick="deletePenyaluran(this)"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot id="tfoot">
                                    <tr>
                                        <td colspan="3">
                                            <button type="button" class="btn btn-success" onclick="addPenyaluran()"><i
                                                    class="fas fa-plus mr-2"></i>Tambah</button>
                                        </td>
                                        <td id="totalBarang" class="text-right">
                                            0
                                        </td>
                                        <td id="totalHarga" class="text-right">
                                            Rp 0,00
                                        </td>
                                        <td></td>
                                    </tr>
                                </tfoot>

                            </table>
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
                                    <tr>
                                        <td class="no text-center">1</td>
                                        <td>
                                            <input type="text" class="form-control no-seri" name="penukaran[0][no_seri]">
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
                                            <input type="checkbox" name="penukaran[0][rincian][]" value="berat-kurang">
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="penukaran[0][rincian][]" value="isi-air">
                                        </td>

                                        <td class="text-center" style="width:60px">
                                            <button type="button" class="btn btn-danger"
                                                onclick="deletePenukaran(this)"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
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

                <div class="text-center">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i> Simpan</button>
                </div>
            </form>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function() {

            $('#tanggal').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                autoApply: true,
                locale: {
                    format: 'DD/MM/YYYY'
                },
            })

            $('.select2').select2({
                allowClear: true
            })

            $('#tanggal').on('apply.daterangepicker', function(ev, picker) {
                console.log(picker.startDate.format('YYYY-MM-DD'));
                getSA(picker.startDate.format('YYYY-MM-DD'))
            });

        })

        function rp(num) {
            return num.toLocaleString("id-ID", {
                style: "currency",
                currency: "IDR",
            })
        }

        const harga = parseInt(document.querySelector('.harga').dataset.val)

        function getSA(tanggal) {

            $('select[name=kitir_id]').attr('disabled', true)
            $.ajax({
                url: 'create/' + tanggal,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        let options = `<option value=""></option>`
                        $.each(response.data, function(key, value) {
                            options +=
                                `<option value="${value.id}" ${value.sisa_kuota <= 0 ? 'disabled' : ''} > ${value.sa.no_sa} (${value.sa.tipe}) - ${value.sa.sppbe.nama} (${value.sisa_kuota} dari ${value.kuota})  </option>`
                        })
                        $('select[name=kitir_id]').html(options)

                    }
                },
                complete: function() {
                    $('select[name=kitir_id]').attr('disabled', false)
                }
            })
        }

        getSA()


        // PENYALURAN 
        function validasiInput(e) {
            if (e.value == '' || e.value < e.min) {
                e.value = 0
                hitungSubtotal(e)
            }
        }

        function hitungSubtotal(e) {
            const subtotal = e.parentElement.nextElementSibling
            subtotal.innerText = rp(e.value * harga)
            hitungTotal()
        }

        function hitungTotal() {
            let totalBarang = 0

            const nodePangkalan = document.querySelectorAll(".pangkalan")
            const nodeJumlah = document.querySelectorAll(".jumlah")
            const nodeNomor = document.querySelectorAll(".no")

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
                if (element.value != '') {
                    totalBarang += parseInt(element.value)
                }
            });
            document.getElementById('totalBarang').innerText = totalBarang
            document.getElementById('totalHarga').innerText = rp(totalBarang * harga)
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
            clone.find(".subtotal").text("Rp 0,00")

            $('#tb_penyaluran tbody').append(clone)
            $('#tb_penyaluran tbody tr:first-child .pangkalan').select2({
                placeholder: "Pilih Pangkalan",
                allowClear: true
            })
            reloadOption()
            hitungTotal()
        }

        function deletePenyaluran(el) {
            if (el.closest("tbody").children.length > 1) {
                el.closest('tr').remove()
                hitungTotal()
                reloadOption()
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
            const cbs = clone.find('input[type=checkbox]')
            cbs.each(function(){
                $(this).prop('checked', false);
            })
            $("#tb_penukaran tbody").append(clone)
            reindexPenukaran()
        }

        function deletePenukaran(el) {
            if (el.closest("tbody").children.length > 1) {
                el.closest('tr').remove()
            }
            reindexPenukaran()
        }
    </script>
@endpush

@push('style')
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        .select2-results__options .select2-results__option[aria-disabled="true"] {
            color: red;
        }
    </style>
@endpush
