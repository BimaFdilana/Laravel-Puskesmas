<div class="row">
    <div class="form-group col-md-6">
        <label>Nama Bayi</label>
        <select name="nama_bayi" id="nama_bayi_select" class="form-control" required>
            <option value="">-- Pilih Nama Bayi --</option>
            @foreach ($bayiList as $bayi)
                <option value="{{ $bayi->nama_bayi }}" {{-- Tambahkan data attributes di sini --}} data-nama_ortu="{{ $bayi->nama_orang_tua }}"
                    data-tgl_lahir="{{ $bayi->tanggal_lahir }}" data-jk="{{ $bayi->jenis_kelamin }}"
                    data-alamat="{{ $bayi->alamat_lengkap }}" data-nik_ortu="{{ $bayi->nik_orang_tua }}"
                    data-nik_bayi="{{ $bayi->nik_bayi }}"
                    {{ old('nama_bayi', $imunisasiBayi->nama_bayi ?? '') == $bayi->nama_bayi ? 'selected' : '' }}>
                    {{ $bayi->nama_bayi }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-6">
        <label>Nama Posyandu</label>
        <select name="posyandu_id" class="form-control" required>
            <option value="">-- Pilih Posyandu --</option>
            @foreach ($posyanduList as $posyandu)
                <option value="{{ $posyandu->id }}"
                    {{ old('posyandu_id', $imunisasiBayi->posyandu_id ?? '') == $posyandu->id ? 'selected' : '' }}>
                    {{ $posyandu->nama_posyandu }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-md-6">
        <label>Nama Orang Tua</label>
        <input type="text" name="nama_orang_tua" id="nama_orang_tua" class="form-control"
            value="{{ old('nama_orang_tua', $imunisasiBayi->nama_orang_tua ?? '') }}" required>
    </div>
    <div class="form-group col-md-6">
        <label>Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control"
            value="{{ old('tanggal_lahir', $imunisasiBayi->tanggal_lahir ?? '') }}" required>
    </div>
    <div class="form-group col-md-6">
        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
            <option value="L"
                {{ old('jenis_kelamin', $imunisasiBayi->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki
            </option>
            <option value="P"
                {{ old('jenis_kelamin', $imunisasiBayi->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan
            </option>
        </select>
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
    <div class="form-group col-12">
        <label>Alamat Lengkap</label>
        <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control" required>{{ old('alamat_lengkap', $imunisasiBayi->alamat_lengkap ?? '') }}</textarea>
    </div>
    <div class="form-group col-md-6">
        <label>NIK Orang Tua</label>
        <input type="text" name="nik_orang_tua" id="nik_orang_tua" class="form-control"
            value="{{ old('nik_orang_tua', $imunisasiBayi->nik_orang_tua ?? '') }}">
    </div>
    <div class="form-group col-md-6">
        <label>NIK Bayi</label>
        <input type="text" name="nik_bayi" id="nik_bayi" class="form-control"
            value="{{ old('nik_bayi', $imunisasiBayi->nik_bayi ?? '') }}">
    </div>
</div>
