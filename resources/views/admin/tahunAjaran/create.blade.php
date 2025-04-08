@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/tombolSwitch.css') }}">
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Form Input Pengumuman</h6>
        </div>
        <div class="card-body px-4 pt-3">
            <form action="{{ route('tahunAjaran.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama" class="form-control-label">Tahun Ajaran</label>
                            <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran"
                                placeholder="Masukkan tahun ajaran">
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="semester" class="form-control-label">Semester</label>
                            <select class="form-control" id="semester" name="semester">
                                <option value="" selected>pilih semester</option>
                                <option value="Ganjil">Ganjil</option>
                                <option value="Genap">Genap</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-md-12">
                        <!-- Rounded switch -->
                        <label for="status" class="form-control-label">Status</label><br>
                        <label class="switch">
                            <input type="checkbox" name="status" value="1"
                                {{ old('status', $tahunAjaran->status ?? 0) ? 'checked' : '' }}>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <button type="submit" class="btn bg-gradient-primary">Simpan</button>
                        <a href="{{ route('tahunAjaran.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
