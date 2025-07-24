<div class="form-group">
    <label>Nama Posyandu</label>
    <input type="text" name="nama_posyandu" class="form-control @error('nama_posyandu') is-invalid @enderror"
        value="{{ old('nama_posyandu', $posyandu->nama_posyandu ?? '') }}" required>
    @error('nama_posyandu')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
