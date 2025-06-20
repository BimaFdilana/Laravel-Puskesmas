@extends('layouts.app')

@section('title', 'Ibu Hamil Page')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between w-100">
                <h1>Data Ibu Hamil (ANC)</h1>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <a href="{{ route('anc.create') }}" class="btn btn-success mb-3">Tambah Data ANC</a>
            <div class="section-body">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
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
                                            <div class="d-flex" style="gap: 6px;">
                                                <a href="{{ route('anc.show', $record) }}" class="btn btn-info btn-sm"
                                                    title="Lihat">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('anc.edit', $record) }}" class="btn btn-warning btn-sm"
                                                    title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('anc.export-word', $record) }}"
                                                    class="btn btn-success btn-sm" title="Export Word">
                                                    <i class="fas fa-file-word"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm delete-button"
                                                    data-id="{{ $record->id }}" data-name="{{ $record->nama_pasien }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            <div class="py-4">
                                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                                <h5 class="text-muted">Belum ada data Ibu Hamil (ANC)</h5>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>

                        @if ($records->hasPages())
                            <div class="d-flex justify-content-center mt-3">
                                {{ $records->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto close alert
            setTimeout(() => {
                document.querySelectorAll('.alert-dismissible').forEach(alert => {
                    alert.classList.remove('show');
                    alert.addEventListener('transitionend', () => alert.remove());
                });
            }, 5000);

            // SweetAlert delete confirm
            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const recordId = this.dataset.id;
                    const recordName = this.dataset.name;

                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: `Data "${recordName}" akan dihapus secara permanen!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = `/anc/${recordId}`;
                            form.innerHTML = `
                                @csrf
                                @method('DELETE')
                            `;
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush
