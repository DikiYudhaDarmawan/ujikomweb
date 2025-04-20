@extends('layouts.pembina')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white text-white">
            <h5 class="mb-0 fw-bold">Presensi Acara: {{ $acara->nama }} <small class="fw-normal">({{ \Carbon\Carbon::parse($acara->tanggal)->format('d M Y') }})</small></h5>
        </div>

        <div class="card-body">
            <form action="{{ route('presensi.store', $acara->id) }}" method="POST">
                @csrf
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-secondary">
                            <tr>
                                <th style="width: 60%">Nama Siswa</th>
                                <th style="width: 40%">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_siswa as $datasiswa)
                                <tr>
                                    <td>
                                        {{ $datasiswa->siswa->user->name }}
                                        <input type="hidden" name="siswa_id[]" value="{{ $datasiswa->siswa_id }}">
                                    </td>
                                    <td>
                                        <select name="keterangan[]" class="form-select">
                                            <option value="Hadir">Hadir</option>
                                            <option value="Izin">Izin</option>
                                            <option value="Sakit">Sakit</option>
                                            <option value="Alpha">Alpha</option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach

                            @if($data_siswa->isEmpty())
                                <tr>
                                    <td colspan="2" class="text-center py-4">Tidak ada data siswa.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-primary shadow-sm">
                        <i class="fas fa-save me-2"></i> Simpan Presensi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-end mt-3">
        <a href="{{ route('acara.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>
</div>
@endsection
