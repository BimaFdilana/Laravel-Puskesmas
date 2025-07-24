@extends('layouts.app')
@section('title', 'Tambah Data Posyandu')
@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Data Posyandu</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <form action="{{ route('posyandu.store') }}" method="POST">
                        @csrf
                        <div class="card-body">@include('pages.apps.pustu.imunisasi.posyandu._form')</div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('posyandu.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
