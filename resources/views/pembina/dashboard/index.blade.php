@extends('layouts.pembina')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-4">
                <a href="{{ route('datasiswa.index') }}" class="text-decoration-none text-dark">
                    <div class="card shadow-sm h-100 hover-shadow">
                        <div class="card-body p-3">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <p class="text-sm text-uppercase font-weight-bold mb-0">Jumlah Siswa</p>
                                    <h5 class="font-weight-bolder">{{ $totalSiswa }} Siswa</h5>
                                    <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">Data Terdaftar</span>
                                    </p>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                        <i class="ni ni-hat-3 text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Jumlah Pengumuman -->
            <div class="col-xl-3 col-sm-6 mb-4">
                <a href="{{ route('pengumuman.index') }}" class="text-decoration-none text-dark">
                    <div class="card shadow-sm h-100 hover-shadow">
                        <div class="card-body p-3">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <p class="text-sm text-uppercase font-weight-bold mb-0">Jumlah Pengumuman</p>
                                    <h5 class="font-weight-bolder">{{ $totalPengumuman }} Pengumuman </h5>
                                    <p class="mb-0">
                                        <span class="text-info text-sm font-weight-bolder">Sudah Diumumkan</span>
                                    </p>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                        <i class="ni ni-bell-55 text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Jumlah Acara -->
            <div class="col-xl-3 col-sm-6 mb-4">
                <a href="{{ route('acara.index') }}" class="text-decoration-none text-dark">
                    <div class="card shadow-sm h-100 hover-shadow">
                        <div class="card-body p-3">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <p class="text-sm text-uppercase font-weight-bold mb-0">Jumlah Acara</p>
                                    <h5 class="font-weight-bolder">{{ $totalAcara }} Acara</h5>
                                    <p class="mb-0">
                                        <span class="text-primary text-sm font-weight-bolder">Sudah Dibuat</span>
                                    </p>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                        <i class="ni ni-calendar-grid-58 text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Jumlah Absensi -->
            <div class="col-xl-3 col-sm-6 mb-4">
                <a href="{{ route('acara.index') }}" class="text-decoration-none text-dark">
                    <div class="card shadow-sm h-100 hover-shadow">
                        <div class="card-body p-3">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <p class="text-sm text-uppercase font-weight-bold mb-0">Jumlah Absensi</p>
                                    <h5 class="font-weight-bolder">{{ $totalAbsensi }} Absensi</h5>
                                    <p class="mb-0">
                                        <span class="text-warning text-sm font-weight-bolder">Sudah Dibuat</span>
                                    </p>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                        <i class="ni ni-check-bold text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow-lg rounded-3">
                    <div class="card-header pb-0">
                        <h6 class="text-dark font-weight-bold">Grafik Absensi per Acara</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="absensiChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('absensiChart');
        if (ctx) {
            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($labels),
                    datasets: [
                        {
                            label: 'Hadir',
                            backgroundColor: '#4caf50',
                            data: @json($dataHadir)
                        },
                        {
                            label: 'Izin',
                            backgroundColor: '#ffeb3b',
                            data: @json($dataIzin)
                        },
                        {
                            label: 'Sakit',
                            backgroundColor: '#03a9f4',
                            data: @json($dataSakit)
                        },
                        {
                            label: 'Alpha',
                            backgroundColor: '#f44336',
                            data: @json($dataAlpha)
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Rekap Absensi Siswa per Acara'
                        },
                        legend: {
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Siswa'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Tanggal Acara'
                            }
                        }
                    }
                }
            });
        }
    });
</script>