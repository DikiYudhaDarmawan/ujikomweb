@extends('layouts.admin')
@section('content')
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Form Input user</h6>
        </div>
        <div class="card-body px-4 pt-3">
            <form action="{{ route('user.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-control-label">Nama </label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Masukkan nama ">
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" class="form-control-label">Email</label>
                            <input class="form-control" id="email" name="email" rows="3"
                                placeholder="Masukkan email"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password" class="form-control-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="masukan password">
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="role" class="form-control-label">Role</label>
                            <select class="form-select" id="role" name="role">
                                <option value="" selected disabled>Pilih role</option>
                                <option value="pembina">pembina</option>
                                <option value="siswa">siswa</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- jika memiliki role siswa --}}
                <div id="siswaForm" style="display: none;">
                    <div class="row form-group mb-3">
                        <label class="mb-2">Jenis Kelamin</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin"
                                    value="L">
                                <label class="form-check-label" for="jenis_kelamin1">
                                    laki-laki
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin"
                                    value="P">
                                <label class="form-check-label" for="jenis_kelamin2">
                                    perempuan
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <select class="form-control" name="kelas_id" id="kelas_id" >
                            <option value="">Pilih Kelas</option>
                            @foreach ($kelas as $data)
                                <option value="{{ $data->id }}">{{ $data->tingkat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <select class="form-control" name="jurusan_id" id="jurusan_id" >
                            <option value="">Pilih Jurusan</option>
                            @foreach ($jurusans as $data)
                                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <select class="form-control" name="gelombang_belajar_id" id="gelombang_belajar_id" >
                            <option value="">Pilih Gelombang Belajar</option>
                            @foreach ($gelombang_belajars as $data)
                                <option value="{{ $data->id }}">{{ $data->gelombang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="text" name="nomor_telp" id="nomor_telp" class="form-control">
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <button type="submit" class="btn bg-gradient-primary">Simpan</button>
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
        </div>
        </form>
        <script>
            document.querySelector('select[name="role"]').addEventListener('change', function() {
                const siswaForm = document.getElementById('siswaForm');
                siswaForm.style.display = this.value === 'siswa' ? 'block' : 'none';
            });
        </script>
    </div>
@endsection
