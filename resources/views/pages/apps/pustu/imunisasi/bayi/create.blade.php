@extends('layouts.app')

@section('title', 'Tambah Data Imunisasi Bayi')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
            </div>
            <div class="section-body">
                <div class="card">
                    <form action="{{ route('imunisasi-bayi.store') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4>Formulir Data</h4>
                        </div>
                        <div class="card-body">
                            @include('pages.apps.pustu.imunisasi.bayi._form')
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-danger">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#nama_bayi_select').on('change', function() {
                var selectedOption = $(this).find('option:selected');
                $('#nama_orang_tua').val(selectedOption.data('nama_ortu'));
                $('#tanggal_lahir').val(selectedOption.data('tgl_lahir'));
                $('#jenis_kelamin').val(selectedOption.data('jk'));
                $('#alamat_lengkap').val(selectedOption.data('alamat'));
                $('#nik_orang_tua').val(selectedOption.data('nik_ortu'));
                $('#nik_bayi').val(selectedOption.data('nik_bayi'));
            });
        });
    </script>
@endpush
