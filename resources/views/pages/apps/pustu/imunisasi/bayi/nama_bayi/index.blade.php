@extends('layouts.app')
@section('title', 'Master Data Bayi')
@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Master Data Bayi</h1>
            </div>
            <div class="card-header-action">
                <a href="{{ route('bayi.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Tambah
                    Bayi</a>
            </div>
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
                                        <th>Nama Bayi</th>
                                        <th>Nama Orang Tua</th>
                                        <th>Tgl Lahir</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $index => $item)
                                        <tr>
                                            <td>{{ $data->firstItem() + $index }}</td>
                                            <td>{{ $item->nama_bayi }}</td>
                                            <td>{{ $item->nama_orang_tua }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d/m/Y') }}</td>
                                            <td>
                                                <div class="d-flex" style="gap: 6px;">
                                                    <button type="button" class="btn btn-info btn-sm view-button"
                                                        data-id="{{ $item->id }}" data-toggle="modal"
                                                        data-target="#bayiDetailModal">
                                                        Detail
                                                    </button>
                                                    <a href="{{ route('bayi.edit', $item->id) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('bayi.destroy', $item->id) }}" method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus data ini?');"
                                                        style="display: inline-block;">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Belum ada data.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if ($data->hasPages())
                            <div class="d-flex justify-content-center mt-3">
                                {{ $data->appends(request()->query())->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- MODAL DETAIL BAYI -->
    <div class="modal fade" id="bayiDetailModal" tabindex="-1" aria-labelledby="bayiDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bayiDetailModalLabel">Detail Data Bayi: <span
                            id="modal-bayi-nama-pasien"></span></h5>
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
                                    <td><span id="modal-bayi-nama"></span></td>
                                </tr>
                                <tr>
                                    <th>Nama Orang Tua</th>
                                    <td><span id="modal-bayi-nama-ortu"></span></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir</th>
                                    <td><span id="modal-bayi-tgl-lahir"></span></td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td><span id="modal-bayi-jk"></span></td>
                                </tr>
                                <tr>
                                    <th>Alamat Lengkap</th>
                                    <td><span id="modal-bayi-alamat"></span></td>
                                </tr>
                                <tr>
                                    <th>NIK Orang Tua</th>
                                    <td><span id="modal-bayi-nik-ortu"></span></td>
                                </tr>
                                <tr>
                                    <th>NIK Bayi</th>
                                    <td><span id="modal-bayi-nik-bayi"></span></td>
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
                        const response = await fetch(`/bayi/${recordId}`);
                        if (!response.ok) throw new Error(
                            `HTTP error! status: ${response.status}`);
                        const data = await response.json();

                        // Format tanggal
                        const tanggalLahir = new Date(data.tanggal_lahir).toLocaleDateString(
                            'id-ID', {
                                day: '2-digit',
                                month: 'long',
                                year: 'numeric'
                            });

                        // Format Jenis Kelamin
                        const jenisKelamin = data.jenis_kelamin == 'L' ? 'Laki-laki' :
                            'Perempuan';

                        // Isi data ke modal
                        document.getElementById('modal-bayi-nama-pasien').textContent = data
                            .nama_bayi;
                        document.getElementById('modal-bayi-nama').textContent = data.nama_bayi;
                        document.getElementById('modal-bayi-nama-ortu').textContent = data
                            .nama_orang_tua;
                        document.getElementById('modal-bayi-tgl-lahir').textContent =
                            tanggalLahir;
                        document.getElementById('modal-bayi-jk').textContent = jenisKelamin;
                        document.getElementById('modal-bayi-alamat').textContent = data
                            .alamat_lengkap;
                        document.getElementById('modal-bayi-nik-ortu').textContent = data
                            .nik_orang_tua || '-';
                        document.getElementById('modal-bayi-nik-bayi').textContent = data
                            .nik_bayi || '-';

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
