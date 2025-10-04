@extends('layouts.app')
@section('title', 'Daftar Laporan per Pustu')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pilih Pustu untuk Melihat Laporan</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pustu</th>
                                        <th>Email</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pustuUsers as $index => $pustu)
                                        <tr>
                                            <td>{{ $pustuUsers->firstItem() + $index }}</td>
                                            <td>{{ $pustu->name }}</td>
                                            <td>{{ $pustu->email }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('laporan.pustu.show', $pustu->id) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fas fa-eye"></i> Lihat Laporan
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Belum ada data akun Pustu.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        {{ $pustuUsers->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
