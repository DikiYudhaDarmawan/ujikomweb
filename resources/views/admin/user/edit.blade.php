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
                                value="{{ old('name', $user->name) }}" placeholder="Masukkan nama">
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" class="form-control-label">Email</label>
                            <input class="form-control" id="email" name="email" 
                                value="{{ old('email', $user->email) }}" placeholder="Masukkan email">
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
                                <option value="pembina" {{ old('role', $user->role) === 'pembina' ? 'selected' : '' }}>pembina</option>
                                <option value="siswa" {{ old('role', $user->role) === 'siswa' ? 'selected' : '' }}>siswa</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Jika memiliki role siswa --}}

{{-- Siswa Form --}}
<div id="siswaForm" style="display: {{ old('role', $user->role) === 'siswa' ? 'block' : 'none' }};">
    <!-- Gender -->
    <div class="row form-group mb-3">
        <label class="mb-2">Jenis Kelamin</label>
        <div class="col-md-12">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jenis_kelamin" value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') === 'L' ? 'checked' : '' }}>
                <label class="form-check-label">Laki-laki</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jenis_kelamin" value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') === 'P' ? 'checked' : '' }}>
                <label class="form-check-label">Perempuan</label>
            </div>
        </div>
    </div>

    <!-- Kelas -->
    <div class="mb-3">
        <select class="form-control" name="kelas_id">
            <option value="">Pilih Kelas</option>
            @foreach ($kelas as $data)
                <option value="{{ $data->id }}" {{ old('kelas_id', $siswa->kelas_id ?? '') == $data->id ? 'selected' : '' }}>{{ $data->tingkat }}</option>
            @endforeach
        </select>
    </div>

    <!-- Jurusan -->
    <div class="mb-3">
        <select class="form-control" name="jurusan_id">
            <option value="">Pilih Jurusan</option>
            @foreach ($jurusans as $data)
                <option value="{{ $data->id }}" {{ old('jurusan_id', $siswa->jurusan_id ?? '') == $data->id ? 'selected' : '' }}>{{ $data->nama }}</option>
            @endforeach
        </select>
    </div>

    <!-- Gelombang Belajar -->
    <div class="mb-3">
        <select class="form-control" name="gelombang_belajar_id">
            <option value="">Pilih Gelombang Belajar</option>
            @foreach ($gelombang_belajars as $data)
                <option value="{{ $data->id }}" {{ old('gelombang_belajar_id', $siswa->gelombang_belajar_id ?? '') == $data->id ? 'selected' : '' }}>{{ $data->gelombang }}</option>
            @endforeach
        </select>
    </div>

    <!-- Nomor Telepon -->
    <div class="form-group">
        <label>Nomor Telepon</label>
        <input type="text" name="nomor_telp" class="form-control" value="{{ old('nomor_telp', $siswa->nomor_telp ?? '') }}">
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
