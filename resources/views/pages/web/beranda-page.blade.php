@extends('layouts.beranda')

@section('title', 'Beranda')

@section('content')
    {{-- Pastikan variabel $beranda ada sebelum digunakan untuk menghindari error --}}
    @if ($beranda)
        <div class="container-fluid py-5 mb-5 hero-header" style="height: 100vh; padding-top: 0 !important;">
            <div class="container py-5" style="height: 100vh;">
                <div class="row g-5 align-items-center" style="height:100vh;">
                    <div class="col-md-12 col-lg-6">
                        @auth
                            <h4 class="mb-3 text-black" style="font-weight: bold;">Selamat Datang {{ Auth::user()->name }}</h4>
                        @else
                            <h4 class="mb-3 text-black" style="font-weight: bold;">Selamat Datang!</h4>
                        @endauth
                        <h2 class="mb-5 text-success" style="border-bottom: 3px solid; font-weight: bold;">
                            {{ $beranda->hero_title }}</h2>
                        <h5 class="mb-3 text-black" style="font-style:italic;">{{ $beranda->hero_subtitle }}</h5>
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn btn-success">Dashboard</a>
                        @else
                            <div class="dropdown">
                                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu2"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Mari Bergabung
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <a href="{{ route('login') }}"><button class="dropdown-item"
                                            type="button">Pustu</button></a>
                                    <a href="{{ route('login') }}"><button class="dropdown-item"
                                            type="button">Puskesmas</button></a>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="d-flex flex-column">
                            <img class="img-fluid rounded w-75 align-self-end"
                                src="{{ asset('storage/' . $beranda->about_image_1) }}" alt="About 1">
                            <img class="img-fluid rounded w-50 bg-white pt-3 pe-3"
                                src="{{ asset('storage/' . $beranda->about_image_2) }}" alt="About 2"
                                style="margin-top: -25%;">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <p class="d-inline-block border rounded-pill py-1 px-4">About Us</p>
                        <h1 class="mb-4">{{ $beranda->about_title }}</h1>
                        <p>{!! nl2br(e($beranda->about_description)) !!}</p>
                        {{-- Mengubah baris baru menjadi <br> --}}
                        @php
                            $points = explode("\n", $beranda->about_points);
                        @endphp
                        @foreach ($points as $point)
                            <p><i class="far fa-check-circle text-success me-3"></i>{{ trim($point) }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

        <!-- Service Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <p class="d-inline-block border rounded-pill py-1 px-4">Services</p>
                    <h1>Health Care Solutions</h1>
                </div>
                <div class="row g-4">
                    @forelse ($services as $service)
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="service-item bg-light rounded h-100 p-5">
                                <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4"
                                    style="width: 65px; height: 65px;">
                                    <i class="{{ $service->icon }} text-success fs-4"></i>
                                </div>
                                <h4 class="mb-3">{{ $service->title }}</h4>
                                <p class="mb-4">{{ $service->description }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">Belum ada layanan yang tersedia.</p>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- Service End -->

        <!-- Feature Start -->
        <div class="container-fluid bg-success overflow-hidden my-5 px-lg-0">
            <div class="container feature px-lg-0">
                <div class="row g-0 mx-lg-0">
                    <div class="col-lg-6 feature-text py-5 wow fadeIn" data-wow-delay="0.1s">
                        <div class="p-lg-5 ps-lg-0">
                            <p class="d-inline-block border rounded-pill text-light py-1 px-4">Features</p>
                            <h1 class="text-white mb-4">{{ $beranda->feature_title }}</h1>
                            <p class="text-white mb-4 pb-2">{!! nl2br(e($beranda->feature_description)) !!}</p>
                            {{-- ... Fitur statis bisa dibiarkan atau dibuat dinamis juga ... --}}
                        </div>
                    </div>
                    <div class="col-lg-6 pe-lg-0 wow fadeIn" data-wow-delay="0.5s" style="min-height: 400px;">
                        <div class="position-relative h-100">
                            <img class="position-absolute img-fluid w-100 h-100"
                                src="{{ asset('storage/' . $beranda->feature_image) }}" style="object-fit: cover;"
                                alt="Feature">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Feature End -->

        <!-- Team Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <p class="d-inline-block border rounded-pill py-1 px-4">Doctors</p>
                    <h1>Our Experience Doctors</h1>
                </div>
                <div class="row g-4">
                    @forelse ($doctors as $doctor)
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="team-item position-relative rounded overflow-hidden">
                                <div class="overflow-hidden">
                                    <img class="img-fluid" src="{{ asset('storage/' . $doctor->photo) }}"
                                        alt="{{ $doctor->name }}">
                                </div>
                                <div class="team-text bg-light text-center p-4">
                                    <h5>{{ $doctor->name }}</h5>
                                    <p class="text-success">{{ $doctor->department }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">Belum ada data dokter yang tersedia.</p>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- Team End -->

        <!-- Appointment Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                        <p class="d-inline-block border rounded-pill py-1 px-4">Appointment</p>
                        <h1 class="mb-4">{{ $beranda->appointment_title }}</h1>
                        <p class="mb-4">{!! nl2br(e($beranda->appointment_description)) !!}</p>
                    </div>
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="bg-light rounded h-100 d-flex align-items-center p-5">
                            <div class="row g-3">
                                <div class="bg-light rounded d-flex align-items-center p-5 mb-4">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white"
                                        style="width: 55px; height: 55px;">
                                        <i class="fa fa-phone-alt text-success"></i>
                                    </div>
                                    <div class="ms-4">
                                        <p class="mb-2">Call Us Now</p>
                                        <h5 class="mb-0">{{ $beranda->contact_phone }}</h5>
                                    </div>
                                </div>
                                <div class="bg-light rounded d-flex align-items-center p-5">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white"
                                        style="width: 55px; height: 55px;">
                                        <i class="fa fa-envelope-open text-success"></i>
                                    </div>
                                    <div class="ms-4">
                                        <p class="mb-2">Mail Us Now</p>
                                        <h5 class="mb-0">{{ $beranda->contact_email }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Appointment End -->
    @else
        <div class="container py-5 text-center">
            <p>Konten belum diatur. Silakan login sebagai admin untuk mengelola konten halaman ini.</p>
        </div>
    @endif
@endsection
