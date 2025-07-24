@extends('layouts.app')

@section('title', 'Tambah Data Imunisasi WUS & Bumil')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Data Imunisasi WUS & Bumil</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <form action="{{ route('imunisasi-wus-bumil.store') }}" method="POST">
                        @csrf
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            @include('pages.apps.pustu.imunisasi.bumil._form')
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('imunisasi-wus-bumil.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
