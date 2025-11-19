@extends('layouts.app')
@section('title', 'Data Peserta KB Baru')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Keluarga Berencana</h1>
            </div>
            <a href="{{ route('peserta-kb.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i>
                Tambah Data KB</a>
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
                                        <th>Posyandu</th>
                                        <th>Jenis Kontrasepsi</th>
                                        <th>Jalur Layanan</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($records as $index => $record)
                                        <tr>
                                            <td>{{ $records->firstItem() + $index }}</td>
                                            <td>{{ $record->nama_pasien }}</td>
                                            <td>{{ $record->posyandu->nama_posyandu }}</td>
                                            <td>{{ $record->jenis_kontrasepsi }}</td>
                                            <td>{{ $record->jalur_layanan }}</td>
                                            <td>{{ \Carbon\Carbon::parse($record->tanggal_pelayanan)->format('d/m/Y') }}
                                            </td>
                                            <td>
                                                <!-- Modifikasi Aksi -->
                                                <div classD="d-flex" style="gap: 6px;">
                                                    <button type="button" class="btn btn-info btn-sm view-button"
                                                        data-id="{{ $record->id }}" data-toggle="modal"
                                                        data-target="#kbDetailModal">
                                                        Detail
                                                    </button>
                                                    <a href="{{ route('peserta-kb.edit', $record->id) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>

                                                    <form action="{{ route('peserta-kb.destroy', $record->id) }}"
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
                                    @endFORELSE
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

    <!-- MODAL DETAIL KB (BARU) -->
    <div class="modal fade" id="kbDetailModal" tabindex="-1" aria-labelledby="kbDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kbDetailModalLabel">Detail Data Peserta KB: <span
                            id="modal-kb-nama-pasien"></span></h5>
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
                                    <td><span id="modal-kb-nama"></span></td>
                                </tr>
                                <tr>
                                    <th>Nama Posyandu</th>
                                    <td><span id="modal-kb-posyandu"></span></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Pelayanan</th>
                                    <td><span id="modal-kb-tanggal"></span></td>
                                </tr>
                                <tr>
                                    <th>Jenis Kontrasepsi</th>
                                    <td><span id="modal-kb-jenis"></span></td>
                                </tr>
                                <tr>
                                    <th>Jalur Layanan</th>
                                    <td><span id="modal-kb-jalur"></span></td>
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
        // Cek apakah session 'error_posyandu' ada dari controller
        @if (session('error_posyandu'))
            Swal.fire({
                title: 'Data Posyandu Kosong!',
                text: '{{ session('error_posyandu') }}',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK, Tambah Posyandu'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('posyandu.create') }}";
                }
            })
        @endif

        // JAVASCRIPT UNTUK MODAL DETAIL (BARU)
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
                        // Ganti URL fetch ke endpoint peserta-kb
                        const response = await fetch(`/peserta-kb/${recordId}`);
                        if (!response.ok) throw new Error(
                            `HTTP error! status: ${response.status}`);
                        const data = await response.json();

                        // Format tanggal
                        const tanggalPelayanan = new Date(data.tanggal_pelayanan)
                            .toLocaleDateString('id-ID', {
                                day: '2-digit',
                                month: 'long',
                                year: 'numeric'
                            });

                        // Isi data ke modal
                        document.getElementById('modal-kb-nama-pasien').textContent = data
                            .nama_pasien;
                        document.getElementById('modal-kb-nama').textContent = data.nama_pasien;
                        document.getElementById('modal-kb-posyandu').textContent = data.posyandu
                            .nama_posyandu; // Akses relasi
                        document.getElementById('modal-kb-tanggal').textContent =
                            tanggalPelayanan;
                        document.getElementById('modal-kb-jenis').textContent = data
                            .jenis_kontrasepsi;
                        document.getElementById('modal-kb-jalur').textContent = data
                            .jalur_layanan;

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
