@extends('layouts.app', ['title' => 'Pengaturan'])

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <h4 class="page-title">Pengaturan</h4>
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
                    <a href="#">Pengaturan</a>
                </li>
                {{-- <li class="separator">
                    <i class="la la-angle-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Edit</a>
                </li> --}}
            </ul>


        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('setting.update') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate >
                    @csrf
                    @method('PUT')
                    <div class="card">

                        <div class="card-body">
                            <div class="row mb-3">
                               
                                <div class="col-lg-6">
                                    <div class="form-group form-show-validation">
                                        <label for="email" class="required">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" placeholder="Masukkan Email"
                                            value="{{ old('email', $setting->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group form-show-validation">
                                        <label for="telepon" class="required">No. Telepon</label>
                                        <input type="text" class="form-control @error('telepon') is-invalid @enderror"
                                            id="telepon" name="telepon" placeholder="Masukkan No. Telepon"
                                            value="{{ old('telepon', $setting->telepon) }}" required>
                                        @error('telepon')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>

                              

                                <div class="col-lg-6">
                                    <div class="form-group form-show-validation">
                                        <label for="nama_manager" class="required">Nama Manager</label>
                                        <input type="text"
                                            class="form-control @error('nama_manager') is-invalid @enderror"
                                            id="nama_manager" name="nama_manager" placeholder="Masukkan Nama Manager"
                                            value="{{ old('nama_manager', $setting->nama_manager) }}" required>
                                        @error('nama_manager')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group form-show-validation">
                                        <label for="ttd_manager" class="required">TTD Manager</label>
                                        <div class="img-preview-container">
                                            <div class="d-flex align-items-start">
                                                <img src="{{ asset('img/' . $setting->ttd_manager) }}" alt=""
                                                    class="img-preview img-thumbnail" width="200px">
                                                <button type="button"
                                                    class="btn btn-sm btn-danger btn-delete p-1 ml-1"><span
                                                        class="btn-label"><i class="la la-trash"></i></span></button>
                                            </div>
                                            {{-- <label>{{ $setting->ttd_manager }}</label> --}}
                                        </div>

                                        <input type="file" name="ttd_manager" class="d-none" accept="image/*" required>

                                        <div>
                                            <button type="button" class="btn btn-dark btn-upload"
                                                style="display: none"><span class="btn-label"><i
                                                        class="la la-upload mr-1"></i></span>Upload</button>
                                        </div>

                                        @error('ttd_manager')
                                            <small class="text-danger mt-2">
                                                {{ $message }}
                                            </small>
                                        @enderror

                                    </div>
                                </div>

                                


                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="form-group form-show-validation">
                                        <label for="stok_awal" class="required">Stok Awal</label>
                                        <input type="number"
                                            class="form-control @error('stok_awal') is-invalid @enderror"
                                            id="stok_awal" name="stok_awal" placeholder="Masukkan Stok Awal"
                                            value="{{ old('stok_awal', $setting->stok_awal) }}" required>
                                        @error('stok_awal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group form-show-validation">
                                        <label for="harga" class="required">Harga /tabung</label>
                                        <input type="number"
                                            class="form-control @error('harga') is-invalid @enderror"
                                            id="harga" name="harga" placeholder="Masukkan Harga Tabung Gas"
                                            value="{{ old('harga', $setting->harga) }}" required>
                                        @error('harga')
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


@push('script')
    <script>
        $(document).ready(function() {

            $('.btn-upload').on('click', function() {
                $('input[type=file]').click()
            })
            $('input[type=file]').change(function() {
                const file = this.files[0];
                // console.log(file);
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        $('.img-preview').attr('src', event.target.result);
                        // $('.img-preview-container label').text(file.name)
                        $('.img-preview-container').show()
                        $('.btn-upload').hide()
                    }
                    reader.readAsDataURL(file);
                }
            });

            $('body').on('click', '.btn-delete', function() {
                $('input[type=file]').val('')
                $('.img-preview-container').hide()
                $('.btn-upload').show()
            })
        })
    </script>
@endpush
