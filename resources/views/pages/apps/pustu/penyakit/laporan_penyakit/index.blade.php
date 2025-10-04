@extends('layouts.app')
@section('title', 'Laporan Surveilans Penyakit')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Laporan Surveilans Penyakit</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <form action="{{ route('laporan.surveilans.export') }}" method="GET">
                        {{-- Input tersembunyi untuk user_id (jika admin yang melihat) --}}
                        @if (request('user_id'))
                            <input type="hidden" name="user_id" value="{{ request('user_id') }}">
                        @endif

                        <div class="card-body">
                            {{-- Dropdown untuk memilih jenis filter --}}
                            <div class="form-group">
                                <label for="filter_type">Jenis Filter</label>
                                <select name="filter_type" id="filter_type" class="form-control">
                                    <option value="monthly" selected>Bulanan</option>
                                    <option value="yearly">Tahunan</option>
                                    <option value="range">Rentang Tanggal</option>
                                    <option value="all">Semua Data</option>
                                </select>
                            </div>

                            {{-- Wadah untuk filter bulanan --}}
                            <div id="monthly-filter" class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bulan">Pilih Bulan</label>
                                        <select name="bulan" id="bulan" class="form-control">
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}"
                                                    {{ request('bulan', now()->month) == $i ? 'selected' : '' }}>
                                                    {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tahun_bulanan">Pilih Tahun</label>
                                        <select name="tahun_bulanan" id="tahun_bulanan" class="form-control">
                                            @for ($i = now()->year; $i >= now()->year - 5; $i--)
                                                <option value="{{ $i }}"
                                                    {{ request('tahun', now()->year) == $i ? 'selected' : '' }}>
                                                    {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- Wadah untuk filter tahunan --}}
                            <div id="yearly-filter" class="row" style="display: none;">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="tahun_tahunan">Pilih Tahun</label>
                                        <select name="tahun_tahunan" id="tahun_tahunan" class="form-control">
                                            @for ($i = now()->year; $i >= now()->year - 5; $i--)
                                                <option value="{{ $i }}"
                                                    {{ request('tahun', now()->year) == $i ? 'selected' : '' }}>
                                                    {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- Wadah untuk filter rentang tanggal --}}
                            <div id="range-filter" class="row" style="display: none;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date">Tanggal Mulai</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control"
                                            value="{{ now()->startOfMonth()->format('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_date">Tanggal Akhir</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control"
                                            value="{{ now()->endOfMonth()->format('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-download"></i> Download Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterTypeSelector = document.getElementById('filter_type');
            const monthlyFilter = document.getElementById('monthly-filter');
            const yearlyFilter = document.getElementById('yearly-filter');
            const rangeFilter = document.getElementById('range-filter');

            function toggleFilterVisibility() {
                // Sembunyikan semua filter terlebih dahulu
                monthlyFilter.style.display = 'none';
                yearlyFilter.style.display = 'none';
                rangeFilter.style.display = 'none';

                // Tampilkan filter yang sesuai berdasarkan pilihan
                const selectedType = filterTypeSelector.value;
                if (selectedType === 'monthly') {
                    monthlyFilter.style.display = 'flex'; // 'flex' agar sejajar
                } else if (selectedType === 'yearly') {
                    yearlyFilter.style.display = 'flex';
                } else if (selectedType === 'range') {
                    rangeFilter.style.display = 'flex';
                }
                // Jika 'all', tidak ada yang ditampilkan
            }

            // Tambahkan event listener untuk mengubah visibilitas saat dropdown berubah
            filterTypeSelector.addEventListener('change', toggleFilterVisibility);

            // Panggil fungsi saat halaman pertama kali dimuat untuk mengatur tampilan awal
            toggleFilterVisibility();
        });
    </script>
@endpush
