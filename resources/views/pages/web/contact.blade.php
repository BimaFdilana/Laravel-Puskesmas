@extends('layouts.beranda')

@section('title', 'Kontak Kami')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-3 text-success mb-3 animated slideInDown">Contact Us</h1>
        </div>
    </div>
    <!-- Page Header End -->

    {{-- Pastikan variabel $beranda ada sebelum digunakan --}}
    @if ($beranda)
        <!-- Contact Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="h-100 bg-light rounded d-flex align-items-center p-5">
                            <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white"
                                style="width: 55px; height: 55px;">
                                <i class="fa fa-map-marker-alt text-success"></i>
                            </div>
                            <div class="ms-4">
                                <p class="mb-2">Alamat</p>
                                {{-- Data dinamis untuk alamat --}}
                                <h5 class="mb-0 text-break">{{ $beranda->contact_address }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="h-100 bg-light rounded d-flex align-items-center p-5">
                            <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white"
                                style="width: 55px; height: 55px;">
                                <i class="fa fa-phone-alt text-success"></i>
                            </div>
                            <div class="ms-4">
                                <p class="mb-2">Telepon</p>
                                {{-- Data dinamis untuk telepon --}}
                                <h5 class="mb-0 text-break">{{ $beranda->contact_phone }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="h-100 bg-light rounded d-flex align-items-center p-5">
                            <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white"
                                style="width: 55px; height: 55px;">
                                <i class="fa fa-envelope-open text-success"></i>
                            </div>
                            <div class="ms-4">
                                <p class="mb-2">Email</p>
                                {{-- PERBAIKAN: Menambahkan class "text-break" --}}
                                <h5 class="mb-0 text-break">{{ $beranda->contact_email }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="bg-light rounded p-5">
                            <p class="d-inline-block border rounded-pill py-1 px-4">Kontak Kami</p>
                            <h1 class="mb-4">Punya Pertanyaan? Silakan Hubungi Kami!</h1>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ route('contact.store') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" placeholder="Nama Anda"
                                                value="{{ old('name') }}">
                                            <label for="name">Nama Anda</label>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" placeholder="Email Anda"
                                                value="{{ old('email') }}">
                                            <label for="email">Email Anda</label>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text"
                                                class="form-control @error('subject') is-invalid @enderror" id="subject"
                                                name="subject" placeholder="Subjek" value="{{ old('subject') }}">
                                            <label for="subject">Subjek</label>
                                            @error('subject')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control @error('message') is-invalid @enderror" placeholder="Tinggalkan pesan di sini"
                                                id="message" name="message" style="height: 100px">{{ old('message') }}</textarea>
                                            <label for="message">Pesan</label>
                                            @error('message')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-success w-100 py-3" type="submit">Kirim Pesan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <div class="h-100" style="min-height: 400px;">
                            {{-- Data dinamis untuk Google Maps --}}
                            <iframe class="rounded w-100 h-100" src="{{ $beranda->google_maps_link }}" frameborder="0"
                                allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->
    @else
        <div class="container py-5 text-center">
            <p>Konten Kontak belum diatur oleh admin.</p>
        </div>
    @endif
@endsection
