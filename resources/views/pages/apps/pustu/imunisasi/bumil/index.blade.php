@extends('layouts.app')

@section('title', 'Data Imunisasi WUS & Bumil')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Imunisasi WUS & Bumil</h1>
            </div>
            <a href="{{ route('imunisasi-wus-bumil.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i>
                Tambah Data WUS & Bumil</a>
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4></h4>
                        <div class="card-header-action">
                            <a href="{{ route('imunisasi-wus-bumil.export') }}" class="btn btn-primary"><i
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
                                        <th>Nama Wus/Bumil</th>
                                        <th>Nama Suami</th>
                                        <th>Umur</th>
                                        <th>Hamil Ke</th>
                                        <th>Posyandu</th>
                                        <th>Imunisasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dataImunisasi as $index => $data)
                                        <tr>
                                            <td>{{ $dataImunisasi->firstItem() + $index }}</td>
                                            <td>{{ $data->nama_wus_bumil }}</td>
                                            <td>{{ $data->nama_suami }}</td>
                                            <td>{{ $data->umur }}</td>
                                            <td>{{ $data->hamil_ke ?? '-' }}</td>
                                            <td>{{ $data->posyandu->nama_posyandu }}</td>
                                            <td>{{ $data->jenisImunisasi->nama_imunisasi ?? 'N/A' }}</td>
                                            <td>
                                                <div class="d-flex" style="gap: 6px;">
                                                    <button type="button" class="btn btn-info btn-sm view-button"
                                                        data-id="{{ $data->id }}" data-toggle="modal"
                                                        data-target="#wusBumilDetailModal">
                                                        Detail
                                                    </button>
                                                    <a href="{{ route('imunisasi-wus-bumil.edit', $data->id) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>

                                                    <form id="delete-form-{{ $data->id }}"
                                                        action="{{ route('imunisasi-wus-bumil.destroy', $data->id) }}"
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
                                            <td colspan="8" class="text-center">Belum ada data.</td>
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

    <!-- MODAL DETAIL WUS/BUMIL -->
    <div class="modal fade" id="wusBumilDetailModal" tabindex="-1" aria-labelledby="wusBumilDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="wusBumilDetailModalLabel">Detail Imunisasi WUS/Bumil: <span
                            id="modal-wusbumil-nama"></span></h5>
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
                                    <th style="width: 30%;">Nama WUS/Bumil</th>
                                    <td><span id="modal-wusbumil-nama-pasien"></span></td>
                                </tr>
                                <tr>
                                    <th>Nama Suami</th>
                                    <td><span id="modal-wusbumil-suami"></span></td>
                                </tr>
                                <tr>
                                    <th>Umur</th>
                                    <td><span id="modal-wusbumil-umur"></span></td>
                                </tr>
                                <tr>
                                    <th>Hamil Ke</th>
                                    <td><span id="modal-wusbumil-hamil-ke"></span></td>
                                </tr>
                                <tr>
                                    <th>NIK</th>
                                    <td><span id="modal-wusbumil-nik"></span></td>
                                </tr>
                                <tr>
                                    <th>Alamat Lengkap</th>
                                    <td><span id="modal-wusbumil-alamat"></span></td>
                                </tr>
                                <tr>
                                    <th>Posyandu</th>
                                    <td><span id="modal-wusbumil-posyandu"></span></td>
                                </tr>
                                <tr>
                                    <th>Jenis Imunisasi</th>
                                    <td><span id="modal-wusbumil-imunisasi"></span></td>
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

{{-- TAMBAHKAN KODE JAVASCRIPT DI BAWAH INI --}}
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
                        const response = await fetch(`/imunisasi-wus-bumil/${recordId}`);
                        if (!response.ok) throw new Error(
                            `HTTP error! status: ${response.status}`);
                        const data = await response.json();

                        document.getElementById('modal-wusbumil-nama').textContent = data
                            .nama_wus_bumil;
                        document.getElementById('modal-wusbumil-nama-pasien').textContent = data
                            .nama_wus_bumil;
                        document.getElementById('modal-wusbumil-suami').textContent = data
                            .nama_suami;
                        document.getElementById('modal-wusbumil-umur').textContent = data.umur;
                        document.getElementById('modal-wusbumil-hamil-ke').textContent = data
                            .hamil_ke || '-';
                        document.getElementById('modal-wusbumil-nik').textContent = data.nik ||
                            '-';
                        document.getElementById('modal-wusbumil-alamat').textContent = data
                            .alamat_lengkap;
                        document.getElementById('modal-wusbumil-posyandu').textContent = data
                            .posyandu ? data.posyandu.nama_posyandu : 'N/A';
                        document.getElementById('modal-wusbumil-imunisasi').textContent = data
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
