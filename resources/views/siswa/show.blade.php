@extends('layouts.siswa2')

@section('title', $ekskul->name . ' - Detail Ekskul')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card shadow border-0">
                    <!-- Header Gambar dengan Overlay -->
                    <div class="position-relative">
                        @if ($ekskul->foto)
                            <img src="{{ asset('image/logoekskul/' . $ekskul->foto) }}" class="card-img-top"
                                alt="{{ $ekskul->name }}" style="height: 350px; object-fit: cover;">
                        @else
                            <img src="{{ asset('assets/foto/noimage.jpeg') }}" class="card-img-top" alt="No Image"
                                style="height: 350px; object-fit: cover;">
                        @endif
                        <div class="card-img-overlay d-flex align-items-end p-0">
                            <div class="w-100 bg-dark bg-opacity-50 p-3">
                                <h2 class="card-title text-white mb-0">{{ $ekskul->name }}</h2>
                            </div>
                        </div>
                    </div>

                    <!-- Body Detail Ekskul -->
                    <div class="card-body">
                        <p class="card-text">{{ $ekskul->description }}</p>
                        <ul class="list-group list-group-flush mt-4">
                            <li class="list-group-item">
                                <i class="bi bi-person-fill me-2"></i>
                                <strong>Pembina:</strong> {{ $ekskul->user->name }}
                            </li>
                            <li class="list-group-item">
                                <i class="bi bi-calendar-event-fill me-2"></i>
                                <strong>Tanggal Kegiatan:</strong> {{ $ekskul->activity_date }}
                            </li>
                            <li class="list-group-item">
                                <i class="bi bi-clock-fill me-2"></i>
                                <strong>Waktu Mulai:</strong> {{ $ekskul->start_time }}
                            </li>
                            <li class="list-group-item">
                                <i class="bi bi-clock-history me-2"></i>
                                <strong>Waktu Selesai:</strong> {{ $ekskul->end_time }}
                            </li>
                            @if ($ekskul->activity_date2)
                                <li class="list-group-item">
                                    <i class="bi bi-calendar-event me-2"></i>
                                    <strong>Tanggal Kegiatan (Sesi 2):</strong> {{ $ekskul->activity_date2 }}
                                </li>
                                <li class="list-group-item">
                                    <i class="bi bi-clock-fill me-2"></i>
                                    <strong>Waktu Mulai (Sesi 2):</strong> {{ $ekskul->start_time2 }}
                                </li>
                                <li class="list-group-item">
                                    <i class="bi bi-clock-history me-2"></i>
                                    <strong>Waktu Selesai (Sesi 2):</strong> {{ $ekskul->end_time2 }}
                                </li>
                            @endif
                            <li class="list-group-item">
                                <i class="bi bi-geo-alt-fill me-2"></i>
                                <strong>Lokasi:</strong> {{ $ekskul->location }}
                            </li>
                        </ul>
                    </div>

                    <!-- Footer dengan Tombol Kembali -->
                    <div class="card-footer text-end bg-white">
                        <a href="{{ route('siswa.index') }}" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-left"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
