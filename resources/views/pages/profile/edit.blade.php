@extends('layouts.app', ['title' => 'Profil Saya'])

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <h4 class="page-title">Profil Saya</h4>
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
                    <a href="#">Profil Saya</a>
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
            <div class="col-md-6">
                <form action="{{ route('profile.update')}}" method="POST" class="needs-validation" novalidate autocomplete="off"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">

                        <div class="card-header">
                            <h4 class="card-title">Ubah Profil</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group ">
                                <label for="name" class="required">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Masukkan name"
                                    value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="form-group ">
                                <label for="email" class="required">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="Masukkan Email"
                                    value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="form-group ">
                                <label for="phone">No. HP</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" placeholder="Masukkan No. HP" value="{{ old('phone', $user->phone) }}"
                                    required>
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

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
            <div class="col-md-6">
                <form action="{{ route('profile.update-password')}}" method="POST" class="needs-validation" novalidate autocomplete="off"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Ubah Password</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="current-password" class="required">Password Saat Ini</label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                    id="current-password" name="current_password" placeholder="Masukkan Password Saat Ini" required>
                                @error('current_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="new-password" class="required">Password Baru</label>
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                    id="new-password" name="new_password" placeholder="Masukkan Password Baru" required>
                                @error('new_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="password-confirm" class="required">Konfirmasi Password</label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="password-confirm" name="new_password_confirmation" placeholder="Masukkan Konfirmasi Password" required >

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
