@extends('layouts.app')

@section('title', 'Edit Laporan Imunisasi')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Laporan Rekapitulasi Imunisasi</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <form action="{{ route('laporan-imunisasi.update', $laporanImunisasi->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Formulir Laporan</h4>
                        </div>
                        @include('pages.apps.pustu.imunisasi.laporan_imunisasi._form', [
                            'laporanImunisasi' => $laporanImunisasi,
                        ])
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('laporan-imunisasi.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
