    @extends('layouts.app')
    @section('title', 'Master Data Bayi')
    @section('main')
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Master Data Bayi</h1>
                </div>
                <div class="card-header-action">
                    <a href="{{ route('bayi.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Tambah
                        Bayi</a>
                </div>
                <div class="section-body">
                    <div class="card">
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Bayi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data as $index => $item)
                                            <tr>
                                                <td>{{ $data->firstItem() + $index }}</td>
                                                <td>{{ $item->nama_bayi }}</td>
                                                <td>
                                                    <form action="{{ route('bayi.destroy', $item->id) }}" method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                        <a href="{{ route('bayi.edit', $item->id) }}"
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
