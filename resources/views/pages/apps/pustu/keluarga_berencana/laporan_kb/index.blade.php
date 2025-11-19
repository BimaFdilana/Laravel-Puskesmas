@extends('layouts.app')
@section('title', 'Laporan KB Peserta Baru')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Laporan Keluarga Berencana</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <form id="filterForm" action="{{ route('laporan.kb.index') }}" method="GET">
                        @if (request('user_id'))
                            <input type="hidden" name="user_id" value="{{ request('user_id') }}">
                        @endif

                        <div class="card-body">
                            <div class="form-group">
                                <label for="filter_type">Jenis Filter</label>
                                <select name="filter_type" id="filter_type" class="form-control">
                                    <option value="monthly" {{ request('filter_type') == 'monthly' ? 'selected' : '' }}>
                                        Bulanan</option>
                                    <option value="yearly" {{ request('filter_type') == 'yearly' ? 'selected' : '' }}>
                                        Tahunan</option>
                                    <option value="range" {{ request('filter_type') == 'range' ? 'selected' : '' }}>Rentang
                                        Tanggal</option>
                                </select>
                            </div>

                            <div id="monthly-filter" class="row"
                                style="{{ request('filter_type') == 'monthly' || !request('filter_type') ? '' : 'display:none' }}">
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

                            <div id="yearly-filter" class="row"
                                style="{{ request('filter_type') == 'yearly' ? '' : 'display:none' }}">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="tahun_tahunan">Pilih Tahun</label>
                                        <select name="tahun_tahunan" id="tahun_tahunan" class="form-control">
                                            @for ($i = now()->year; $i >= now()->year - 5; $i--)
                                                <option value="{{ $i }}"
                                                    {{ request('tahun_tahunan', now()->year) == $i ? 'selected' : '' }}>
                                                    {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div id="range-filter" class="row"
                                style="{{ request('filter_type') == 'range' ? '' : 'display:none' }}">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date">Tanggal Mulai</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control"
                                            value="{{ request('start_date', now()->startOfMonth()->format('Y-m-d')) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_date">Tanggal Akhir</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control"
                                            value="{{ request('end_date', now()->endOfMonth()->format('Y-m-d')) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary mr-2">
                                <i class="fas fa-eye"></i> Tampilkan Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel"
        aria-hidden="true" style="z-index: 1051;">
        <div class="modal-dialog modal-xl" role="document" style="min-width: 95%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Preview Laporan KB: {{ isset($periode) ? $periode : '' }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (isset($reportData) && count($reportData) > 0)
                        <div class="table-responsive" style="max-height: 65vh; overflow-y: auto;">
                            <table class="table table-bordered table-striped table-hover table-sm">
                                <thead class="text-center bg-light text-dark" style="position: sticky; top: 0; z-index: 1;">
                                    <tr>
                                        <th rowspan="2" class="align-middle">No</th>
                                        <th rowspan="2" class="align-middle">Nama Posyandu</th>

                                        @foreach ($allKontrasepsi as $kontrasepsi)
                                            <th colspan="3">{{ $kontrasepsi }}</th>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @foreach ($allKontrasepsi as $kontrasepsi)
                                            @foreach ($allJalur as $jalur)
                                                <th style="font-size: 10px;">{{ $jalur }}</th>
                                            @endforeach
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reportData as $index => $row)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $row['nama_desa'] }}</td>

                                            @foreach ($allKontrasepsi as $kontrasepsi)
                                                @foreach ($allJalur as $jalur)
                                                    <td class="text-center">{{ $row[$kontrasepsi][$jalur] }}</td>
                                                @endforeach
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">Tidak ada data ditemukan untuk periode ini.</div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-success" onclick="submitExport()">
                        <i class="fas fa-download"></i> Download Excel
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>

        function submitExport() {
            const form = document.getElementById('filterForm');
            const originalAction = form.action;
            form.action = "{{ route('laporan.kb.export') }}";
            form.submit();
            setTimeout(() => {
                form.action = originalAction;
            }, 100);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const filterTypeSelector = document.getElementById('filter_type');
            const monthlyFilter = document.getElementById('monthly-filter');
            const yearlyFilter = document.getElementById('yearly-filter');
            const rangeFilter = document.getElementById('range-filter');

            function toggleFilterVisibility() {
                monthlyFilter.style.display = 'none';
                yearlyFilter.style.display = 'none';
                rangeFilter.style.display = 'none';
                const selectedType = filterTypeSelector.value;
                if (selectedType === 'monthly') monthlyFilter.style.display = 'flex';
                else if (selectedType === 'yearly') yearlyFilter.style.display = 'flex';
                else if (selectedType === 'range') rangeFilter.style.display = 'flex';
            }
            filterTypeSelector.addEventListener('change', toggleFilterVisibility);
            toggleFilterVisibility();

            @if (isset($reportData))
                $('#previewModal').modal('show');
            @endif
        });
    </script>
@endpush
