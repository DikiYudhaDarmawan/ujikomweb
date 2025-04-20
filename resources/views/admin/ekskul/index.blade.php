@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Data Ekskul</h6>
                        <a href="{{ route('ekskul.create') }}" class="btn btn-sm bg-gradient-primary">
                            <i class="fas fa-plus me-2"></i> Tambah Data
                        </a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="example" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3">
                                        No.</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3">
                                        Logo</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3">
                                        Nama Ekskul</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3">
                                        Nama Pembina</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3 text-center">
                                        Hari Pelaksanaan</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3 text-center">
                                        Waktu Pelaksanaan</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3 text-center">
                                        Tempat Pelaksanaan</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3 text-center">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($ekskuls as $data)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $i++ }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <img src="{{ $data->foto ? asset('storage/' . $data->foto) : asset('assets/foto/default.jpg') }}"
                                                alt="{{ $data->name }}"
                                                style="width: 100px; height: auto; object-fit: cover;">
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $data->name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <p class="d-flex justify-content-center text-xs font-weight-bold mb-0">
                                                {{ $data->user->name }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @if ($data->activity_date2)
                                                <span
                                                    class="badge badge-sm bg-gradient-success">{{ $data->activity_date }}</span>
                                                <br>
                                                <span
                                                    class="badge badge-sm bg-gradient-success">{{ $data->activity_date2 }}</span>
                                            @else
                                                <span
                                                    class="badge badge-sm bg-gradient-success">{{ $data->activity_date }}</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            @if ($data->start_time2 && $data->end_time2)
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ $data->start_time }} - {{ $data->end_time }}
                                                </span>
                                                <br>
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ $data->start_time2 }} - {{ $data->end_time2 }}
                                                </span>
                                            @else
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ $data->start_time }} - {{ $data->end_time }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $data->location }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex ms-auto gap-2">
                                                <a href="{{ route('ekskul.edit', $data->id) }}"
                                                    class="btn btn-sm bg-gradient-info px-3 mb-0">
                                                    <i class="fas fa-pencil-alt me-2"></i>Edit
                                                </a>

                                                <form action="{{ route('ekskul.destroy', $data->id) }}" method="POST"
                                                    class="d-inline" id="delete-form-{{ $data->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm bg-gradient-danger px-3 mb-0"
                                                        onclick="confirmDelete({{ $data->id }})">
                                                        <i class="fas fa-trash me-2"></i>Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                                @if ($ekskuls->isEmpty())
                                    <tr>
                                        <td colspan="8" class="text-center py-3">
                                            <span class="text-muted">Belum ada data ekskul</span>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('javascript')
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>

        <script>
            let table = new DataTable('#myTable');

            function confirmDelete(userId) {
              
                if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                  
                    document.getElementById('delete-form-' + userId).submit();
                }
            }
        </script>
    @endpush
