@extends('layouts.admin')
@section('content')
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Form Input Ekskul</h6>
        </div>
        <div class="card-body px-4 pt-3">
            <form action="{{ route('ekskul.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="foto" class="form-label">Logo Ekskul</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">  
                            <label for="nama" class="form-control-label">Nama Ekskul</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Masukkan nama ekskul">
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="deskripsi" class="form-control-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="3"
                                placeholder="Masukkan deskripsi ekskul"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pembina_id" class="form-control-label">Nama Pembina</label>
                            <select class="form-select" id="pembina_id" name="pembina_id" required>
                                <option value="" selected disabled>Pilih Pembina</option>
                                @foreach ($pembina_id as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="activity_date" class="form-control-label">Hari Pelaksanaan</label>
                            <select class="form-select" id="activity_date" name="activity_date">
                                <option value="" selected disabled>Pilih hari</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="jam_mulai" class="form-control-label">Jam Mulai</label>
                            <input type="time" class="form-control" id="start_time" name="start_time">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="jam_selesai" class="form-control-label">Jam Selesai</label>
                            <input type="time" class="form-control" id="end_time" name="end_time">
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="activity_date2" class="form-control-label">Hari Pelaksanaan kedua (opsional)</label>
                            <select class="form-select" id="activity_date2" name="activity_date2">
                                <option value="" selected disabled>Pilih hari</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="jam_mulai" class="form-control-label">Jam Mulai</label>
                            <input type="time" class="form-control" id="start_time2" name="start_time2">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="jam_selesai" class="form-control-label">Jam Selesai</label>
                            <input type="time" class="form-control" id="end_time2" name="end_time2">
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_pembina" class="form-control-label">lokasi</label>
                            <input type="text" class="form-control" id="location" name="location"
                                placeholder="Masukkan nama lokasi">
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <button type="submit" class="btn bg-gradient-primary">Simpan</button>
                        <a href="{{ route('ekskul.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
