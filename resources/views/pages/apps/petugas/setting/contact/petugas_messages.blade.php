@extends('layouts.app')

@section('title', 'Pesan Masuk')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pesan Masuk dari Pengunjung</h1>
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
                                        <th style="width: 5%;">No.</th>
                                        <th style="width: 15%;">Tanggal</th>
                                        <th style="width: 20%;">Nama Pengirim</th>
                                        <th style="width: 20%;">Email</th>
                                        <th>Subjek & Pesan</th>
                                        <th class="text-center" style="width: 10%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($messages as $index => $message)
                                        <tr>
                                            <td>{{ $messages->firstItem() + $index }}</td>
                                            <td>{{ $message->created_at->format('d M Y, H:i') }}</td>
                                            <td>{{ $message->name }}</td>
                                            <td>{{ $message->email }}</td>
                                            <td>
                                                <strong>{{ $message->subject }}</strong>
                                                <p class="mt-2 mb-0">{{ Str::limit($message->message, 100) }}</p>
                                            </td>
                                            <td class="text-center">
                                                <form action="{{ route('admin.messages.destroy', $message->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fas fa-trash"></i> Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Belum ada pesan yang masuk.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="float-right">
                            {{ $messages->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
