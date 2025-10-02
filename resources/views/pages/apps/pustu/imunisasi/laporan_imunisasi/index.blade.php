@extends('layouts.app')

@section('title', 'Laporan Imunisasi')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Laporan Rekapitulasi Imunisasi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Laporan Imunisasi</div>
                </div>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Filter Laporan Bulanan</h4>
                    </div>
                    {{-- Formulir ini mengarah ke route 'laporan.imunisasi.export' yang sudah kita definisikan --}}
                    <form action="{{ route('laporan.imunisasi.export') }}" method="GET">
                        <div class="card-body">
                            <div class="row">
                                {{-- Dropdown untuk Bulan --}}
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="bulan">Pilih Bulan</label>
                                        <select name="bulan" id="bulan" class="form-control" required>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}"
                                                    {{ request('bulan', now()->month) == $i ? 'selected' : '' }}>
                                                    {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                {{-- Dropdown untuk Tahun --}}
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="tahun">Pilih Tahun</label>
                                        <select name="tahun" id="tahun" class="form-control" required>
                                            @for ($i = now()->year; $i >= now()->year - 5; $i--)
                                                <option value="{{ $i }}"
                                                    {{ request('tahun', now()->year) == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                {{-- Tombol untuk men-download laporan --}}
                                <div class="col-md-2 d-flex align-items-end">
                                    <div class="form-group w-100">
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="fas fa-download"></i> Download Laporan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
