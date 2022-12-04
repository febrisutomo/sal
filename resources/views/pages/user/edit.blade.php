@extends('layouts.app', ['title' => 'Edit Pengguna'])

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <h4 class="page-title">Edit Pengguna</h4>
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
                    <a href="{{ route('user.index') }}">Pengguna</a>
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
            <div class="col-md-6">
                <form action="{{ route('user.update', $user) }}" method="POST" class="needs-validation" novalidate
                    autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">

                        <div class="card-header">
                            <h4 class="card-title">Ubah Profil</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
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
                            <div class="mb-3">
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
                            <div class="mb-3">
                                <label for="phone">No. HP</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" placeholder="Masukkan No. HP"
                                    value="{{ old('phone', $user->phone) }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label for="role">Role</label>
                                <select class="form-control" id="role" name="role" required>
                                    <option value="admin" @selected(old('role') == 'admin' || $user->role == 'admin')>Admin</option>
                                    <option value="manager" @selected(old('role') == 'manager' || $user->role == 'manager')>Manager</option>
                                    <option value="pegawai" @selected(old('role') == 'pegawai' || $user->role == 'pegawai')>Pegawai</option>
                                </select>

                            </div>

                            <div class="mb-3">
                                <label for="is_active">Status</label>
                                <select class="form-control" id="is_active" name="is_active" required>
                                    <option value="1" @selected(old('is_active') == '1' || $user->is_active == 1)>Aktif</option>
                                    <option value="0" @selected(old('is_active') == '0' || $user->is_active == 0)>Tidak Aktif</option>
                                </select>

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
                <form action="{{ route('user.update-password', $user) }}" method="POST" class="needs-validation" novalidate
                    autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Ubah Password</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="new-password" class="required">Password Baru</label>
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                    id="new-password" name="new_password" placeholder="Masukkan Password Baru" required>
                                @error('new_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label for="password-confirm" class="required">Konfirmasi Password</label>
                                <input type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="password-confirm" name="new_password_confirmation"
                                    placeholder="Masukkan Konfirmasi Password" required>

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
