{{-- File: resources/views/pages/apps/petugas/setting/doctors/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Kelola Dokter')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Kelola Data Dokter</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.beranda.edit') }}">Kelola Beranda</a></div>
                    <div class="breadcrumb-item">Dokter</div>
                </div>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Dokter</h4>
                        <div class="card-header-action">
                            <a href="{{ route('doctors.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                                Tambah Data Dokter</a>
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
                                        <th>Foto</th>
                                        <th>Nama Dokter</th>
                                        <th>Departemen/Spesialisasi</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($doctors as $doctor)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/' . $doctor->photo) }}"
                                                    alt="{{ $doctor->name }}" width="100" class="img-thumbnail">
                                            </td>
                                            <td>{{ $doctor->name }}</td>
                                            <td>{{ $doctor->department }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('doctors.edit', $doctor->id) }}"
                                                    class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data dokter ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Belum ada data dokter.</td>
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
