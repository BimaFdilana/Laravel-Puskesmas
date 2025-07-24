@extends('layouts.app')
@section('title', 'Master Data Posyandu')
@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Master Data Posyandu</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Posyandu</h4>
                        <div class="card-header-action">
                            <a href="{{ route('posyandu.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah
                                Baru</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Posyandu</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $index => $item)
                                        <tr>
                                            <td>{{ $data->firstItem() + $index }}</td>
                                            <td>{{ $item->nama_posyandu }}</td>
                                            <td>
                                                <form action="{{ route('posyandu.destroy', $item->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin?');">
                                                    <a href="{{ route('posyandu.edit', $item->id) }}"
                                                        class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Belum ada data.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
