<div class="card-body">
    {{-- Informasi Umum --}}
    <div class="row">
        <div class="form-group col-md-6">
            <label>Nama Posyandu</label>
            <input type="text" name="nama_posyandu" class="form-control"
                value="{{ old('nama_posyandu', $laporanImunisasi->nama_posyandu ?? '') }}" required>
        </div>
        <div class="form-group col-md-6">
            <label>Desa</label>
            <input type="text" name="desa" class="form-control"
                value="{{ old('desa', $laporanImunisasi->desa ?? '') }}" required>
        </div>
        <div class="form-group col-md-6">
            <label>Bulan</label>
            <input type="text" name="bulan" class="form-control"
                value="{{ old('bulan', $laporanImunisasi->bulan ?? '') }}" required>
        </div>
        <div class="form-group col-md-6">
            <label>Tahun</label>
            <input type="number" name="tahun" class="form-control"
                value="{{ old('tahun', $laporanImunisasi->tahun ?? date('Y')) }}" required>
        </div>
    </div>
    <hr>

    {{-- Tabel Input Data --}}
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th rowspan="2" class="align-middle">Jenis Imunisasi</th>
                    <th colspan="2">Jumlah Bayi di Imunisasi</th>
                </tr>
                <tr>
                    <th>Laki-laki (L)</th>
                    <th>Perempuan (P)</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $imunisasiBayi = [
                        'hbo' => 'HBO',
                        'bcg' => 'BCG',
                        'polio1' => 'Polio 1',
                        'dpthbhib1' => 'DPTHBHIB 1',
                        'polio2' => 'Polio 2',
                        'dpthbhib2' => 'DPTHBHIB 2',
                        'polio3' => 'Polio 3',
                        'dpthbhib3' => 'DPTHBHIB 3',
                        'polio4' => 'Polio 4',
                        'ipv' => 'IPV',
                        'campak' => 'Campak',
                        'dpthbhib_booster' => 'DPTHBHIB Booster',
                        'campak_booster' => 'Campak Booster',
                    ];
                @endphp
                @foreach ($imunisasiBayi as $key => $label)
                    <tr>
                        <td class="text-left">{{ $label }}</td>
                        <td><input type="number" name="{{ $key }}_l" class="form-control"
                                value="{{ old($key . '_l', $laporanImunisasi->{$key . '_l'} ?? 0) }}"></td>
                        <td><input type="number" name="{{ $key }}_p" class="form-control"
                                value="{{ old($key . '_p', $laporanImunisasi->{$key . '_p'} ?? 0) }}"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <h5>TT BUMIL</h5>
            @foreach (['tt3', 'tt4', 'tt5'] as $tt)
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{ strtoupper($tt) }}</label>
                    <div class="col-sm-9">
                        <input type="number" name="tt_bumil_{{ $tt }}" class="form-control"
                            value="{{ old('tt_bumil_' . $tt, $laporanImunisasi->{'tt_bumil_' . $tt} ?? 0) }}">
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-6">
            <h5>TT WUS</h5>
            @foreach (['tt3', 'tt4', 'tt5'] as $tt)
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{ strtoupper($tt) }}</label>
                    <div class="col-sm-9">
                        <input type="number" name="tt_wus_{{ $tt }}" class="form-control"
                            value="{{ old('tt_wus_' . $tt, $laporanImunisasi->{'tt_wus_' . $tt} ?? 0) }}">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
