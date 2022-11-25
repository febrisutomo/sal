@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <h4 class="page-title">Tambah Truk</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="la la-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="la la-angle-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{route('armada.truk.index')}}">Truk</a>
                </li>
                <li class="separator">
                    <i class="la la-angle-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Tambah</a>
                </li>
            </ul>


        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('armada.truk.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="card">

                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="form-group form-show-validation">
                                        <label for="kode" class="required">Kode</label>
                                        <input type="text" class="form-control @error('kode') is-invalid @enderror"
                                            id="kode" name="kode" placeholder="Masukkan Kode"
                                            value="{{ old('kode') }}" required>
                                        @error('kode')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group form-show-validation">
                                        <label for="merk" class="required">Merk / Type</label>
                                        <input type="text" class="form-control @error('merk') is-invalid @enderror"
                                            id="merk" name="merk" placeholder="Masukkan Merk / Type"
                                            value="{{ old('merk') }}" required>
                                        @error('merk')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group form-show-validation">
                                        <label for="plat_nomor" class="required">Pat Nomor</label>
                                        <input type="text" class="form-control @error('plat_nomor') is-invalid @enderror"
                                            id="plat_nomor" name="plat_nomor" placeholder="Masukkan Pat Nomor"
                                            value="{{ old('plat_nomor') }}" required>
                                        @error('plat_nomor')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group form-show-validation">
                                        <label for="kapasitas" class="required">Kapasitas</label>
                                        <input type="text" class="form-control @error('kapasitas') is-invalid @enderror"
                                            id="kapasitas" name="kapasitas" placeholder="Masukkan Kapasitas"
                                            value="{{ old('kapasitas') }}" required>
                                        @error('kapasitas')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group form-show-validation">
                                        <label for="sopir_id" class="required">Sopir</label>
                                        <select class="form-control select2  @error('sopir_id') is-invalid @enderror"
                                            id="sopir_id" name="sopir_id" placeholder="Pilih Sopir"
                                            data-placeholder="Pilih Sopir" required>
                                            <option value=""></option>
                                            @foreach ($sopirs as $sopir)
                                                <option value="{{ $sopir->id }}" @selected(old('sopir_id') == $sopir->id)>
                                                    {{ $sopir->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('sopir_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group form-show-validation">
                                        <label for="kernet_id" class="required">Kernet</label>
                                        <select class="form-control select2  @error('kernet_id') is-invalid @enderror"
                                            id="kernet_id" name="kernet_id" placeholder="Pilih Kernet"
                                            data-placeholder="Pilih Kernet" required>
                                            <option value=""></option>
                                            @foreach ($kernets as $kernet)
                                                <option value="{{ $kernet->id }}" @selected(old('kernet_id') == $kernet->id)>
                                                    {{ $kernet->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('kernet_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>



                            </div>


                        </div>
                        <div class="card-footer">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary"><span class="btn-label"><i
                                            class="la la-save mr-1"></i></span>Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
