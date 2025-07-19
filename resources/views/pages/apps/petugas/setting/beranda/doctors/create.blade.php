{{-- File: resources/views/pages/apps/petugas/setting/doctors/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Tambah Data Dokter')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Data Dokter</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <form action="{{ route('doctors.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Lengkap Dokter</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Departemen / Spesialisasi</label>
                                <input type="text" name="department" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Foto Dokter</label>
                                <input type="file" name="photo" class="form-control" required>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
