@extends('layouts.app')

@section('title', 'Tambah Akun')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Akun</h1>
                <div class="section-header-breadcrumb">
                    <a href="{{ route('usersData') }}" class="btn btn-danger">Tutup</a>
                </div>
            </div>

            {{-- Alert sukses & error --}}
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

            {{-- Tampilkan semua error sekaligus --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Puskesmas Pembantu</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('registerPustu') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" class="form-control @error('password') is-invalid @enderror"
                                            name="password" required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <input type="hidden" name="role_id" value="2">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alertTimeout = 5000; // 5 detik
            const alertElements = document.querySelectorAll('.alert-dismissible');
            alertElements.forEach(alert => {
                setTimeout(() => {
                    alert.classList.remove('show');
                    alert.addEventListener('transitionend', () => alert.remove());
                }, alertTimeout);
            });
        });
    </script>
@endpush
