@extends('layouts.pembina')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>data nilai - {{ $ekskul->name }} - {{ $data_siswa->siswa->user->name }}</h6>
                        <a href="{{ route('evaluasi.create', ['siswa_id' => $data_siswa->id]) }}"
                            class="btn btn-sm bg-gradient-primary">
                            <i class="fas fa-plus me-2"></i> Tambah Data Nilai
                        </a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3">
                                        No.</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3">
                                        Grade</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3">
                                        Description</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3 text-center">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($evaluasi as $data)
                                    <tr>
                                        <td class="px-4 py-3">{{ $i++ }}</td>
                                        <td class="px-4 py-3">{{ $data->grade }}</td>
                                        <td class="px-4 py-3">{{ $data->description }}</td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex justify-content-center align-items-center gap-2">
                                                <a href="{{ route('evaluasi.edit', $data) }}"
                                                    class="btn btn-sm bg-gradient-info px-3 mb-0">
                                                    <i class="fas fa-pencil-alt me-2"></i>Edit
                                                </a>
                                                <form action="{{ route('evaluasi.destroy', $data->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm bg-gradient-danger px-3 mb-0">
                                                        <i class="fas fa-trash me-2"></i>Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                @if ($evaluasi->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center py-3">
                                            <span class="text-muted">Siswa Belum Memiliki Nilai</span>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
