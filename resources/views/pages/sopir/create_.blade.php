@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <h4 class="page-title">Tambah Sopir</h4>
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
                                        <label for="no_hp" class="required">No. HP</label>
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
                                        <label for="alamat" class="required">Alamat</label>
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

                                        {{-- <div class="img-preview-container" style="display: none">
                                            <div class="d-flex align-items-start">
                                                <img src="" alt="" class="img-preview img-thumbnail"
                                                    width="200px">
                                                <button type="button" class="btn btn-sm btn-danger btn-delete ml-1"><span
                                                        class="btn-label"><i class="la la-trash"></i></span></button>
                                            </div>
                                        </div>

                                        <input type="file" name="ttd" class="d-none" accept="image/*" required>

                                        <div>
                                            <button type="button" class="btn btn-dark btn-upload"><span
                                                    class="btn-label"><i
                                                        class="la la-upload mr-1"></i></span>Upload</button>
                                        </div> --}}

                                        <div class="img-preview-container" style="{{ old('ttd') ? '' : 'display: none' }}">
                                            <div class="d-flex align-items-start">
                                                <div>
                                                    <img src="{{ old('ttd') ? asset('img/' . old('ttd')) : '#' }}"
                                                        alt="" class="img-preview border d-block" width="200px"
                                                        style="background-color: lightgray">
                                                    <label for=""></label>
                                                </div>

                                                <button type="button"
                                                    class="btn btn-sm btn-danger btn-remove ml-1 p-1"><span
                                                        class="btn-label"><i class="la la-trash"></i></span></button>
                                            </div>
                                        </div>

                                        <input type="hidden" name="ttd" value="{{ old('ttd')}}">

                                        <div>
                                            <button type="button" class="btn btn-dark btn-upload"
                                                style="{{ old('ttd') ? 'display: none' : '' }}"><span class="btn-label"><i
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

    <div class="modal fade modal-upload" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Foto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="">Silahkan pilih foto yang tersedia atau upload baru</h6>
                    <form action="{{ route('dropzone.store') }}" method="post" enctype="multipart/form-data"
                        class="dropzone mb-3" id="media-dropzone">
                        @csrf

                    </form>

                    <div class="media-container row">

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        Dropzone.autoDiscover = false;
        $(document).ready(function() {

            $('.btn-upload').on('click', function() {
                $('.modal-upload').modal('show')
            })


            function getFiles() {
                $.ajax({
                    url: '{{ route('dropzone.index') }}',
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            // $('.media-all').prepend(response.media);
                            let img = ''
                            response.files.forEach((val, i) => {
                                img +=
                                    ` <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                                <div class="card rounded p-2 position-relative card-img" style="background-color: lightgray; cursor: pointer">
                                    <button type="button" class="btn btn-sm btn-danger p-1 btn-delete position-absolute" style="right: -6px; top:-6px"><span
                                            class="btn-label"><i class="la la-trash"></i></span></button>
                                    <img class="img-fluid mb-2" src="${window.location.origin}/img/${val}" />
                                    <label class="truncate-2">${val}</label>
                                </div>

                            </div>`

                            })
                            $('.media-container').html(img)
                        }
                    }
                })
            }

            

            $('body').on('click', '.btn-delete', function(e) {
                e.stopPropagation()
                let file = $(this).siblings('label').text().trim()
                swal.fire({
                    title: 'Apakah anda yakin?',
                    text: file,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batalkan'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: window.location.origin + '/dropzone/' + file,
                            type: 'DELETE',
                            success: function(response) {
                                if (response.success) {
                                    Toast.fire({
                                        icon: 'success',
                                        title: response.message,
                                    })
                                    getFiles()
                                }
                            }
                        })
                    }
                })

            })

            $('body').on('click', '.card-img', function() {
                let file = $(this).children('label').text().trim()
                let src = window.location.origin + '/img/' + file
                $('.modal-upload').modal('hide')
                $('.img-preview-container').show()
                $('.img-preview-container label').text(file)
                $('.btn-upload').hide()
                $('.img-preview').attr('src', src)
                $('input[name="ttd"]').val(file)

            })

            $('body').on('click', '.btn-remove', function() {
                $('.modal-upload').modal('hide')
                $('.img-preview-container').hide()
                $('.btn-upload').show()
                $('.img-preview').attr('src', '')
                $('input[name="ttd"]').val('')
            })



            $("#media-dropzone").dropzone({
                addRemoveLinks: false,
                acceptedFiles: "image/*",
                maxFilesize: 5,
                autoProcessQueue: true,
                dictDefaultMessage: 'Drop files here or click here to upload',
                init: function() {
                    getFiles()
                },
                success: function(file, response) {
                    if (response.success) {
                        Toast.fire({
                            icon: 'success',
                            title: response.message,
                        })
                        getFiles()
                    }
                    // this.removeFile(file);
                },
                error: function(file, response) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Gagal mengupload file!',
                    })
                    this.removeFile(file);
                }
            })
        })
    </script>
@endpush

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
@endpush
