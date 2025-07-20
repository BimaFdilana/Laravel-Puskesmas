@extends('layouts.app')

@section('title', 'Setting Akun')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                @if (Route::currentRouteName() == 'admin.account.setting')
                    <h1>Setting Akun</h1>
                @else
                    <h1>Edit Data Akun Pustu</h1>
                @endif
            </div>

            <div class="section-body">
                <div class="card">
                    <form action="{{ route('admin.account.update', $users->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible show fade">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert"><span>&times;</span></button>
                                        {{ session('success') }}
                                    </div>
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $users->name) }}" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $users->email) }}" required>
                            </div>
                            <div class="form-group">
                                <label>Password Baru</label>
                                <input type="password" name="password" class="form-control">
                                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
