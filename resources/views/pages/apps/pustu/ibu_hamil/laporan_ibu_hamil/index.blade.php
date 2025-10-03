@extends('layouts.app')

@section('title', 'Laporan Ibu Hamil')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Laporan Ibu Hamil (ANC)</h1>
            </div>

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
                                            <a href="{{ route('anc.export-word', $record) }}" class="btn btn-success btn-sm"
                                                title="Export Word">
                                                <i class="fas fa-download"></i> Download Laporan
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Belum ada data.</td>
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
