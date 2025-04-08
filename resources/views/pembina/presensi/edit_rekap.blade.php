@extends('layouts.pembina')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <h5 class="mb-0 fw-bold">
                Edit Rekap Presensi Acara: {{ $acara->nama }}
                <small class="fw-normal">({{ \Carbon\Carbon::parse($acara->tanggal)->format('d M Y') }})</small>
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('presensi.update', $acara->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-secondary">
                            <tr>
                                <th style="width: 60%">Nama Siswa</th>
                                <th style="width: 40%">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswaEkskuls as $siswaEkskul)
                                <tr>
                                    <td>
                                        {{ $siswaEkskul->siswa->user->name }}
                                        <input type="hidden" name="presensi[{{ $siswaEkskul->id }}][siswa_id]" value="{{ $siswaEkskul->siswa_id }}">
                                    </td>
                                    <td>
                                        <select name="presensi[{{ $siswaEkskul->id }}][keterangan]" class="form-select">
                                            @php
                                                $current = optional($siswaEkskul->presensi)->keterangan ?? 'Hadir';
                                            @endphp
                                            <option value="Hadir" {{ $current == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                                            <option value="Izin" {{ $current == 'Izin' ? 'selected' : '' }}>Izin</option>
                                            <option value="Alpha" {{ $current == 'Alpha' ? 'selected' : '' }}>Alpha</option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                            @if($siswaEkskuls->isEmpty())
                                <tr>
                                    <td colspan="2" class="text-center py-4">Tidak ada data siswa.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-primary shadow-sm">
                        <i class="fas fa-save me-2"></i> Update Rekap
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="d-flex justify-content-end mt-3">
        <a href="{{ route('presensi.rekap', $acara->id) }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>
</div>
@endsection
