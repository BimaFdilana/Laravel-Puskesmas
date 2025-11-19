@extends('layouts.app')

@section('title', 'Data Imunisasi Bayi')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Imunisasi Bayi</h1>
            </div>
            <a href="{{ route('imunisasi-bayi.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Tambah
                Data Bayi</a>
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4></h4>
                        <div class="card-header-action">
                            <a href="{{ route('imunisasi-bayi.export') }}" class="btn btn-primary"><i
                                    class="fas fa-file-excel"></i> Ekspor ke Excel</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Bayi</th>
                                        <th>Nama Ortu</th>
                                        <th>Tgl Lahir</th>
                                        <th>Posyandu</th>
                                        <th>Imunisasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dataImunisasi as $index => $data)
                                        <tr>
                                            <td>{{ $dataImunisasi->firstItem() + $index }}</td>
                                            <td>{{ $data->nama_bayi }}</td>
                                            <td>{{ $data->nama_orang_tua }}</td>
                                            <td>{{ \Carbon\Carbon::parse($data->tanggal_lahir)->format('d/m/Y') }}</td>
                                            <td>{{ $data->posyandu->nama_posyandu ?? 'N/A' }}</td>
                                            <td>{{ $data->jenisImunisasi->nama_imunisasi ?? 'N/A' }}</td>
                                            <td>
                                                <div class="d-flex" style="gap: 6px;">
                                                    <button type="button" class="btn btn-info btn-sm view-button"
                                                        data-id="{{ $data->id }}" data-toggle="modal"
                                                        data-target="#imunisasiDetailModal">
                                                        Detail
                                                    </button>
                                                    <a href="{{ route('imunisasi-bayi.edit', $data->id) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>

                                                    <form id="delete-form-{{ $data->id }}"
                                                        action="{{ route('imunisasi-bayi.destroy', $data->id) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm delete-button"
                                                            data-id="{{ $data->id }}"><i
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

                        @if ($dataImunisasi->hasPages())
                            <div class="d-flex justify-content-center mt-3">
                                {{ $dataImunisasi->appends(request()->query())->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- MODAL DETAIL IMUNISASI BAYI -->
    <div class="modal fade" id="imunisasiDetailModal" tabindex="-1" aria-labelledby="imunisasiDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imunisasiDetailModalLabel">Detail Data Imunisasi: <span
                            id="modal-imunisasi-nama"></span></h5>
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
                                    <th style="width: 30%;">Nama Bayi</th>
                                    <td><span id="modal-imunisasi-nama-bayi"></span></td>
                                </tr>
                                <tr>
                                    <th>Nama Orang Tua</th>
                                    <td><span id="modal-imunisasi-nama-ortu"></span></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir</th>
                                    <td><span id="modal-imunisasi-tgl-lahir"></span></td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td><span id="modal-imunisasi-jk"></span></td>
                                </tr>
                                <tr>
                                    <th>Alamat Lengkap</th>
                                    <td><span id="modal-imunisasi-alamat"></span></td>
                                </tr>
                                <tr>
                                    <th>NIK Orang Tua</th>
                                    <td><span id="modal-imunisasi-nik-ortu"></span></td>
                                </tr>
                                <tr>
                                    <th>NIK Bayi</th>
                                    <td><span id="modal-imunisasi-nik-bayi"></span></td>
                                </tr>
                                <tr>
                                    <th>Posyandu</th>
                                    <td><span id="modal-imunisasi-posyandu"></span></td>
                                </tr>
                                <tr>
                                    <th>Jenis Imunisasi</th>
                                    <td><span id="modal-imunisasi-jenis"></span></td>
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
        @if (session('show_posyandu_alert'))
            Swal.fire({
                title: 'Data Posyandu Kosong!',
                text: 'Anda harus mengisi data Posyandu terlebih dahulu untuk dapat menambahkan data Imunisasi.',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK, Tambah Posyandu'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('posyandu.create') }}";
                }
            })
        @endif

        const deleteButtons = document.querySelectorAll('.delete-button');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const dataId = this.getAttribute('data-id');
                const form = document.getElementById(`delete-form-${dataId}`);

                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            });
        });

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
                        const response = await fetch(`/imunisasi-bayi/${recordId}`);
                        if (!response.ok) throw new Error(
                            `HTTP error! status: ${response.status}`);
                        const data = await response.json();

                        const tanggalLahir = new Date(data.tanggal_lahir).toLocaleDateString(
                            'id-ID', {
                                day: '2-digit',
                                month: 'long',
                                year: 'numeric'
                            });

                        const jenisKelamin = data.jenis_kelamin == 'L' ? 'Laki-laki' :
                            'Perempuan';

                        document.getElementById('modal-imunisasi-nama').textContent = data
                            .nama_bayi;
                        document.getElementById('modal-imunisasi-nama-bayi').textContent = data
                            .nama_bayi;
                        document.getElementById('modal-imunisasi-nama-ortu').textContent = data
                            .nama_orang_tua;
                        document.getElementById('modal-imunisasi-tgl-lahir').textContent =
                            tanggalLahir;
                        document.getElementById('modal-imunisasi-jk').textContent =
                        jenisKelamin;
                        document.getElementById('modal-imunisasi-alamat').textContent = data
                            .alamat_lengkap;
                        document.getElementById('modal-imunisasi-nik-ortu').textContent = data
                            .nik_orang_tua || '-';
                        document.getElementById('modal-imunisasi-nik-bayi').textContent = data
                            .nik_bayi || '-';
                        document.getElementById('modal-imunisasi-posyandu').textContent = data
                            .posyandu ? data.posyandu.nama_posyandu : 'N/A';
                        document.getElementById('modal-imunisasi-jenis').textContent = data
                            .jenis_imunisasi ? data.jenis_imunisasi.nama_imunisasi : 'N/A';

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
