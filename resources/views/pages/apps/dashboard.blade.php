@extends('layouts.app')
@section('title', 'Dashboard')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard {{ auth()->user()->role_id == 1 ? 'Petugas Puskesmas' : 'Puskesmas Pembantu' }}</h1>
            </div>

            {{-- BARIS KARTU STATISTIK TOTAL --}}
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary"><i class="fas fa-baby"></i></div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Imunisasi Bayi (Total)</h4>
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
                                <h4>Peserta KB Baru (Total)</h4>
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
                                <h4>Kunjungan ANC (Total)</h4>
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
                                <h4>Kasus Penyakit (Total)</h4>
                            </div>
                            <div class="card-body">{{ $surveilansCount }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- BARIS GRAFIK --}}
            <div class="row">
                <div class="col-lg-7 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Aktivitas 7 Hari Terakhir</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="trendChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Distribusi Jenis Kontrasepsi</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="kbDistributionChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            {{-- BARIS AKSI CEPAT & AKTIVITAS TERBARU --}}
            <div class="row">
                <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Aktivitas Terakhir per Modul</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Jenis Data</th>
                                        <th>Detail Pasien</th>
                                        <th>Waktu Input</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="badge badge-warning">Ibu Hamil (ANC)</div>
                                        </td>
                                        <td>{{ $latestAnc->nama_pasien ?? '-' }}</td>
                                        <td>{{ $latestAnc ? Carbon\Carbon::parse($latestAnc->created_at)->diffForHumans() : '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="badge badge-danger">Peserta KB</div>
                                        </td>
                                        <td>{{ $latestKb->nama_pasien ?? '-' }}</td>
                                        <td>{{ $latestKb ? Carbon\Carbon::parse($latestKb->tanggal_pelayanan)->diffForHumans() : '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="badge badge-success">Surveilans</div>
                                        </td>
                                        <td>{{ $latestSurveilans->nama_pasien ?? '-' }}</td>
                                        <td>{{ $latestSurveilans ? Carbon\Carbon::parse($latestSurveilans->tanggal_kunjungan)->diffForHumans() : '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="badge badge-primary">Imunisasi Bayi</div>
                                        </td>
                                        <td>{{ $latestImunisasi->nama_bayi ?? '-' }}</td>
                                        <td>{{ $latestImunisasi ? Carbon\Carbon::parse($latestImunisasi->created_at)->diffForHumans() : '-' }}
                                        </td>
                                    </tr>
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
    <script>
        // Data dari Controller
        const trendLabels = @json($trendLabels);
        const trendData = @json($trendData);
        const kbLabels = @json($kbLabels);
        const kbData = @json($kbData);

        // 1. Grafik Tren Aktivitas (Line Chart)
        const ctxTrend = document.getElementById('trendChart').getContext('2d');
        new Chart(ctxTrend, {
            type: 'line',
            data: {
                labels: trendLabels,
                datasets: [{
                    label: 'Jumlah Entri Baru',
                    data: trendData,
                    borderColor: '#6777ef',
                    backgroundColor: 'rgba(103, 119, 239, 0.2)',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
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
                            stepSize: 1,
                            callback: function(value) {
                                if (Number.isInteger(value)) {
                                    return value;
                                }
                            }
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }]
                },
            }
        });

        // 2. Grafik Distribusi KB (Doughnut Chart)
        const ctxKb = document.getElementById('kbDistributionChart').getContext('2d');
        new Chart(ctxKb, {
            type: 'doughnut',
            data: {
                labels: kbLabels,
                datasets: [{
                    label: 'Jumlah Peserta',
                    data: kbData,
                    backgroundColor: ['#fc544b', '#ffa426', '#3abaf4', '#63ed7a', '#8446f7', '#34395e',
                        '#ef2e46'
                    ],
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom'
                },
            }
        });
    </script>
@endpush
