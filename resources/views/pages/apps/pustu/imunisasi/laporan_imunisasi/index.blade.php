@extends('layouts.app')

@section('title', 'Laporan Imunisasi')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Laporan Rekapitulasi Imunisasi</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Laporan</h4>
                    <div class="card-header-action">
                        <a href="{{ route('laporan-imunisasi.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Buat Laporan Baru</a>
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
                                    <th>Posyandu</th>
                                    <th>Desa</th>
                                    <th>Bulan & Tahun</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($laporan as $index => $item)
                                    <tr>
                                        <td>{{ $laporan->firstItem() + $index }}</td>
                                        <td>{{ $item->nama_posyandu }}</td>
                                        <td>{{ $item->desa }}</td>
                                        <td>{{ $item->bulan }} {{ $item->tahun }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('laporan-imunisasi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus laporan ini?');">
                                                <a href="{{ route('laporan-imunisasi.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada laporan imunisasi.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $laporan->links() }}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
