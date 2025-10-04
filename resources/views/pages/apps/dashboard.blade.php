@extends('layouts.app')

@section('title', 'Dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                @if (Auth::user()->role_id == 1)
                    <h1>Dashboard Petugas Puskesmas</h1>
                @else
                    <h1>Dashboard Puskesmas Pembantu</h1>
                @endif
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary"><i class="fas fa-baby"></i></div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Imunisasi Bayi (Bulan Ini)</h4>
                            </div>
                            <div class="card-body">{{ $imunisasiCount }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger"><i class="fas fa-pills"></i></div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Peserta KB Baru (Bulan Ini)</h4>
                            </div>
                            <div class="card-body">{{ $kbCount }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning"><i class="fas fa-stethoscope"></i></div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Kunjungan ANC (Bulan Ini)</h4>
                            </div>
                            <div class="card-body">{{ $ancCount }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success"><i class="fas fa-bug"></i></div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Kasus Penyakit (Bulan Ini)</h4>
                            </div>
                            <div class="card-body">{{ $surveilansCount }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Total Data Tercatat (Semua Waktu)</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="totalDataChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>5 Penyakit Teratas (Bulan Ini)</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="penyakitChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Aktivitas Terbaru (Data Surveilans)</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    {{-- ... isi tabel ... --}}
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <script src="{{ asset('js/page/index-0.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>

    <script>
        const penyakitLabels = @json($penyakitLabels);
        const penyakitData = @json($penyakitData);
        const aktivitasLabels = @json($aktivitasLabels);
        const aktivitasData = @json($aktivitasData);

        const ctxPenyakit = document.getElementById('penyakitChart').getContext('2d');
        new Chart(ctxPenyakit, {
            type: 'bar',
            data: {},
            options: {}
        });
        const ctxTotalData = document.getElementById('totalDataChart').getContext('2d');
        new Chart(ctxTotalData, {
            type: 'bar',
            data: {
                labels: aktivitasLabels,
                datasets: [{
                    label: 'Jumlah Total Data',
                    data: aktivitasData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value) {
                                if (Number.isInteger(value)) {
                                    return value;
                                }
                            },
                        }
                    }]
                }
            }
        });
    </script>
@endpush
