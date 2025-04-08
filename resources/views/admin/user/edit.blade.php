@extends('layouts.admin')
@section('content')
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Edit Data User</h6>
        </div>
        <div class="card-body px-4 pt-3">
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-control-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $user->name }}" placeholder="Masukkan nama">
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" class="form-control-label">Email</label>
                            <input class="form-control" id="email" name="email" 
                                value="{{ $user->email }}" placeholder="Masukkan email">
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password" class="form-control-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Masukkan password baru (kosongkan jika tidak ingin mengubah)">
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="role" class="form-control-label">Role</label>
                            <select class="form-select" id="role" name="role">
                                <option value="" disabled>Pilih role</option>
                                <option value="pembina" {{ $user->role === 'pembina' ? 'selected' : '' }}>pembina</option>
                                <option value="siswa" {{ $user->role === 'siswa' ? 'selected' : '' }}>siswa</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="siswaForm" style="display: {{ $user->role === 'siswa' ? 'block' : 'none' }}">
                    <div class="row form-group mb-3">
                        <label class="mb-2">Jenis Kelamin</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin"
                                    value="L" {{ $user->jenis_kelamin === 'L' ? 'checked' : '' }}>
                                <label class="form-check-label" for="jenis_kelamin1">
                                    laki-laki
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin"
                                    value="P" {{ $user->jenis_kelamin === 'P' ? 'checked' : '' }}>
                                <label class="form-check-label" for="jenis_kelamin2">
                                    perempuan
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Kelas</label>
                        <input type="text" name="kelas" id="kelas" class="form-control" 
                            value="{{ $user->kelas }}">
                    </div>

                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="text" name="nomor_telp" id="nomor_telp" class="form-control"
                            value="{{ $user->nomor_telp }}">
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <button type="submit" class="btn bg-gradient-primary">Simpan Perubahan</button>
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.querySelector('select[name="role"]').addEventListener('change', function() {
            const siswaForm = document.getElementById('siswaForm');
            siswaForm.style.display = this.value === 'siswa' ? 'block' : 'none';
        });
    </script>
@endsection
