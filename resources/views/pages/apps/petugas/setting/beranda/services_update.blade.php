@extends('layouts.app')

@section('title', 'Edit Layanan')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Layanan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('services.index') }}">Layanan</a></div>
                    <div class="breadcrumb-item">Edit</div>
                </div>
            </div>
            <div class="section-body">
                <div class="card">
                    <form action="{{ route('services.update', $service->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Ikon (Contoh: fa fa-heartbeat)</label>
                                <input type="text" name="icon"
                                    class="form-control @error('icon') is-invalid @enderror"
                                    value="{{ old('icon', $service->icon) }}" required>
                                @error('icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Gunakan nama kelas dari Font Awesome. Lihat referensi di
                                    <a href="https://fontawesome.com/v5/search" target="_blank">Font Awesome 5</a>.</small>
                            </div>
                            <div class="form-group">
                                <label>Judul Layanan</label>
                                <input type="text" name="title"
                                    class="form-control @error('title') is-invalid @enderror"
                                    value="{{ old('title', $service->title) }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <label>Deskripsi Singkat</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" required>{{ old('description', $service->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
