@extends('layouts.app')

@section('title', 'Edit Data Dokter')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Data Dokter</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <form action="{{ route('doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Lengkap Dokter</label>
                                <input type="text" name="name" class="form-control" value="{{ $doctor->name }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Departemen / Spesialisasi</label>
                                <input type="text" name="department" class="form-control"
                                    value="{{ $doctor->department }}" required>
                            </div>
                            <div class="form-group">
                                <label>Foto Dokter</label>
                                <input type="file" name="photo" class="form-control">
                                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
                                @if ($doctor->photo)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $doctor->photo) }}" alt="Current Photo"
                                            width="150" class="img-thumbnail">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
