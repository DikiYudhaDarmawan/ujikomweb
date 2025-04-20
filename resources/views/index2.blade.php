@extends('layouts.siswa2')

@section('title', 'Beranda - Ekskul')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section position-relative d-flex align-items-center"
        style="background: url('{{ asset('assets/foto/banner.png') }}') no-repeat center center; background-size: cover; height: 600px;">
        <div class="position-absolute top-0 start-0 w-100 h-100"
            style="background: linear-gradient(135deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 100%);"></div>
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-md-6 text-white">
                    <h1 class="display-6 fw-bold mb-3">Selamat Datang, {{ Auth::user()->name }}!</h1>
                    <p class="lead mb-4">
                        Nikmati kemudahan dalam mengelola kegiatan ekstrakurikuler. Temukan ekskul yang sesuai minatmu dan
                        raih prestasi terbaik!
                    </p>
                    <a href="#ekskul" class="btn btn-primary btn-lg shadow">Lihat Ekskul</a>
                </div>
                <div class="col-md-6 text-center">
                    <img src="{{ asset('assets/foto/fotoekskul.jpeg') }}" alt="Ilustrasi Ekskul"
                        class="img-fluid rounded shadow" style="max-height: 400px;">
                </div>
            </div>
        </div>
    </section>

    <!-- Ekskul Section -->
    <section id="ekskul" class="py-5" style="background-color: #f9f9f9;">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <h2 class="mb-5 text-center">Ekskul Tersedia</h2>
            <div class="row g-4">
                @forelse($ekskul as $data)
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            @if ($data->foto)
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $data->foto) }}" class="card-img-top"
                                        alt="{{ $data->name }}" style="height: 220px; object-fit: cover;">
                                    <div class="card-img-overlay d-flex align-items-end p-0">
                                        <div class="w-100 bg-dark bg-opacity-50 p-2">
                                            <h5 class="card-title text-white mb-0">{{ $data->name }}</h5>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <img src="{{ asset('assets/foto/noimage.jpeg') }}" class="card-img-top" alt="Default Image"
                                    style="height: 220px; object-fit: cover;">
                            @endif

                            <div class="card-body d-flex flex-column">
                                @if (!$data->foto)
                                    <h5 class="card-title text-dark">{{ $data->name }}</h5>
                                @endif
                                <p class="card-text text-dark flex-grow-1">{{ Str::limit($data->description, 150) }}</p>
                                <div class="d-grid gap-2">
                                    @if (in_array($data->id, $ekskulDiikuti))
                                        <button class="btn btn-outline-secondary" disabled>Anda sudah mendaftar</button>
                                    @else
                                        <form action="{{ route('daftar') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="ekskul_id" value="{{ $data->id }}">
                                            <button type="submit" class="btn btn-primary">Daftar Sekarang</button>
                                        </form>
                                    @endif
                                    <a href="{{ route('siswa.show', $data->id) }}" class="btn btn-info">Detail Ekskul</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center">Belum ada ekskul yang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
