@extends('layouts.pembina')
@section('content')
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Form Input nilai</h6>
        </div>
        <div class="card-body px-4 pt-3">
            <form action="{{ route('evaluasi.update', ['evaluasi' => $nilai->id]) }}" method="POST">
            @csrf
                @method('PUT')
                  <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama" class="form-control-label">Grade</label>
                            <input type="text" class="form-control" id="grade" name="grade"
                                placeholder="Masukkan grade nilai" value="{{$nilai->grade}}">
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="deskripsi" class="form-control-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="3"
                                placeholder="Masukkan deskripsi nilai">{{$nilai->description}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <button type="submit" class="btn bg-gradient-primary">Simpan</button>
                        <a href="{{ route('evaluasi.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
