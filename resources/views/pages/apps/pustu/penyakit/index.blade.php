@extends('layouts.app')
@section('title', 'Data Surveilans Penyakit')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Surveilans Penyakit</h1>
            </div>
            <a href="{{ route('surveilans-penyakit.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Tambah
                Kasus</a>
            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pasien</th>
                                        <th>Penyakit</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Tanggal Kunjungan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($records as $index => $record)
                                        <tr>
                                            <td>{{ $records->firstItem() + $index }}</td>
                                            <td>{{ $record->nama_pasien }}</td>
                                            <td>{{ $record->penyakit->nama_penyakit }}</td>
                                            <td>{{ $record->jenis_kelamin }}</td>
                                            <td>{{ \Carbon\Carbon::parse($record->tanggal_lahir)->format('d/m/Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($record->tanggal_kunjungan)->format('d/m/Y') }}
                                            </td>
                                            <td>
                                                <div class="d-flex" style="gap: 6px;">
                                                    <button type="button" class="btn btn-info btn-sm view-button"
                                                        data-id="{{ $record->id }}" data-toggle="modal"
                                                        data-target="#surveilansDetailModal">
                                                        Detail
                                                    </button>
                                                    <a href="{{ route('surveilans-penyakit.edit', $record->id) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>

                                                    <form action="{{ route('surveilans-penyakit.destroy', $record->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus data ini?');"
                                                        style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Belum ada data.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if ($records->hasPages())
                            <div class="d-flex justify-content-center mt-3">
                                {{ $records->appends(request()->query())->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- MODAL DETAIL SURVEILANS -->
    <div class="modal fade" id="surveilansDetailModal" tabindex="-1" aria-labelledby="surveilansDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="surveilansDetailModalLabel">Detail Kasus: <span
                            id="modal-surveilans-nama"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="modal-loading" class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p>Memuat data...</p>
                    </div>
                    <div id="modal-content" style="display: none;">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th style="width: 30%;">Nama Pasien</th>
                                    <td><span id="modal-surveilans-nama-pasien"></span></td>
                                </tr>
                                <tr>
                                    <th>Penyakit</th>
                                    <td><span id="modal-surveilans-penyakit"></span></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir</th>
                                    <td><span id="modal-surveilans-tgl-lahir"></span></td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td><span id="modal-surveilans-jk"></span></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Kunjungan</th>
                                    <td><span id="modal-surveilans-tgl-kunjungan"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: "success",
                title: "Berhasil!",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2500
            });
        @endif

        // SCRIPT MODAL DETAIL BARU
        document.addEventListener('DOMContentLoaded', function() {
            const viewButtons = document.querySelectorAll('.view-button');
            const modalLoading = document.getElementById('modal-loading');
            const modalContent = document.getElementById('modal-content');

            viewButtons.forEach(button => {
                button.addEventListener('click', async function() {
                    const recordId = this.dataset.id;
                    modalLoading.style.display = 'block';
                    modalContent.style.display = 'none';

                    try {
                        const response = await fetch(`/surveilans-penyakit/${recordId}`);
                        if (!response.ok) throw new Error(
                            `HTTP error! status: ${response.status}`);
                        const data = await response.json();

                        const tanggalLahir = new Date(data.tanggal_lahir).toLocaleDateString(
                            'id-ID', {
                                day: '2-digit',
                                month: 'long',
                                year: 'numeric'
                            });
                        const tanggalKunjungan = new Date(data.tanggal_kunjungan)
                            .toLocaleDateString('id-ID', {
                                day: '2-digit',
                                month: 'long',
                                year: 'numeric'
                            });
                        const jenisKelamin = data.jenis_kelamin == 'L' ? 'Laki-laki' :
                            'Perempuan';

                        document.getElementById('modal-surveilans-nama').textContent = data
                            .nama_pasien;
                        document.getElementById('modal-surveilans-nama-pasien').textContent =
                            data.nama_pasien;
                        document.getElementById('modal-surveilans-penyakit').textContent = data
                            .penyakit ? data.penyakit.nama_penyakit : 'N/A';
                        document.getElementById('modal-surveilans-tgl-lahir').textContent =
                            tanggalLahir;
                        document.getElementById('modal-surveilans-jk').textContent =
                            jenisKelamin;
                        document.getElementById('modal-surveilans-tgl-kunjungan').textContent =
                            tanggalKunjungan;

                        modalLoading.style.display = 'none';
                        modalContent.style.display = 'block';

                    } catch (error) {
                        console.error('Error saat mengambil data detail:', error);
                        alert(
                            'Tidak dapat memuat detail data. Cek console untuk info lebih lanjut.'
                        );
                        modalLoading.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endpush
