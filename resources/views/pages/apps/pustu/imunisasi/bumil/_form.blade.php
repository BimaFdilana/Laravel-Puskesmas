<div class="row">
    <div class="form-group col-md-6">
        <label>Nama Posyandu</label>
        <select name="posyandu_id" class="form-control" required>
            <option value="">-- Pilih Posyandu --</option>
            @foreach ($posyanduList as $posyandu)
                <option value="{{ $posyandu->id }}"
                    {{ old('posyandu_id', $imunisasiWusBumil->posyandu_id ?? '') == $posyandu->id ? 'selected' : '' }}>
                    {{ $posyandu->nama_posyandu }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-6">
        <label>Nama Wus/Bumil</label>
        <input type="text" name="nama_wus_bumil" class="form-control"
            value="{{ old('nama_wus_bumil', $imunisasiWusBumil->nama_wus_bumil ?? '') }}" required>
    </div>
    <div class="form-group col-md-6">
        <label>Nama Suami</label>
        <input type="text" name="nama_suami" class="form-control"
            value="{{ old('nama_suami', $imunisasiWusBumil->nama_suami ?? '') }}" required>
    </div>
    <div class="form-group col-md-6">
        <label>Umur</label>
        <input type="number" name="umur" class="form-control"
            value="{{ old('umur', $imunisasiWusBumil->umur ?? '') }}" required>
    </div>
    <div class="form-group col-md-6">
        <label>Hamil Ke</label>
        <input type="number" name="hamil_ke" class="form-control"
            value="{{ old('hamil_ke', $imunisasiWusBumil->hamil_ke ?? '') }}">
    </div>
    <div class="form-group col-md-6">
        <label>Jenis Imunisasi</label>
        <select name="jenis_imunisasi_id" class="form-control">
            <option value="">-- Pilih Imunisasi --</option>
            @foreach ($jenisImunisasiList as $jenis)
                <option value="{{ $jenis->id }}"
                    {{ old('jenis_imunisasi_id', $imunisasiBayi->jenis_imunisasi_id ?? '') == $jenis->id ? 'selected' : '' }}>
                    {{ $jenis->nama_imunisasi }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-6">
        <label>NIK</label>
        <input type="text" name="nik" class="form-control"
            value="{{ old('nik', $imunisasiWusBumil->nik ?? '') }}">
    </div>
    <div class="form-group col-6">
        <label>Alamat Lengkap</label>
        <textarea name="alamat_lengkap" class="form-control" required>{{ old('alamat_lengkap', $imunisasiWusBumil->alamat_lengkap ?? '') }}</textarea>
    </div>
</div>
