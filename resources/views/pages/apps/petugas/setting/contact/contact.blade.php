@extends('layouts.app')

@section('title', 'Kelola Informasi Kontak')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Kelola Informasi Kontak</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <form action="{{ route('admin.contact.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible show fade">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                        {{ session('success') }}
                                    </div>
                                </div>
                            @endif

                            <div class="form-group">
                                <label class="form-label">Nomor Telepon</label>
                                <input type="text" name="contact_phone" class="form-control"
                                    value="{{ old('contact_phone', $kontak->contact_phone) }}">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Alamat Email</label>
                                <input type="email" name="contact_email" class="form-control"
                                    value="{{ old('contact_email', $kontak->contact_email) }}">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Alamat Kantor</label>
                                <textarea name="contact_address" class="form-control" rows="3">{{ old('contact_address', $kontak->contact_address) }}</textarea>
                            </div>

                            <div class="form-group mb-0">
                                <label class="form-label">Link Google Maps (Embed URL)</label>
                                <textarea name="google_maps_link" class="form-control" rows="3">{{ old('google_maps_link', $kontak->google_maps_link) }}</textarea>
                                <small class="form-text text-muted">Buka Google Maps > Cari lokasi > Klik Share > Pilih
                                    "Embed a map" > Salin URL dari atribut `src`.</small>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
