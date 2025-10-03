@extends('layouts.app')

@section('title', 'Edit Data Imunisasi WUS & Bumil')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Data Imunisasi WUS & Bumil</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <form action="{{ route('imunisasi-wus-bumil.update', $imunisasiWusBumil->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            @include('pages.apps.pustu.imunisasi.bumil._form', [
                                'imunisasiWusBumil' => $imunisasiWusBumil,
                            ])
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-danger">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
