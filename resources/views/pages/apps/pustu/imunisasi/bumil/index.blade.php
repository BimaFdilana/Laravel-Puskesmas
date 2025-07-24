@extends('layouts.app')

@section('title', 'Data Imunisasi WUS & Bumil')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Imunisasi WUS & Bumil</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4></h4>
                        <div class="card-header-action">
                            <a href="{{ route('imunisasi-wus-bumil.export') }}" class="btn btn-success"><i
                                    class="fas fa-file-excel"></i> Ekspor ke Excel</a>
                            <a href="{{ route('imunisasi-wus-bumil.create') }}" class="btn btn-primary"><i
                                    class="fas fa-plus"></i> Tambah Data</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Wus/Bumil</th>
                                        <th>Nama Suami</th>
                                        <th>Umur</th>
                                        <th>Hamil Ke</th>
                                        <th>Posyandu</th>
                                        <th>Imunisasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dataImunisasi as $index => $data)
                                        <tr>
                                            <td>{{ $dataImunisasi->firstItem() + $index }}</td>
                                            <td>{{ $data->nama_wus_bumil }}</td>
                                            <td>{{ $data->nama_suami }}</td>
                                            <td>{{ $data->umur }}</td>
                                            <td>{{ $data->hamil_ke }}</td>
                                            <td>{{ $data->posyandu->nama_posyandu }}</td>
                                            <td>{{ $data->jenisImunisasi->nama_imunisasi ?? 'N/A' }}</td>
                                            <td>
                                                <form action="{{ route('imunisasi-wus-bumil.destroy', $data->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                    <a href="{{ route('imunisasi-wus-bumil.edit', $data->id) }}"
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
                        {{ $dataImunisasi->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
