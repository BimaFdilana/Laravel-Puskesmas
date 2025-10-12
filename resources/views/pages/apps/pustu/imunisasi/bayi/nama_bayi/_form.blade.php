    <div class="form-group">
        <label>Nama Bayi</label>
        <input type="text" name="nama_bayi" class="form-control @error('nama_bayi') is-invalid @enderror"
            value="{{ old('nama_bayi', $bayi->nama_bayi ?? '') }}" required>
        @error('nama_bayi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
