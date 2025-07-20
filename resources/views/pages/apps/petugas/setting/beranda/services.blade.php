@extends('layouts.app')

@section('title', 'Kelola Layanan')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Kelola Layanan (Services)</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.beranda.edit') }}">Kelola Beranda</a></div>
                    <div class="breadcrumb-item">Layanan</div>
                </div>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                    {{ session('success') }}
                                </div>
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 15%;">Ikon</th>
                                        <th style="width: 25%;">Nama Layanan</th>
                                        <th>Deskripsi</th>
                                        <th class="text-center" style="width: 15%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($services as $service)
                                        <tr>
                                            <td><i
                                                    class="{{ $service->icon }} fa-2x"></i><br><small>({{ $service->icon }})</small>
                                            </td>
                                            <td>{{ $service->title }}</td>
                                            <td>{{ $service->description }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('services.edit', $service->id) }}"
                                                    class="btn btn-warning btn-sm my-1"><i class="fas fa-edit"></i> Edit</a>
                                                <form action="{{ route('services.destroy', $service->id) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm my-1"><i
                                                            class="fas fa-trash"></i> Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Data layanan tidak ditemukan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
