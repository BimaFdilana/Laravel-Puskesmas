@extends('layouts.app')

@section('title', 'Ibu Hamil Page')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between w-100">
                <h1>Data Ibu Hamil (ANC)</h1>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses!</strong> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <a href="{{ route('anc.create') }}" class="btn btn-success mb-3">Tambah Data ANC</a>
            <div class="section-body">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>No</th>
                                    <th>Rekam Medis</th>
                                    <th>Kohort</th>
                                    <th>Nama Pasien</th>
                                    <th>NIK</th>
                                    <th>Petugas</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                                @forelse($records as $index => $record)
                                    <tr>
                                        <td>{{ $records->firstItem() + $index }}</td>
                                        <td>{{ $record->rekam_medis }}</td>
                                        <td>{{ $record->kohort }}</td>
                                        <td>{{ $record->nama_pasien }}</td>
                                        <td>{{ $record->nik }}</td>
                                        <td>{{ $record->petugas }}</td>
                                        <td>{{ $record->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <div class="d-flex" style="gap: 6px;">
                                                <button type="button" class="btn btn-info btn-sm view-button"
                                                    data-id="{{ $record->id }}" data-toggle="modal"
                                                    data-target="#ancDetailModal">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <a href="{{ route('anc.edit', $record) }}" class="btn btn-warning btn-sm"
                                                    title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('anc.export-word', $record) }}"
                                                    class="btn btn-success btn-sm" title="Export Word">
                                                    <i class="fas fa-file-word"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm delete-button"
                                                    data-id="{{ $record->id }}" data-name="{{ $record->nama_pasien }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            <div class="py-4">
                                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                                <h5 class="text-muted">Belum ada data Ibu Hamil (ANC)</h5>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>

                        @if ($records->hasPages())
                            <div class="d-flex justify-content-center mt-3">
                                {{ $records->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- MODAL UNTUK MENAMPILKAN DETAIL -->
    <div class="modal fade" id="ancDetailModal" tabindex="-1" aria-labelledby="ancDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ancDetailModalLabel">Detail Data ANC Pasien: <span
                            id="modal-nama-pasien"></span></h5>
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
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>No. Rekam Medis:</strong> <span id="modal-rekam-medis"></span><br>
                                <strong>Kohort:</strong> <span id="modal-kohort"></span><br>
                                <strong>NIK:</strong> <span id="modal-nik"></span>
                            </div>
                            <div class="col-md-6">
                                <strong>Alamat:</strong> <span id="modal-alamat"></span><br>
                                <strong>Petugas:</strong> <span id="modal-petugas"></span>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th rowspan="2" style="width: 5%;">No</th>
                                        <th rowspan="2" style="width: 35%;">Pemeriksaan</th>
                                        <th colspan="6">Kunjungan</th>
                                    </tr>
                                    <tr>
                                        <th>K1</th>
                                        <th>K2</th>
                                        <th>K3</th>
                                        <th>K4</th>
                                        <th>K5</th>
                                        <th>K6</th>
                                    </tr>
                                </thead>
                                <tbody id="modal-anc-table-body">
                                    {{-- Isi tabel akan di-generate oleh JavaScript --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const ancItems = @json(App\Models\AncRecord::getAncItems());

        document.addEventListener('DOMContentLoaded', function() {

            // KODE UNTUK SWEETALERT DELETE (YANG HILANG)
            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const recordId = this.dataset.id;
                    const recordName = this.dataset.name;

                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: `Data "${recordName}" akan dihapus secara permanen!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = `/anc/${recordId}`;
                            form.innerHTML = `@csrf @method('DELETE')`;
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                });
            });

            // KODE UNTUK MODAL LIHAT DETAIL (YANG SUDAH ADA)
            const viewButtons = document.querySelectorAll('.view-button');
            const modalLoading = document.getElementById('modal-loading');
            const modalContent = document.getElementById('modal-content');

            viewButtons.forEach(button => {
                button.addEventListener('click', async function() {
                    const recordId = this.dataset.id;
                    modalLoading.style.display = 'block';
                    modalContent.style.display = 'none';

                    try {
                        const response = await fetch(`/anc/${recordId}`);
                        if (!response.ok) throw new Error(
                            `HTTP error! status: ${response.status}`);
                        const data = await response.json();

                        document.getElementById('modal-nama-pasien').textContent = data
                            .nama_pasien;
                        document.getElementById('modal-rekam-medis').textContent = data
                            .rekam_medis;
                        document.getElementById('modal-kohort').textContent = data.kohort;
                        document.getElementById('modal-nik').textContent = data.nik;
                        document.getElementById('modal-alamat').textContent = data.alamat;
                        document.getElementById('modal-petugas').textContent = data.petugas;

                        const tableBody = document.getElementById('modal-anc-table-body');
                        tableBody.innerHTML = '';

                        for (const no in ancItems) {
                            const itemText = ancItems[no];
                            let rowHtml =
                                `<tr><td class="text-center">${no}</td><td>${itemText}</td>`;

                            ['k1', 'k2', 'k3', 'k4', 'k5', 'k6'].forEach(kunjungan => {
                                const isChecked = data[kunjungan] && Array.isArray(data[
                                        kunjungan]) && data[kunjungan].map(String)
                                    .includes(String(no));
                                rowHtml +=
                                    `<td class="text-center">${isChecked ? '✓' : '-'}</td>`;
                            });

                            rowHtml += `</tr>`;
                            tableBody.innerHTML += rowHtml;
                        }

                        modalLoading.style.display = 'none';
                        modalContent.style.display = 'block';

                    } catch (error) {
                        console.error('Error saat mengambil data detail:', error);
                        alert(
                            'Tidak dapat memuat detail data. Cek console untuk info lebih lanjut.');
                        modalLoading.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endpush
