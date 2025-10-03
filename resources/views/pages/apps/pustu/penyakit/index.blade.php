@extends('layouts.app')
@section('title', 'Data Surveilans Penyakit')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Surveilans Penyakit</h1>
            </div>
            <a href="{{ route('surveilans-penyakit.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Tambah
                Kasus</a>
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
                                        <th>Penyakit</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Tanggal Kunjungan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($records as $index => $record)
                                        <tr>
                                            <td>{{ $records->firstItem() + $index }}</td>
                                            <td>{{ $record->nama_pasien }}</td>
                                            <td>{{ $record->penyakit->nama_penyakit }}</td>
                                            <td>{{ $record->jenis_kelamin }}</td>
                                            <td>{{ \Carbon\Carbon::parse($record->tanggal_lahir)->format('d/m/Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($record->tanggal_kunjungan)->format('d/m/Y') }}
                                            </td>
                                            <td>
                                                <form action="{{ route('surveilans-penyakit.destroy', $record->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                    <a href="{{ route('surveilans-penyakit.edit', $record->id) }}"
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
