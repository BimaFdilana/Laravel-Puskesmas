@extends('layouts.app')

@section('title', 'Data Imunisasi Bayi')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Imunisasi Bayi</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4></h4>
                        <div class="card-header-action">
                            <a href="{{ route('imunisasi-bayi.export') }}" class="btn btn-success"><i
                                    class="fas fa-file-excel"></i> Ekspor ke Excel</a>
                            <a href="{{ route('imunisasi-bayi.create') }}" class="btn btn-primary"><i
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
                                        <th>Nama Bayi</th>
                                        <th>Nama Ortu</th>
                                        <th>Tgl Lahir</th>
                                        <th>JK</th>
                                        <th>Posyandu</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dataImunisasi as $index => $data)
                                        <tr>
                                            <td>{{ $dataImunisasi->firstItem() + $index }}</td>
                                            <td>{{ $data->nama_bayi }}</td>
                                            <td>{{ $data->nama_orang_tua }}</td>
                                            <td>{{ \Carbon\Carbon::parse($data->tanggal_lahir)->format('d/m/Y') }}</td>
                                            <td>{{ $data->jenis_kelamin }}</td>
                                            <td>{{ $data->nama_posyandu }}</td>
                                            <td>
                                                <form action="{{ route('imunisasi-bayi.destroy', $data->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                    <a href="{{ route('imunisasi-bayi.edit', $data->id) }}"
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
