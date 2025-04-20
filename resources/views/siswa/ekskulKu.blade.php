@extends('layouts.siswa2')

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0 text-center flex-grow-1">Ekskul saya</h2>
            <a href="{{ route('siswa.index') }}" class="btn btn-light border shadow-sm px-3">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>
        <div class="row">
            @if (!isset($ekskulKu) || $ekskulKu->isEmpty())
                <div class="col text-center">
                    <p class="text-muted">Anda belum mendaftar ke ekskul manapun.</p>
                </div>
            @else
                @foreach ($ekskulKu as $data)
                    <div class="col-12 mb-4">
                        <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="{{ asset('storage/' . $data->foto) }}" class="card-img-top"
                                        alt="{{ $data->name }}" style="height: 220px; object-fit: cover;">
                                </div>
                                <div class="col-md-8 d-flex flex-column">
                                    <div class="card-body flex-grow-1 d-flex flex-column">
                                        <h5 class="card-title fw-bold text-primary">{{ $data->name }}</h5>
                                        <p class="card-text text-muted">{{ Str::limit($data->description, 100) }}</p>
                                        <div class="mt-auto d-flex justify-content-end gap-2">
                                            {{-- <a href="{{ route('siswa.show', $data->id) }}" class="btn btn-outline-info">
                      <i class="fas fa-info-circle"></i> Detail
                    </a> --}}
                                            <a href="{{ route('siswa.pengumuman', $data->id) }}"
                                                class="btn btn-outline-warning">
                                                <i class="fas fa-bullhorn"></i> Pengumuman
                                            </a>
                                            <a href="{{ route('siswa.nilai', $data->id) }}" class="btn btn-outline-success">
                                                <i class="fas fa-chart-line"></i> Nilai
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End row g-0 -->
                        </div> <!-- End card -->
                    </div> <!-- End col-12 -->
                @endforeach
            @endif
        </div>
    </div>
@endsection
