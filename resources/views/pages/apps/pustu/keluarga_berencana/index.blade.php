@extends('layouts.app')
@section('title', 'Data Peserta KB Baru')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Keluarga Berencana</h1>
            </div>
            <a href="{{ route('peserta-kb.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i>
                Tambah Data KB</a>
            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pasien</th>
                                        <th>Posyandu</th>
                                        <th>Jenis Kontrasepsi</th>
                                        <th>Jalur Layanan</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($records as $index => $record)
                                        <tr>
                                            <td>{{ $records->firstItem() + $index }}</td>
                                            <td>{{ $record->nama_pasien }}</td>
                                            <td>{{ $record->posyandu->nama_posyandu }}</td>
                                            <td>{{ $record->jenis_kontrasepsi }}</td>
                                            <td>{{ $record->jalur_layanan }}</td>
                                            <td>{{ \Carbon\Carbon::parse($record->tanggal_pelayanan)->format('d/m/Y') }}
                                            </td>
                                            <td>
                                                <form action="{{ route('peserta-kb.destroy', $record->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                    <a href="{{ route('peserta-kb.edit', $record->id) }}"
                                                        class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Belum ada data.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{ $records->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


@push('scripts')
    <script>
        // Cek apakah session 'error_posyandu' ada dari controller
        @if (session('error_posyandu'))
            Swal.fire({
                title: 'Data Posyandu Kosong!',
                text: '{{ session('error_posyandu') }}',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK, Tambah Posyandu'
            }).then((result) => {
                // Jika tombol konfirmasi ditekan, arahkan ke halaman create posyandu
                if (result.isConfirmed) {
                    window.location.href = "{{ route('posyandu.create') }}";
                }
            })
        @endif
    </script>
@endpush
