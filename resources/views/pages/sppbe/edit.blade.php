@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <h4 class="page-title">Edit SP(P)BE</h4>
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
                    <a href="#">SP(P)BE</a>
                </li>
                <li class="separator">
                    <i class="la la-angle-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Edit</a>
                </li>
            </ul>
            <div class="ml-auto">


            </div>


        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('sppbe.update', $sppbe) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="card">

                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="form-group form-show-validation">
                                        <label for="nama" class="required">Nama</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            id="nama" name="nama" placeholder="Masukkan nama"
                                            value="{{ old('nama', $sppbe->nama) }}" required>
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group form-show-validation">
                                        <label for="kode" class="required">Kode</label>
                                        <input type="text" class="form-control  @error('kode') is-invalid @enderror"
                                            id="kode" name="kode" placeholder="Masukkan kode"
                                            value="{{ old('kode', $sppbe->kode) }}" required>
                                        @error('kode')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group form-show-validation">
                                        <label for="no_sh" class="required">No. SH</label>
                                        <input type="text" class="form-control @error('no_sh') is-invalid @enderror"
                                            id="no_sh" name="no_sh" placeholder="Masukkan No. SH" value="{{old('no_sh', $sppbe->no_sh)}}" required>
                                        @error('no_sh')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group form-show-validation">
                                        <label for="plant" class="required">Plant</label>
                                        <input type="text" class="form-control @error('plant') is-invalid @enderror"
                                            id="plant" name="plant" placeholder="Masukkan plant" value="{{old('plant', $sppbe->plant)}}" required>
                                        @error('plant')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group form-show-validation">
                                        <label for="alamat" class="required">Alamat</label>
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                            id="alamat" name="alamat" placeholder="Masukkan alamat" value="{{old('alamat', $sppbe->alamat)}}" required>
                                        @error('alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group form-show-validation">
                                        <label for="no_hp" class="required">No. Telepon</label>
                                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                            id="no_hp" name="no_hp" placeholder="Masukkan No. telepon" value="{{old('no_hp', $sppbe->no_hp)}}" required>
                                        @error('no_hp')
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
