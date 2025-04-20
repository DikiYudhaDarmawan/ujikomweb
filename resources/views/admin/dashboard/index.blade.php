@extends('layouts.admin')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <!-- Jumlah Siswa -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ route('user.index') }}" class="text-decoration-none">
                    <div class="card shadow-lg rounded-3" style="background: white">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-sm text-dark mb-0 text-uppercase font-weight-bold"
                                    >Jumlah Siswa</p>
                                    <h5 class="text-black font-weight-bolder">{{ $totalSiswa }} Siswa</h5>
                                </div>
                                <div class="icon icon-shape bg-gradient-primary shadow-success text-center rounded-circle">
                                    <i class="ni ni-hat-3 text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Jumlah Ekskul -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ route('ekskul.index') }}" class="text-decoration-none">
                    <div class="card shadow-lg rounded-3" style="background: white">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-sm text-dark mb-0 text-uppercase font-weight-bold"
                                    >Jumlah Ekskul</p>
                                    <h5 class="text-black font-weight-bolder">{{ $totalEkskul }} Ekskul</h5>
                                </div>
                                <div class="icon icon-shape bg-gradient-warning shadow-info text-center rounded-circle">
                                    <i class="ni ni-bell-55 text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Siswa Ikut Ekskul -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ route('siswaekskul.index') }}" class="text-decoration-none">
                    <div class="card shadow-lg rounded-3" style="background: white">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-sm text-dark mb-0 text-uppercase font-weight-bold"
                                      >Siswa Ikut Ekskul</p>
                                    <h5 class="text-black font-weight-bolder">{{ $totalSiswaIkutEkskul }} Siswa</h5>
                                </div>
                                <div class="icon icon-shape bg-gradient-info shadow-success text-center rounded-circle">
                                    <i class="ni ni-money-coins text-lg opacity-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Jumlah Pembina -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ route('user.index') }}" class="text-decoration-none">
                    <div class="card shadow-lg rounded-3" style="background: white">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-sm text-dark mb-0 text-uppercase font-weight-bold"
                                     >Jumlah Pembina</p>
                                    <h5 class="text-black font-weight-bolder">{{ $totalPembina }} Pembina</h5>
                                </div>
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <i class="ni ni-badge text-lg opacity-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Grafik -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow-lg rounded-3">
                    <div class="card-header pb-0">
                        <h6 class="text-dark font-weight-bold">Grafik Jumlah Siswa per Ekskul</h6>
                    </div>
                    <div class="card-body">
                        <!-- Grafik Chart.js -->
                        <canvas id="siswaPerEkskulChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('siswaPerEkskulChart');
        if (ctx) {
            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($chartData->pluck('name')) !!}, // Nama ekskul
                    datasets: [{
                        label: 'Jumlah Siswa',
                        data: {!! json_encode($chartData->pluck('count')) !!}, // Jumlah siswa per ekskul
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        borderRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }
                }
            });
        }
    });
</script>
