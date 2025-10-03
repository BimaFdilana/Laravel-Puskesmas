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
                                        <th>JK</th>
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
                                            <td>{{ $data->jenis_kelamin }}</td>
                                            <td>{{ $data->posyandu->nama_posyandu ?? 'N/A' }}</td>
                                            <td>{{ $data->jenisImunisasi->nama_imunisasi ?? 'N/A' }}</td>
                                            <td>
                                                <form id="delete-form-{{ $data->id }}"
                                                    action="{{ route('imunisasi-bayi.destroy', $data->id) }}"
                                                    method="POST">
                                                    <a href="{{ route('imunisasi-bayi.edit', $data->id) }}"
                                                        class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm delete-button"
                                                        data-id="{{ $data->id }}"><i class="fas fa-trash"></i></button>
                                                </form>
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
                        {{ $dataImunisasi->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
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
    </script>
@endpush
