@extends('layouts.app')
@section('title', 'Edit Data Surveilans')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Kasus Surveilans</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <form action="{{ route('surveilans-penyakit.update', $surveilans_penyakit->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Formulir Edit Kasus</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Pasien</label>
                                <input type="text" name="nama_pasien"
                                    class="form-control @error('nama_pasien') is-invalid @enderror"
                                    value="{{ old('nama_pasien', $surveilans_penyakit->nama_pasien) }}" required>
                                @error('nama_pasien')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir"
                                            class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                            value="{{ old('tanggal_lahir', $surveilans_penyakit->tanggal_lahir) }}"
                                            required>
                                        @error('tanggal_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select name="jenis_kelamin"
                                            class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                                            <option value="L"
                                                {{ old('jenis_kelamin', $surveilans_penyakit->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="P"
                                                {{ old('jenis_kelamin', $surveilans_penyakit->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Penyakit yang Didiagnosis</label>
                                <select name="penyakit_id" class="form-control @error('penyakit_id') is-invalid @enderror"
                                    required>
                                    @foreach ($penyakitList as $penyakit)
                                        <option value="{{ $penyakit->id }}"
                                            {{ old('penyakit_id', $surveilans_penyakit->penyakit_id) == $penyakit->id ? 'selected' : '' }}>
                                            {{ $penyakit->nama_penyakit }}</option>
                                    @endforeach
                                </select>
                                @error('penyakit_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Tanggal Kunjungan</label>
                                <input type="date" name="tanggal_kunjungan"
                                    class="form-control @error('tanggal_kunjungan') is-invalid @enderror"
                                    value="{{ old('tanggal_kunjungan', $surveilans_penyakit->tanggal_kunjungan) }}"
                                    required>
                                @error('tanggal_kunjungan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Perbarui</button>
                            <a href="{{ route('surveilans-penyakit.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
