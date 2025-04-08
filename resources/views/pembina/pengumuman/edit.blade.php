@extends('layouts.pembina')
@section('content')
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Form Input Pengumuman</h6>
        </div>
        <div class="card-body px-4 pt-3">
            <form action="{{ route('pengumuman.update', $pengumuman->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama" class="form-control-label">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul"
                                placeholder="Masukan Judul Pengumuman" value="{{ $pengumuman->judul }}">
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="deskripsi" class="form-control-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="3"
                                placeholder="Masukan Deskripsi Pengumuman">{{ $pengumuman->description }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label"></label>Foto
                    <input type="file" class="form-control" name="foto" value="{{ $pengumuman->foto }}">
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <button type="submit" class="btn bg-gradient-primary">Simpan</button>
                        <a href="{{ route('pengumuman.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
