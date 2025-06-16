@extends('layouts.app')

@section('title', 'Ibu Hamil Page Create')

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

        .kunjungan-header {
            writing-mode: vertical-rl;
            text-orientation: mixed;
            height: 120px;
            padding: 10px 5px;
        }
    </style>
@endpush

@section('main')
    <br>
    <br>
    <br>
    <br>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center mb-0">FORM ANC SESUAI STANDAR</h4>
                    </div>
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
                            <h5 class="mb-3">Form ANC</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="width: 50px;">No</th>
                                            <th rowspan="2" style="width: 300px;">Kontak ke<br>Usia minggu</th>
                                            <th>K1</th>
                                            <th>K2</th>
                                            <th>K3</th>
                                            <th>K4</th>
                                            <th>K5</th>
                                            <th>K6</th>
                                        </tr>
                                        <tr>
                                            <th style="font-size: 12px;">0-12<br>minggu</th>
                                            <th style="font-size: 12px;">>12-24<br>minggu</th>
                                            <th style="font-size: 12px;">>12-24<br>minggu</th>
                                            <th style="font-size: 12px;">>24 minggu<br>sampai kelahiran</th>
                                            <th style="font-size: 12px;">>24 minggu<br>sampai kelahiran</th>
                                            <th style="font-size: 12px;">>24 minggu<br>sampai kelahiran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-secondary">
                                            <td></td>
                                            <td><strong>ANC sesuai standar</strong></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="table-light">
                                            <td></td>
                                            <td><strong>Sumber</strong></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
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
                                                                id="{{ $kunjungan }}_{{ $no }}">
                                                        </div>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Keterangan -->
                            <div class="mt-4">
                                <h6>Keterangan:</h6>
                                <ol>
                                    <li>Ceklis kolom ANC sesuai standar terlebih dahulu</li>
                                    <li>Ceklis sesuai dengan pelayanan yang dilakukan</li>
                                </ol>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <a href="{{ route('anc.index') }}" class="btn btn-secondary me-md-2">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan Data</button>
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
