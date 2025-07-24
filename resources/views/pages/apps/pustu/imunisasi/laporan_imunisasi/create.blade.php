@extends('layouts.app')

@section('title', 'Buat Laporan Imunisasi Baru')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Buat Laporan Rekapitulasi Imunisasi Baru</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <form action="{{ route('laporan-imunisasi.store') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4>Formulir Laporan</h4>
                        </div>
                        @include('pages.apps.pustu.imunisasi.laporan_imunisasi._form')
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('laporan-imunisasi.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
