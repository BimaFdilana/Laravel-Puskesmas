@extends('layouts.app')
@section('title', 'Edit Data Posyandu')
@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Data Posyandu</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <form action="{{ route('posyandu.update', $posyandu->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="card-body">@include('pages.apps.pustu.imunisasi.posyandu._form', ['posyandu' => $posyandu])</div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('posyandu.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
