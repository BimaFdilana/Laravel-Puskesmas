@extends('layouts.app')

@section('title', 'Edit Data Ibu Hamil')

@push('style')
    <style>
        .table-responsive {
            font-size: 14px;
        }

        .form-check-input {
            transform: scale(1.2);
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
        }

        .table td {
            vertical-align: middle;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between w-100">
                <h1>Edit Data Ibu Hamil (ANC)</h1>
                <a href="{{ route('anc.index') }}" class="btn btn-danger">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('anc.update', $ancRecord->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Data Pasien -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">No. Rekam Medis</label>
                                        <input type="text" class="form-control" name="rekam_medis"
                                            value="{{ $ancRecord->rekam_medis }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Kohort</label>
                                        <input type="text" class="form-control" name="kohort"
                                            value="{{ $ancRecord->kohort }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nama Pasien</label>
                                        <input type="text" class="form-control" name="nama_pasien"
                                            value="{{ $ancRecord->nama_pasien }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Alamat (sesuai KTP)</label>
                                        <textarea class="form-control" name="alamat" rows="2" required>{{ $ancRecord->alamat }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">NIK</label>
                                        <input type="text" class="form-control" name="nik"
                                            value="{{ $ancRecord->nik }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Petugas</label>
                                        <input type="text" class="form-control" name="petugas"
                                            value="{{ $ancRecord->petugas }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="width: 50px;">No</th>
                                            <th rowspan="2" style="width: 300px;">Kontak ke<br>Usia minggu</th>
                                            <th colspan="6">Kunjungan</th>
                                        </tr>
                                        <tr>
                                            <th style="font-size: 12px;">0-12<br>Minggu (K1)</th>
                                            <th style="font-size: 12px;">>12-24<br>Minggu (K2)</th>
                                            <th style="font-size: 12px;">>12-24<br>Minggu (K3)</th>
                                            <th style="font-size: 12px;">>24 s/d<br>Kelahiran (K4)</th>
                                            <th style="font-size: 12px;">>24 s/d<br>Kelahiran (K5)</th>
                                            <th style="font-size: 12px;">>24 s/d<br>Kelahiran (K6)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-secondary">
                                            <td></td>
                                            <td><strong>ANC sesuai standar</strong></td>
                                            <td colspan="6"></td>
                                        </tr>
                                        <tr class="table-light">
                                            <td></td>
                                            <td><strong>Sumber</strong></td>
                                            <td colspan="6"></td>
                                        </tr>
                                        @foreach ($ancItems as $no => $item)
                                            <tr>
                                                <td class="text-center">{{ $no }}</td>
                                                <td>{{ $item }}</td>
                                                @foreach (['k1', 'k2', 'k3', 'k4', 'k5', 'k6'] as $kunjungan)
                                                    <td class="text-center">
                                                        <div class="form-check d-flex justify-content-center">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="{{ $kunjungan }}[]" value="{{ $no }}"
                                                                id="{{ $kunjungan }}_{{ $no }}"
                                                                {{ is_array($ancRecord->$kunjungan) && in_array($no, $ancRecord->$kunjungan) ? 'checked' : '' }}>
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
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Perbarui Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
