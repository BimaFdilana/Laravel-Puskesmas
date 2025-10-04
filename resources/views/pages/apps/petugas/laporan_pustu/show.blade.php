@extends('layouts.app')
@section('title', 'Laporan Pustu: ' . $user->name)

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pilih Laporan untuk: {{ $user->name }}</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    {{-- KARTU LAPORAN IBU HAMIL (ANC) --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Laporan Ibu Hamil</h4>
                            </div>
                            <div class="card-body text-center">
                                <i class="fas fa-female fa-3x mb-3 text-primary"></i>
                                <p>Buka halaman filter laporan data ANC untuk Pustu ini.</p>
                                <a href="{{ route('laporan.anc.index', ['user_id' => $user->id]) }}"
                                    class="btn btn-primary stretched-link">Buka Laporan</a>
                            </div>
                        </div>
                    </div>
                    {{-- KARTU LAPORAN IMUNISASI --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h4>Laporan Imunisasi</h4>
                            </div>
                            <div class="card-body text-center">
                                <i class="fa fa-print fa-1x mb-3 text-danger"></i>
                                <p>Buka halaman filter laporan data Imunisasi untuk Pustu ini.</p>
                                <a href="{{ route('laporan.imunisasi.index', ['user_id' => $user->id]) }}"
                                    class="btn btn-danger stretched-link">Buka Laporan</a>
                            </div>
                        </div>
                    </div>
                    {{-- KARTU LAPORAN KB --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card card-warning">
                            <div class="card-header">
                                <h4>Laporan KB</h4>
                            </div>
                            <div class="card-body text-center">
                                <i class="fas fa-pills fa-3x mb-3 text-warning"></i>
                                <p>Buka halaman filter laporan data Peserta KB untuk Pustu ini.</p>
                                <a href="{{ route('laporan.kb.index', ['user_id' => $user->id]) }}"
                                    class="btn btn-warning stretched-link">Buka Laporan</a>
                            </div>
                        </div>
                    </div>
                    {{-- KARTU LAPORAN SURVEILANS --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card card-success">
                            <div class="card-header">
                                <h4>Laporan Surveilans</h4>
                            </div>
                            <div class="card-body text-center">
                                <i class="fas fa-chart-bar fa-3x mb-3 text-success"></i>
                                <p>Buka halaman filter laporan data Surveilans Penyakit.</p>
                                <a href="{{ route('laporan.surveilans.index', ['user_id' => $user->id]) }}"
                                    class="btn btn-success stretched-link">Buka Laporan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
