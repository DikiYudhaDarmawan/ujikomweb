@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Data User</h6>
                        <a href="{{ route('user.create') }}" class="btn btn-sm bg-gradient-primary">
                            <i class="fas fa-plus me-2"></i> Tambah Data
                        </a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class=" table align-items-center mb-0" id="example">
                            <thead>
                                <tr>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3">
                                        No.</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3">
                                        Nama </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3">
                                        Email</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3 text-center">
                                        role</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3 text-center">
                                        status</th>
                                        <th
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3 text-center">
                                    Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($user as $data)
                                    @if (($data->role == 'admin') & $loop->first)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $i++ }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $data->name }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $data->email }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm bg-gradient-success">{{ $data->role }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="">-</span>
                                            </td>
                
                                            <td class="align-middle text-center">
                                                <div class="ms-auto">
                                                    <a href="{{ route('user.edit', $data->id) }}"
                                                        class="btn btn-sm bg-gradient-info px-3 mb-0">
                                                        <i class="fas fa-pencil-alt me-2"></i>Edit
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $i++ }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $data->name }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $data->email }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm bg-gradient-success">{{ $data->role }}</span>
                                            </td>
                                             <td class="d-flex justify-content-center px-4 py-3 ">
                                                <form action="{{ route('user.updateStatus') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" name="status"
                                                            onchange="this.form.submit()"
                                                            {{ $data->status ? 'checked' : '' }}>
                                                    </div>
                                                </form>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="ms-auto">
                                                    <a href="{{ route('user.edit', $data->id) }}"
                                                        class="btn btn-sm bg-gradient-info px-3 mb-0">
                                                        <i class="fas fa-pencil-alt me-2"></i>Edit
                                                    </a>

                                                    <form action="{{ route('user.destroy', $data->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm bg-gradient-danger px-3 mb-0">
                                                            <i class="fas fa-trash me-2"></i>Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#example');
    </script>
@endpush
