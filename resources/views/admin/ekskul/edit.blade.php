@extends('layouts.admin')

@section('content')
<div class="card mb-4">
    <div class="card-header pb-0">
        <h6>Form Edit Ekskul</h6>
    </div>
    <div class="card-body px-4 pt-3">
        <form action="{{ route('ekskul.update', $ekskuls->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Menampilkan Error Validasi -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Foto Ekskul -->
            <div class="mb-3">
                <label for="foto" class="form-label">Foto Ekskul</label>
                <input type="file" name="foto" id="foto" class="form-control" value="{{ old('foto', $ekskuls->foto) }}">
            </div>

            <!-- Nama Ekskul -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="form-control-label">Nama Ekskul</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $ekskuls->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Deskripsi Ekskul -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description" class="form-control-label">Deskripsi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $ekskuls->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Pembina -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="pembina_id" class="form-control-label">Nama Pembina</label>
                        <select class="form-select @error('pembina_id') is-invalid @enderror" id="pembina_id" name="pembina_id" required>
                            <option value="" selected disabled>Pilih Pembina</option>
                            @foreach ($pembina_id as $p)
                                <option value="{{ $p->id }}" {{ old('pembina_id', $ekskuls->pembina_id) == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                            @endforeach
                        </select>
                        @error('pembina_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Hari, Jam Mulai, Jam Selesai -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="activity_date" class="form-control-label">Hari Pelaksanaan</label>
                        <select class="form-select @error('activity_date') is-invalid @enderror" id="activity_date" name="activity_date">
                            <option value="" disabled>Pilih Hari</option>
                            <option value="Senin" {{ old('activity_date', $ekskuls->activity_date) == 'Senin' ? 'selected' : '' }}>Senin</option>
                            <option value="Selasa" {{ old('activity_date', $ekskuls->activity_date) == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                            <option value="Rabu" {{ old('activity_date', $ekskuls->activity_date) == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                            <option value="Kamis" {{ old('activity_date', $ekskuls->activity_date) == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                            <option value="Jumat" {{ old('activity_date', $ekskuls->activity_date) == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                            <option value="Sabtu" {{ old('activity_date', $ekskuls->activity_date) == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                        </select>
                        @error('activity_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="start_time" class="form-control-label">Jam Mulai</label>
                        <input type="time" class="form-control @error('start_time') is-invalid @enderror" id="start_time" name="start_time" value="{{ old('start_time', $ekskuls->start_time) }}">
                        @error('start_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="end_time" class="form-control-label">Jam Selesai</label>
                        <input type="time" class="form-control @error('end_time') is-invalid @enderror" id="end_time" name="end_time" value="{{ old('end_time', $ekskuls->end_time) }}">
                        @error('end_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Hari Kedua (Opsional) -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="activity_date2" class="form-control-label">Hari Pelaksanaan Kedua (Opsional)</label>
                        <select class="form-select @error('activity_date2') is-invalid @enderror" id="activity_date2" name="activity_date2">
                            <option value="" >Pilih Hari</option>
                            <option value="Senin" {{ old('activity_date2', $ekskuls->activity_date2) == 'Senin' ? 'selected' : '' }}>Senin</option>
                            <option value="Selasa" {{ old('activity_date2', $ekskuls->activity_date2) == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                            <option value="Rabu" {{ old('activity_date2', $ekskuls->activity_date2) == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                            <option value="Kamis" {{ old('activity_date2', $ekskuls->activity_date2) == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                            <option value="Jumat" {{ old('activity_date2', $ekskuls->activity_date2) == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                            <option value="Sabtu" {{ old('activity_date2', $ekskuls->activity_date2) == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                        </select>
                        @error('activity_date2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="start_time2" class="form-control-label">Jam Mulai</label>
                        <input type="time" class="form-control @error('start_time2') is-invalid @enderror" id="start_time2" name="start_time2" value="{{ old('start_time2', $ekskuls->start_time2) }}">
                        @error('start_time2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="end_time2" class="form-control-label">Jam Selesai</label>
                        <input type="time" class="form-control @error('end_time2') is-invalid @enderror" id="end_time2" name="end_time2" value="{{ old('end_time2', $ekskuls->end_time2) }}">
                        @error('end_time2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Lokasi -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="location" class="form-control-label">Lokasi</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location', $ekskuls->location) }}">
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Tombol Submit -->
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
