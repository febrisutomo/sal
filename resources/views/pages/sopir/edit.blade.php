@extends('layouts.app', ['title' => 'Edit Sopir'])

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <h4 class="page-title">Edit Sopir</h4>
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
                    <a href="{{ route('armada.sopir.index') }}">Sopir</a>
                </li>
                <li class="separator">
                    <i class="la la-angle-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Edit</a>
                </li>
            </ul>


        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('armada.sopir.update', $sopir) }}" method="POST" class="needs-validation" novalidate
                    autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">

                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="form-group form-show-validation">
                                        <label for="nama" class="required">Nama</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            id="nama" name="nama" placeholder="Masukkan Nama"
                                            value="{{ old('nama', $sopir->nama) }}" required>
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group form-show-validation">
                                        <label for="no_hp" class="required">No. HP</label>
                                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                            id="no_hp" name="no_hp" placeholder="Masukkan No. HP"
                                            value="{{ old('no_hp', $sopir->no_hp) }}" required>
                                        @error('no_hp')
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
                                            id="alamat" name="alamat" placeholder="Masukkan Alamat"
                                            value="{{ old('alamat', $sopir->alamat) }}" required>
                                        @error('alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group form-show-validation">
                                        <label for="tanda tangan" class="required">Tanda Tangan</label>

                                        <div class="img-preview-container">
                                            <div class="d-flex align-items-start">
                                                <img src="{{asset('img/sopir/'.$sopir->ttd)}}" alt="" class="img-preview img-thumbnail"
                                                    width="200px">
                                                <button type="button" class="btn btn-sm btn-danger btn-delete p-1 ml-1"><span
                                                        class="btn-label"><i class="la la-trash"></i></span></button>
                                            </div>
                                            <label>{{ $sopir->ttd }}</label>
                                        </div>

                                        <input type="file" name="ttd" class="d-none" accept="image/*" required>

                                        <div>
                                            <button type="button" class="btn btn-dark btn-upload" style="display: none"><span
                                                    class="btn-label"><i
                                                        class="la la-upload mr-1"></i></span>Upload</button>
                                        </div>

                                        @error('ttd')
                                            <small class="text-danger mt-2">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                        {{-- <div class="input-file input-file-image">
                                            <img class="img-upload-preview" width="150" src="" alt="preview"
                                                hidden>
                                            <input type="file" class="form-control form-control-file" id="uploadImg"
                                                name="uploadImg" accept="image/*" required="">
                                            <label for="uploadImg"
                                                class=" label-input-file btn btn-icon btn-default btn-round btn-lg"><i
                                                    class="la la-file-image-o"></i>Upload</label>
                                        </div> --}}
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
                        $('.img-preview-container label').text(file.name)
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
