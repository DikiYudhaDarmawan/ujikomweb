@extends('layouts.pembina')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Edit Acara</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('acara.update', $acara->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Acara</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $acara->nama }}" required>
                </div>

                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $acara->tanggal }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('acara.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
