@extends('layouts.app')
@section('title', 'Edit Data Peserta KB')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Data Peserta KB Baru</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <form action="{{ route('peserta-kb.update', $peserta_kb->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Pasien</label>
                                <input type="text" name="nama_pasien"
                                    class="form-control @error('nama_pasien') is-invalid @enderror"
                                    value="{{ old('nama_pasien', $peserta_kb->nama_pasien) }}" required>
                                @error('nama_pasien')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Tanggal Pelayanan</label>
                                <input type="date" name="tanggal_pelayanan"
                                    class="form-control @error('tanggal_pelayanan') is-invalid @enderror"
                                    value="{{ old('tanggal_pelayanan', $peserta_kb->tanggal_pelayanan) }}" required>
                                @error('tanggal_pelayanan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Posyandu</label>
                                <select name="posyandu_id" class="form-control @error('posyandu_id') is-invalid @enderror"
                                    required>
                                    @foreach ($posyanduList as $posyandu)
                                        <option value="{{ $posyandu->id }}"
                                            {{ old('posyandu_id', $peserta_kb->posyandu_id) == $posyandu->id ? 'selected' : '' }}>
                                            {{ $posyandu->nama_posyandu }}</option>
                                    @endforeach
                                </select>
                                @error('posyandu_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Jenis Kontrasepsi</label>
                                <select name="jenis_kontrasepsi"
                                    class="form-control @error('jenis_kontrasepsi') is-invalid @enderror" required>
                                    <option value="PIL"
                                        {{ old('jenis_kontrasepsi', $peserta_kb->jenis_kontrasepsi) == 'PIL' ? 'selected' : '' }}>
                                        PIL</option>
                                    <option value="SUNTIK"
                                        {{ old('jenis_kontrasepsi', $peserta_kb->jenis_kontrasepsi) == 'SUNTIK' ? 'selected' : '' }}>
                                        SUNTIK</option>
                                    <option value="KONDOM"
                                        {{ old('jenis_kontrasepsi', $peserta_kb->jenis_kontrasepsi) == 'KONDOM' ? 'selected' : '' }}>
                                        KONDOM</option>
                                    <option value="IUD"
                                        {{ old('jenis_kontrasepsi', $peserta_kb->jenis_kontrasepsi) == 'IUD' ? 'selected' : '' }}>
                                        IUD</option>
                                    <option value="IMPLAN"
                                        {{ old('jenis_kontrasepsi', $peserta_kb->jenis_kontrasepsi) == 'IMPLAN' ? 'selected' : '' }}>
                                        IMPLAN</option>
                                    <option value="MOW"
                                        {{ old('jenis_kontrasepsi', $peserta_kb->jenis_kontrasepsi) == 'MOW' ? 'selected' : '' }}>
                                        MOW</option>
                                    <option value="MOP"
                                        {{ old('jenis_kontrasepsi', $peserta_kb->jenis_kontrasepsi) == 'MOP' ? 'selected' : '' }}>
                                        MOP</option>
                                </select>
                                @error('jenis_kontrasepsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Jalur Layanan</label>
                                <select name="jalur_layanan"
                                    class="form-control @error('jalur_layanan') is-invalid @enderror" required>
                                    <option value="UMUM"
                                        {{ old('jalur_layanan', $peserta_kb->jalur_layanan) == 'UMUM' ? 'selected' : '' }}>
                                        UMUM</option>
                                    <option value="BPJS/K"
                                        {{ old('jalur_layanan', $peserta_kb->jalur_layanan) == 'BPJS/K' ? 'selected' : '' }}>
                                        BPJS/K</option>
                                    <option value="PASCA SALIN"
                                        {{ old('jalur_layanan', $peserta_kb->jalur_layanan) == 'PASCA SALIN' ? 'selected' : '' }}>
                                        PASCA SALIN</option>
                                </select>
                                @error('jalur_layanan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-danger">Perbarui</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
