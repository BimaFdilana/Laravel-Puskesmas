{{-- File: resources/views/pages/apps/petugas/setting/services/index.blade.php --}}
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
                    <div class="card-header">
                        <h4>Daftar Layanan</h4>
                        <div class="card-header-action">
                            <a href="{{ route('services.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                                Tambah Layanan Baru</a>
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
                                        <th>Ikon</th>
                                        <th>Nama Layanan</th>
                                        <th>Deskripsi</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($services as $service)
                                        <tr>
                                            <td><i class="{{ $service->icon }} fs-4"></i> ({{ $service->icon }})</td>
                                            <td>{{ $service->title }}</td>
                                            <td>{{ $service->description }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('services.edit', $service->id) }}"
                                                    class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('services.destroy', $service->id) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Belum ada data layanan.</td>
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

{{-- =================================================================================== --}}

{{-- File: resources/views/pages/apps/petugas/setting/services/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Tambah Layanan Baru')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Layanan Baru</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <form action="{{ route('services.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Ikon (Contoh: fa fa-heartbeat)</label>
                                <input type="text" name="icon" class="form-control" required>
                                <small class="form-text text-muted">Gunakan nama kelas dari Font Awesome. Lihat referensi di
                                    <a href="https://fontawesome.com/v5/search" target="_blank">Font Awesome</a>.</small>
                            </div>
                            <div class="form-group">
                                <label>Judul Layanan</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Singkat</label>
                                <textarea name="description" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('services.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

{{-- =================================================================================== --}}

{{-- File: resources/views/pages/apps/petugas/setting/services/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Layanan')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Layanan</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <form action="{{ route('services.update', $service->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Ikon (Contoh: fa fa-heartbeat)</label>
                                <input type="text" name="icon" class="form-control" value="{{ $service->icon }}"
                                    required>
                                <small class="form-text text-muted">Gunakan nama kelas dari Font Awesome. Lihat referensi di
                                    <a href="https://fontawesome.com/v5/search" target="_blank">Font Awesome</a>.</small>
                            </div>
                            <div class="form-group">
                                <label>Judul Layanan</label>
                                <input type="text" name="title" class="form-control" value="{{ $service->title }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Singkat</label>
                                <textarea name="description" class="form-control" rows="3" required>{{ $service->description }}</textarea>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('services.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
