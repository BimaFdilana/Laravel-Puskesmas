@extends('layouts.app')

@section('title', 'Ibu Hamil Page')

@push('style')

@endpush

@section('main')
    <br>
    <br>
    <br>
    <br>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Data ANC Records</h4>
                        <a href="{{ route('anc.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah Data ANC
                        </a>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Rekam Medis</th>
                                        <th>Kohort</th>
                                        <th>Nama Pasien</th>
                                        <th>NIK</th>
                                        <th>Petugas</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($records as $index => $record)
                                        <tr>
                                            <td>{{ $records->firstItem() + $index }}</td>
                                            <td>{{ $record->rekam_medis }}</td>
                                            <td>{{ $record->kohort }}</td>
                                            <td>{{ $record->nama_pasien }}</td>
                                            <td>{{ $record->nik }}</td>
                                            <td>{{ $record->petugas }}</td>
                                            <td>{{ $record->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('anc.show', $record) }}" class="btn btn-info btn-sm"
                                                        title="Lihat">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('anc.edit', $record) }}"
                                                        class="btn btn-warning btn-sm" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('anc.export-word', $record) }}"
                                                        class="btn btn-success btn-sm" title="Export Word">
                                                        <i class="fas fa-file-word"></i>
                                                    </a>
                                                    <form action="{{ route('anc.destroy', $record) }}" method="POST"
                                                        style="display: inline;"
                                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">
                                                <div class="py-4">
                                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                                    <h5 class="text-muted">Belum ada data ANC</h5>
                                                    <p class="text-muted">Silakan tambahkan data ANC pertama Anda</p>
                                                    <a href="{{ route('anc.create') }}" class="btn btn-primary">
                                                        <i class="fas fa-plus"></i> Tambah Data ANC
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if ($records->hasPages())
                            <div class="d-flex justify-content-center">
                                {{ $records->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
