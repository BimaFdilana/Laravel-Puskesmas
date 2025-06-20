@extends('layouts.app')

@section('title', 'Tambah Data Ibu Hamil')

@push('style')
    <style>
        .table-responsive {
            font-size: 14px;
        }

        .form-check-input {
            transform: scale(1.2);
        }

        .table th {
            background-color: #ffff;
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
        }

        .table td {
            vertical-align: middle;
        }

        .kunjungan-header {
            writing-mode: vertical-rl;
            text-orientation: mixed;
            height: 120px;
            padding: 10px 5px;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between w-100">
                <h1>Tambah Data Ibu Hamil (ANC)</h1>
                <a href="{{ route('anc.index') }}" class="btn btn-danger">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('anc.store') }}" method="POST">
                            @csrf

                            <!-- Data Pasien -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">No. Rekam Medis</label>
                                        <input type="text" class="form-control" name="rekam_medis" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Kohort</label>
                                        <input type="text" class="form-control" name="kohort" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nama Pasien</label>
                                        <input type="text" class="form-control" name="nama_pasien" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Alamat (sesuai KTP)</label>
                                        <textarea class="form-control" name="alamat" rows="2" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">NIK</label>
                                        <input type="text" class="form-control" name="nik" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Petugas</label>
                                        <input type="text" class="form-control" name="petugas" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Form ANC -->
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="width: 50px;">No</th>
                                            <th rowspan="2" style="width: 300px;">Kontak ke<br>Usia minggu</th>
                                            <th colspan="6">Kunjungan</th>
                                        </tr>
                                        <tr>
                                            <th style="font-size: 12px;">(K1)<br>0-12 Minggu</th>
                                            <th style="font-size: 12px;">(K2)<br>>12-24 minggu</th>
                                            <th style="font-size: 12px;">(K3)<br>>12-24 minggu</th>
                                            <th style="font-size: 12px;">(K4)<br>24 s/d Kelahiran</th>
                                            <th style="font-size: 12px;">(K5)<br>24 s/d Kelahiran</th>
                                            <th style="font-size: 12px;">(K6)<br>24 s/d Kelahiran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ancItems as $no => $item)
                                            <tr>
                                                <td class="text-center">{{ $no }}</td>
                                                <td>{{ $item }}</td>
                                                @foreach (['k1', 'k2', 'k3', 'k4', 'k5', 'k6'] as $kunjungan)
                                                    <td class="text-center">
                                                        <div class="form-check d-flex justify-content-center">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="{{ $kunjungan }}[]" value="{{ $no }}"
                                                                id="{{ $kunjungan }}_{{ $no }}">
                                                        </div>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Submit Button -->
                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Simpan Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    </div>
@endsection

@push('scripts')
@endpush
