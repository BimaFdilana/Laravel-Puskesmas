<div class="row">
    <div class="form-group col-md-6">
        <label>Nama Bayi</label>
        <input type="text" name="nama_bayi" class="form-control"
            value="{{ old('nama_bayi', $imunisasiBayi->nama_bayi ?? '') }}" required>
    </div>
    <div class="form-group col-md-6">
        <label>Nama Posyandu</label>
        <input type="text" name="nama_posyandu" class="form-control"
            value="{{ old('nama_posyandu', $imunisasiBayi->nama_posyandu ?? '') }}" required>
    </div>
    <div class="form-group col-md-6">
        <label>Nama Orang Tua</label>
        <input type="text" name="nama_orang_tua" class="form-control"
            value="{{ old('nama_orang_tua', $imunisasiBayi->nama_orang_tua ?? '') }}" required>
    </div>
    <div class="form-group col-md-6">
        <label>Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" class="form-control"
            value="{{ old('tanggal_lahir', $imunisasiBayi->tanggal_lahir ?? '') }}" required>
    </div>
    <div class="form-group col-md-6">
        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-control" required>
            <option value="L"
                {{ old('jenis_kelamin', $imunisasiBayi->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki
            </option>
            <option value="P"
                {{ old('jenis_kelamin', $imunisasiBayi->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan
            </option>
        </select>
    </div>
    <div class="form-group col-md-6">
        <label>Jenis Imunisasi (Opsional)</label>
        <input type="text" name="jenis_imunisasi" class="form-control"
            value="{{ old('jenis_imunisasi', $imunisasiBayi->jenis_imunisasi ?? '') }}">
    </div>
    <div class="form-group col-12">
        <label>Alamat Lengkap</label>
        <textarea name="alamat_lengkap" class="form-control" required>{{ old('alamat_lengkap', $imunisasiBayi->alamat_lengkap ?? '') }}</textarea>
    </div>
    <div class="form-group col-md-6">
        <label>NIK Orang Tua (Opsional)</label>
        <input type="text" name="nik_orang_tua" class="form-control"
            value="{{ old('nik_orang_tua', $imunisasiBayi->nik_orang_tua ?? '') }}">
    </div>
    <div class="form-group col-md-6">
        <label>NIK Bayi (Opsional)</label>
        <input type="text" name="nik_bayi" class="form-control"
            value="{{ old('nik_bayi', $imunisasiBayi->nik_bayi ?? '') }}">
    </div>
</div>
