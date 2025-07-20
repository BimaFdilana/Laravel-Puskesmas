@extends('layouts.beranda')

@section('title', 'Tentang Kami')

@section('content')
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-3 text-success mb-3 animated slideInDown">About Us</h1>
        </div>
    </div>

    @if ($beranda)
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="d-flex flex-column">
                            <img class="img-fluid rounded w-75 align-self-end"
                                src="{{ asset('storage/' . $beranda->about_image_1) }}" alt="Tentang Kami 1">
                            <img class="img-fluid rounded w-50 bg-white pt-3 pe-3"
                                src="{{ asset('storage/' . $beranda->about_image_2) }}" alt="Tentang Kami 2"
                                style="margin-top: -25%;">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <p class="d-inline-block border rounded-pill py-1 px-4">About Us</p>
                        <h1 class="mb-4">{{ $beranda->about_title }}</h1>
                        <p>{!! nl2br(e($beranda->about_description)) !!}</p>
                        @php
                            $points = explode("\n", $beranda->about_points);
                        @endphp

                        @foreach ($points as $point)
                            @if (trim($point) !== '')
                                <p><i class="far fa-check-circle text-success me-3"></i>{{ trim($point) }}</p>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container py-5 text-center">
            <p>Konten "Tentang Kami" belum diatur oleh admin.</p>
        </div>
    @endif
@endsection
