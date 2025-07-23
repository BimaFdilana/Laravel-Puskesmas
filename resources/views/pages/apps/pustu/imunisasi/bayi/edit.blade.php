@extends('layouts.app')

@section('title', 'Edit Data Imunisasi Bayi')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
            </div>
            <div class="section-body">
                <div class="card">
                    <form action="{{ route('imunisasi-bayi.update', $imunisasiBayi->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Formulir Data</h4>
                        </div>
                        <div class="card-body">
                            @include('pages.apps.pustu.imunisasi.bayi._form', ['imunisasiBayi' => $imunisasiBayi])
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('imunisasi-bayi.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
