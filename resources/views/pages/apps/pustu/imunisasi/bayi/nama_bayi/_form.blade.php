<div class="form-group">
    <label>Nama Bayi</label>
    <input type="text" name="nama_bayi" class="form-control @error('nama_bayi') is-invalid @enderror"
        value="{{ old('nama_bayi', $bayi->nama_bayi ?? '') }}" required>
    @error('nama_bayi')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label>Nama Orang Tua</label>
    <input type="text" name="nama_orang_tua" class="form-control"
        value="{{ old('nama_orang_tua', $bayi->nama_orang_tua ?? '') }}" required>
</div>

<div class="form-group">
    <label>Tanggal Lahir</label>
    <input type="date" name="tanggal_lahir" class="form-control"
        value="{{ old('tanggal_lahir', $bayi->tanggal_lahir ?? '') }}" required>
</div>

<div class="form-group">
    <label>Jenis Kelamin</label>
    <select name="jenis_kelamin" class="form-control" required>
        <option value="L" {{ old('jenis_kelamin', $bayi->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki
        </option>
        <option value="P" {{ old('jenis_kelamin', $bayi->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan
        </option>
    </select>
</div>

<div class="form-group">
    <label>Alamat Lengkap</label>
    <textarea name="alamat_lengkap" class="form-control" required>{{ old('alamat_lengkap', $bayi->alamat_lengkap ?? '') }}</textarea>
</div>

<div class="form-group">
    <label>NIK Orang Tua</label>
    <input type="text" name="nik_orang_tua" class="form-control"
        value="{{ old('nik_orang_tua', $bayi->nik_orang_tua ?? '') }}">
</div>

<div class="form-group">
    <label>NIK Bayi</label>
    <input type="text" name="nik_bayi" class="form-control" value="{{ old('nik_bayi', $bayi->nik_bayi ?? '') }}">
</div>
