@extends('layouts.app')

@section('title', 'Rekap Laporan Pustu')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Rekap Laporan Pustu</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Unduh Laporan Rekapitulasi Imunisasi</h4>
                    </div>
                    <form action="{{ route('laporan.rekap.export') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <p>Silakan pilih filter di bawah ini untuk menghasilkan laporan rekapitulasi dalam format Excel.
                            </p>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="desa">Desa</label>
                                    <input type="text" id="desa" name="desa" class="form-control" value="SEBAUK"
                                        required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="bulan">Bulan</label>
                                    <select id="bulan" name="bulan" class="form-control" required>
                                        @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $key => $bulan)
                                            <option value="{{ $key + 1 }}"
                                                {{ date('n') == $key + 1 ? 'selected' : '' }}>{{ $bulan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tahun">Tahun</label>
                                    <input type="number" id="tahun" name="tahun" class="form-control"
                                        value="{{ date('Y') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-file-excel"></i> Unduh Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
