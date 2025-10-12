    @extends('layouts.app')
    @section('title', 'Edit Data Bayi')
    @section('main')
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Edit Data Bayi</h1>
                </div>
                <div class="section-body">
                    <div class="card">
                        <form action="{{ route('bayi.update', $bayi->id) }}" method="POST">
                            @csrf @method('PUT')
                            <div class="card-body">@include('pages.apps.pustu.imunisasi.bayi.nama_bayi._form', ['bayi' => $bayi])</div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-danger">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    @endsection
