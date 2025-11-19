@extends('layouts.app')

@section('title', 'Laporan Ibu Hamil')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Laporan Ibu Hamil (ANC)</h1>
            </div>

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
                                                    data-target="#ancDetailModal" title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </button>

                                                <a href="{{ route('anc.export-word', $record) }}"
                                                    class="btn btn-primary btn-sm" title="Export Word">
                                                    <i class="fas fa-file-word"></i>
                                                </a>

                                                <a href="{{ route('anc.export-pdf', $record) }}"
                                                    class="btn btn-danger btn-sm" title="Export PDF">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Belum ada data.</td>
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
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td width="35%"><strong>No. Rekam Medis</strong></td>
                                        <td>: <span id="modal-rekam-medis"></span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Kohort</strong></td>
                                        <td>: <span id="modal-kohort"></span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>NIK</strong></td>
                                        <td>: <span id="modal-nik"></span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td width="35%"><strong>Alamat</strong></td>
                                        <td>: <span id="modal-alamat"></span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Petugas</strong></td>
                                        <td>: <span id="modal-petugas"></span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tanggal Input</strong></td>
                                        <td>: <span id="modal-tanggal"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="bg-light">
                                    <tr>
                                        <th rowspan="2" class="text-center align-middle" style="width: 5%;">No</th>
                                        <th rowspan="2" class="align-middle" style="width: 35%;">Jenis Pemeriksaan (10H)
                                        </th>
                                        <th colspan="6" class="text-center">Kunjungan</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">K1</th>
                                        <th class="text-center">K2</th>
                                        <th class="text-center">K3</th>
                                        <th class="text-center">K4</th>
                                        <th class="text-center">K5</th>
                                        <th class="text-center">K6</th>
                                    </tr>
                                </thead>
                                <tbody id="modal-anc-table-body">
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
    <script>
        const ancItems = @json(App\Models\AncRecord::getAncItems());

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

                        const date = new Date(data.created_at);
                        document.getElementById('modal-tanggal').textContent = date
                            .toLocaleDateString('id-ID');

                        const tableBody = document.getElementById('modal-anc-table-body');
                        tableBody.innerHTML = '';

                        for (const no in ancItems) {
                            const itemText = ancItems[no];
                            let rowHtml =
                                `<tr><td class="text-center">${no}</td><td>${itemText}</td>`;

                            ['k1', 'k2', 'k3', 'k4', 'k5', 'k6'].forEach(kunjungan => {
                                const isChecked = data[kunjungan] && Array.isArray(data[
                                        kunjungan]) &&
                                    data[kunjungan].map(String).includes(String(no));

                                const checkIcon = isChecked ?
                                    '<i class="fas fa-check text-success font-weight-bold"></i>' :
                                    '<span class="text-muted">-</span>';

                                rowHtml += `<td class="text-center">${checkIcon}</td>`;
                            });

                            rowHtml += `</tr>`;
                            tableBody.innerHTML += rowHtml;
                        }

                        modalLoading.style.display = 'none';
                        modalContent.style.display = 'block';

                    } catch (error) {
                        console.error('Error saat mengambil data detail:', error);
                        alert('Tidak dapat memuat detail data.');
                        modalLoading.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endpush
