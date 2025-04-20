@extends('layouts.pembina')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white text-white">
                <h5 class="mb-0 fw-bold">
                    Rekap Presensi Acara: {{ $acara->nama }}
                    <small class="fw-normal">({{ \Carbon\Carbon::parse($acara->tanggal)->format('d M Y') }})</small>
                </h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 5%">No.</th>
                                <th>Nama Siswa</th>
                                <th class="text-center" style="width: 20%">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($presensis as $key => $item)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>{{ $item->siswa->user->name }}</td>
                                    <td class="text-center">
                                        @if ($item->keterangan == 'Hadir')
                                            <span class="badge bg-success">Hadir</span>
                                        @elseif($item->keterangan == 'Izin')
                                            <span class="badge bg-warning text-dark">Izin</span>
                                        @elseif($item->keterangan == 'Sakit')
                                            <span class="badge bg-primary">Sakit</span>
                                        @else
                                            <span class="badge bg-danger">Alpha</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            @if ($presensis->isEmpty())
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">
                                        Belum ada presensi.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('acara.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>

                    <div>
                        <a href="{{ route('presensi.export.pdf', $acara->id) }}" class="btn btn-danger me-2">
                            <i class="fas fa-file-pdf me-1"></i> Export PDF
                        </a>

                        <a href="{{ route('presensi.edit', $acara->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-1"></i> Edit Presensi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
