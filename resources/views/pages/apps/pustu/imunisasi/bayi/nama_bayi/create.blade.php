    @extends('layouts.app')
    @section('title', 'Tambah Data Bayi')
    @section('main')
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Tambah Data Bayi</h1>
                </div>
                <div class="section-body">
                    <div class="card">
                        <form action="{{ route('bayi.store') }}" method="POST">
                            @csrf
                            <div class="card-body">@include('pages.apps.pustu.imunisasi.bayi.nama_bayi._form')</div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-danger">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    @endsection
