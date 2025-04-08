@extends('layouts.pembina')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white text-white">
            <h5 class="mb-0">Tambah Acara</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('acara.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Acara</label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Acara" required>
                </div>

                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
