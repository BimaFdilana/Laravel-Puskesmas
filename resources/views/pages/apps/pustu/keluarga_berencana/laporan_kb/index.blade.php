@extends('layouts.app')

@section('title', 'Laporan KB')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Laporan Keluarga Berencana</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <form action="{{ route('laporan.kb.export') }}" method="GET">
                        <div class="card-body">
                            <div class="row">
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
                                <div class="col-md-2 d-flex align-items-end">
                                    <div class="form-group w-100">
                                        <button type="submit" class="btn btn-success w-100">
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
