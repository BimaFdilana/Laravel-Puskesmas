@extends('layouts.beranda')

@section('title', 'Beranda')

@section('content')
    <div class="container-fluid py-5 mb-5 hero-header" style="height: 100vh; padding-top: 0 !important;">
        <div class="container py-5" style="height: 100vh;">
            <div class="row g-5 align-items-center" style="height:100vh;">
                <div class="col-md-12 col-lg-6">
                    <h4 class="mb-3 text-black" style="font-weight: bold;">Selamat Datang!</h4>
                    <h2 class="mb-5 text-primary" style="border-bottom: 3px solid; font-weight: bold;">Web Puskesmas Meskom
                    </h2>
                    <h5 class="mb-3 text-black" style="font-style:italic;">Sistem ini mendukung pelayanan
                        kesehatan yang optimal untuk seluruh pustu di bawah naungan Puskesmas Meskom</h5>
                    <div class="dropdown">
                        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu2"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Mari Bergabung
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <a href="{{ route('login') }}"><button class="dropdown-item" type="button">Pustu</button></a>
                            <a href="{{ route('login') }}"><button class="dropdown-item"
                                    type="button">Puskesmas</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
