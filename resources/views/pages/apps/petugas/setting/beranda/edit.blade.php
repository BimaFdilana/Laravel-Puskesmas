@extends('layouts.app')

@section('title', 'Kelola Halaman Beranda')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between w-100">
                <h1>Kelola Halaman Beranda</h1>
                <a href="{{ route('beranda') }}" class="btn btn-primary" target="_blank">
                    <i class="fas fa-eye"></i> Lihat Halaman Depan
                </a>
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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('admin.beranda.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Hero Section --}}
                            <div class="card">
                                <div class="card-header">
                                    <h5>1. Hero Section (Bagian Atas)</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Judul Utama</label>
                                        <input type="text" name="hero_title" class="form-control"
                                            value="{{ old('hero_title', $beranda->hero_title) }}" required>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label class="form-label">Subjudul / Deskripsi Singkat</label>
                                        <textarea name="hero_subtitle" class="form-control" rows="3" required>{{ old('hero_subtitle', $beranda->hero_subtitle) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            {{-- About Us Section --}}
                            <div class="card">
                                <div class="card-header">
                                    <h5>2. About Us Section (Tentang Kami)</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Judul "About Us"</label>
                                        <input type="text" name="about_title" class="form-control"
                                            value="{{ old('about_title', $beranda->about_title) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Deskripsi "About Us"</label>
                                        <textarea name="about_description" class="form-control" rows="4" required>{{ old('about_description', $beranda->about_description) }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Poin-poin Keunggulan (Pisahkan tiap poin dengan baris
                                            baru)</label>
                                        <textarea name="about_points" class="form-control" rows="4" required>{{ old('about_points', $beranda->about_points) }}</textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Gambar "About Us" 1 (Besar)</label>
                                                <input type="file" name="about_image_1" class="form-control">
                                                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah
                                                    gambar.</small>
                                                @if ($beranda->about_image_1)
                                                    <img src="{{ asset('storage/' . $beranda->about_image_1) }}"
                                                        alt="About Image 1" width="150" class="mt-2 img-thumbnail">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Gambar "About Us" 2 (Kecil)</label>
                                                <input type="file" name="about_image_2" class="form-control">
                                                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah
                                                    gambar.</small>
                                                @if ($beranda->about_image_2)
                                                    <img src="{{ asset('storage/' . $beranda->about_image_2) }}"
                                                        alt="About Image 2" width="150" class="mt-2 img-thumbnail">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Features Section --}}
                            <div class="card">
                                <div class="card-header">
                                    <h5>3. Features Section (Mengapa Memilih Kami)</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Judul "Features"</label>
                                        <input type="text" name="feature_title" class="form-control"
                                            value="{{ old('feature_title', $beranda->feature_title) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Deskripsi "Features"</label>
                                        <textarea name="feature_description" class="form-control" rows="4" required>{{ old('feature_description', $beranda->feature_description) }}</textarea>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label class="form-label">Gambar "Features"</label>
                                        <input type="file" name="feature_image" class="form-control">
                                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah
                                            gambar.</small>
                                        @if ($beranda->feature_image)
                                            <img src="{{ asset('storage/' . $beranda->feature_image) }}"
                                                alt="Feature Image" width="150" class="mt-2 img-thumbnail">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Appointment Section --}}
                            <div class="card">
                                <div class="card-header">
                                    <h5>4. Appointment & Kontak Section</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Judul "Appointment"</label>
                                        <input type="text" name="appointment_title" class="form-control"
                                            value="{{ old('appointment_title', $beranda->appointment_title) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Deskripsi "Appointment"</label>
                                        <textarea name="appointment_description" class="form-control" rows="4" required>{{ old('appointment_description', $beranda->appointment_description) }}</textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-md-0">
                                                <label class="form-label">Nomor Telepon Kontak</label>
                                                <input type="text" name="contact_phone" class="form-control"
                                                    value="{{ old('contact_phone', $beranda->contact_phone) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-0">
                                                <label class="form-label">Alamat Email Kontak</label>
                                                <input type="email" name="contact_email" class="form-control"
                                                    value="{{ old('contact_email', $beranda->contact_email) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    {{-- Tambahkan script kustom di sini jika diperlukan --}}
@endpush
