@extends('layouts.app', ['title' => 'Tambah Sopir'])

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <h4 class="page-title">Tambah Sopir</h4>
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
                    <a href="#">Tambah</a>
                </li>
            </ul>


        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('armada.sopir.store') }}" method="POST" class="needs-validation" novalidate
                    autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="card">

                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="form-group form-show-validation">
                                        <label for="nama" class="required">Nama</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            id="nama" name="nama" placeholder="Masukkan Nama"
                                            value="{{ old('nama') }}" required>
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group form-show-validation">
                                        <label for="no_hp">No. HP</label>
                                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                            id="no_hp" name="no_hp" placeholder="Masukkan No. HP"
                                            value="{{ old('no_hp') }}" required>
                                        @error('no_hp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group form-show-validation">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                            id="alamat" name="alamat" placeholder="Masukkan Alamat"
                                            value="{{ old('alamat') }}" required>
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

                                        <div class="img-preview-container" style="display: none">
                                            <div class="d-flex align-items-start">
                                                    <img src="#" class="img-preview img-thumbnail d-block"
                                                    width="200px">
                                                
                                                <button type="button" class="btn btn-sm btn-danger btn-delete p-1 ml-1"><span
                                                        class="btn-label"><i class="la la-trash"></i></span></button>
                                            </div>
                                            <label></label>
                                        </div>

                                        <input id="inputImage" type="file" name="ttd" class="d-none" accept="image/*" required>

                                        <div>
                                            <button type="button" class="btn btn-dark btn-upload"><span
                                                    class="btn-label"><i
                                                        class="la la-upload mr-1"></i></span>Upload</button>
                                        </div>

                                        @error('ttd')
                                            <small class="text-danger mt-2">
                                                {{ $message }}
                                            </small>
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
                $('#inputImage').click()
            })

            $('#inputImage').change(function() {
                const file = this.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        $('.img-preview').attr('src', event.target.result);
                        $('.img-preview-container').show()
                        $('.img-preview-container label').text(file.name)
                        $('.btn-upload').hide()
                    }
                    reader.readAsDataURL(file);
                }
            });

            $('body').on('click', '.btn-delete', function() {
                $('#inputImage').val('')
                $('.img-preview-container').hide()
                $('.btn-upload').show()
            })
            
        })
    </script>
@endpush
{{-- 
@push('style')
    <style>
        .truncate-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            width: 100%;
            overflow: hidden;
        }
        /* .dropzone {
            height: 80px;

        }
        .dropzone .dz-message {
            margin: 0;
        } */
    </style>
@endpush --}}
