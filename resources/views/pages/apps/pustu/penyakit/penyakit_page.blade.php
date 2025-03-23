@extends('layouts.app')

@section('title', 'Penyakit Page')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Penyakit</h1>
            </div>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <a href="" class="btn btn-success mb-3">Tambah Data Penyakit</a>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Umur</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Penyakit</th>
                                            <th>Gejala</th>
                                            <th>Action</th>
                                        </tr>
                                        @if ($penyakit->isEmpty())
                                            <tr>
                                                <td colspan="7" class="text-center">Tidak ada data</td>
                                            </tr>
                                        @else
                                            @foreach ($penyakit as $index => $penyakit)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $penyakit->nama }}</td>
                                                    <td>{{ $penyakit->umur }}</td>
                                                    <td>{{ $penyakit->jenis_kelamin }}</td>
                                                    <td>{{ $penyakit->penyakit }}</td>
                                                    <td>{{ $penyakit->gejala }}</td>
                                                    <td>
                                                        <div class="d-flex" style="gap: 10px;">
                                                            <a href="" class="btn btn-warning">Edit</a>
                                                            <button type="button" class="btn btn-danger delete-button"
                                                                data-id="{{ $penyakit->id }}"
                                                                data-name="{{ $penyakit->nama }}">Hapus</button>

                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Durasi auto-close (ms) untuk alert biasa
            const alertTimeout = 5000; // 5 detik

            // Auto-close untuk alert sukses/error
            const alertElements = document.querySelectorAll('.alert-dismissible');
            alertElements.forEach(alert => {
                setTimeout(() => {
                    alert.classList.remove('show');
                    alert.addEventListener('transitionend', () => alert.remove());
                }, alertTimeout);
            });

            // SweetAlert Confirm untuk tombol Hapus
            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.getAttribute('data-id');
                    const userName = this.getAttribute('data-name');

                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: `Akun "${userName}" akan dihapus secara permanen!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#6777ef',
                        cancelButtonColor: '#fc544b',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = `/penyakit/${userId}`;
                            form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush
